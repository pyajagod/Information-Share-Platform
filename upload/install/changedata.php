<?php
error_reporting(E_ALL ^ E_NOTICE);

@set_time_limit(1000);

if(file_exists("install.off"))
{
	echo"���۹�����ϵͳ����װ���������������Ҫ���°�װ����ɾ����Ŀ¼�µ�<b>install.off</b>�ļ���";
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
echo"�������ݿ⻺�����.<script>self.location.href='index.php?phome=success&f=6&defaultdata=$defaultdata';</script>";
exit();
?>