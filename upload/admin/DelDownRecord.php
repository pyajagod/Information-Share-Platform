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
CheckLevel($myuserid,$myusername,$classid,"card");

//批量删除备份记录
function DelDownRecord($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[downtime]=RepPostVar2($add[downtime]);
	if(empty($add[downtime]))
	{printerror("请输入截止时间","history.go(-1)");}
	//验证权限
	CheckLevel($userid,$username,$classid,"card");
	$sql=$empire->query("delete from {$dbtbpre}downdown where downtime<'".$add[downtime]."'");
	if($sql)
	{
		printerror("删除下载记录成功","DelDownRecord.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
//批量删除备份记录
if($phome=="DelDownRecord")
{
	DelDownRecord($_POST,$myuserid,$myusername);
}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>删除下载备份记录</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置: 删除下载备份记录</td>
  </tr>
</table>
<form name="form1" method="post" action="DelDownRecord.php" onsubmit="return confirm('确认要删除?');">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25"><div align="center">删除下载备份记录 
          <input name="phome" type="hidden" id="phome" value="DelDownRecord">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">删除截止于 
          <input name="downtime" type="text" id="downtime" value="<?=date("Y-m-d H:i:s")?>" size="20">
          之前的备份记录 
          <input type="submit" name="Submit" value="提交">
          &nbsp; </div></td>
    </tr>
  </table>
</form>
</body>
</html>
