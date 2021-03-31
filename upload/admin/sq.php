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
$url="软件授权管理";
//验证权限
CheckLevel($myuserid,$myusername,$classid,"sq");

//增加授权形式
function AddSq($sqname,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($sqname))
	{
		printerror("请输入授权形式","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"sq");
	$sql=$empire->query("insert into {$dbtbpre}sq(sqname) values('$sqname');");
	GetClassZt();//更新缓存
	if($sql)
	{
		printerror("增加授权形式成功","sq.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改授权形式
function EditSq($sqid,$sqname,$userid,$username){
	global $empire,$dbtbpre;
	$sqid=(int)$sqid;
	if(!$sqid||!$sqname)
	{
		printerror("请输入授权形式","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"sq");
	$sql=$empire->query("update {$dbtbpre}sq set sqname='$sqname' where sqid='$sqid'");
	GetClassZt();//更新缓存
	if($sql)
	{
		printerror("修改授权形式成功","sq.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除授权形式
function DelSq($sqid,$userid,$username){
	global $empire,$dbtbpre;
	$sqid=(int)$sqid;
	if(empty($sqid))
	{
		printerror("请选择要删除的授权形式","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"sq");
	$sql=$empire->query("delete from {$dbtbpre}sq where sqid='$sqid'");
	GetClassZt();//更新缓存
	if($sql)
	{
		printerror("删除授权形式成功","sq.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//默认授权
function DefaultSq($sqid,$userid,$username){
	global $empire,$dbtbpre;
	$sqid=(int)$sqid;
	if(empty($sqid))
	{
		printerror("请选择要默认的授权","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"sq");
	$sql1=$empire->query("update {$dbtbpre}sq set isdefault=0");
	$sql=$empire->query("update {$dbtbpre}sq set isdefault=1 where sqid='$sqid'");
	if($sql)
	{
		printerror("设为默认授权形式成功","sq.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="AddSq")//增加软件授权
{
	$sqname=$_POST['sqname'];
	AddSq($sqname,$myuserid,$myusername);
}
elseif($phome=="EditSq")//修改软件授权
{
	$sqid=$_POST['sqid'];
	$sqname=$_POST['sqname'];
	EditSq($sqid,$sqname,$myuserid,$myusername);
}
elseif($phome=="DelSq")//删除软件授权
{
	$sqid=$_GET['sqid'];
	DelSq($sqid,$myuserid,$myusername);
}
elseif($phome=="DefaultSq")//默认软件授权
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
<title>软件授权</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="sq.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr>
      <td bgcolor="#FFFFFF">
<div align="center">增加软件授权： 
          <input name="sqname" type="text" id="sqname">
          <input type="submit" name="Submit" value="增加">
          <input name="phome" type="hidden" id="phome" value="AddSq">
        </div></td>
    </tr>
  </table>
</form>

<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="12%" height="25"> <div align="center">ID</div></td>
    <td width="52%" height="25"> <div align="left">软件授权</div></td>
    <td width="36%" height="25"> <div align="center">操作</div></td>
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
          <input type="button" name="Submit4" value="设为默认" onclick="self.location.href='sq.php?sqid=<?=$r[sqid]?>&phome=DefaultSq'">
          &nbsp; 
          <input type="submit" name="Submit2" value="修改">
          &nbsp; 
          <input type="button" name="Submit3" value="删除" onclick="if(confirm('确实要删除?')){self.location.href='sq.php?sqid=<?=$r[sqid]?>&phome=DelSq';}">
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
