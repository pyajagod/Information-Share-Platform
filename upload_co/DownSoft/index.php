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
	echo"<script>alert('�����ز�����');window.close();</script>";
	exit();
}
$query="select * from {$dbtbpre}down where softid='$softid'";
$r=$empire->fetch1($query);
if(!$r[softid])
{
	echo"<script>alert('�����ز�����');window.close();</script>";
	exit();
}
//�������ص�ַ
$path_r=explode("\r\n",$r[downpath]);
if(!$path_r[$pathid])
{
	echo"<script>alert('�����ز�����');window.close();</script>";
	exit();
}
$showdown_r=explode("::::::",$path_r[$pathid]);
//����Ȩ��
$downgroup=$showdown_r[2];
if($downgroup)
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
	if($level_r[$downgroup][level]>$level_r[$u[$user_group]][level])
	{
		echo"<script>alert('���Ļ�Ա������(".$level_r[$downgroup][groupname].")��û�����ش������Ȩ��!');window.close();</script>";
        exit();
	}
	//�����Ƿ��㹻
	if($showdown_r[3])
	{
		//---------�Ƿ�����ʷ��¼
		$bakr=$empire->fetch1("select softid,truetime from {$dbtbpre}downdown where softid='$softid' and pathid='$pathid' and userid='$user[userid]' order by downid desc limit 1");
		if($bakr[softid]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
		{}
		else
		{
			//���¿�
			if($u[$user_downdate]-time()>0)
			{}
			//����
			else
			{
				if($showdown_r[3]>$u[$user_downfen])
			    {
					echo"<script>alert('���ĵ������� $showdown_r[3] �㣬�޷����ش����');window.close();</script>";
					exit();
			    }
			}
		}
	}
}
//����
$thisdownname=$showdown_r[0];	//��ǰ���ص�ַ����
$classname=$class_r[$r[classid]]['classname'];	//������
$bclassid=$class_r[$r[classid]]['bclassid'];	//������ID
$bclassname=$class_r[$bclassid]['classname'];	//��������
$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);	//�������
$pass=md5("wm_chief".$public_r[downpass].$user[userid]);	//��֤��
$url="../phome/?phome=DownSoft&softid=$softid&pathid=$pathid&pass=".$pass."&p=".$user[userid].":::".$user[rnd];	//���ص�ַ
$trueurl=ReturnDSofturl($showdown_r[1],$showdown_r[4],'../',1);//��ʵ�ļ���ַ
$downfen=$showdown_r[3];	//���ص���
$downuser=$level_r[$downgroup][groupname];	//���صȼ�
@include('../data/template/downpagetemp.php');
db_close();
$empire=null;
?>