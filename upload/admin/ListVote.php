<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"vote");

//增加投票
function AddVote($title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$userid,$username){
	global $empire,$dbtbpre;
	if(!$title)
	{
		printerror("请输入投票标题","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"vote");
	//返回组合
	$votetext=ReturnVote($votename,$votenum,$delvid,$vid,0);
	//统计总票数
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
	//生成投票js
	$voteid=$empire->lastid();
	GetVoteJs($voteid);
	if($sql)
	{
		printerror("增加投票成功","AddVote.php?phome=AddVote");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改投票
function EditVote($voteid,$title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$userid,$username){
	global $empire,$dbtbpre;
	$voteid=(int)$voteid;
	if(!$voteid||!$title)
	{
		printerror("请输入投票标题","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"vote");
	//返回组合
	$votetext=ReturnVote($votename,$votenum,$delvid,$vid,1);
	//统计总票数
	for($i=0;$i<count($votename);$i++)
	{$t_votenum+=$votenum[$i];}
	$r=$empire->fetch1("select dotime,votetime from {$dbtbpre}downvote where voteid='$voteid'");
	$votetime=to_date($dotime);
	//处理变量
	$t_votenum=(int)$t_votenum;
	$voteclass=(int)$voteclass;
	$votetime=(int)$votetime;
	$width=(int)$width;
	$height=(int)$height;
	$doip=(int)$doip;
	$sql=$empire->query("update {$dbtbpre}downvote set title='$title',votetext='$votetext',votenum='$t_votenum',voteclass='$voteclass',doip='$doip',dotime='$dotime',votetime='$votetime',width='$width',height='$height' where voteid='$voteid'");
	//生成投票js
	GetVoteJs($voteid);
	if($sql)
	{
		printerror("修改投票成功","ListVote.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除投票
function DelVote($voteid,$userid,$username){
	global $empire,$dbtbpre;
	$voteid=(int)$voteid;
	if(!$voteid)
	{
		printerror("请选择要删除的投票","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"vote");
	$r=$empire->fetch1("select title from {$dbtbpre}downvote where voteid='$voteid'");
	$sql=$empire->query("delete from {$dbtbpre}downvote where voteid='$voteid'");
	$file="../data/js/vote/vote".$voteid.".js";
	DelFiletext($file);
	if($sql)
	{
		printerror("删除投票成功","ListVote.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
//增加投票
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
//修改投票
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
//删除投票
elseif($phome=="DelVote")
{
	$voteid=$_GET['voteid'];
	DelVote($voteid,$myuserid,$myusername);
}

$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
$query="select voteid,title,addtime from {$dbtbpre}downvote";
$num=$empire->num($query);//取得总条数
$query=$query." order by voteid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
$url="管理投票";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理投票</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td width="50%">位置: 
      <?=$url?>
    </td>
    <td><div align="right"> 
        <input type="button" name="Submit5" value="增加投票" onclick="self.location.href='AddVote.php?phome=AddVote';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"><div align="center">ID</div></td>
    <td width="32%" height="25"><div align="center">投票标题</div></td>
    <td width="18%" height="25"><div align="center">发布时间</div></td>
    <td width="26%" height="25">调用地址</td>
    <td width="19%" height="25"><div align="center">操作</div></td>
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
      [<a href="view/js.php?js=vote<?=$r[voteid]?>&p=vote" target="_blank">预览</a>]</td>
    <td height="25"><div align="center">[<a href="AddVote.php?phome=EditVote&voteid=<?=$r[voteid]?>">修改</a>] 
        [<a href="ListVote.php?phome=DelVote&voteid=<?=$r[voteid]?>" onclick="return confirm('确认要删除?');">删除</a>]</div></td>
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
    <td height="25" colspan="5">说明:在要显示投票的地方加上:&lt;script src=调用地址&gt;&lt;/script&gt;</td>
  </tr>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>
