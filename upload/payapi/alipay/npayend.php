

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
//������

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

$paytype='alipay';
$payr=$empire->fetch1("select * from {$dbtbpre}downpayapi where paytype='$paytype' limit 1");

$v_mid=$payr['payuser'];//�̻���

$key=$payr['paykey'];//��Կ
//----------------------------------------------������Ϣ
require_once 'config.php';
require_once 'pagepay/service/AlipayTradeService.php';

$arr=$_POST;
$alipaySevice = new AlipayTradeService($config);
$alipaySevice->writeLog(var_export($_POST,true));
$result = $alipaySevice->check($arr);

/* ʵ����֤���̽����̻��������У�顣
1���̻���Ҫ��֤��֪ͨ�����е�out_trade_no�Ƿ�Ϊ�̻�ϵͳ�д����Ķ����ţ�
2���ж�total_amount�Ƿ�ȷʵΪ�ö�����ʵ�ʽ����̻���������ʱ�Ľ���
3��У��֪ͨ�е�seller_id������seller_email) �Ƿ�Ϊout_trade_no��ʵ��ݵĶ�Ӧ�Ĳ��������е�ʱ��һ���̻������ж��seller_id/seller_email��
4����֤app_id�Ƿ�Ϊ���̻�����
*/

?><!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
    /* *
     * ���ܣ�֧����ҳ����תͬ��֪ͨҳ��
     * �汾��2.0
     * �޸����ڣ�2017-05-01
     * ˵����
     * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣

     *************************ҳ�湦��˵��*************************
     * ��ҳ����ڱ������Բ���
     * �ɷ���HTML������ҳ��Ĵ��롢�̻�ҵ���߼��������
     */
    require_once("config.php");
    require_once 'pagepay/service/AlipayTradeService.php';


    $arr=$_GET;
    $alipaySevice = new AlipayTradeService($config);
    $result = $alipaySevice->check($arr);

    /* ʵ����֤���̽����̻��������У�顣
    1���̻���Ҫ��֤��֪ͨ�����е�out_trade_no�Ƿ�Ϊ�̻�ϵͳ�д����Ķ����ţ�
    2���ж�total_amount�Ƿ�ȷʵΪ�ö�����ʵ�ʽ����̻���������ʱ�Ľ���
    3��У��֪ͨ�е�seller_id������seller_email) �Ƿ�Ϊout_trade_no��ʵ��ݵĶ�Ӧ�Ĳ��������е�ʱ��һ���̻������ж��seller_id/seller_email��
    4����֤app_id�Ƿ�Ϊ���̻�����
    */
    if($result) {//��֤�ɹ�
        //�̻�������

        $out_trade_no = $_GET['out_trade_no'];

        //֧�������׺�

        $trade_no = $_GET['trade_no'];

        //����״̬
        $trade_status = $_GET['trade_status'];

        $trade_price = $_GET['total_amount'];

        include('../payfun.php');
        $orderid=$trade_no;	//֧������
        $ddno=$out_trade_no;	//��վ�Ķ�����
        $money=$trade_price;   //��������

        if($phome=='BuyGroupPay')//�����ֵ����
        {
            $bgid=(int)getcvar('paymoneybgid');
            PayApiBuyGroupPay($bgid,$money,$orderid,$user[userid],$user[username],$user[groupid],$paytype);
        }

        db_close();
        $empire=null;
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //������������̻���ҵ���߼��������

        //�������������ҵ���߼�����д�������´�������ο�������
        //��ȡ֧������֪ͨ���ز������ɲο������ĵ���ҳ����תͬ��֪ͨ�����б�

        //�̻�������
        $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

        //֧�������׺�
        $trade_no = htmlspecialchars($_GET['trade_no']);

        echo "��֤�ɹ�<br />֧�������׺ţ�".$trade_no;

        //�������������ҵ���߼�����д�������ϴ�������ο�������

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    else {
        //��֤ʧ��
        echo "��֤ʧ��";
    }
    ?>
    <title>֧����������վ֧��return_url</title>
</head>
<body>
</body>
</html>