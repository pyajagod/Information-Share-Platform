<?php
require("../../class/connect.php");
include("../../data/cache/public.php");
include("../../class/db_sql.php");
include("../../class/functions.php");
include("class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"dbdata");
$mypath=$_GET['mypath'];
$mydbname=$_GET['mydbname'];
$selectdbname=$phome_db_dbname;
if($mydbname)
{
	$selectdbname=$mydbname;
}
$bakpath=$public_r['bakdbpath'];
$db='';
if($public_r['ebakcanlistdb'])
{
	$db.="<option value='".$selectdbname."' selected>".$selectdbname."</option>";
}
else
{
	$sql=$empire->query("SHOW DATABASES");
	while($r=$empire->fetch($sql))
	{
		if($r[0]==$selectdbname)
		{$select=" selected";}
		else
		{$select="";}
		$db.="<option value='".$r[0]."'".$select.">".$r[0]."</option>";
	}
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�ָ�����</title>
<link href="../../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã�<a href="ReData.php">�ָ�����</a></td>
  </tr>
</table>
<form action="phome.php" method="post" name="ebakredata" target="_blank" onsubmit="return confirm('ȷ��Ҫ�ָ���');">
  <table width="70%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="34%" height="25">�ָ����� 
        <input name="phome" type="hidden" id="phome" value="ReData"></td>
      <td width="66%" height="25">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ָ�����ԴĿ¼��</td>
      <td height="25">
        <?=$bakpath?>
        / 
        <input name="mypath" type="text" id="mypath" value="<?=$mypath?>">
        <input type="button" name="Submit2" value="ѡ��Ŀ¼" onclick="javascript:window.open('ChangePath.php?change=1','','width=600,height=500,scrollbars=yes');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">Ҫ��������ݿ⣺</td>
      <td height="25"> <select name="add[mydbname]" size="23" id="add[mydbname]" style="width=200">
          <?=$db?>
        </select></td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td height="25">�ָ�ѡ�</td>
      <td height="25">ÿ��ָ������ 
        <input name="add[waitbaktime]" type="text" id="add[waitbaktime]" value="0" size="2">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"> <div align="left"> 
          <input type="submit" name="Submit" value="��ʼ�ָ�">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
