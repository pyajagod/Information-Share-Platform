

<?php
header("Content-type:text/html; charset=utf-8");
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

$paytype='alipay';
$payr=$empire->fetch1("select * from {$dbtbpre}downpayapi where paytype='$paytype' limit 1");

$v_mid=$payr['payuser'];//商户号

$key=$payr['paykey'];//密钥
//----------------------------------------------返回信息
require_once 'config.php';
require_once 'pagepay/service/AlipayTradeService.php';

$arr=$_POST;
$alipaySevice = new AlipayTradeService($config);
$alipaySevice->writeLog(var_export($_POST,true));
$result = $alipaySevice->check($arr);

/* 实际验证过程建议商户添加以下校验。
1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
4、验证app_id是否为该商户本身。
*/

?><!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
    /* *
     * 功能：支付宝页面跳转同步通知页面
     * 版本：2.0
     * 修改日期：2017-05-01
     * 说明：
     * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。

     *************************页面功能说明*************************
     * 该页面可在本机电脑测试
     * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
     */
    require_once("config.php");
    require_once 'pagepay/service/AlipayTradeService.php';


    $arr=$_GET;
    $alipaySevice = new AlipayTradeService($config);
    $result = $alipaySevice->check($arr);

    /* 实际验证过程建议商户添加以下校验。
    1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
    2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
    3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
    4、验证app_id是否为该商户本身。
    */
    if($result) {//验证成功
        //商户订单号

        $out_trade_no = $_GET['out_trade_no'];

        //支付宝交易号

        $trade_no = $_GET['trade_no'];

        //交易状态
        $trade_status = $_GET['trade_status'];

        $trade_price = $_GET['total_amount'];

        include('../payfun.php');
        $orderid=$trade_no;	//支付订单
        $ddno=$out_trade_no;	//网站的订单号
        $money=$trade_price;   //交易数额

        if($phome=='BuyGroupPay')//购买充值类型
        {
            $bgid=(int)getcvar('paymoneybgid');
            PayApiBuyGroupPay($bgid,$money,$orderid,$user[userid],$user[username],$user[groupid],$paytype);
        }

        db_close();
        $empire=null;
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //请在这里加上商户的业务逻辑程序代码

        //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
        //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

        //商户订单号
        $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

        //支付宝交易号
        $trade_no = htmlspecialchars($_GET['trade_no']);

        echo "验证成功<br />支付宝交易号：".$trade_no;

        //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    else {
        //验证失败
        echo "验证失败";
    }
    ?>
    <title>支付宝电脑网站支付return_url</title>
</head>
<body>
</body>
</html>