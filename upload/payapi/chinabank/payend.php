<?php
require("../../class/connect.php");
include("../../data/cache/public.php");
include("../../class/db_sql.php");
include("../../class/q_functions.php");
include("../../class/user.php");
include("../../data/cache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//������
if(!getcvar('checkpaysession'))
{
	printerror('�Ƿ�����','../../',1);
}
else
{
	esetcookie("checkpaysession","",0);
}
//�Ƿ��½
$user=islogin();
//�����¼�
$phome=getcvar('payphome');
if($phome=='BuyGroupPay')//�������
{}
else
{
	printerror('�����Ե����Ӳ�����','',1);
}

$paytype='chinabank';
$payr=$empire->fetch1("select * from {$dbtbpre}downpayapi where paytype='$paytype' limit 1");

$v_mid=$payr['payuser'];//�̻���

$key=$payr['paykey'];//��Կ

//----------------------------------------------������Ϣ
$v_oid    =trim($_POST['v_oid']);      
$v_pmode   =trim($_POST['v_pmode']);      
$v_pstatus=trim($_POST['v_pstatus']);      
$v_pstring=trim($_POST['v_pstring']);      
$v_amount=trim($_POST['v_amount']);     
$v_moneytype  =trim($_POST['v_moneytype']);     
$remark1  =trim($_POST['remark1']);     
$remark2  =trim($_POST['remark2']);     
$v_md5str =trim($_POST['v_md5str']);    

//md5
$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));

if($v_md5str!=$md5string)
{
	printerror('��֤MD5ǩ��ʧ��.','../../',1);
}

if($v_pstatus!="20")
{
	printerror('֧��ʧ��.','../../',1);
}

//----------- ֧���ɹ����� -----------

include('../payfun.php');

$orderid=$v_oid;	//֧������
$ddno=$remark1;	//��վ�Ķ�����
$money=$v_amount;

if($phome=='BuyGroupPay')//�����ֵ����
{
	$bgid=(int)getcvar('paymoneybgid');
	PayApiBuyGroupPay($bgid,$money,$orderid,$user[userid],$user[username],$user[groupid],$paytype);
}

db_close();
$empire=null;
?>