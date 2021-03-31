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
CheckLevel($myuserid,$myusername,$classid,"player");

//��֤�ļ�
function CheckPlayerFilename($filename){
	if(strstr($filename,"\\")||strstr($filename,"/")||strstr($filename,".."))
	{
		printerror("�ļ�������","history.go(-1)");
	}
	//�ļ��Ƿ����
	if(!file_exists("../play/".$filename))
	{
		printerror("�ļ�������","history.go(-1)");
	}
}

//------------------���Ӳ�����
function AddPlayer($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[player]||!$add[filename])
	{
		printerror("�����벥�������Ƹ��ļ�","history.go(-1)");
	}
	CheckPlayerFilename($add[filename]);
	$sql=$empire->query("insert into {$dbtbpre}downplayer(player,filename,bz) values('".addslashes($add[player])."','".addslashes($add[filename])."','".addslashes($add[bz])."');");
	$id=$empire->lastid();
	if($sql)
	{
		printerror("���Ӳ������ɹ�","player.php");
	}
	else
	{printerror("���ݿ����","history.go(-1)");}
}

//----------------�޸Ĳ�����
function EditPlayer($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[id]=(int)$add[id];
	if(!$add[player]||!$add[filename]||!$add[id])
	{
		printerror("�����벥�������Ƹ��ļ�","history.go(-1)");
	}
	CheckPlayerFilename($add[filename]);
	$sql=$empire->query("update {$dbtbpre}downplayer set player='".addslashes($add[player])."',filename='".addslashes($add[filename])."',bz='".addslashes($add[bz])."' where id='$add[id]'");
	if($sql)
	{
		printerror("�޸Ĳ������ɹ�","player.php");
	}
	else
	{printerror("���ݿ����","history.go(-1)");}
}

//---------------ɾ��������
function DelPlayer($id,$userid,$username){
	global $empire,$dbtbpre;
	$id=(int)$id;
	if(!$id)
	{
		printerror("��ѡ��Ҫɾ���Ĳ�����","history.go(-1)");
	}
	$r=$empire->fetch1("select id,player from {$dbtbpre}downplayer where id='$id'");
	if(!$r[id])
	{
		printerror("NotDelPlayerID","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}downplayer where id='$id'");
	if($sql)
	{
		printerror("ɾ���������ɹ�","player.php");
	}
	else
	{printerror("���ݿ����","history.go(-1)");}
}

$phome=$_POST['phome'];
if(empty($phome))
{$phome=$_GET['phome'];}
//���Ӳ�����
if($phome=="AddPlayer")
{
	AddPlayer($_POST,$myuserid,$myusername);
}
//�޸Ĳ�����
elseif($phome=="EditPlayer")
{
	EditPlayer($_POST,$myuserid,$myusername);
}
//ɾ��������
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
<title>���Ӳ�����</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<a href="player.php">��������</a></td>
  </tr>
</table>
<form name="addplayerform" method="post" action="player.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="4">���Ӳ�����: <input type=hidden name=phome value=AddPlayer></td>
    </tr>
    <tr>
      <td width="14%" height="25" bgcolor="#FFFFFF">����������</td>
      <td width="33%" bgcolor="#FFFFFF">�ļ���</td>
      <td width="13%" bgcolor="#FFFFFF">˵��</td>
      <td width="40%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 
        <input name="player" type="text" id="player" value="">
      </td>
      <td bgcolor="#FFFFFF">e/DownSys/play/ 
        <input name="filename" type="text" id="filename" value="">
        <a href="#edown" onclick="window.open('ChangePlayerFile.php?returnform=opener.document.addplayerform.filename.value','','width=400,height=500,scrollbars=yes');">[ѡ��]</a></td>
      <td bgcolor="#FFFFFF"><input name="bz" type="text" id="bz"></td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="����"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header">
    <td width="8%"> 
      <div align="center">ID</div></td>
    <td width="14%" height="25">����������</td>
    <td width="33%">�ļ���</td>
    <td width="13%">˵��</td>
    <td width="32%" height="25"> ����</td>
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
        <a href="#edown" onclick="window.open('ChangePlayerFile.php?returnform=opener.document.playerform<?=$r[id]?>.filename.value','','width=400,height=500,scrollbars=yes');">[ѡ��]</a></td>
      <td><input name="bz" type="text" value="<?=htmlspecialchars(stripSlashes($r[bz]))?>"></td>
      <td height="25"> <div align="left"> 
          <input type="submit" name="Submit3" value="�޸�">
          &nbsp; 
          <input type="button" name="Submit4" value="ɾ��" onclick="if(confirm('ȷ��Ҫɾ��?')){self.location.href='player.php?phome=DelPlayer&id=<?=$r[id]?>';}">
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
