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
CheckLevel($myuserid,$myusername,$classid,"template");
$url="<a href=ListSofttemp.php>管理内容模板</a>";
$sql=$empire->query("select tempid,tempname from {$dbtbpre}downsofttemp");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理內容模板</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：
      <?=$url?>
    </td>
    <td><div align="right">
        <input type="button" name="Submit" value="增加内容模板" onclick="self.location.href='AddSofttemp.php?phome=AddSofttemp';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="13%" height="25"><div align="center"><strong>ID</strong></div></td>
    <td width="52%" height="25"><div align="center"><strong>模板名</strong></div></td>
    <td width="35%" height="25"><div align="center"><strong>操作</strong></div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="ffffff"> 
    <td height="25"><div align="center"> 
        <?=$r[tempid]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[tempname]?>
      </div></td>
    <td height="25"><div align="center"> [<a href="AddSofttemp.php?phome=EditSofttemp&tempid=<?=$r[tempid]?>">修改</a>] 
        [<a href="tempphome.php?phome=DelSofttemp&tempid=<?=$r[tempid]?>" onclick="return confirm('确认要删除？');">删除</a>]</div></td>
  </tr>
  <?
  }
  ?>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>
