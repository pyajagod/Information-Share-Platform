<?php
require("../class/connect.php");
include("../class/db_sql.php");
$link=db_connect();
$empire=new mysqlquery();
$lid=(int)$_GET['lid'];
$url=$_GET['url'];
if($url&&$lid)
{
	$sql=$empire->query("update {$dbtbpre}downlink set onclick=onclick+1 where lid='$lid'");
	$url=htmlspecialchars(urldecode($url));
	Header("Location:$url");
}
db_close();
$empire=null;
?>
