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
CheckLevel($myuserid,$myusername,$classid,"gg");
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=10;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
$query="select ggid,title,ggtime from {$dbtbpre}downgg";
$num=$empire->num($query);//取得总条数
$query=$query." order by ggid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理公告</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：管理公告</td>
    <td> <div align="right">
        <input type="button" name="Submit" value="增加公告" onclick="self.location.href='AddGg.php?phome=AddGg';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"> <div align="center">ID</div></td>
    <td width="45%" height="25"> <div align="center">标题</div></td>
    <td width="30%" height="25"> <div align="center">时间</div></td>
    <td width="20%" height="25"> <div align="center">操作</div></td>
  </tr>
  <?
  $ggurl=EDReturnGgUrl();
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <?=$r[ggid]?>
      </div></td>
    <td height="25"><a href="<?=$ggurl?>#gg<?=$r[ggid]?>" target="_blank"> 
        <?=$r[title]?>
        </a></td>
    <td height="25"> <div align="center"> 
        <?=$r[ggtime]?>
      </div></td>
    <td height="25"> <div align="center">[<a href="AddGg.php?phome=EditGg&ggid=<?=$r[ggid]?>">修改</a>] 
        [<a href="comphome.php?phome=DelGg&ggid=<?=$r[ggid]?>" onclick="return confirm('确认要删除?');">删除</a>]</div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="4"> 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>
