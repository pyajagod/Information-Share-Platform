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
CheckLevel($myuserid,$myusername,$classid,"userpage");

//增加自定义页面
function AddUserpage($add,$userid,$username){
	global $empire,$dbtbpre;
	//操作权限
	CheckLevel($userid,$username,$classid,"userpage");
	if(empty($add['title'])||empty($add['filename']))
	{
		printerror("请输入页面名称与文件名","history.go(-1)");
    }
	if(file_exists("../page/".$add['filename']))
	{
		printerror('此文件已存在','');
	}
	$sql=$empire->query("insert into {$dbtbpre}downuserpage(title,filename,pagetext,pagetitle,pagekeywords,pagedescription) values('$add[title]','$add[filename]','".addslashes($add[pagetext])."','".addslashes($add[pagetitle])."','".addslashes($add[pagekeywords])."','".addslashes($add[pagedescription])."');");
	$id=$empire->lastid();
	ReUserpage($id);
	if($sql)
	{
		printerror("增加自定义页面成功","AddPage.php?phome=AddUserpage");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改自定义页面
function EditUserpage($add,$userid,$username){
	global $empire,$dbtbpre;
	//操作权限
	CheckLevel($userid,$username,$classid,"userpage");
	$id=(int)$add['id'];
	if(!$id||empty($add['title'])||empty($add['filename']))
	{
		printerror("请输入页面名称与文件名","history.go(-1)");
    }
	//改变地址
	if($add['oldfilename']<>$add['filename'])
	{
		DelFiletext('../page/'.$add['filename']);
	}
	$sql=$empire->query("update {$dbtbpre}downuserpage set title='$add[title]',filename='$add[filename]',pagetext='".addslashes($add[pagetext])."',pagetitle='".addslashes($add[pagetitle])."',pagekeywords='".addslashes($add[pagekeywords])."',pagedescription='".addslashes($add[pagedescription])."' where id='$id'");
	ReUserpage($id);
	if($sql)
	{
		printerror("修改自定义页面成功","ListPage.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除自定义页面
function DelUserpage($id,$userid,$username){
	global $empire,$dbtbpre;
	//操作权限
	CheckLevel($userid,$username,$classid,"userpage");
	$id=(int)$id;
	if(empty($id))
	{
		printerror("请选择要删除的自定义页面","history.go(-1)");
    }
	$r=$empire->fetch1("select id,filename from {$dbtbpre}downuserpage where id='$id'");
	if(empty($r['id']))
	{
		printerror("请选择要删除的自定义页面","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}downuserpage where id='$id'");
	DelFiletext('../page/'.$r['filename']);
	if($sql)
	{
		printerror("删除自定义页面成功","ListPage.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
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
$line=25;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
$totalquery="select count(*) as total from {$dbtbpre}downuserpage";
$num=$empire->gettotal($totalquery);//取得总条数
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
<title>管理自定义页面</title>
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">位置：<a href="ListPage.php">管理自定义页面</a></td>
    <td><div align="right">
        <input type="button" name="Submit5" value="增加自定义页面" onclick="self.location.href='AddPage.php?phome=AddUserpage';">
      </div></td>
  </tr>
</table>

<br>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="8%" height="25"> <div align="center">ID</div></td>
    <td width="60%" height="25"> <div align="center">页面名称</div></td>
    <td width="32%" height="25"> <div align="center">操作</div></td>
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
    <td height="25"> <div align="center">[<a href="AddPage.php?phome=EditUserpage&id=<?=$r[id]?>">修改</a>]&nbsp;[<a href="AddPage.php?phome=AddUserpage&docopy=1&id=<?=$r[id]?>">复制</a>]&nbsp;[<a href="ListPage.php?phome=DelUserpage&id=<?=$r[id]?>" onclick="return confirm('确认要删除？');">删除</a>]</div></td>
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
