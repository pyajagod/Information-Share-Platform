<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
include("../class/user.php");
include("../data/cache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
//�Ƿ��½
$user=islogin();
//֧��ƽ̨
$payid=intval($_POST['payid']);
if(!$payid)
{
	printerror('��ѡ��֧��ƽ̨','',1);
}
//��ֵ����
$id=intval($_POST['id']);
if(!$id)
{
	printerror('��ѡ���ֵ����','',1);
}
$payr=$empire->fetch1("select * from {$dbtbpre}downpayapi where payid='$payid' and isclose=0 limit 1");
if(!$payr[payid])
{
	printerror('��ѡ��֧��ƽ̨','',1);
}
$buyr=$empire->fetch1("select * from {$dbtbpre}downbuygroup where id='$id'");
if(!$buyr['id'])
{
	printerror('��ѡ���ֵ����','',1);
}
//Ȩ��
if($buyr[buygroupid]&&$level_r[$buyr[buygroupid]][level]>$level_r[$user[groupid]][level])
{
	printerror('�˳�ֵ������Ҫ '.$level_r[$buyr[buygroupid]][groupname].' ��Ա��������','',1);
}

$money=$buyr['gmoney'];
if(!$money)
{
	printerror('�˳�ֵ���ͽ������','',1);
}
$ddno='';
$productname="��ֵ����:".$buyr['gname'];

esetcookie("payphome","BuyGroupPay",0);
esetcookie("paymoneybgid",$id,0);
//���ص�ַǰ׺
$PayReturnUrlQz=$public_r['sitedown'];
if(!stristr($public_r['sitedown'],'://'))
{
	$PayReturnUrlQz=eReturnDomain().$public_r['sitedown'];
}
$file=$payr['paytype'].'/to_pay.php';
@include($file);
db_close();
$empire=null;
?>