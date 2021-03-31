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
CheckLevel($myuserid,$myusername,$classid,"softtype");

//����������
function AddSofttype($add,$userid,$username){
	global $empire,$dbtbpre;
	$lencord=(int)$add['lencord'];
	$maxnum=(int)$add['maxnum'];
	$listtempid=(int)$add['listtempid'];
	if(!$add[softtype]||!$listtempid)
	{
		printerror("����������������ѡ���б�ģ��","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"softtype");
	$sql=$empire->query("insert into {$dbtbpre}softtype(softtype,lencord,isdefault,maxnum,listtempid) values('$add[softtype]','$lencord',0,'$maxnum','$listtempid');");
	GetClassZt();//���»���
	if($sql)
	{
		printerror("����������ɹ�","softtype.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸�������
function EditSofttype($add,$userid,$username){
	global $empire,$dbtbpre;
	$softtypeid=(int)$add['softtypeid'];
	$lencord=(int)$add['lencord'];
	$maxnum=(int)$add['maxnum'];
	$listtempid=(int)$add['listtempid'];
	if(!$softtypeid||!$add[softtype]||!$listtempid)
	{
		printerror("����������������ѡ���б�ģ��","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"softtype");
	$sql=$empire->query("update {$dbtbpre}softtype set softtype='$add[softtype]',lencord='$lencord',maxnum='$maxnum',listtempid='$listtempid' where softtypeid='$softtypeid'");
	GetClassZt();//���»���
	if($sql)
	{
		printerror("�޸�������ɹ�","softtype.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ��������
function DelSofttype($softtypeid,$userid,$username){
	global $empire,$dbtbpre;
	$softtypeid=(int)$softtypeid;
	if(empty($softtypeid))
	{
		printerror("��ѡ��Ҫɾ����������","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"softtype");
	//ɾ���б��ļ�
	$r=$empire->fetch1("select lencord from {$dbtbpre}softtype where softtypeid='$softtypeid'");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where softtype='$softtypeid'");
	GetClassZt();//���»���
    DelListFile("type".$softtypeid."_",$r[lencord],$num);
	$sql=$empire->query("delete from {$dbtbpre}softtype where softtypeid='$softtypeid'");
	if($sql)
	{
		printerror("ɾ��������ɹ�","softtype.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//Ĭ��������
function DefaultSofttype($softtypeid,$userid,$username){
	global $empire,$dbtbpre;
	$softtypeid=(int)$softtypeid;
	if(empty($softtypeid))
	{
		printerror("��ѡ��ҪĬ�ϵ��������","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"softtype");
	$sql1=$empire->query("update {$dbtbpre}softtype set isdefault=0");
	$sql=$empire->query("update {$dbtbpre}softtype set isdefault=1 where softtypeid='$softtypeid'");
	if($sql)
	{
		printerror("��ΪĬ��������ͳɹ�","softtype.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="AddSofttype")//�����������
{
	AddSofttype($_POST,$myuserid,$myusername);
}
elseif($phome=="EditSofttype")//�޸��������
{
	EditSofttype($_POST,$myuserid,$myusername);
}
elseif($phome=="DelSofttype")//ɾ���������
{
	$softtypeid=$_GET['softtypeid'];
	DelSofttype($softtypeid,$myuserid,$myusername);
}
elseif($phome=="DefaultSofttype")//Ĭ���������
{
	$softtypeid=$_GET['softtypeid'];
	DefaultSofttype($softtypeid,$myuserid,$myusername);
}

$url="������͹���";
$sql=$empire->query("select softtypeid,softtype,lencord,isdefault,maxnum,listtempid from {$dbtbpre}softtype");
//�б�ģ��
$listtemp="";
$ltsql=$empire->query("select tempid,tempname from {$dbtbpre}downlisttemp order by tempid");
while($ltr=$empire->fetch($ltsql))
{
	$listtemp.="<option value='".$ltr[tempid]."'>".$ltr[tempname]."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�������</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="softtype.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr>
      <td bgcolor="#FFFFFF">
<div align="center">����������ͣ� 
          <input name="softtype" type="text" id="softtype">
          �б�ģ��<select name="listtempid">
          <?=$listtemp?>
        </select>��ÿҳ��ʾ 
          <input name="lencord" type="text" id="lencord" value="25" size="6">
          ���������ʾ��
          <input name="maxnum" type="text" id="maxnum" value="0" size="6">
          <input type="submit" name="Submit" value="����">
          <input name="phome" type="hidden" id="phome" value="AddSofttype">
        </div></td>
    </tr>
  </table>
</form>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="7%" height="25"> <div align="center">ID</div></td>
    <td width="22%" height="25"> <div align="left">�������</div></td>
    <td width="20%">�б�ģ��</td>
    <td width="8%" height="25"><div align="center">Ԥ��</div></td>
    <td width="9%" height="25"> <div align="center">ÿҳ��</div></td>
    <td width="9%"><div align="center">�����</div></td>
    <td width="25%" height="25"> <div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
	if($r[isdefault])
	{$bgcolor="#DBEAF5";}
	else
	{$bgcolor="#ffffff";}
	$pageurl=EDReturnTypeUrl($r[softtypeid]);
  ?>
  <form name=form1 method=post action="softtype.php">
    <tr bgcolor="<?=$bgcolor?>"> 
      <td height="25"> <div align="center"> 
          <?=$r[softtypeid]?>
        </div></td>
      <td height="25"> <div align="left"> 
          <input name="softtype" type="text" id="softtype" value="<?=$r[softtype]?>">
          [<a href='chtmlphome.php?phome=ReSoftTypeHtml&softtypeid=<?=$r[softtypeid]?>'>����</a>]</div></td>
      <td><select name="listtempid" id="listtempid">
          <?=str_replace("<option value='$r[listtempid]'>","<option value='$r[listtempid]' selected>",$listtemp)?>
        </select></td>
      <td height="25"> <div align="center">[<a href="<?=$pageurl?>" target=_blank>Ԥ��</a>]</div></td>
      <td height="25"> <div align="center"> 
          <input name="lencord" type="text" id="lencord" value="<?=$r[lencord]?>" size="6">
        </div></td>
      <td><div align="center"> 
          <input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="6">
        </div></td>
      <td height="25"> <div align="center"> 
          <input name="softtypeid" type="hidden" id="softtypeid" value="<?=$r[softtypeid]?>">
          <input name="phome" type="hidden" id="phome" value="EditSofttype">
          <input type="button" name="Submit4" value="��ΪĬ��" onclick="self.location.href='softtype.php?softtypeid=<?=$r[softtypeid]?>&phome=DefaultSofttype'">
          &nbsp; 
          <input type="submit" name="Submit2" value="�޸�">
          &nbsp; 
          <input type="button" name="Submit3" value="ɾ��" onclick="if(confirm('ȷʵҪɾ��?')){self.location.href='softtype.php?softtypeid=<?=$r[softtypeid]?>&phome=DelSofttype';}">
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
