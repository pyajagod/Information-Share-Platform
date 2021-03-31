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
$url="软件环境管理";
//验证权限
CheckLevel($myuserid,$myusername,$classid,"fj");

//增加软件环境
function AddFj($fjname,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($fjname))
	{
		printerror("请输入软件环境名称","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"fj");
	$sql=$empire->query("insert into {$dbtbpre}fj(fjname) values('$fjname');");
	if($sql)
	{
		printerror("增加软件环境成功","fj.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改软件环境
function EditFj($fjid,$fjname,$userid,$username){
	global $empire,$dbtbpre;
	$fjid=(int)$fjid;
	if(!$fjid||!$fjname)
	{
		printerror("请输入软件环境名称","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"fj");
	$sql=$empire->query("update {$dbtbpre}fj set fjname='$fjname' where fjid='$fjid'");
	if($sql)
	{
		printerror("修改软件环境成功","fj.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除软件环境
function DelFj($fjid,$userid,$username){
	global $empire,$dbtbpre;
	$fjid=(int)$fjid;
	if(empty($fjid))
	{
		printerror("请选择要删除的软件环境","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"fj");
	$sql=$empire->query("delete from {$dbtbpre}fj where fjid='$fjid'");
	if($sql)
	{
		printerror("删除软件环境成功","fj.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="AddFj")//增加软件环境
{
	$fjname=$_POST['fjname'];
	AddFj($fjname,$myuserid,$myusername);
}
elseif($phome=="EditFj")//修改软件环境
{
	$fjid=$_POST['fjid'];
	$fjname=$_POST['fjname'];
	EditFj($fjid,$fjname,$myuserid,$myusername);
}
elseif($phome=="DelFj")//删除软件环境
{
	$fjid=$_GET['fjid'];
	DelFj($fjid,$myuserid,$myusername);
}

$sql=$empire->query("select fjid,fjname from {$dbtbpre}fj");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>软件环境</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="fj.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr>
      <td bgcolor="#FFFFFF">
<div align="center">增加软件环境： 
          <input name="fjname" type="text" id="fjname">
          <input type="submit" name="Submit" value="增加">
          <input name="phome" type="hidden" id="phome" value="AddFj">
        </div></td>
    </tr>
  </table>
</form>

<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="12%" height="25"> <div align="center">ID</div></td>
    <td width="52%" height="25"> <div align="left">软件环境</div></td>
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
  <form name=form1 method=post action="fj.php">
    <tr bgcolor="<?=$bgcolor?>"> 
      <td height="25"> <div align="center"> 
          <?=$r[fjid]?>
        </div></td>
      <td height="25"> <div align="left"> 
          <input name="fjname" type="text" id="fjname" value="<?=$r[fjname]?>">
        </div></td>
      <td height="25"> <div align="center"> 
          <input name="phome" type="hidden" id="phome" value="EditFj">
          <input name="fjid" type="hidden" id="fjid" value="<?=$r[fjid]?>">
          <input type="submit" name="Submit2" value="修改">
          &nbsp; 
          <input type="button" name="Submit3" value="删除" onclick="if(confirm('确实要删除?')){self.location.href='fj.php?fjid=<?=$r[fjid]?>&phome=DelFj';}">
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
