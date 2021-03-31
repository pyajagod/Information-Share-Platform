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
CheckLevel($myuserid,$myusername,$classid,"vote");

//����ͶƱ
function AddVote($title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$userid,$username){
	global $empire,$dbtbpre;
	if(!$title)
	{
		printerror("������ͶƱ����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"vote");
	//�������
	$votetext=ReturnVote($votename,$votenum,$delvid,$vid,0);
	//ͳ����Ʊ��
	for($i=0;$i<count($votename);$i++)
	{$t_votenum+=$votenum[$i];}
	$votetime=to_date($dotime);
	$addtime=date("Y-m-d H:i:s");
	$t_votenum=(int)$t_votenum;
	$voteclass=(int)$voteclass;
	$votetime=(int)$votetime;
	$width=(int)$width;
	$height=(int)$height;
	$doip=(int)$doip;
	$sql=$empire->query("insert into {$dbtbpre}downvote(title,votetext,votenum,voteip,voteclass,doip,votetime,dotime,width,height,addtime) values('$title','$votetext','$t_votenum','','$voteclass','$doip','$votetime','$dotime','$width','$height','$addtime');");
	//����ͶƱjs
	$voteid=$empire->lastid();
	GetVoteJs($voteid);
	if($sql)
	{
		printerror("����ͶƱ�ɹ�","AddVote.php?phome=AddVote");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸�ͶƱ
function EditVote($voteid,$title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$userid,$username){
	global $empire,$dbtbpre;
	$voteid=(int)$voteid;
	if(!$voteid||!$title)
	{
		printerror("������ͶƱ����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"vote");
	//�������
	$votetext=ReturnVote($votename,$votenum,$delvid,$vid,1);
	//ͳ����Ʊ��
	for($i=0;$i<count($votename);$i++)
	{$t_votenum+=$votenum[$i];}
	$r=$empire->fetch1("select dotime,votetime from {$dbtbpre}downvote where voteid='$voteid'");
	$votetime=to_date($dotime);
	//�������
	$t_votenum=(int)$t_votenum;
	$voteclass=(int)$voteclass;
	$votetime=(int)$votetime;
	$width=(int)$width;
	$height=(int)$height;
	$doip=(int)$doip;
	$sql=$empire->query("update {$dbtbpre}downvote set title='$title',votetext='$votetext',votenum='$t_votenum',voteclass='$voteclass',doip='$doip',dotime='$dotime',votetime='$votetime',width='$width',height='$height' where voteid='$voteid'");
	//����ͶƱjs
	GetVoteJs($voteid);
	if($sql)
	{
		printerror("�޸�ͶƱ�ɹ�","ListVote.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ��ͶƱ
function DelVote($voteid,$userid,$username){
	global $empire,$dbtbpre;
	$voteid=(int)$voteid;
	if(!$voteid)
	{
		printerror("��ѡ��Ҫɾ����ͶƱ","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"vote");
	$r=$empire->fetch1("select title from {$dbtbpre}downvote where voteid='$voteid'");
	$sql=$empire->query("delete from {$dbtbpre}downvote where voteid='$voteid'");
	$file="../data/js/vote/vote".$voteid.".js";
	DelFiletext($file);
	if($sql)
	{
		printerror("ɾ��ͶƱ�ɹ�","ListVote.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
//����ͶƱ
if($phome=="AddVote")
{
	$title=$_POST['title'];
	$votename=$_POST['votename'];
	$votenum=$_POST['votenum'];
	$delvid=$_POST['delvid'];
	$vid=$_POST['vid'];
	$voteclass=$_POST['voteclass'];
	$doip=$_POST['doip'];
	$dotime=$_POST['dotime'];
	$width=$_POST['width'];
	$height=$_POST['height'];
	AddVote($title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$myuserid,$myusername);
}
//�޸�ͶƱ
elseif($phome=="EditVote")
{
	$voteid=$_POST['voteid'];
	$title=$_POST['title'];
	$votename=$_POST['votename'];
	$votenum=$_POST['votenum'];
	$delvid=$_POST['delvid'];
	$vid=$_POST['vid'];
	$voteclass=$_POST['voteclass'];
	$doip=$_POST['doip'];
	$dotime=$_POST['dotime'];
	$width=$_POST['width'];
	$height=$_POST['height'];
	EditVote($voteid,$title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$myuserid,$myusername);
}
//ɾ��ͶƱ
elseif($phome=="DelVote")
{
	$voteid=$_GET['voteid'];
	DelVote($voteid,$myuserid,$myusername);
}

$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
$query="select voteid,title,addtime from {$dbtbpre}downvote";
$num=$empire->num($query);//ȡ��������
$query=$query." order by voteid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
$url="����ͶƱ";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>����ͶƱ</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td width="50%">λ��: 
      <?=$url?>
    </td>
    <td><div align="right"> 
        <input type="button" name="Submit5" value="����ͶƱ" onclick="self.location.href='AddVote.php?phome=AddVote';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"><div align="center">ID</div></td>
    <td width="32%" height="25"><div align="center">ͶƱ����</div></td>
    <td width="18%" height="25"><div align="center">����ʱ��</div></td>
    <td width="26%" height="25">���õ�ַ</td>
    <td width="19%" height="25"><div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"><div align="center">
        <?=$r[voteid]?>
      </div></td>
    <td height="25">
      <?=$r[title]?>
    </td>
    <td height="25"><div align="center">
        <?=$r[addtime]?>
      </div></td>
    <td height="25"><input name="textfield" type="text" value="<?=$public_r[sitedown]?>data/js/vote/vote<?=$r[voteid]?>.js">
      [<a href="view/js.php?js=vote<?=$r[voteid]?>&p=vote" target="_blank">Ԥ��</a>]</td>
    <td height="25"><div align="center">[<a href="AddVote.php?phome=EditVote&voteid=<?=$r[voteid]?>">�޸�</a>] 
        [<a href="ListVote.php?phome=DelVote&voteid=<?=$r[voteid]?>" onclick="return confirm('ȷ��Ҫɾ��?');">ɾ��</a>]</div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="5">&nbsp;
      <?=$returnpage?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="5">˵��:��Ҫ��ʾͶƱ�ĵط�����:&lt;script src=���õ�ַ&gt;&lt;/script&gt;</td>
  </tr>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>
