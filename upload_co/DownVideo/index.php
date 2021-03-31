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
    echo"<script>alert('此下载不存在');window.close();</script>";
    exit();
}
$query="select * from ccxm_path where path_id='$path_id'";
$r=$empire->fetch1($query);
if(!$r[path_id])
{

    echo"<script>alert('此下载不存在');window.close();</script>";
    exit();
}
//下载权限无
if(1)
{
    $user=islogin();
    //取得会员资料
    $u=$empire->fetch1("select * from ".$user_tablename." where ".$user_userid."='$user[userid]' and ".$user_rnd."='$user[rnd]' limit 1");
    if(empty($u[$user_userid]))
    {
        echo"<script>alert('同一帐号，只能一人在线');window.close();</script>";
        exit();
    }
    //下载次数限制
    if($level_r[$u[$user_group]][daydown])
    {
        $thetoday=date("Y-m-d");
        if($thetoday==$u[$user_todaydate])
        {
            if($u[$user_todaydown]>=$level_r[$u[$user_group]][daydown])
            {
                echo"<script>alert('您的下载与观看次数已超过系统限制(".$level_r[$u[$user_group]][daydown]." 次)!');window.close();</script>";
                exit();
            }
        }
    }

    //点数是否足够
    if($r[path_need_point])
    {
        //---------是否有历史记录
        $bakr=$empire->fetch1("select path_id,truetime from {$dbtbpre}downdownrecord where path_id='$path_id'  and userid='$user[userid]' order by down_id desc limit 1");
        if($bakr[$path_id]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
        {}
        else
        {
            //包月卡
            if($u[$user_downdate]-time()>0)
            {}
            //点数
            else
            {
                if($r[path_need_point]>$u[$user_downfen])
                {
                    echo"<script>alert('您的点数不足 $r[path_need_point] 点，无法下载此软件');window.history.go(-1);</script>";
                    exit();
                }
            }
        }
    }
}
//变量

$pass=md5("wm_chief".$public_r[downpass].$user[userid]);	//验证码
$url="../phome/?phome=DownVideo&path_id=$path_id&pass=".$pass."&p=".$user[userid].":::".$user[rnd];	//下载地址
$downfen=$r[path_need_point];	//下载点数
@include('templete.php');
db_close();
$empire=null;

?>