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
CheckLevel($myuserid,$myusername,$classid,"member");
$phome=$_GET['phome'];
$r[favanum]=50;
$url="<a href=ListMemberGroup.php>�����Ա��</a>&nbsp;>&nbsp;���ӻ�Ա��";
if($phome=="EditMemberGroup")
{
	$groupid=(int)$_GET['groupid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downmembergroup where groupid='$groupid'");
	$url="<a href=ListMemberGroup.php>�����Ա��</a>&nbsp;>&nbsp;�޸Ļ�Ա�飺".$r[groupname];
	if($r[checked])
	{$checked=" checked";}
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>���ӻ�Ա��</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td height="25">λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="memberphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">���ӻ�Ա�� <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
        <input name="add[groupid]" type="hidden" id="add[groupid]" value="<?=$groupid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="30%" height="25">��Ա�����ƣ�</td>
      <td width="70%" height="25"> <input name="add[groupname]" type="text" id="add[groupname]" value="<?=$r[groupname]?>">
        (���磺VIP��Ա,��ͨ��Ա)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��Ա�鼶��ֵ��</td>
      <td height="25"> <input name="add[level]" type="text" id="add[level]" value="<?=$r[level]?>" size="6">
        (�磺1,2...�ȣ�����ֵԽ�ߣ����ص�Ȩ��Խ��)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ղؼ��������</td>
      <td height="25"><input name="add[favanum]" type="text" id="add[favanum]" value="<?=$r[favanum]?>" size="6">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ÿ�������������</td>
      <td height="25"><input name="add[daydown]" type="text" id="add[daydown]" value="<?=$r[daydown]?>" size="6">
        ��(0Ϊ������)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="�ύ"> <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
