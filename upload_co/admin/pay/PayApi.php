<?php
require("../../class/connect.php");
include("../../data/cache/public.php");
include("../../class/db_sql.php");
include("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"pay");

//���ýӿ�
function EditPayApi($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[payid]=(int)$add[payid];
	if(empty($add[payname])||!$add[payid])
	{
		printerror("������ӿ�����","history.go(-1)");
    }
	$add[isclose]=(int)$add[isclose];
	$sql=$empire->query("update {$dbtbpre}downpayapi set isclose='$add[isclose]',payname='$add[payname]',paysay='$add[paysay]',payuser='$add[payuser]',paykey='$add[paykey]',payfee='$add[payfee]' where payid='$add[payid]'");
	if($sql)
	{
		printerror("���ýӿ����","PayApi.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

$phome=$_POST['phome'];
if(empty($phome))
{$phome=$_GET['phome'];}
//���ýӿ�
if($phome=="EditPayApi")
{
	EditPayApi($_POST,$myuserid,$myusername);
}

$sql=$empire->query("select payid,paytype,payfee,paylogo,paysay,payname,isclose from {$dbtbpre}downpayapi order by myorder,payid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>֧���ӿ�</title>
<link href="../../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">λ�ã�����֧��&gt; <a href="PayApi.php">����֧���ӿ�</a> </td>
    <td><div align="right">
        <input type="button" name="Submit5" value="����֧����¼" onclick="self.location.href='ListPayRecord.php';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="15%"><div align="center">�ӿ�����</div></td>
    <td width="47%"><div align="center">�ӿ�����</div></td>
    <td width="7%"><div align="center">״̬</div></td>
    <td width="12%" height="25"><div align="center">�ӿ�����</div></td>
    <td width="11%" height="25"><div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
	  if($r[paytype]=='tenpay')
	  {
		  $r[payname]="<font color='red'><b>".$r[payname]."</b></font>";
	  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="38" align="center"> 
      <?=$r[payname]?>
    </td>
    <td>
      <?=$r[paysay]?>
    </td>
    <td><div align="center">
        <?=$r[isclose]==0?'����':'�ر�'?>
      </div></td>
    <td height="25"> <div align="center">
        <?=$r[paytype]?>
      </div></td>
    <td height="25"> <div align="center"><a href="SetPayApi.php?phome=EditPayApi&payid=<?=$r[payid]?>">���ýӿ�</a></div></td>
  </tr>
  <?
  }
  db_close();
  $empire=null;
  ?>
</table>
</body>
</html>
