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
CheckLevel($myuserid,$myusername,$classid,"userpage");

//�����Զ���ҳ��
function AddUserpage($add,$userid,$username){
	global $empire,$dbtbpre;
	//����Ȩ��
	CheckLevel($userid,$username,$classid,"userpage");
	if(empty($add['title'])||empty($add['filename']))
	{
		printerror("������ҳ���������ļ���","history.go(-1)");
    }
	if(file_exists("../page/".$add['filename']))
	{
		printerror('���ļ��Ѵ���','');
	}
	$sql=$empire->query("insert into {$dbtbpre}downuserpage(title,filename,pagetext,pagetitle,pagekeywords,pagedescription) values('$add[title]','$add[filename]','".addslashes($add[pagetext])."','".addslashes($add[pagetitle])."','".addslashes($add[pagekeywords])."','".addslashes($add[pagedescription])."');");
	$id=$empire->lastid();
	ReUserpage($id);
	if($sql)
	{
		printerror("�����Զ���ҳ��ɹ�","AddPage.php?phome=AddUserpage");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸��Զ���ҳ��
function EditUserpage($add,$userid,$username){
	global $empire,$dbtbpre;
	//����Ȩ��
	CheckLevel($userid,$username,$classid,"userpage");
	$id=(int)$add['id'];
	if(!$id||empty($add['title'])||empty($add['filename']))
	{
		printerror("������ҳ���������ļ���","history.go(-1)");
    }
	//�ı��ַ
	if($add['oldfilename']<>$add['filename'])
	{
		DelFiletext('../page/'.$add['filename']);
	}
	$sql=$empire->query("update {$dbtbpre}downuserpage set title='$add[title]',filename='$add[filename]',pagetext='".addslashes($add[pagetext])."',pagetitle='".addslashes($add[pagetitle])."',pagekeywords='".addslashes($add[pagekeywords])."',pagedescription='".addslashes($add[pagedescription])."' where id='$id'");
	ReUserpage($id);
	if($sql)
	{
		printerror("�޸��Զ���ҳ��ɹ�","ListPage.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ���Զ���ҳ��
function DelUserpage($id,$userid,$username){
	global $empire,$dbtbpre;
	//����Ȩ��
	CheckLevel($userid,$username,$classid,"userpage");
	$id=(int)$id;
	if(empty($id))
	{
		printerror("��ѡ��Ҫɾ�����Զ���ҳ��","history.go(-1)");
    }
	$r=$empire->fetch1("select id,filename from {$dbtbpre}downuserpage where id='$id'");
	if(empty($r['id']))
	{
		printerror("��ѡ��Ҫɾ�����Զ���ҳ��","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}downuserpage where id='$id'");
	DelFiletext('../page/'.$r['filename']);
	if($sql)
	{
		printerror("ɾ���Զ���ҳ��ɹ�","ListPage.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_POST['phome'];
if(empty($phome))
{$phome=$_GET['phome'];}
if($phome=="AddUserpage")
{
	AddUserpage($_POST,$myuserid,$myusername);
}
elseif($phome=="EditUserpage")
{
	EditUserpage($_POST,$myuserid,$myusername);
}
elseif($phome=="DelUserpage")
{
	$id=$_GET['id'];
	DelUserpage($id,$myuserid,$myusername);
}

$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=25;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
$totalquery="select count(*) as total from {$dbtbpre}downuserpage";
$num=$empire->gettotal($totalquery);//ȡ��������
$query="select id,title,filename from {$dbtbpre}downuserpage";
$query=$query." order by id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>�����Զ���ҳ��</title>
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">λ�ã�<a href="ListPage.php">�����Զ���ҳ��</a></td>
    <td><div align="right">
        <input type="button" name="Submit5" value="�����Զ���ҳ��" onclick="self.location.href='AddPage.php?phome=AddUserpage';">
      </div></td>
  </tr>
</table>

<br>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="8%" height="25"> <div align="center">ID</div></td>
    <td width="60%" height="25"> <div align="center">ҳ������</div></td>
    <td width="32%" height="25"> <div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <?=$r[id]?>
      </div></td>
    <td height="25"> <div align="center"><a href="../page/<?=$r[filename]?>" target=_blank><?=$r[title]?></a></div></td>
    <td height="25"> <div align="center">[<a href="AddPage.php?phome=EditUserpage&id=<?=$r[id]?>">�޸�</a>]&nbsp;[<a href="AddPage.php?phome=AddUserpage&docopy=1&id=<?=$r[id]?>">����</a>]&nbsp;[<a href="ListPage.php?phome=DelUserpage&id=<?=$r[id]?>" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��</a>]</div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="3">&nbsp;&nbsp;&nbsp; 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>
