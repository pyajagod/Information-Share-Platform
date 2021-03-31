<?php
error_reporting(E_ALL ^ E_NOTICE);
$js=$_GET['js'];
$classid=$_GET['classid'];
$ztid=$_GET['ztid'];
if($classid)
{
	$url=$js;
}
else
{
	if($_GET['p'])
	{
		$a=$_GET['p']."/";
	}
	$url="../../data/js/".$a.$js.".js";
}
?>
<link href="../../data/images/index.css" rel="stylesheet" type="text/css">
<script src="<?=$url?>"></script>