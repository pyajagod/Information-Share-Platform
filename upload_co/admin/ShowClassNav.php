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
//������Ϣҳ����
if($ecms==1)
{
	$show="�������أ�<select name=\\\"select\\\" onchange=\\\"if(this.options[this.selectedIndex].value!=0){self.location.href='AddSoft.php?bclassid=&classid='+this.options[this.selectedIndex].value+'&phome=AddSoft';}\\\"><option value='0'>ѡ���������صķ���</option>".$do_class."</select>";
	echo"<script>parent.document.getElementById(\"showclassnav\").innerHTML=\"".$show."\";</script>";
}
//������Ϣ�б�
elseif($ecms==2)
{
	$show="<select name='addclassid'><option value='0'>ѡ���������صķ���</option>".$do_class."</select>";
	echo"<script>parent.document.getElementById(\"showaddclassnav\").innerHTML=\"".$show."\";";

	$show="<select name='classid' id='classid'><option value='0'>���з���</option>".$do_class."</select>";
	echo"parent.document.getElementById(\"searchclassnav\").innerHTML=\"".$show."\";";

	$show="<select name='to_classid'><option value='0'>ѡ��Ҫ�ƶ�/���Ƶ�Ŀ�����</option>".$do_class."</select>";
	echo"parent.document.getElementById(\"moveclassnav\").innerHTML=\"".$show."\";</script>";
}
//��Ϣ�б�
elseif($ecms==3)
{
	$show="<select name='to_classid'><option value='0'>ѡ��Ҫ�ƶ�/���Ƶ�Ŀ�����</option>".$do_class."</select>";
	echo"<script>parent.document.getElementById(\"moveclassnav\").innerHTML=\"".$show."\";</script>";
}
//���븽��
elseif($ecms==4)
{
	$show="<select name='searchclassid'><option value='all'>���з���</option>".$do_class."</select>";
	echo"<script>parent.document.getElementById(\"fileclassnav\").innerHTML=\"".$show."\";</script>";
}
//������
elseif($ecms==5)
{
	$show="<select name='classid'><option value='0'>���з���</option>".$do_class."</select>";
	echo"<script>parent.document.getElementById(\"listfileclassnav\").innerHTML=\"".$show."\";</script>";
}
?>