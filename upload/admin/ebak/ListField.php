<?php
require("../../class/connect.php");
include("../../data/cache/public.php");
include("../../class/db_sql.php");
include("../../class/functions.php");
include("class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"dbdata");
//���ݿ�
$mydbname=RepPostVar($_GET['mydbname']);
$mytbname=RepPostVar($_GET['mytbname']);
if(empty($mydbname)||empty($mytbname))
{
	printerror("��δѡ�����ݱ�","history.go(-1)");
}
$form=$_GET['form'];
if(empty($form))
{
	$form='ebakchangetb';
}
$usql=$empire->query("use `$mydbname`");
$sql=$empire->query("SHOW FIELDS FROM `".$mytbname."`");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>���ֶ��б�</title>
<link href="../../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ChangeAutoField(f)
{
	var tbname="<?=$mytbname?>";
	var chstr=tbname+"."+f;
	var r;
	var dh=",";
	var a;
	a=opener.document.<?=$form?>.autofield.value;
	r=a.split(chstr);
	if(r.length!=1)
	{return true;}
	if(a=="")
	{
		dh="";
	}
	opener.document.<?=$form?>.autofield.value+=dh+chstr;
	window.close();
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã�<b><?=$mydbname?>.<?=$mytbname?></b> �ֶ��б�</td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="27"> <div align="center">�ֶ���</div></td>
    <td><div align="center">�ֶ�����</div></td>
    <td><div align="center">�ֶ�����</div></td>
    <td><div align="center">Ĭ��ֵ</div></td>
    <td><div align="center">��������</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
	  $r[Field]="<a href='#ebak' onclick=\"ChangeAutoField('".$r[Field]."');\" title='����ȥ������ֵ�ֶ��б�'>$r[Field]</a>";
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="27"> <div align="center">
        <?=$r[Field]?>
      </div></td>
    <td> <div align="center">
        <?=$r[Type]?>
      </div></td>
    <td> <div align="center">
        <?=$r[Key]?>
      </div></td>
    <td> <div align="center">
        <?=$r['Default']?>
      </div></td>
    <td> <div align="center">
        <?=$r[Extra]?>
      </div></td>
  </tr>
  <?
  }
  db_close();
  $empire=null;
  ?>
</table>
<br>
</body>
</html>
