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
CheckLevel($myuserid,$myusername,$classid,"softtype");

//增加软件类别
function AddSofttype($add,$userid,$username){
	global $empire,$dbtbpre;
	$lencord=(int)$add['lencord'];
	$maxnum=(int)$add['maxnum'];
	$listtempid=(int)$add['listtempid'];
	if(!$add[softtype]||!$listtempid)
	{
		printerror("请输入软件类别名与选择列表模板","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"softtype");
	$sql=$empire->query("insert into {$dbtbpre}softtype(softtype,lencord,isdefault,maxnum,listtempid) values('$add[softtype]','$lencord',0,'$maxnum','$listtempid');");
	GetClassZt();//更新缓存
	if($sql)
	{
		printerror("增加软件类别成功","softtype.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改软件类别
function EditSofttype($add,$userid,$username){
	global $empire,$dbtbpre;
	$softtypeid=(int)$add['softtypeid'];
	$lencord=(int)$add['lencord'];
	$maxnum=(int)$add['maxnum'];
	$listtempid=(int)$add['listtempid'];
	if(!$softtypeid||!$add[softtype]||!$listtempid)
	{
		printerror("请输入软件类别名与选择列表模板","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"softtype");
	$sql=$empire->query("update {$dbtbpre}softtype set softtype='$add[softtype]',lencord='$lencord',maxnum='$maxnum',listtempid='$listtempid' where softtypeid='$softtypeid'");
	GetClassZt();//更新缓存
	if($sql)
	{
		printerror("修改软件类别成功","softtype.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除软件类别
function DelSofttype($softtypeid,$userid,$username){
	global $empire,$dbtbpre;
	$softtypeid=(int)$softtypeid;
	if(empty($softtypeid))
	{
		printerror("请选择要删除的软件类别","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"softtype");
	//删除列表文件
	$r=$empire->fetch1("select lencord from {$dbtbpre}softtype where softtypeid='$softtypeid'");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where softtype='$softtypeid'");
	GetClassZt();//更新缓存
    DelListFile("type".$softtypeid."_",$r[lencord],$num);
	$sql=$empire->query("delete from {$dbtbpre}softtype where softtypeid='$softtypeid'");
	if($sql)
	{
		printerror("删除软件类别成功","softtype.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//默认软件类别
function DefaultSofttype($softtypeid,$userid,$username){
	global $empire,$dbtbpre;
	$softtypeid=(int)$softtypeid;
	if(empty($softtypeid))
	{
		printerror("请选择要默认的软件类型","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"softtype");
	$sql1=$empire->query("update {$dbtbpre}softtype set isdefault=0");
	$sql=$empire->query("update {$dbtbpre}softtype set isdefault=1 where softtypeid='$softtypeid'");
	if($sql)
	{
		printerror("设为默认软件类型成功","softtype.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="AddSofttype")//增加软件类型
{
	AddSofttype($_POST,$myuserid,$myusername);
}
elseif($phome=="EditSofttype")//修改软件类型
{
	EditSofttype($_POST,$myuserid,$myusername);
}
elseif($phome=="DelSofttype")//删除软件类型
{
	$softtypeid=$_GET['softtypeid'];
	DelSofttype($softtypeid,$myuserid,$myusername);
}
elseif($phome=="DefaultSofttype")//默认软件类型
{
	$softtypeid=$_GET['softtypeid'];
	DefaultSofttype($softtypeid,$myuserid,$myusername);
}

$url="软件类型管理";
$sql=$empire->query("select softtypeid,softtype,lencord,isdefault,maxnum,listtempid from {$dbtbpre}softtype");
//列表模板
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
<title>软件类型</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="softtype.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr>
      <td bgcolor="#FFFFFF">
<div align="center">增加软件类型： 
          <input name="softtype" type="text" id="softtype">
          列表模板<select name="listtempid">
          <?=$listtemp?>
        </select>，每页显示 
          <input name="lencord" type="text" id="lencord" value="25" size="6">
          条，最大显示数
          <input name="maxnum" type="text" id="maxnum" value="0" size="6">
          <input type="submit" name="Submit" value="增加">
          <input name="phome" type="hidden" id="phome" value="AddSofttype">
        </div></td>
    </tr>
  </table>
</form>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="7%" height="25"> <div align="center">ID</div></td>
    <td width="22%" height="25"> <div align="left">软件类型</div></td>
    <td width="20%">列表模板</td>
    <td width="8%" height="25"><div align="center">预览</div></td>
    <td width="9%" height="25"> <div align="center">每页数</div></td>
    <td width="9%"><div align="center">最大数</div></td>
    <td width="25%" height="25"> <div align="center">操作</div></td>
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
          [<a href='chtmlphome.php?phome=ReSoftTypeHtml&softtypeid=<?=$r[softtypeid]?>'>生成</a>]</div></td>
      <td><select name="listtempid" id="listtempid">
          <?=str_replace("<option value='$r[listtempid]'>","<option value='$r[listtempid]' selected>",$listtemp)?>
        </select></td>
      <td height="25"> <div align="center">[<a href="<?=$pageurl?>" target=_blank>预览</a>]</div></td>
      <td height="25"> <div align="center"> 
          <input name="lencord" type="text" id="lencord" value="<?=$r[lencord]?>" size="6">
        </div></td>
      <td><div align="center"> 
          <input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="6">
        </div></td>
      <td height="25"> <div align="center"> 
          <input name="softtypeid" type="hidden" id="softtypeid" value="<?=$r[softtypeid]?>">
          <input name="phome" type="hidden" id="phome" value="EditSofttype">
          <input type="button" name="Submit4" value="设为默认" onclick="self.location.href='softtype.php?softtypeid=<?=$r[softtypeid]?>&phome=DefaultSofttype'">
          &nbsp; 
          <input type="submit" name="Submit2" value="修改">
          &nbsp; 
          <input type="button" name="Submit3" value="删除" onclick="if(confirm('确实要删除?')){self.location.href='softtype.php?softtypeid=<?=$r[softtypeid]?>&phome=DelSofttype';}">
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
