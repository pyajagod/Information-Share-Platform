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
CheckLevel($myuserid,$myusername,$classid,"error");

//ɾ�����󱨸�
function DelError($errorid,$userid,$username){
	global $empire,$dbtbpre;
	$errorid=(int)$errorid;
	if(!$errorid)
	{
		printerror("��ѡ��Ҫɾ���Ĵ��󱨸�","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"error");
	$sql=$empire->query("delete from {$dbtbpre}downerror where errorid='$errorid'");
	if($sql)
	{
		printerror("ɾ�����󱨸�ɹ�","ListError.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�������󱨸�
function DelError_all($errorid,$userid,$username){
	global $empire,$dbtbpre;
	$count=count($errorid);
	if(!$count)
	{
		printerror("��ѡ��Ҫɾ���Ĵ��󱨸�","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"error");
	for($i=0;$i<$count;$i++)
	{
		$add.="errorid='".intval($errorid[$i])."' or ";
	}
	$add=substr($add,0,strlen($add)-4);
	$sql=$empire->query("delete from {$dbtbpre}downerror where ".$add);
	if($sql)
	{
		printerror("ɾ�����󱨸�ɹ�","ListError.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="DelError")//ɾ�����󱨸�
{
	$errorid=$_GET['errorid'];
	DelError($errorid,$myuserid,$myusername);
}
elseif($phome=="DelError_all")//�������󱨸�
{
	$errorid=$_POST['errorid'];
	DelError_all($errorid,$myuserid,$myusername);
}

$search="";
$line=10;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$offset=$start+$page*$line;//��ƫ����
$totalquery="select count(*) as total from {$dbtbpre}downerror";
$num=$empire->gettotal($totalquery);//ȡ��������
$query="select errorid,errortext,errorip,errortime,softid from {$dbtbpre}downerror";
$query=$query." order by errorid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>������󱨸�</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td height="27" bordercolor="#3366CC"> 
      <div align="left">λ��: <a href="ListError.php">������󱨸�</a></div></td>
  </tr>
</table>
<form name=form1 method=post action=ListError.php onsubmit="return confirm('ȷ��Ҫɾ����');">
<?
while($r=$empire->fetch($sql))
{
	$r1=$empire->fetch1("select softname,filename,titleurl from {$dbtbpre}down where softid='$r[softid]'");
	$softurl=EDReturnSoftPageUrl($r1[filename],$r1[titleurl]);
?>
  <table width="100%" border="0" align="center" cellpadding="6" cellspacing="1" class="tableborder">
    <tr bgcolor="#FFFFFF"> 
    <td height="25">������ƣ�<a href="<?=$softurl?>" target=_blank><?=$r1[softname]?></a></td>
    <td height="25"><input name="errorid[]" type="checkbox" id="errorid[]" value="<?=$r[errorid]?>">
        <a href="ListError.php?phome=DelError&errorid=<?=$r[errorid]?>" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��</a></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td width="38%" height="25">������IP��<?=$r[errorip]?></td>
    <td width="62%" height="25">����ʱ�䣺<?=$r[errortime]?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="2"> 
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr>
          <td><?=$r[errortext]?></td>
        </tr>
      </table></td>
  </tr>
</table><br>
<?
}
?>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><?=$returnpage?>&nbsp;&nbsp;&nbsp;<input type=submit name=submit value="����ɾ��">
        <input type=checkbox name=chkall value=on onclick="CheckAll(this.form)">
        ѡ��ȫ��
		<input type=hidden name=phome value=DelError_all></td>
    </tr>
  </table>
 </form>
</body>
</html>
<?
db_close();
$empire=null;
?>
