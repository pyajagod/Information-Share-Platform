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
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>导入/导出模板</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td>位置：导入/导出模板</td>
  </tr>
</table>
  
<br>
<br>
<br>
<table width="420" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="90%" height="25"><div align="center">导出模板</div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <input type="button" name="Submit6" value="导出模板" onclick="self.location.href='tempphome.php?phome=LoadTempGroup';">
      </div></td>
  </tr>
</table>
  <br>
<br>
<br>
<br>
<br>
<form action="tempphome.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('确认要导入?');">
  <table width="420" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <input type=hidden name=phome value=LoadInTempGroup>
    <tr class="header"> 
      <td height="25" colspan="2">导入模板</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="24%" height="25">选择文件</td>
      <td width="76%"> <input type="file" name="file">
        *.temp</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="导入模板"> </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">&nbsp;</td>
      <td height="25"><font color="#666666">提示：导入模板前建议先导出模板（备份原来模板）。</font></td>
    </tr>
  </table>
</form>
</body>
</html>
