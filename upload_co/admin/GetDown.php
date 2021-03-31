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
CheckLevel($myuserid,$myusername,$classid,"card");
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>批量赠送点数</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置: 批量赠送点数</td>
  </tr>
</table>
<form name="form1" method="post" action="memberphome.php">
  <table width="60%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25"><div align="center"><font color="#FFFFFF">批量增加点数 </font>
          <input name="phome" type="hidden" id="phome" value="GetDown_all">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">请输入点数： 
          <input name="downfen" type="text" id="downfen" value="0" size="6">
          点 
          <input type="submit" name="Submit" value="批量增加">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
