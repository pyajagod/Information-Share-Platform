<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
include("../data/cache/class.php");
$link=db_connect();
$empire=new mysqlquery();
//����
if($_GET['searchget']==1)
{
	$_POST=$_GET;
}
$ip=egetip();
$searchtime=time();
$keyboard=RepPostVar2($_POST['keyboard']);
if(!trim($keyboard))
{
	printerror('������ؼ���','history.go(-1)',1);
}
$add='';
$classid=(int)$_POST['classid'];
if($classid)
{
	//�ռ���Ŀ
	if($class_r[$classid][islast])
	{
		$add.="classid='$classid' and ";
	}
	else
	{
		$add.="(".ReturnClass($class_r[$classid][sonclass]).") and ";
	}
}
//ר��
$ztid=(int)$_POST['ztid'];
if($ztid)
{
	$add.="ztid='$ztid' and ";
}
$softtype=(int)$_POST['softtype'];
if($softtype)
{
	$add.="softtype='$softtype' and ";
}
$soft_sq=(int)$_POST['soft_sq'];
if($soft_sq)
{
	$add.="soft_sq='$soft_sq' and ";
}
$language=(int)$_POST['language'];
if($language)
{
	$add.="language='$language' and ";
}
$show=(int)$_POST['show'];
//������ʽ
if($show==0)//��ѯȫ��
{
	$add.="(softname like '%$keyboard%' or softsay like '%$keyboard%')";
}
elseif($show==1)//���������ѯ
{
	$add.="softname like '%$keyboard%'";
}
elseif($show==2)//�����˵����ѯ
{
	$add.="softsay like '%$keyboard%'";
}
else//�����߲�ѯ
{
	$add.="writer like '%$keyboard%'";
}
$search_r=$empire->fetch1("select searchid,searchtime from {$dbtbpre}downsearch where keyboard='$keyboard' and searchclass='$show' and classid='$classid' and softtype='$softtype' and language='$language' and soft_sq='$soft_sq' and ztid='$ztid' limit 1");
$query="select softid from {$dbtbpre}down where ".$add;
$totalquery="select count(*) as total from {$dbtbpre}down where ".$add;
$searchid=$search_r[searchid];
//�Ƿ�����ʷ��¼
if($searchid)
{
    $search_num=$empire->gettotal($totalquery);
	$sql=$empire->query("update {$dbtbpre}downsearch set searchtime='$searchtime',result_num='$search_num',onclick=onclick+1 where searchid='$searchid'");
}
else
{
	$search_num=$empire->gettotal($totalquery);
	if(!$search_num)
	{
		$searchid=0;
	}
	else
	{
		$sql=$empire->query("insert into {$dbtbpre}downsearch(searchtime,keyboard,searchclass,result_num,searchip,classid,softtype,language,soft_sq,onclick,ztid) values('$searchtime','$keyboard','$show','$search_num','$ip','$classid','$softtype','$language','$soft_sq','1','$ztid')");
		$searchid=$empire->lastid();
	}
}
db_close();
$empire=null;
Header("Location:result?searchid=$searchid");
?>
