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
CheckLevel($myuserid,$myusername,$classid,"group");
$url="λ�ã�<a href=ListGroup.php>�û������</a>&nbsp;>&nbsp;�����û���";
//Ĭ��ֵ
$checked="";
$doall=$checked;
$dopublic=$checked;
$doclass=$checked;
$dotemplate=$checked;
$dofile=$checked;
$douser=$checked;
$dolog=$checked;
$domember=$checked;
$dogroup=$checked;
$dolanguage=$checked;
$dosofttype=$checked;
$dosq=$checked;
$dofj=$checked;
$doerror=$checked;
$dorepip=$checked;
$doad=$checked;
$dogg=$checked;
$dovote=$checked;
$dodbdata=$checked;
$dodownurl=$checked;
$dopl=$checked;
$dochangedata=$checked;
$dolink=$checked;

$phome=$_GET['phome'];
//�޸��û���
if($phome=="EditGroup")
{
	$groupid=(int)$_GET['groupid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downgroup where groupid='$groupid'");
	$url="λ�ã�<a href=ListGroup.php>�û������</a>&nbsp;>&nbsp;�޸��û��飺".$r[groupname];
	if($r[doall])
	{
		$doall=" checked";
	}
	if($r[dopublic])
	{
		$dopublic=" checked";
	}
	if($r[doclass])
	{
		$doclass=" checked";
	}
	if($r[dotemplate])
	{
		$dotemplate=" checked";
	}
	if($r[dofile])
	{
		$dofile=" checked";
	}
	if($r[douser])
	{
		$douser=" checked";
	}
	if($r[dolog])
	{
		$dolog=" checked";
	}
	if($r[domember])
	{
		$domember=" checked";
	}
	if($r[dogroup])
	{
		$dogroup=" checked";
	}
	if($r[dolanguage])
	{
		$dolanguage=" checked";
	}
	if($r[dosofttype])
	{
		$dosofttype=" checked";
	}
	if($r[dosq])
	{
		$dosq=" checked";
	}
	if($r[dofj])
	{
		$dofj=" checked";
	}
	if($r[doerror])
	{
		$doerror=" checked";
	}
	if($r[dorepip])
	{
		$dorepip=" checked";
	}
	if($r[doad])
	{
		$doad=" checked";
	}
	if($r[dogg])
	{
		$dogg=" checked";
	}
	if($r[docard])
	{
		$docard=" checked";
	}
	if($r[dovote])
	{
		$dovote=" checked";
	}
	if($r[dodbdata])
	{
		$dodbdata=" checked";
	}
	if($r[dodownurl])
	{
		$dodownurl=" checked";
	}
	if($r[dopl])
	{
		$dopl=" checked";
	}
	if($r[dochangedata])
	{
		$dochangedata=" checked";
	}
	if($r[dolink])
	{
		$dolink=" checked";
	}
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�û���</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="adminphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">�����û��� 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> <input name="gr[groupid]" type="hidden" id="gr[groupid]" value="<?=$groupid?>"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2"><strong>����</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%" height="25">�û������ƣ�</td>
      <td width="71%" height="25"><input name="gr[groupname]" type="text" id="gr[groupname]" value="<?=$r[groupname]?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2"><strong>Ȩ��</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>��������������ϢȨ��:</strong></td>
      <td height="25"><input name="gr[doall]" type="checkbox" id="gr[doall]" value="1"<?=$doall?>>
        ��(�Ƽ������ڹ���Ա��Ч)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�������ã�</td>
      <td height="25"><input name="gr[dopublic]" type="checkbox" id="gr[dopublic]" value="1"<?=$dopublic?>>
        �� </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�������</td>
      <td height="25"><input name="gr[doclass]" type="checkbox" id="gr[doclass]" value="1"<?=$doclass?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ģ�����</td>
      <td height="25"><input name="gr[dotemplate]" type="checkbox" id="gr[public]3" value="1"<?=$dotemplate?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��������</td>
      <td height="25"><input name="gr[dofile]" type="checkbox" id="gr[public]5" value="1"<?=$dofile?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����û���</td>
      <td height="25"><input name="gr[douser]" type="checkbox" id="gr[public]6" value="1"<?=$douser?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">������־��</td>
      <td height="25"><input name="gr[dolog]" type="checkbox" id="gr[public]7" value="1"<?=$dolog?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����Ա��</td>
      <td height="25"><input name="gr[domember]" type="checkbox" id="gr[public]8" value="1"<?=$domember?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�û������</td>
      <td height="25"><input name="gr[dogroup]" type="checkbox" id="gr[dovote]" value="1"<?=$dogroup?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����������ԣ�</td>
      <td height="25"><input name="gr[dolanguage]" type="checkbox" id="gr[dogroup]" value="1"<?=$dolanguage?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����������ͣ�</td>
      <td height="25"><input name="gr[dosofttype]" type="checkbox" id="gr[dogroup]2" value="1"<?=$dosofttype?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���������Ȩ��</td>
      <td height="25"><input name="gr[dosq]" type="checkbox" id="gr[dogroup]3" value="1"<?=$dosq?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�������������</td>
      <td height="25"><input name="gr[dofj]" type="checkbox" id="gr[dogroup]4" value="1"<?=$dofj?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">������󱨸棺</td>
      <td height="25"><input name="gr[doerror]" type="checkbox" id="gr[dogroup]5" value="1"<?=$doerror?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����滻��ַ��</td>
      <td height="25"><input name="gr[dorepip]" type="checkbox" id="gr[dogroup]6" value="1"<?=$dorepip?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����棺</td>
      <td height="25"><input name="gr[doad]" type="checkbox" id="gr[dogroup]7" value="1"<?=$doad?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����棺</td>
      <td height="25"><input name="gr[dogg]" type="checkbox" id="gr[dogroup]8" value="1"<?=$dogg?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�㿨����</td>
      <td height="25"><input name="gr[docard]" type="checkbox" id="gr[dogg]" value="1"<?=$docard?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ͶƱ����</td>
      <td height="25"><input name="gr[dovote]" type="checkbox" id="gr[dogg]" value="1"<?=$dovote?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ݱ��ݹ���</td>
      <td height="25"><input name="gr[dodbdata]" type="checkbox" id="gr[dogg]" value="1"<?=$dodbdata?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ַǰ׺����</td>
      <td height="25"><input name="gr[dodownurl]" type="checkbox" id="gr[dogg]" value="1"<?=$dodownurl?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����������ۣ�</td>
      <td height="25"><input name="gr[dopl]" type="checkbox" id="gr[dogg]" value="1"<?=$dopl?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">������������ݣ�</td>
      <td height="25"><input name="gr[dochangedata]" type="checkbox" id="gr[dogg]" value="1"<?=$dochangedata?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�������ӹ���</td>
      <td height="25"><input name="gr[dolink]" type="checkbox" id="gr[dogg]" value="1"<?=$dolink?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����ר�⣺</td>
      <td height="25"><input name="gr[dozt]" type="checkbox" id="gr[dozt]" value="1"<?=$r[dozt]==1?' checked':''?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����Զ����б�</td>
      <td height="25"><input name="gr[douserlist]" type="checkbox" id="gr[douserlist]" value="1"<?=$r[douserlist]==1?' checked':''?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����������</td>
      <td height="25"><input name="gr[doplayer]" type="checkbox" id="gr[doplayer]" value="1"<?=$r[doplayer]==1?' checked':''?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�����Զ���ҳ�棺</td>
      <td height="25"><input name="gr[douserpage]" type="checkbox" id="gr[douserpage]" value="1"<?=$r[douserpage]==1?' checked':''?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�����ֵ���ͣ�</td>
      <td height="25"><input name="gr[dobuygroup]" type="checkbox" id="gr[dobuygroup]" value="1"<?=$r[dobuygroup]==1?' checked':''?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">��������֧����</td>
      <td height="25"><input name="gr[dopay]" type="checkbox" id="gr[dopay]" value="1"<?=$r[dopay]==1?' checked':''?>>
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�ύ"> <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
