<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"member");
$url="<a href=ListMemberGroup.php>管理会员组";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理会员组</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
    <td>位置：
      <?=$url?>
    </td>
    <td><div align="right">
        <input type="button" name="Submit" value="增加会员组" onclick="self.location.href='AddMemberGroup.php?phome=AddMemberGroup';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="8%" height="25"> <div align="center">ID</div></td>
    <td width="40%" height="25"> <div align="center">会员组名称</div></td>
    <td width="14%"><div align="center">级别值</div></td>
    <td width="15%" height="25"> <div align="center">本组会员数</div></td>
    <td width="23%" height="25"> <div align="center">操作</div></td>
  </tr>
  <?
  $sql=$empire->query("select * from {$dbtbpre}downmembergroup order by level desc");
  while($r=$empire->fetch($sql))
  {
  //统计会员数
  $t=$empire->fetch1("select count(*) as total from ".$user_tablename." where ".$user_group."='$r[groupid]'");
  $total=$t[total];
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <?=$r[groupid]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[groupname]?>
      </div></td>
    <td><div align="center"> 
        <?=$r[level]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$total?>
      </div></td>
    <td height="25"> <div align="center">[<a href="AddMemberGroup.php?phome=EditMemberGroup&groupid=<?=$r[groupid]?>">修改</a>] 
        [<a href="memberphome.php?phome=DelMemberGroup&groupid=<?=$r[groupid]?>" onclick="return confirm('确认要删除此会员组？');">删除</a>]</div></td>
  </tr>
  <?
  }
  db_close();
  $empire=null;
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="5">说明：级别值越高，下载的权限越大</td>
  </tr>
</table>
</body>
</html>
