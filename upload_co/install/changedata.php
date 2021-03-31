<?php
error_reporting(E_ALL ^ E_NOTICE);

@set_time_limit(1000);

if(file_exists("install.off"))
{
	echo"《帝国下载系统》安装程序已锁定。如果要重新安装，请删除本目录下的<b>install.off</b>文件！";
	exit();
}

require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();

$phome=$_GET['phome'];
$defaultdata=$_GET['defaultdata'];

GetPublic();
GetMemberLevel();
GetClass();
GetClassZt();
echo"更新数据库缓存完毕.<script>self.location.href='index.php?phome=success&f=6&defaultdata=$defaultdata';</script>";
exit();
?>