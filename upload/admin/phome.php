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
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];

if($phome=="ReSoftData")//�������ݿ⻺��
{
	ReSoftData($myuserid,$myusername);
}
else
{
	printerror("�����Ե����Ӳ�����","history.go(-1)");
}
db_close();
$empire=null;
?>
