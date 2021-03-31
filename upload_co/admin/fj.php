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
$url="�����������";
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"fj");

//�����������
function AddFj($fjname,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($fjname))
	{
		printerror("�����������������","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"fj");
	$sql=$empire->query("insert into {$dbtbpre}fj(fjname) values('$fjname');");
	if($sql)
	{
		printerror("������������ɹ�","fj.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸��������
function EditFj($fjid,$fjname,$userid,$username){
	global $empire,$dbtbpre;
	$fjid=(int)$fjid;
	if(!$fjid||!$fjname)
	{
		printerror("�����������������","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"fj");
	$sql=$empire->query("update {$dbtbpre}fj set fjname='$fjname' where fjid='$fjid'");
	if($sql)
	{
		printerror("�޸���������ɹ�","fj.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ���������
function DelFj($fjid,$userid,$username){
	global $empire,$dbtbpre;
	$fjid=(int)$fjid;
	if(empty($fjid))
	{
		printerror("��ѡ��Ҫɾ�����������","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"fj");
	$sql=$empire->query("delete from {$dbtbpre}fj where fjid='$fjid'");
	if($sql)
	{
		printerror("ɾ����������ɹ�","fj.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="AddFj")//�����������
{
	$fjname=$_POST['fjname'];
	AddFj($fjname,$myuserid,$myusername);
}
elseif($phome=="EditFj")//�޸��������
{
	$fjid=$_POST['fjid'];
	$fjname=$_POST['fjname'];
	EditFj($fjid,$fjname,$myuserid,$myusername);
}
elseif($phome=="DelFj")//ɾ���������
{
	$fjid=$_GET['fjid'];
	DelFj($fjid,$myuserid,$myusername);
}

$sql=$empire->query("select fjid,fjname from {$dbtbpre}fj");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�������</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="fj.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr>
      <td bgcolor="#FFFFFF">
<div align="center">������������� 
          <input name="fjname" type="text" id="fjname">
          <input type="submit" name="Submit" value="����">
          <input name="phome" type="hidden" id="phome" value="AddFj">
        </div></td>
    </tr>
  </table>
</form>

<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="12%" height="25"> <div align="center">ID</div></td>
    <td width="52%" height="25"> <div align="left">�������</div></td>
    <td width="36%" height="25"> <div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  	if($r[isdefault])
  	{$bgcolor="#DBEAF5";}
  	else
  	{$bgcolor="ffffff";}
  ?>
  <form name=form1 method=post action="fj.php">
    <tr bgcolor="<?=$bgcolor?>"> 
      <td height="25"> <div align="center"> 
          <?=$r[fjid]?>
        </div></td>
      <td height="25"> <div align="left"> 
          <input name="fjname" type="text" id="fjname" value="<?=$r[fjname]?>">
        </div></td>
      <td height="25"> <div align="center"> 
          <input name="phome" type="hidden" id="phome" value="EditFj">
          <input name="fjid" type="hidden" id="fjid" value="<?=$r[fjid]?>">
          <input type="submit" name="Submit2" value="�޸�">
          &nbsp; 
          <input type="button" name="Submit3" value="ɾ��" onclick="if(confirm('ȷʵҪɾ��?')){self.location.href='fj.php?fjid=<?=$r[fjid]?>&phome=DelFj';}">
        </div></td>
    </tr>
  </form>
  <?
  }
  db_close();
  $empire=null;
  ?>
</table>
</body>
</html>
