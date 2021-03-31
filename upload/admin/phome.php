<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];

if($phome=="ReSoftData")//更新数据库缓存
{
	ReSoftData($myuserid,$myusername);
}
else
{
	printerror("您来自的链接不存在","history.go(-1)");
}
db_close();
$empire=null;
?>
