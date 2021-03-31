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
$url="�����Ȩ����";
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"sq");

//������Ȩ��ʽ
function AddSq($sqname,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($sqname))
	{
		printerror("��������Ȩ��ʽ","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"sq");
	$sql=$empire->query("insert into {$dbtbpre}sq(sqname) values('$sqname');");
	GetClassZt();//���»���
	if($sql)
	{
		printerror("������Ȩ��ʽ�ɹ�","sq.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸���Ȩ��ʽ
function EditSq($sqid,$sqname,$userid,$username){
	global $empire,$dbtbpre;
	$sqid=(int)$sqid;
	if(!$sqid||!$sqname)
	{
		printerror("��������Ȩ��ʽ","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"sq");
	$sql=$empire->query("update {$dbtbpre}sq set sqname='$sqname' where sqid='$sqid'");
	GetClassZt();//���»���
	if($sql)
	{
		printerror("�޸���Ȩ��ʽ�ɹ�","sq.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ����Ȩ��ʽ
function DelSq($sqid,$userid,$username){
	global $empire,$dbtbpre;
	$sqid=(int)$sqid;
	if(empty($sqid))
	{
		printerror("��ѡ��Ҫɾ������Ȩ��ʽ","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"sq");
	$sql=$empire->query("delete from {$dbtbpre}sq where sqid='$sqid'");
	GetClassZt();//���»���
	if($sql)
	{
		printerror("ɾ����Ȩ��ʽ�ɹ�","sq.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//Ĭ����Ȩ
function DefaultSq($sqid,$userid,$username){
	global $empire,$dbtbpre;
	$sqid=(int)$sqid;
	if(empty($sqid))
	{
		printerror("��ѡ��ҪĬ�ϵ���Ȩ","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"sq");
	$sql1=$empire->query("update {$dbtbpre}sq set isdefault=0");
	$sql=$empire->query("update {$dbtbpre}sq set isdefault=1 where sqid='$sqid'");
	if($sql)
	{
		printerror("��ΪĬ����Ȩ��ʽ�ɹ�","sq.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="AddSq")//���������Ȩ
{
	$sqname=$_POST['sqname'];
	AddSq($sqname,$myuserid,$myusername);
}
elseif($phome=="EditSq")//�޸������Ȩ
{
	$sqid=$_POST['sqid'];
	$sqname=$_POST['sqname'];
	EditSq($sqid,$sqname,$myuserid,$myusername);
}
elseif($phome=="DelSq")//ɾ�������Ȩ
{
	$sqid=$_GET['sqid'];
	DelSq($sqid,$myuserid,$myusername);
}
elseif($phome=="DefaultSq")//Ĭ�������Ȩ
{
	$sqid=$_GET['sqid'];
	DefaultSq($sqid,$myuserid,$myusername);
}

$sql=$empire->query("select sqid,sqname,isdefault from {$dbtbpre}sq");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�����Ȩ</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="sq.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr>
      <td bgcolor="#FFFFFF">
<div align="center">���������Ȩ�� 
          <input name="sqname" type="text" id="sqname">
          <input type="submit" name="Submit" value="����">
          <input name="phome" type="hidden" id="phome" value="AddSq">
        </div></td>
    </tr>
  </table>
</form>

<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="12%" height="25"> <div align="center">ID</div></td>
    <td width="52%" height="25"> <div align="left">�����Ȩ</div></td>
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
  <form name=form1 method=post action="sq.php">
    <tr bgcolor="<?=$bgcolor?>"> 
      <td height="25"> <div align="center"> 
          <?=$r[sqid]?>
        </div></td>
      <td height="25"> <div align="left"> 
          <input name="sqname" type="text" id="sqname" value="<?=$r[sqname]?>">
        </div></td>
      <td height="25"> <div align="center"> 
          <input name="phome" type="hidden" id="phome" value="EditSq">
          <input name="sqid" type="hidden" id="sqid" value="<?=$r[sqid]?>">
          <input type="button" name="Submit4" value="��ΪĬ��" onclick="self.location.href='sq.php?sqid=<?=$r[sqid]?>&phome=DefaultSq'">
          &nbsp; 
          <input type="submit" name="Submit2" value="�޸�">
          &nbsp; 
          <input type="button" name="Submit3" value="ɾ��" onclick="if(confirm('ȷʵҪɾ��?')){self.location.href='sq.php?sqid=<?=$r[sqid]?>&phome=DelSq';}">
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
