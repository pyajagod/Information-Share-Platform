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
//订单号
if(!getcvar('checkpaysession'))
{
	printerror('非法操作','../../',1);
}
else
{
	esetcookie("checkpaysession","",0);
}
//是否登陆
$user=islogin();
//操作事件
$phome=getcvar('payphome');
if($phome=='BuyGroupPay')//购买点数
{}
else
{
	printerror('您来自的链接不存在','',1);
}

$paytype='chinabank';
$payr=$empire->fetch1("select * from {$dbtbpre}downpayapi where paytype='$paytype' limit 1");

$v_mid=$payr['payuser'];//商户号

$key=$payr['paykey'];//密钥

//----------------------------------------------返回信息
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
	printerror('验证MD5签名失败.','../../',1);
}

if($v_pstatus!="20")
{
	printerror('支付失败.','../../',1);
}

//----------- 支付成功后处理 -----------

include('../payfun.php');

$orderid=$v_oid;	//支付订单
$ddno=$remark1;	//网站的订单号
$money=$v_amount;

if($phome=='BuyGroupPay')//购买充值类型
{
	$bgid=(int)getcvar('paymoneybgid');
	PayApiBuyGroupPay($bgid,$money,$orderid,$user[userid],$user[username],$user[groupid],$paytype);
}

db_close();
$empire=null;
?>