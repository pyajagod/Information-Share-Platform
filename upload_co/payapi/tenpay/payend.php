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

$paytype='tenpay';
$payr=$empire->fetch1("select * from {$dbtbpre}downpayapi where paytype='$paytype' limit 1");

$bargainor_id=$payr['payuser'];//商户号

$key=$payr['paykey'];//密钥

//----------------------------------------------返回信息
import_request_variables("gpc", "frm_");
$strCmdno			= $frm_cmdno;
$strPayResult		= $frm_pay_result;
$strPayInfo		= $frm_pay_info;
$strBillDate		= $frm_date;
$strBargainorId	= $frm_bargainor_id;
$strTransactionId	= $frm_transaction_id;
$strSpBillno		= $frm_sp_billno;
$strTotalFee		= $frm_total_fee;
$strFeeType		= $frm_fee_type;
$strAttach			= $frm_attach;
$strMd5Sign		= $frm_sign;

//支付验证
$checkkey="cmdno=".$strCmdno."&pay_result=".$strPayResult."&date=".$strBillDate."&transaction_id=".$strTransactionId."&sp_billno=".$strSpBillno."&total_fee=".$strTotalFee."&fee_type=".$strFeeType."&attach=".$strAttach."&key=".$key;
$checkSign=strtoupper(md5($checkkey));
  
if($checkSign!=$strMd5Sign)
{
	printerror('验证MD5签名失败.','../../',1);
}  

if($bargainor_id!=$strBargainorId)
{
	printerror('错误的商户号.','../../',1);
}

if($strPayResult!="0")
{
	printerror('支付失败.','../../',1);
}

//----------- 支付成功后处理 -----------

include('../payfun.php');

$orderid=$strSpBillno;	//支付订单
$ddno=$strAttach;	//网站的订单号
$money=$strTotalFee/100;

if($phome=='BuyGroupPay')//购买充值类型
{
	$bgid=(int)getcvar('paymoneybgid');
	PayApiBuyGroupPay($bgid,$money,$orderid,$user[userid],$user[username],$user[groupid],$paytype);
}

db_close();
$empire=null;
?>