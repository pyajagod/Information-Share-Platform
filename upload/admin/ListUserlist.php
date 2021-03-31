<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../data/cache/class.php");
include("../class/t_functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"userlist");

//�����Զ�����Ϣ�б�
function AddUserlist($add,$userid,$username){
	global $empire,$dbtbpre;
	$listtempid=(int)$add['listtempid'];
	$maxnum=(int)$add['maxnum'];
	$lencord=(int)$add['lencord'];
	if(!$add[listname]||!$listtempid||!$add[listsql]||!$add[totalsql]||!$add[lencord])
	{
		printerror("��*��Ϊ����","history.go(-1)");
	}
	$query_first=substr($add['totalsql'],0,7);
	$query_firstlist=substr($add['listsql'],0,7);
	if(!($query_first=="select "||$query_first=="SELECT "||$query_firstlist=="select "||$query_firstlist=="SELECT "))
	{
		printerror("���ǲ�ѯSQL","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"userlist");
	if(empty($add['pagetitle']))
	{
		$add['pagetitle']=$add['listname'];
	}
	$add[totalsql]=ClearAddsData($add[totalsql]);
	$add[listsql]=ClearAddsData($add[listsql]);
	$sql=$empire->query("insert into {$dbtbpre}downuserlist(listname,pagetitle,pagekey,pagedes,totalsql,listsql,maxnum,lencord,listtempid) values('$add[listname]','$add[pagetitle]','$add[pagekey]','$add[pagedes]','".addslashes($add[totalsql])."','".addslashes($add[listsql])."',$maxnum,$lencord,$listtempid);");
	//�����б�
	$add[listsql]=addslashes($add[listsql]);
	$add[totalsql]=addslashes($add[totalsql]);
	$id=$empire->lastid();
	ListHtml($id,$listtemp_r,4);
	if($sql)
	{
		printerror("�����Զ����б�ɹ�","AddUserlist.php?phome=AddUserlist");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸��Զ�����Ϣ�б�
function EditUserlist($add,$userid,$username){
	global $empire,$dbtbpre;
	$id=(int)$add['id'];
	$listtempid=(int)$add['listtempid'];
	$maxnum=(int)$add['maxnum'];
	$lencord=(int)$add['lencord'];
	if(!$id||!$add[listname]||!$listtempid||!$add[listsql]||!$add[totalsql]||!$add[lencord])
	{
		printerror("��*��Ϊ����","history.go(-1)");
	}
	$query_first=substr($add['totalsql'],0,7);
	$query_firstlist=substr($add['listsql'],0,7);
	if(!($query_first=="select "||$query_first=="SELECT "||$query_firstlist=="select "||$query_firstlist=="SELECT "))
	{
		printerror("���ǲ�ѯSQL","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"userlist");
	if(empty($add['pagetitle']))
	{
		$add['pagetitle']=$add['listname'];
	}
	$add[totalsql]=ClearAddsData($add[totalsql]);
	$add[listsql]=ClearAddsData($add[listsql]);
	$sql=$empire->query("update {$dbtbpre}downuserlist set listname='$add[listname]',pagetitle='$add[pagetitle]',pagekey='$add[pagekey]',pagedes='$add[pagedes]',totalsql='".addslashes($add['totalsql'])."',listsql='".addslashes($add['listsql'])."',maxnum=$maxnum,lencord=$lencord,listtempid=$listtempid where id=$id");
	//ˢ���б�
	$add[listsql]=addslashes($add[listsql]);
	$add[totalsql]=addslashes($add[totalsql]);
	ListHtml($id,$listtemp_r,4);
	if($sql)
	{
		printerror("�޸��Զ����б�ɹ�","ListUserlist.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ���Զ�����Ϣ�б�
function DelUserlist($id,$userid,$username){
	global $empire,$dbtbpre;
	$id=(int)$id;
	if(!$id)
	{
		printerror("��ѡ��Ҫɾ�����Զ����б�","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"userlist");
	$r=$empire->fetch1("select totalsql,lencord from {$dbtbpre}downuserlist where id=$id");
	$sql=$empire->query("delete from {$dbtbpre}downuserlist where id=$id");
	$totalsql=RepSqlTbpre(stripSlashes($r[totalsql]));
	$num=$empire->gettotal($totalsql);
	DelListFile('list'.$id,$r[lencord],$num);
	if($sql)
	{
		printerror("ɾ���Զ����б�ɹ�","ListUserlist.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_POST['phome'];
if(empty($phome))
{$phome=$_GET['phome'];}
if($phome=="AddUserlist")
{
	AddUserlist($_POST,$myuserid,$myusername);
}
elseif($phome=="EditUserlist")
{
	EditUserlist($_POST,$myuserid,$myusername);
}
elseif($phome=="DelUserlist")
{
	$id=$_GET['id'];
	DelUserlist($id,$myuserid,$myusername);
}
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//ÿҳ��ʾ����
$page_line=20;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
$query="select id,listname from {$dbtbpre}downuserlist";
$totalquery="select count(*) as total from {$dbtbpre}downuserlist";
$num=$empire->gettotal($totalquery);//ȡ��������
$query=$query." order by id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>�����Զ����б�</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">λ�ã�<a href=ListUserlist.php>�����Զ����б�</a></td>
    <td><div align="right">
        <input type="button" name="Submit" value="�����Զ����б�" onclick="self.location.href='AddUserlist.php?phome=AddUserlist';">
      </div></td>
  </tr>
</table>

<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="9%" height="25"> <div align="center">ID</div></td>
    <td width="44%" height="25"> <div align="center">�б�����</div></td>
    <td width="13%"><div align="center">Ԥ��</div></td>
    <td width="34%" height="25"> <div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  	$pageurl=EDReturnUserlistUrl($r[id]);
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <?=$r[id]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <a href="<?=$pageurl?>" target="_blank"><?=$r[listname]?></a>
      </div></td>
    <td><div align="center">[<a href="<?=$pageurl?>" target="_blank">Ԥ��</a>]</div></td>
    <td height="25"> <div align="center">[<a href="chtmlphome.php?phome=ReUserlistHtml&id=<?=$r[id]?>">����</a>]&nbsp;&nbsp;[<a href="AddUserlist.php?phome=EditUserlist&id=<?=$r[id]?>">�޸�</a>]&nbsp;&nbsp;[<a href="AddUserlist.php?phome=AddUserlist&docopy=1&id=<?=$r[id]?>">����</a>]&nbsp;&nbsp;[<a href="ListUserlist.php?phome=DelUserlist&id=<?=$r[id]?>" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��</a>]</div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="4">&nbsp;&nbsp;&nbsp; 
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
