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
$url="������Թ���";
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"language");

//�����������
function AddLanguage($language,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($language))
	{
		printerror("��������������","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"language");
	$sql=$empire->query("insert into {$dbtbpre}language(language) values('$language');");
	GetClassZt();//���»���
	if($sql)
	{
		printerror("�������Գɹ�","language.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸��������
function EditLanguage($languageid,$language,$userid,$username){
	global $empire,$dbtbpre;
	$languageid=(int)$languageid;
	if(!$languageid||!$language)
	{
		printerror("��������������","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"language");
	$sql=$empire->query("update {$dbtbpre}language set language='$language' where languageid='$languageid'");
	GetClassZt();//���»���
	if($sql)
	{
		printerror("�޸����Գɹ�","language.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ������
function DelLanguage($languageid,$userid,$username){
	global $empire,$dbtbpre;
	$languageid=(int)$languageid;
	if(empty($languageid))
	{
		printerror("��ѡ��Ҫɾ��������","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"language");
	$sql=$empire->query("delete from {$dbtbpre}language where languageid='$languageid'");
	GetClassZt();//���»���
	if($sql)
	{
		printerror("ɾ�����Գɹ�","language.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//��ΪĬ������
function DefaultLanguage($languageid,$userid,$username){
	global $empire,$dbtbpre;
	$languageid=(int)$languageid;
	if(!$languageid)
	{
		printerror("��ѡ��Ҫ���õ�Ĭ������","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"language");
	$sql1=$empire->query("update {$dbtbpre}language set isdefault=0");
	$sql=$empire->query("update {$dbtbpre}language set isdefault=1 where languageid='$languageid'");
	if($sql)
	{
		printerror("��ΪĬ�����Գɹ�","language.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="AddLanguage")//��������
{
	$language=$_POST['language'];
	AddLanguage($language,$myuserid,$myusername);
}
elseif($phome=="EditLanguage")//�޸�����
{
	$languageid=$_POST['languageid'];
	$language=$_POST['language'];
	EditLanguage($languageid,$language,$myuserid,$myusername);
}
elseif($phome=="DelLanguage")//ɾ������
{
	$languageid=$_GET['languageid'];
	DelLanguage($languageid,$myuserid,$myusername);
}
elseif($phome=="DefaultLanguage")//Ĭ������
{
	$languageid=$_GET['languageid'];
	DefaultLanguage($languageid,$myuserid,$myusername);
}

$sql=$empire->query("select languageid,language,isdefault from {$dbtbpre}language");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>������Թ���</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="language.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr>
      <td bgcolor="#FFFFFF">
<div align="center">����������ԣ� 
          <input name="language" type="text" id="language">
          <input type="submit" name="Submit" value="����">
          <input name="phome" type="hidden" id="phome" value="AddLanguage">
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
	  <?php
	  while($r=$empire->fetch($sql))
	  {
		if($r[isdefault])
		{$bgcolor="#DBEAF5";}
	  	else
	  	{$bgcolor="ffffff";}
  ?>
  <form name=form1 method=post action="language.php">
    <tr bgcolor="<?=$bgcolor?>"> 
      <td height="25"> <div align="center">
          <?=$r[languageid]?>
        </div></td>
      <td height="25"> <div align="left"> 
          <input name="language" type="text" id="language" value="<?=$r[language]?>">
        </div></td>
      <td height="25"> <div align="center"> 
          <input name="phome" type="hidden" id="phome" value="EditLanguage">
          <input name="languageid" type="hidden" id="languageid" value="<?=$r[languageid]?>">
          <input type="button" name="Submit4" value="��ΪĬ��" onclick="self.location.href='language.php?languageid=<?=$r[languageid]?>&phome=DefaultLanguage'">
          &nbsp; 
          <input type="submit" name="Submit2" value="�޸�">
          &nbsp; 
          <input type="button" name="Submit3" value="ɾ��" onclick="if(confirm('ȷʵҪɾ��?')){self.location.href='language.php?languageid=<?=$r[languageid]?>&phome=DelLanguage';}">
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
