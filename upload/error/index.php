<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
$link=db_connect();
$empire=new mysqlquery();
$softid=(int)$_GET['softid'];
$r=$empire->fetch1("select softname,softid,filename,titleurl from {$dbtbpre}down where softid='$softid'");
if(!$r[softid])
{
	echo"<script>alert('�����ز�����');window.close();</script>";
	exit();
}
$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>���ʹ��󱨸�</title>
<link href="../data/images/qcss.css" rel="stylesheet" type="text/css">
</head>

<body>
  
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="../phome/index.php" onsubmit="return confirm('ȷ�Ϸ��ͣ�');">
  <input type=hidden name=phome value=AddError>
  <input type=hidden name=softid value="<?=$softid?>">
    <tr class="header"> 
      <td height="25" colspan="2">���ʹ��󱨸�</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="20%" height="25">������ƣ�</td>
      <td width="80%" height="25"><a href="<?=$softurl?>"><?=$r[softname]?></a></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�������ݣ�</td>
      <td height="25"> <textarea name="errortext" cols="55" rows="6" id="errortext"></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"></td>
      <td height="25"> <input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="����"></td>
    </tr>
	</form>
  </table>
</body>
</html>
