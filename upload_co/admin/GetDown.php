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
CheckLevel($myuserid,$myusername,$classid,"card");
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�������͵���</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ��: �������͵���</td>
  </tr>
</table>
<form name="form1" method="post" action="memberphome.php">
  <table width="60%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25"><div align="center"><font color="#FFFFFF">�������ӵ��� </font>
          <input name="phome" type="hidden" id="phome" value="GetDown_all">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">����������� 
          <input name="downfen" type="text" id="downfen" value="0" size="6">
          �� 
          <input type="submit" name="Submit" value="��������">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
