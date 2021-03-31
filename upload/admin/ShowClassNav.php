<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
$ecms=$_GET['ecms'];
$classid=$_GET['classid'];
$fcjsfile='../data/fc/downclass.js';
$do_class=GetFcfiletext($fcjsfile);
$do_class=str_replace("<option value='$classid'","<option value='$classid' selected",$do_class);
db_close();
$empire=null;
//增加信息页导航
if($ecms==1)
{
	$show="增加下载：<select name=\\\"select\\\" onchange=\\\"if(this.options[this.selectedIndex].value!=0){self.location.href='AddSoft.php?bclassid=&classid='+this.options[this.selectedIndex].value+'&phome=AddSoft';}\\\"><option value='0'>选择增加下载的分类</option>".$do_class."</select>";
	echo"<script>parent.document.getElementById(\"showclassnav\").innerHTML=\"".$show."\";</script>";
}
//所有信息列表
elseif($ecms==2)
{
	$show="<select name='addclassid'><option value='0'>选择增加下载的分类</option>".$do_class."</select>";
	echo"<script>parent.document.getElementById(\"showaddclassnav\").innerHTML=\"".$show."\";";

	$show="<select name='classid' id='classid'><option value='0'>所有分类</option>".$do_class."</select>";
	echo"parent.document.getElementById(\"searchclassnav\").innerHTML=\"".$show."\";";

	$show="<select name='to_classid'><option value='0'>选择要移动/复制的目标分类</option>".$do_class."</select>";
	echo"parent.document.getElementById(\"moveclassnav\").innerHTML=\"".$show."\";</script>";
}
//信息列表
elseif($ecms==3)
{
	$show="<select name='to_classid'><option value='0'>选择要移动/复制的目标分类</option>".$do_class."</select>";
	echo"<script>parent.document.getElementById(\"moveclassnav\").innerHTML=\"".$show."\";</script>";
}
//插入附件
elseif($ecms==4)
{
	$show="<select name='searchclassid'><option value='all'>所有分类</option>".$do_class."</select>";
	echo"<script>parent.document.getElementById(\"fileclassnav\").innerHTML=\"".$show."\";</script>";
}
//管理附件
elseif($ecms==5)
{
	$show="<select name='classid'><option value='0'>所有分类</option>".$do_class."</select>";
	echo"<script>parent.document.getElementById(\"listfileclassnav\").innerHTML=\"".$show."\";</script>";
}
?>