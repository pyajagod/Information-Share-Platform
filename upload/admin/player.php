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
CheckLevel($myuserid,$myusername,$classid,"player");

//验证文件
function CheckPlayerFilename($filename){
	if(strstr($filename,"\\")||strstr($filename,"/")||strstr($filename,".."))
	{
		printerror("文件不存在","history.go(-1)");
	}
	//文件是否存在
	if(!file_exists("../play/".$filename))
	{
		printerror("文件不存在","history.go(-1)");
	}
}

//------------------增加播放器
function AddPlayer($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[player]||!$add[filename])
	{
		printerror("请输入播放器名称跟文件","history.go(-1)");
	}
	CheckPlayerFilename($add[filename]);
	$sql=$empire->query("insert into {$dbtbpre}downplayer(player,filename,bz) values('".addslashes($add[player])."','".addslashes($add[filename])."','".addslashes($add[bz])."');");
	$id=$empire->lastid();
	if($sql)
	{
		printerror("增加播放器成功","player.php");
	}
	else
	{printerror("数据库出错","history.go(-1)");}
}

//----------------修改播放器
function EditPlayer($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[id]=(int)$add[id];
	if(!$add[player]||!$add[filename]||!$add[id])
	{
		printerror("请输入播放器名称跟文件","history.go(-1)");
	}
	CheckPlayerFilename($add[filename]);
	$sql=$empire->query("update {$dbtbpre}downplayer set player='".addslashes($add[player])."',filename='".addslashes($add[filename])."',bz='".addslashes($add[bz])."' where id='$add[id]'");
	if($sql)
	{
		printerror("修改播放器成功","player.php");
	}
	else
	{printerror("数据库出错","history.go(-1)");}
}

//---------------删除播放器
function DelPlayer($id,$userid,$username){
	global $empire,$dbtbpre;
	$id=(int)$id;
	if(!$id)
	{
		printerror("请选择要删除的播放器","history.go(-1)");
	}
	$r=$empire->fetch1("select id,player from {$dbtbpre}downplayer where id='$id'");
	if(!$r[id])
	{
		printerror("NotDelPlayerID","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}downplayer where id='$id'");
	if($sql)
	{
		printerror("删除播放器成功","player.php");
	}
	else
	{printerror("数据库出错","history.go(-1)");}
}

$phome=$_POST['phome'];
if(empty($phome))
{$phome=$_GET['phome'];}
//增加播放器
if($phome=="AddPlayer")
{
	AddPlayer($_POST,$myuserid,$myusername);
}
//修改播放器
elseif($phome=="EditPlayer")
{
	EditPlayer($_POST,$myuserid,$myusername);
}
//删除播放器
elseif($phome=="DelPlayer")
{
	$id=$_GET['id'];
	DelPlayer($id,$myuserid,$myusername);
}
$sql=$empire->query("select id,player,filename,bz from {$dbtbpre}downplayer order by id");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>增加播放器</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<a href="player.php">管理播放器</a></td>
  </tr>
</table>
<form name="addplayerform" method="post" action="player.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="4">增加播放器: <input type=hidden name=phome value=AddPlayer></td>
    </tr>
    <tr>
      <td width="14%" height="25" bgcolor="#FFFFFF">播放器名称</td>
      <td width="33%" bgcolor="#FFFFFF">文件名</td>
      <td width="13%" bgcolor="#FFFFFF">说明</td>
      <td width="40%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 
        <input name="player" type="text" id="player" value="">
      </td>
      <td bgcolor="#FFFFFF">e/DownSys/play/ 
        <input name="filename" type="text" id="filename" value="">
        <a href="#edown" onclick="window.open('ChangePlayerFile.php?returnform=opener.document.addplayerform.filename.value','','width=400,height=500,scrollbars=yes');">[选择]</a></td>
      <td bgcolor="#FFFFFF"><input name="bz" type="text" id="bz"></td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="增加"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header">
    <td width="8%"> 
      <div align="center">ID</div></td>
    <td width="14%" height="25">播放器名称</td>
    <td width="33%">文件名</td>
    <td width="13%">说明</td>
    <td width="32%" height="25"> 操作</td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name="playerform<?=$r[id]?>" method=post action=player.php>
    <input type=hidden name=phome value=EditPlayer>
    <input type=hidden name=id value=<?=$r[id]?>>
    <tr bgcolor="#FFFFFF">
      <td><div align="center"><?=$r[id]?></div></td>
      <td height="25"> <input name="player" type="text" value="<?=htmlspecialchars(stripSlashes($r[player]))?>"> 
      </td>
      <td>play/ 
        <input name="filename" type="text" value="<?=htmlspecialchars(stripSlashes($r[filename]))?>"> 
        <a href="#edown" onclick="window.open('ChangePlayerFile.php?returnform=opener.document.playerform<?=$r[id]?>.filename.value','','width=400,height=500,scrollbars=yes');">[选择]</a></td>
      <td><input name="bz" type="text" value="<?=htmlspecialchars(stripSlashes($r[bz]))?>"></td>
      <td height="25"> <div align="left"> 
          <input type="submit" name="Submit3" value="修改">
          &nbsp; 
          <input type="button" name="Submit4" value="删除" onclick="if(confirm('确认要删除?')){self.location.href='player.php?phome=DelPlayer&id=<?=$r[id]?>';}">
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
