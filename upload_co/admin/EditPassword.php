<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>�޸�����</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã��޸�����</td>
  </tr>
</table>
<form name="form1" method="post" action="adminphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">�޸�����
        <input name="phome" type="hidden" id="phome" value="EditPassword">
        </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="27%" height="25">�û�����</td>
      <td width="73%" height="25"><?=$myusername?></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����룺</td>
      <td height="25"><input name="oldpassword" type="password" id="oldpassword"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����룺</td>
      <td height="25"><input name="password" type="password" id="password"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ظ������룺</td>
      <td height="25"><input name="repassword" type="password" id="repassword"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�ύ">
        <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
