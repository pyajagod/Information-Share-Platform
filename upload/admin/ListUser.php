<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"user");
$sql=$empire->query("select * from {$dbtbpre}downuser order by userid desc");
$url="<a href=ListUser.php>管理用户</a>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理用户</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置： 
      <?=$url?>
    </td>
    <td><div align="right">
        <input type="button" name="Submit" value="增加用户" onclick="self.location.href='AddUser.php?phome=AddUser';">
      </div></td>
  </tr>
</table>
<form name="form1" method="post" action="adminphome.php">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="7%" height="25"><div align="center">ID</div></td>
      <td width="27%" height="25"><div align="center">用户名</div></td>
      <td width="23%" height="25"><div align="center">用户组</div></td>
      <td width="9%"><div align="center">登陆次数</div></td>
      <td width="20%"><div align="center">最后登陆</div></td>
      <td width="14%" height="25"><div align="center">操作</div></td>
    </tr>
    <?
	while($r=$empire->fetch($sql))
	{
		$gr=$empire->fetch1("select groupname from {$dbtbpre}downgroup where groupid='$r[groupid]'");
		$lasttime='---';
  		if($r[lasttime])
  		{
  			$lasttime=date("Y-m-d H:i:s",$r[lasttime]);
  		}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center"> 
          <?=$r[userid]?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[username]?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$gr[groupname]?>
        </div></td>
      <td><div align="center"><?=$r[loginnum]?></div></td>
      <td><div align="center"><a title="最后登陆IP：<?=$r[lastip]?>"><?=$lasttime?></a></div></td>
      <td height="25"><div align="center">[<a href="AddUser.php?phome=EditUser&userid=<?=$r[userid]?>">修改</a>] 
          [<a href="adminphome.php?phome=DelUser&userid=<?=$r[userid]?>" onclick="return confirm('您是否要删除？');">删除</a>]</div></td>
    </tr>
    <?
  }
  ?>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>
