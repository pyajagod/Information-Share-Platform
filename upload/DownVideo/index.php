<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
include("../class/user.php");
include("../data/cache/MemberLevel.php");
include("../data/cache/class.php");
$link=db_connect();
$empire=new mysqlquery();
$ecmsreurl=2;
$path_id=(int)$_GET['path_id'];
//echo $path_id;
if(!$path_id)
{
    echo"<script>alert('�����ز�����');window.close();</script>";
    exit();
}
$query="select * from ccxm_path where path_id='$path_id'";
$r=$empire->fetch1($query);
if(!$r[path_id])
{

    echo"<script>alert('�����ز�����');window.close();</script>";
    exit();
}
//����Ȩ����
if(1)
{
    $user=islogin();
    //ȡ�û�Ա����
    $u=$empire->fetch1("select * from ".$user_tablename." where ".$user_userid."='$user[userid]' and ".$user_rnd."='$user[rnd]' limit 1");
    if(empty($u[$user_userid]))
    {
        echo"<script>alert('ͬһ�ʺţ�ֻ��һ������');window.close();</script>";
        exit();
    }
    //���ش�������
    if($level_r[$u[$user_group]][daydown])
    {
        $thetoday=date("Y-m-d");
        if($thetoday==$u[$user_todaydate])
        {
            if($u[$user_todaydown]>=$level_r[$u[$user_group]][daydown])
            {
                echo"<script>alert('����������ۿ������ѳ���ϵͳ����(".$level_r[$u[$user_group]][daydown]." ��)!');window.close();</script>";
                exit();
            }
        }
    }

    //�����Ƿ��㹻
    if($r[path_need_point])
    {
        //---------�Ƿ�����ʷ��¼
        $bakr=$empire->fetch1("select path_id,truetime from {$dbtbpre}downdownrecord where path_id='$path_id'  and userid='$user[userid]' order by down_id desc limit 1");
        if($bakr[$path_id]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
        {}
        else
        {
            //���¿�
            if($u[$user_downdate]-time()>0)
            {}
            //����
            else
            {
                if($r[path_need_point]>$u[$user_downfen])
                {
                    echo"<script>alert('���ĵ������� $r[path_need_point] �㣬�޷����ش����');window.history.go(-1);</script>";
                    exit();
                }
            }
        }
    }
}
//����

$pass=md5("wm_chief".$public_r[downpass].$user[userid]);	//��֤��
$url="../phome/?phome=DownVideo&path_id=$path_id&pass=".$pass."&p=".$user[userid].":::".$user[rnd];	//���ص�ַ
$downfen=$r[path_need_point];	//���ص���
@include('templete.php');
db_close();
$empire=null;

?>