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
$url="软件语言管理";
//验证权限
CheckLevel($myuserid,$myusername,$classid,"language");

//增加软件语言
function AddLanguage($language,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($language))
	{
		printerror("请输入语言名称","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"language");
	$sql=$empire->query("insert into {$dbtbpre}language(language) values('$language');");
	GetClassZt();//更新缓存
	if($sql)
	{
		printerror("增加语言成功","language.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改软件语言
function EditLanguage($languageid,$language,$userid,$username){
	global $empire,$dbtbpre;
	$languageid=(int)$languageid;
	if(!$languageid||!$language)
	{
		printerror("请输入语言名称","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"language");
	$sql=$empire->query("update {$dbtbpre}language set language='$language' where languageid='$languageid'");
	GetClassZt();//更新缓存
	if($sql)
	{
		printerror("修改语言成功","language.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除语言
function DelLanguage($languageid,$userid,$username){
	global $empire,$dbtbpre;
	$languageid=(int)$languageid;
	if(empty($languageid))
	{
		printerror("请选择要删除的语言","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"language");
	$sql=$empire->query("delete from {$dbtbpre}language where languageid='$languageid'");
	GetClassZt();//更新缓存
	if($sql)
	{
		printerror("删除语言成功","language.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//设为默认语言
function DefaultLanguage($languageid,$userid,$username){
	global $empire,$dbtbpre;
	$languageid=(int)$languageid;
	if(!$languageid)
	{
		printerror("请选择要设置的默认语言","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"language");
	$sql1=$empire->query("update {$dbtbpre}language set isdefault=0");
	$sql=$empire->query("update {$dbtbpre}language set isdefault=1 where languageid='$languageid'");
	if($sql)
	{
		printerror("设为默认语言成功","language.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="AddLanguage")//增加语言
{
	$language=$_POST['language'];
	AddLanguage($language,$myuserid,$myusername);
}
elseif($phome=="EditLanguage")//修改语言
{
	$languageid=$_POST['languageid'];
	$language=$_POST['language'];
	EditLanguage($languageid,$language,$myuserid,$myusername);
}
elseif($phome=="DelLanguage")//删除语言
{
	$languageid=$_GET['languageid'];
	DelLanguage($languageid,$myuserid,$myusername);
}
elseif($phome=="DefaultLanguage")//默认语言
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
<title>软件语言管理</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="language.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr>
      <td bgcolor="#FFFFFF">
<div align="center">增加软件语言： 
          <input name="language" type="text" id="language">
          <input type="submit" name="Submit" value="增加">
          <input name="phome" type="hidden" id="phome" value="AddLanguage">
        </div></td>
    </tr>
  </table>
</form>

<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="12%" height="25"> <div align="center">ID</div></td>
    <td width="52%" height="25"> <div align="left">软件语言</div></td>
    <td width="36%" height="25"> <div align="center">操作</div></td>
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
          <input type="button" name="Submit4" value="设为默认" onclick="self.location.href='language.php?languageid=<?=$r[languageid]?>&phome=DefaultLanguage'">
          &nbsp; 
          <input type="submit" name="Submit2" value="修改">
          &nbsp; 
          <input type="button" name="Submit3" value="删除" onclick="if(confirm('确实要删除?')){self.location.href='language.php?languageid=<?=$r[languageid]?>&phome=DelLanguage';}">
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
