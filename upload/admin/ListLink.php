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
CheckLevel($myuserid,$myusername,$classid,"link");

//增加友情链接
function AddLink($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[lname]||!$add[lurl])
	{
		printerror("请输入网站名称与网址","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"link");
	$add[onclick]=(int)$add[onclick];
	$add[myorder]=(int)$add[myorder];
	$add[checked]=(int)$add[checked];
	$add[ltype]=(int)$add[ltype];
	$ltime=date("Y-m-d H:i:s");
	$sql=$empire->query("insert into {$dbtbpre}downlink(lname,lpic,lurl,ltime,onclick,width,height,target,myorder,email,lsay,ltype,checked) values('$add[lname]','$add[lpic]','$add[lurl]','$ltime','$add[onclick]','$add[width]','$add[height]','$add[target]','$add[myorder]','$add[email]','$add[lsay]','$add[ltype]','$add[checked]');");
	if($sql)
	{
		printerror("增加友情链接成功","AddLink.php?phome=AddLink");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改友情链接
function EditLink($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[lid]=(int)$add[lid];
	if(!$add[lname]||!$add[lurl]||!$add[lid])
	{
		printerror("请输入网站名称与网址","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"link");
	$add[onclick]=(int)$add[onclick];
	$add[myorder]=(int)$add[myorder];
	$add[checked]=(int)$add[checked];
	$add[ltype]=(int)$add[ltype];
	$sql=$empire->query("update {$dbtbpre}downlink set lname='$add[lname]',lpic='$add[lpic]',lurl='$add[lurl]',onclick='$add[onclick]',width='$add[width]',height='$add[height]',target='$add[target]',myorder='$add[myorder]',email='$add[email]',lsay='$add[lsay]',ltype='$add[ltype]',checked='$add[checked]' where lid='$add[lid]'");
	if($sql)
	{
		printerror("修改友情链接成功","ListLink.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除友情链接
function DelLink($lid,$userid,$username){
	global $empire,$dbtbpre;
	$lid=(int)$lid;
	if(!$lid)
	{
		printerror("请选择要删除的友情链接","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"link");
	$r=$empire->fetch1("select lname from {$dbtbpre}downlink where lid='$lid'");
	$sql=$empire->query("delete from {$dbtbpre}downlink where lid='$lid'");
	if($sql)
	{
		printerror("删除友情链接成功","ListLink.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_POST['phome'];
if(empty($phome))
{$phome=$_GET['phome'];}
if($phome=="AddLink")
{
	AddLink($_POST,$myuserid,$myusername);
}
elseif($phome=="EditLink")
{
	EditLink($_POST,$myuserid,$myusername);
}
elseif($phome=="DelLink")
{
	$lid=$_GET['lid'];
	DelLink($lid,$myuserid,$myusername);
}
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=16;//每页显示条数
$page_line=25;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
$query="select * from {$dbtbpre}downlink";
$num=$empire->num($query);//取得总条数
$query=$query." order by myorder,lid limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理友情链接</title>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">位置：<a href="ListLink.php">管理友情链接</a></td>
    <td><div align="right"> 
        <input type="button" name="Submit5" value="增加友情链接" onclick="self.location.href='AddLink.php?phome=AddLink';">
      </div></td>
  </tr>
</table>
<br>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="6%" height="25"> <div align="center">ID</div></td>
    <td width="51%" height="25"> <div align="center">预览</div></td>
    <td width="11%" height="25"> <div align="center">点击</div></td>
    <td width="12%"><div align="center">状态</div></td>
    <td width="20%" height="25"> <div align="center">操作</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  //文字
  if(empty($r[lpic]))
  {
  $logo="<a href='".$r[lurl]."' title='".$r[lname]."' target=".$r[target].">".$r[lname]."</a>";
  }
  //图片
  else
  {
  $logo="<a href='".$r[lurl]."' target=".$r[target]."><img src='".$r[lpic]."' alt='".$r[lname]."' border=0 width='".$r[width]."' height='".$r[height]."'></a>";
  }
  if(empty($r[checked]))
  {$checked="关闭";}
  else
  {$checked="显示";}
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <?=$r[lid]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$logo?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[onclick]?>
      </div></td>
    <td><div align="center">
        <?=$checked?>
      </div></td>
    <td height="25"> <div align="center">[<a href="AddLink.php?phome=EditLink&lid=<?=$r[lid]?>">修改</a>]&nbsp;[<a href="ListLink.php?phome=DelLink&lid=<?=$r[lid]?>" onclick="return confirm('确认要删除？');">删除</a>]</div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="5">&nbsp;&nbsp;&nbsp; 
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
