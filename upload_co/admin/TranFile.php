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

$classid=(int)$_GET['classid'];
$filepass=(int)$_GET['filepass'];
$softname=$_GET['softname'];
$field=$_GET['field'];
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�ϴ��ļ�</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<form action="filephome.php" method="post" enctype="multipart/form-data" name="form1">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <input type=hidden name=filepass value="<?=$filepass?>">
    <input type=hidden name=classid value="<?=$classid?>">
	<input type=hidden name=field value="<?=$field?>">
    <tr class="header"> 
      <td height="25"><strong><font color="#FFFFFF">�ϴ��ļ�</font></strong></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ϴ��ļ��� 
        <input type="file" name="file"> <input type="submit" name="Submit" value="�ϴ�"> 
        <input name="phome" type="hidden" id="phome" value="TranFile"> </td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�ļ�˵���� 
        <input name="fileno" type="text" id="fileno" value="<?=$softname?>">
        <font color="#666666">(���ڸ�������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">������ļ����ͣ�<font color=red> 
        <?=substr($public_r[trantype],1,strlen($public_r[trantype])-2);?>
        </font><br>
        ������ļ���С��<font color=red> 
        <?=$public_r[transize]?>
        </font>KB</td>
    </tr>
  </table>
</form>
</body>
</html>
