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
CheckLevel($myuserid,$myusername,$classid,"link");

//������������
function AddLink($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[lname]||!$add[lurl])
	{
		printerror("��������վ��������ַ","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"link");
	$add[onclick]=(int)$add[onclick];
	$add[myorder]=(int)$add[myorder];
	$add[checked]=(int)$add[checked];
	$add[ltype]=(int)$add[ltype];
	$ltime=date("Y-m-d H:i:s");
	$sql=$empire->query("insert into {$dbtbpre}downlink(lname,lpic,lurl,ltime,onclick,width,height,target,myorder,email,lsay,ltype,checked) values('$add[lname]','$add[lpic]','$add[lurl]','$ltime','$add[onclick]','$add[width]','$add[height]','$add[target]','$add[myorder]','$add[email]','$add[lsay]','$add[ltype]','$add[checked]');");
	if($sql)
	{
		printerror("�����������ӳɹ�","AddLink.php?phome=AddLink");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸���������
function EditLink($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[lid]=(int)$add[lid];
	if(!$add[lname]||!$add[lurl]||!$add[lid])
	{
		printerror("��������վ��������ַ","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"link");
	$add[onclick]=(int)$add[onclick];
	$add[myorder]=(int)$add[myorder];
	$add[checked]=(int)$add[checked];
	$add[ltype]=(int)$add[ltype];
	$sql=$empire->query("update {$dbtbpre}downlink set lname='$add[lname]',lpic='$add[lpic]',lurl='$add[lurl]',onclick='$add[onclick]',width='$add[width]',height='$add[height]',target='$add[target]',myorder='$add[myorder]',email='$add[email]',lsay='$add[lsay]',ltype='$add[ltype]',checked='$add[checked]' where lid='$add[lid]'");
	if($sql)
	{
		printerror("�޸��������ӳɹ�","ListLink.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ����������
function DelLink($lid,$userid,$username){
	global $empire,$dbtbpre;
	$lid=(int)$lid;
	if(!$lid)
	{
		printerror("��ѡ��Ҫɾ������������","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"link");
	$r=$empire->fetch1("select lname from {$dbtbpre}downlink where lid='$lid'");
	$sql=$empire->query("delete from {$dbtbpre}downlink where lid='$lid'");
	if($sql)
	{
		printerror("ɾ���������ӳɹ�","ListLink.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
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
$line=16;//ÿҳ��ʾ����
$page_line=25;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
$query="select * from {$dbtbpre}downlink";
$num=$empire->num($query);//ȡ��������
$query=$query." order by myorder,lid limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>������������</title>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">λ�ã�<a href="ListLink.php">������������</a></td>
    <td><div align="right"> 
        <input type="button" name="Submit5" value="������������" onclick="self.location.href='AddLink.php?phome=AddLink';">
      </div></td>
  </tr>
</table>
<br>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="6%" height="25"> <div align="center">ID</div></td>
    <td width="51%" height="25"> <div align="center">Ԥ��</div></td>
    <td width="11%" height="25"> <div align="center">���</div></td>
    <td width="12%"><div align="center">״̬</div></td>
    <td width="20%" height="25"> <div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  //����
  if(empty($r[lpic]))
  {
  $logo="<a href='".$r[lurl]."' title='".$r[lname]."' target=".$r[target].">".$r[lname]."</a>";
  }
  //ͼƬ
  else
  {
  $logo="<a href='".$r[lurl]."' target=".$r[target]."><img src='".$r[lpic]."' alt='".$r[lname]."' border=0 width='".$r[width]."' height='".$r[height]."'></a>";
  }
  if(empty($r[checked]))
  {$checked="�ر�";}
  else
  {$checked="��ʾ";}
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
    <td height="25"> <div align="center">[<a href="AddLink.php?phome=EditLink&lid=<?=$r[lid]?>">�޸�</a>]&nbsp;[<a href="ListLink.php?phome=DelLink&lid=<?=$r[lid]?>" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��</a>]</div></td>
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
