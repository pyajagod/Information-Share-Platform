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
$softid=(int)$_GET['softid'];
$pathid=(int)$_GET['pathid'];
if(!$softid)
{
	echo"<script>alert('此下载不存在');window.close();</script>";
	exit();
}
$query="select * from {$dbtbpre}down where softid='$softid'";
$r=$empire->fetch1($query);
if(!$r[softid])
{
	echo"<script>alert('此下载不存在');window.close();</script>";
	exit();
}
//区分下载地址
$path_r=explode("\r\n",$r[downpath]);
if(!$path_r[$pathid])
{
	echo"<script>alert('此下载不存在');window.close();</script>";
	exit();
}
$showdown_r=explode("::::::",$path_r[$pathid]);
//下载权限
$downgroup=$showdown_r[2];
if($downgroup)
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
	if($level_r[$downgroup][level]>$level_r[$u[$user_group]][level])
	{
		echo"<script>alert('您的会员级别不足(".$level_r[$downgroup][groupname].")，没有下载此软件的权限!');window.close();</script>";
        exit();
	}
	//点数是否足够
	if($showdown_r[3])
	{
		//---------是否有历史记录
		$bakr=$empire->fetch1("select softid,truetime from {$dbtbpre}downdown where softid='$softid' and pathid='$pathid' and userid='$user[userid]' order by downid desc limit 1");
		if($bakr[softid]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
		{}
		else
		{
			//包月卡
			if($u[$user_downdate]-time()>0)
			{}
			//点数
			else
			{
				if($showdown_r[3]>$u[$user_downfen])
			    {
					echo"<script>alert('您的点数不足 $showdown_r[3] 点，无法下载此软件');window.close();</script>";
					exit();
			    }
			}
		}
	}
}
//变量
$thisdownname=$showdown_r[0];	//当前下载地址名称
$classname=$class_r[$r[classid]]['classname'];	//分类名
$bclassid=$class_r[$r[classid]]['bclassid'];	//父分类ID
$bclassname=$class_r[$bclassid]['classname'];	//父分类名
$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);	//软件链接
$pass=md5("wm_chief".$public_r[downpass].$user[userid]);	//验证码
$url="../phome/?phome=DownSoft&softid=$softid&pathid=$pathid&pass=".$pass."&p=".$user[userid].":::".$user[rnd];	//下载地址
$trueurl=ReturnDSofturl($showdown_r[1],$showdown_r[4],'../',1);//真实文件地址
$downfen=$showdown_r[3];	//下载点数
$downuser=$level_r[$downgroup][groupname];	//下载等级
@include('../data/template/downpagetemp.php');
db_close();
$empire=null;
?>