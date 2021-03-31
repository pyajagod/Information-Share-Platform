<?php
require("../../class/connect.php");
include("../../data/cache/public.php");
include("../../class/db_sql.php");
include("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"pay");

//设置接口
function EditPayApi($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[payid]=(int)$add[payid];
	if(empty($add[payname])||!$add[payid])
	{
		printerror("请输入接口名称","history.go(-1)");
    }
	$add[isclose]=(int)$add[isclose];
	$sql=$empire->query("update {$dbtbpre}downpayapi set isclose='$add[isclose]',payname='$add[payname]',paysay='$add[paysay]',payuser='$add[payuser]',paykey='$add[paykey]',payfee='$add[payfee]' where payid='$add[payid]'");
	if($sql)
	{
		printerror("设置接口完毕","PayApi.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_POST['phome'];
if(empty($phome))
{$phome=$_GET['phome'];}
//设置接口
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
<title>支付接口</title>
<link href="../../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置：在线支付&gt; <a href="PayApi.php">管理支付接口</a> </td>
    <td><div align="right">
        <input type="button" name="Submit5" value="管理支付记录" onclick="self.location.href='ListPayRecord.php';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="15%"><div align="center">接口名称</div></td>
    <td width="47%"><div align="center">接口描述</div></td>
    <td width="7%"><div align="center">状态</div></td>
    <td width="12%" height="25"><div align="center">接口类型</div></td>
    <td width="11%" height="25"><div align="center">操作</div></td>
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
        <?=$r[isclose]==0?'开启':'关闭'?>
      </div></td>
    <td height="25"> <div align="center">
        <?=$r[paytype]?>
      </div></td>
    <td height="25"> <div align="center"><a href="SetPayApi.php?phome=EditPayApi&payid=<?=$r[payid]?>">配置接口</a></div></td>
  </tr>
  <?
  }
  db_close();
  $empire=null;
  ?>
</table>
</body>
</html>
