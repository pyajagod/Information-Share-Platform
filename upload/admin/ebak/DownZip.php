<?php
require("../../class/connect.php");
include("../../data/cache/public.php");
include("../../class/db_sql.php");
include("../../class/functions.php");
include("class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"dbdata");
$bakzippath=$public_r['bakdbzip'];
$p=$_GET['p'];
$f=$_GET['f'];
$file=$bakzippath."/".$f;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>下载压缩包</title>
<link href="../../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
  <tr> 
    <td height="30"> <div align="center"><strong><font color="#FFFFFF">下载压缩包(目录： 
        <?=$p?>
        )</font></strong></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF"> 
      <div align="center">[<a href="<?=$file?>">下载压缩包</a>]</div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF"> 
      <div align="center">[<a href="phome.php?f=<?=$f?>&phome=DelZip" onclick="return confirm('确认要删除？');">删除压缩包</a>]</div></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">
<div align="center">（<font color="#FF0000">说明：安全起见，下载完毕请马上删除压缩包．</font>）</div></td>
  </tr>
</table>
</body>
</html>
