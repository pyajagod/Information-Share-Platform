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
CheckLevel($myuserid,$myusername,$classid,"user");
$phome=$_GET['phome'];
$url="<a href=ListUser.php>�û�����</a>&nbsp;>�����û�";
if($phome=="EditUser")
{
	$userid=(int)$_GET['userid'];
	$r=$empire->fetch1("select username,adminclass,groupid from {$dbtbpre}downuser where userid='$userid'");
	$url="<a href=ListUser.php>�û�����</a>&nbsp;>�޸��û���".$r[username];
}
//-----------�û���
$sql=$empire->query("select groupid,groupname from {$dbtbpre}downgroup order by groupid desc");
while($gr=$empire->fetch($sql))
{
	if($r[groupid]==$gr[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$group.="<option value=".$gr[groupid].$select.">".$gr[groupname]."</option>";
}
//--------------------��������Ŀ
$class=ShowClass_AddClass($r[adminclass],"n",0,"|-",3);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�����û�</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="adminphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">�����û� 
        <input name="userid" type="hidden" id="userid" value="<?=$userid?>">
        <input name="oldusername" type="hidden" id="oldusername" value="<?=$r[username]?>">
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>">
        </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="28%" height="25">�û�����</td>
      <td width="72%" height="25"><input name="username" type="text" id="username" value="<?=$r[username]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���룺</td>
      <td height="25"><input name="password" type="password" id="password">
        (�����޸�������)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ظ����룺</td>
      <td height="25"><input name="repassword" type="password" id="repassword">
        (�����޸�������)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�û��飺</td>
      <td height="25"><select name="groupid" id="groupid">
          <?=$group?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2" valign="top"> <p>������ࣺ<br>
          <br>
          (���������ctrl��) </p></td>
      <td height="25" valign="top"> <select name="adminclass[]" size="12" multiple id="adminclass[]" style="width:210;">
          <?=$class?>
        </select> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ע�����<font color="#FF0000">ѡ�񸸷����Ӧ�����ӷ��࣬�������ѡ�񸸷��࣬����ѡ�����ӷ���</font>)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�ύ"> <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>
