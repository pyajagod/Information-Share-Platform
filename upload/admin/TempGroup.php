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
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"template");
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>����/����ģ��</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td>λ�ã�����/����ģ��</td>
  </tr>
</table>
  
<br>
<br>
<br>
<table width="420" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="90%" height="25"><div align="center">����ģ��</div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <input type="button" name="Submit6" value="����ģ��" onclick="self.location.href='tempphome.php?phome=LoadTempGroup';">
      </div></td>
  </tr>
</table>
  <br>
<br>
<br>
<br>
<br>
<form action="tempphome.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('ȷ��Ҫ����?');">
  <table width="420" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <input type=hidden name=phome value=LoadInTempGroup>
    <tr class="header"> 
      <td height="25" colspan="2">����ģ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="24%" height="25">ѡ���ļ�</td>
      <td width="76%"> <input type="file" name="file">
        *.temp</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="����ģ��"> </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">&nbsp;</td>
      <td height="25"><font color="#666666">��ʾ������ģ��ǰ�����ȵ���ģ�壨����ԭ��ģ�壩��</font></td>
    </tr>
  </table>
</form>
</body>
</html>
