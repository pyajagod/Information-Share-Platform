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

$paytype='tenpay';
$payr=$empire->fetch1("select * from {$dbtbpre}downpayapi where paytype='$paytype' limit 1");

$bargainor_id=$payr['payuser'];//�̻���

$key=$payr['paykey'];//��Կ

//----------------------------------------------������Ϣ
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

//֧����֤
$checkkey="cmdno=".$strCmdno."&pay_result=".$strPayResult."&date=".$strBillDate."&transaction_id=".$strTransactionId."&sp_billno=".$strSpBillno."&total_fee=".$strTotalFee."&fee_type=".$strFeeType."&attach=".$strAttach."&key=".$key;
$checkSign=strtoupper(md5($checkkey));
  
if($checkSign!=$strMd5Sign)
{
	printerror('��֤MD5ǩ��ʧ��.','../../',1);
}  

if($bargainor_id!=$strBargainorId)
{
	printerror('������̻���.','../../',1);
}

if($strPayResult!="0")
{
	printerror('֧��ʧ��.','../../',1);
}

//----------- ֧���ɹ����� -----------

include('../payfun.php');

$orderid=$strSpBillno;	//֧������
$ddno=$strAttach;	//��վ�Ķ�����
$money=$strTotalFee/100;

if($phome=='BuyGroupPay')//�����ֵ����
{
	$bgid=(int)getcvar('paymoneybgid');
	PayApiBuyGroupPay($bgid,$money,$orderid,$user[userid],$user[username],$user[groupid],$paytype);
}

db_close();
$empire=null;
?>