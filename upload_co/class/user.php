<?php
//��ǰ׺
if(!defined('InEmpireDown'))
{$user_tbpre="e_";}
else
{$user_tbpre=$dbtbpre;}

//---------------------- ���濪ʼ��Ա������� ----------------------

//�û���
$user_tablename="{$user_tbpre}downmember";                //��Ա��(���ݿ���.���ݱ���)
$user_userid="userid";                                    //�û�ID�ֶ�
$user_username="username";                                //�û����ֶ�
$user_password="password";                                //�����ֶ�
$user_dopass=0;                                           //���뱣����ʽ,0Ϊmd5,1Ϊ����,2Ϊ˫�ؼ���,3Ϊ16λmd5
$user_rnd="rnd";                                          //�������
$user_checked="checked";                                  //���״̬�ֶ�
$user_email="email";                                      //�����ֶ�
$user_registertime="registertime";                        //ע��ʱ���ֶ�
$user_regcookietime=0;									  //ע����Ϣ����ʱ��(��)
$user_register=0;                                         //ע��ʱ�䱣����ʽ,0Ϊ����ʱ��,1Ϊ��ֵ��
$user_group="groupid";                                    //��Ա���ֶ�
$user_zgroup="zgroupid";								  //����ת���Ա��
$user_downfen="downfen";                                  //�����ֶ�
$user_downdate="downdate";                                //�����ֶ�
$user_todaydate="todaydate";                              //��������
$user_todaydown="todaydown";                              //�������ش���
$user_groupid=$public_r[defaultgroupid];                  //ע��ʱ��Ա��ID(edown�Ļ�Ա��)

//��Աҳ��
$registerurl="";										  //ע���ַ
$eloginurl="";											  //��½��ַ
$equiturl="";											  //�˳���ַ

//��������(��vbb)
$user_salt="salt";                                        //salt
$user_saltnum=3;                                          //salt������ַ���

$utfdata=0;												  //�����Ƿ���UTF8����,0Ϊ��������,1ΪUTF8����

//---------------------- ��Ա������ý��� ----------------------

//����ת��
function doUtfAndGbk($str,$phome=0){
	global $utfdata;
	//��������
	if(empty($utfdata))
	{
		return $str;
    }
	//�Ƿ�֧��iconv
	if(!function_exists("iconv"))
	{
		echo"Iconv is not install!";
		exit();
	}
	if(empty($phome))//gbkתutf
	{
		$str=iconv("gbk","UTF-8",$str);
	}
	else//utfתgbk
	{
		$str=iconv("UTF-8","gbk",$str);
	}
	return addslashes($str);
}

//��¼����cookie
function AddLoginCookie($r){
}

//�޸ĸ�������
function EditMemberAddInfo($userid,$add){
	global $empire,$dbtbpre;
	$add[truename]=RepPostStr($add[truename]);
	$add[oicq]=RepPostStr($add[oicq]);
	$add[msn]=RepPostStr($add[msn]);
	$add[mycall]=RepPostStr($add[mycall]);
	$add[phone]=RepPostStr($add[phone]);
	$add[address]=RepPostStr($add[address]);
	$add[zip]=RepPostStr($add[zip]);
	$add[homepage]=RepPostStr($add[homepage]);
	$add[saytext]=RepPostStr($add[saytext]);
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}downmemberadd where userid='$userid'");
	if($num)
	{
		$empire->query("update {$dbtbpre}downmemberadd set truename='$add[truename]',oicq='$add[oicq]',msn='$add[msn]',mycall='$add[mycall]',phone='$add[phone]',address='$add[address]',zip='$add[zip]',homepage='$add[homepage]',saytext='$add[saytext]' where userid='$userid'");
	}
	else
	{
		$empire->query("insert into {$dbtbpre}downmemberadd(userid,truename,oicq,msn,mycall,phone,address,zip,homepage,saytext) values('$userid','$add[truename]','$add[oicq]','$add[msn]','$add[mycall]','$add[phone]','$add[address]','$add[zip]','$add[homepage]','$add[saytext]');");
	}
}

//��̨�޸�����
function admin_EditMember($add,$loginuserid,$loginusername){
	global $empire,$user_tablename,$user_userid,$user_username,$user_password,$user_dopass,$user_email,$user_registertime,$user_register,$user_group,$user_downfen,$user_downdate,$user_saltnum,$user_salt,$dbtbpre,$user_zgroup,$user_checked;
	$add[userid]=(int)$add[userid];
	if(!$add[userid]||!trim($add[email])||!trim($add[username])||!$add[groupid])
	{
		printerror("���䲻��Ϊ��","history.go(-1)");
	}
    //��֤Ȩ��
    CheckLevel($loginuserid,$loginusername,$classid,"member");
	//����ת��
	$dousername=$add[username];
	$dooldusername=$add[oldusername];
	$add[username]=doUtfAndGbk($add[username],0);
	$add[oldusername]=doUtfAndGbk($add[oldusername],0);
	$add[password]=doUtfAndGbk($add[password],0);
	$add[email]=doUtfAndGbk($add[email],0);
	//�޸�����
	$add1='';
	if($add[password])
	{
		$sa='';
		if(empty($user_dopass))//����md5
		{
		   $add[password]=md5($add[password]);
	    }
		elseif($user_dopass==2)//˫��md5
		{
			$salt=make_password($user_saltnum);
			$add[password]=md5(md5($add[password]).$salt);
			$sa=",".$user_salt."='$salt'";
		}
		elseif($user_dopass==3)//16λmd5
		{
			$add[password]=substr(md5($add[password]),8,16);
		}
		else
		{}
		$add1=",".$user_password."='".$add[password]."'".$sa;
	}
	//�޸��û���
	if($add[oldusername]<>$add[username])
	{
		$num=$empire->gettotal("select count(*) as total from ".$user_tablename." where ".$user_username."='$add[username]' and ".$user_userid."<>".$add[userid]." limit 1");
		if($num)
		{
			printerror("���û����Ѵ���","history.go(-1)");
		}
		$add1.=",".$user_username."='$add[username]'";
	}
	//����
	$add[zgroupid]=(int)$add[zgroupid];
	if($add[downdate]>0)
	{
		$downdate=time()+$add[downdate]*24*3600;
	}
	else
	{
		$add[zgroupid]=0;
	}
	//����
	$add[groupid]=(int)$add[groupid];
	$add[downfen]=(int)$add[downfen];
	$downdate=(int)$downdate;
	$add[checked]=(int)$add[checked];
	$sql=$empire->query("update ".$user_tablename." set ".$user_email."='$add[email]',".$user_group."='$add[groupid]',".$user_downfen."='$add[downfen]',".$user_downdate."='$downdate',".$user_zgroup."='$add[zgroupid]',".$user_checked."='$add[checked]'".$add1." where ".$user_userid."='$add[userid]'");
	//���ӱ�
	EditMemberAddInfo($add[userid],$add);
	if($sql)
	{
	   printerror("�޸��û����ϳɹ�","ListMember.php");
	}
    else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//��̨ɾ����Ա
function admin_DelMember($userid,$loginuserid,$loginusername){
	global $empire,$dbtbpre,$user_tablename,$user_username,$user_userid;
	$userid=(int)$userid;
	if(empty($userid))
	{
		printerror("��ѡ��Ҫɾ���Ļ�Ա","history.go(-1)");
	}
    //��֤Ȩ��
    CheckLevel($loginuserid,$loginusername,$classid,"member");
    $sql=$empire->query("delete from ".$user_tablename." where ".$user_userid."='$userid'");
	$empire->query("delete from {$dbtbpre}downmemberadd where userid='$userid'");
	//ɾ���ղ�
	$del=$empire->query("delete from {$dbtbpre}downfava where userid='$userid'");
	//�����¼
	$empire->query("delete from {$dbtbpre}downbuy_bak where userid='$userid'");
	//���ؼ�¼
	$empire->query("delete from {$dbtbpre}downdown where userid='$userid'");
    if($sql)
	{
		printerror("ɾ����Ա�ɹ�","ListMember.php");
	}
    else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//��̨����ɾ����Ա
function admin_DelMember_all($userid,$logininid,$loginin){
	global $empire,$dbtbpre,$user_tablename,$user_username,$user_userid;
    //��֤Ȩ��
     CheckLevel($logininid,$loginin,$classid,"member");
     $count=count($userid);
     if(!$count)
	{
		 printerror("��ѡ��Ҫɾ���Ļ�Ա","history.go(-1)");
	}
	$ids='';
	$dh='';
	for($i=0;$i<$count;$i++)
	{
		$ids.=$dh.intval($userid[$i]);
		$dh=',';
    }
	$sql=$empire->query("delete from ".$user_tablename." where ".$user_userid." in (".$ids.")");
	$empire->query("delete from {$dbtbpre}downmemberadd where userid in (".$ids.")");
	//ɾ���ղ�
	$empire->query("delete from {$dbtbpre}downfava where userid in (".$ids.")");
	//�����¼
	$empire->query("delete from {$dbtbpre}downbuy_bak where userid in (".$ids.")");
	//���ؼ�¼
	$empire->query("delete from {$dbtbpre}downdown where userid in (".$ids.")");
	if($sql)
	{
		printerror("ɾ����Ա�ɹ�","ListMember.php");
    }
	else
	{
		printerror("���ݿ����","history.go(-1)");
    }
}

//ȡ���ʼ���ַ
function GetUserEmail($userid,$username){
	global $empire,$user_tablename,$user_userid,$user_email;
	$r=$empire->fetch1("select ".$user_email." from ".$user_tablename." where ".$user_userid."='$userid' limit 1");
	return doUtfAndGbk($r[$user_email],1);
}

//��̨�޸���Ƶ
function admin_EditVideo($add,$loginuserid,$loginusername){
    global $empire,$user_tablename,$user_userid,$user_username,$user_password,$user_dopass,$user_email,$user_registertime,$user_register,$user_group,$user_downfen,$user_downdate,$user_saltnum,$user_salt,$dbtbpre,$user_zgroup,$user_checked;
    $add[path_id]=(int)$add[path_id];
    if(!$add[path_id]||!trim($add[course_name])|!$add[course_id])
    {
        printerror("id����Ϊ��","history.go(-1)");
    }
    //��֤Ȩ��
    CheckLevel($loginuserid,$loginusername,$classid,"member");
    //����ת��

    $add[path_intro]=doUtfAndGbk($add[path_intro],0);


    //����
    $add[course_id]=(int)$add[course_id];
    $add[path_need_point]=(int)$add[path_need_point];

    $sql=$empire->query("update ccxm_path set path_address='$add[path_address]',path_password='$add[path_password]',path_intro='$add[path_intro]',cate_log='$add[cate_log]',path_need_point='$add[path_need_point]',course_id='$add[course_id]' where path_id='$add[path_id]'");

    if($sql)
    {
        printerror("�޸���Ƶ���ϳɹ�","ListVideo.php");
    }
    else
    {
        printerror("���ݿ����","history.go(-1)");
    }
}

//��̨ɾ����Ƶ
function admin_DelVideo($path_id,$loginuserid,$loginusername){
    global $empire,$dbtbpre,$user_tablename,$user_username,$user_userid;
    $userid=(int)$path_id;
    if(empty($path_id))
    {
        printerror("��ѡ��Ҫɾ������Ƶ","history.go(-1)");
    }
    //��֤Ȩ��
    CheckLevel($loginuserid,$loginusername,$classid,"member");
    $sql=$empire->query("delete from ccxm_path where path_id='$path_id'");

    if($sql)
    {
        printerror("ɾ����Ƶ�ɹ�","ListVideo.php");
    }
    else
    {
        printerror("���ݿ����","history.go(-1)");
    }
}

//��̨����ɾ����Ƶ
function admin_DelVideo_all($path_id,$logininid,$loginin){
    global $empire,$dbtbpre,$user_tablename,$user_username,$user_userid;
    //��֤Ȩ��
    CheckLevel($logininid,$loginin,$classid,"member");
    $count=count($path_id);
    if(!$count)
    {
        printerror("��ѡ��Ҫɾ������Ƶ","history.go(-1)");
    }
    $ids='';
    $dh='';
    for($i=0;$i<$count;$i++)
    {
        $ids.=$dh.intval($path_id[$i]);
        $dh=',';
    }
    $sql=$empire->query("delete from ccxm_path where path_id in (".$ids.")");

    if($sql)
    {
        printerror("ɾ����Ƶ�ɹ�","ListVideo.php");
    }
    else
    {
        printerror("���ݿ����","history.go(-1)");
    }
}
function ReturnVideoInfo($path_id){
    global $empire,$user_tablename,$user_userid,$user_username,$user_email,$user_group,$user_downfen,$user_downdate,$user_todaydown,$user_zgroup,$user_registertime,$user_checked;
    $r=$empire->fetch1("select path_address,path_password,path_intro,cate_log,path_need_point,course_id from ccxm_path  where path_id='$path_id' limit 1");
    $c=$empire->fetch1("select course_name from ccxm_course where course_id='$r[course_id]'");
    $re[$path_id]=$path_id;
    $re[path_intro]=doUtfAndGbk($r[path_intro],1);
    $re[path_address]=$r[path_address];
    $re[path_password]=$r[path_password];
    $re[cate_log]=$r[cate_log];
    $re[path_need_point]=$r[path_need_point];
    $re[course_id]=$r[course_id];
    $re[course_name]=$c[course_name];
    return $re;
}
//�����޸�����
function ReturnUserInfo($userid){
	global $empire,$user_tablename,$user_userid,$user_username,$user_email,$user_group,$user_downfen,$user_downdate,$user_todaydown,$user_zgroup,$user_registertime,$user_checked;
	$r=$empire->fetch1("select ".$user_username.",".$user_email.",".$user_group.",".$user_downfen.",".$user_downdate.",".$user_todaydown.",".$user_zgroup.",".$user_registertime.",".$user_checked." from ".$user_tablename." where ".$user_userid."='$userid' limit 1");
	$re[userid]=$userid;
	$re[username]=doUtfAndGbk($r[$user_username],1);
	$re[email]=doUtfAndGbk($r[$user_email],1);
	$re[downfen]=$r[$user_downfen];
	$re[groupid]=$r[$user_group];
	$re[downdate]=$r[$user_downdate];
	$re[zgroupid]=$r[$user_zgroup];
	$re[todaydown]=$r[$user_todaydown];
	$re[registertime]=$r[$user_registertime];
	$re[checked]=$r[$user_checked];
	return $re;
}

//�û�ע��
function register($username,$password,$repassword,$email,$key){
	global $empire,$user_tablename,$public_r,$user_groupid,$user_username,$user_userid,$user_email,$user_password,$user_dopass,$user_rnd,$user_registertime,$user_register,$user_group,$user_saltnum,$user_salt,$registerurl,$dbtbpre,$user_regcookietime,$user_downfen,$user_checked;
	//�ر�
	if($public_r[openregister])
	{
		printerror("��Աע���ѹر�","history.go(-1)",1);
	}
	if(!empty($registerurl))
	{
		Header("Location:$registerurl");
		exit();
	}
	$username=trim($username);
	$password=trim($password);
	$username=RepPostVar($username);
	$password=RepPostVar($password);
	if(!$username||!$password||!$email)
	{
		printerror("�û��������������䲻��Ϊ��","history.go(-1)",1);
	}
	$pr=$empire->fetch1("select closeusername,min_userlen,max_userlen,min_passlen,max_passlen,registerkey,emailonly from {$dbtbpre}downpublic limit 1");
	//��֤��
	if($pr['registerkey'])
	{
		$checkplkey=getcvar('checkplkey');
		if($key<>$checkplkey||empty($checkplkey))
		{
			printerror("��֤�����","history.go(-1)",1);
		}
	}
	//�û�����
	$userlen=strlen($username);
	if($userlen<$pr[min_userlen]||$userlen>$pr[max_userlen])
	{
		printerror("�û�����������","history.go(-1)",1);
	}
	//��������
	$passlen=strlen($password);
	if($passlen<$pr[min_passlen]||$passlen>$pr[max_passlen])
	{
		printerror("���볤������","history.go(-1)",1);
	}
	if($repassword!=$password)
	{
		printerror("�������벻һ�£�","history.go(-1)",1);
	}
	if(!chemail($email))
	{
		printerror("���������������!","history.go(-1)",1);
	}
	if(strstr($username,"|"))
	{
		printerror("�û����в��ܰ���|�ַ�","history.go(-1)",1);
	}
	//�Ƿ��н�ֹע���
	toCheckCloseWord($username,$pr['closeusername'],"��������û������������ַ�");
	$username=RepPostStr($username);
	$num=$empire->gettotal("select count(*) as total from ".$user_tablename." where ".$user_username."='$username' limit 1");
	if($num)
	{
		printerror("���û����ѱ�ע�ᣡ","history.go(-1)",1);
	}
	$email=RepPostStr($email);
	if($public_r['emailonly'])
	{
		$num=$empire->gettotal("select count(*) as total from ".$user_tablename." where ".$user_email."='$email' limit 1");
		if($num)
		{
			printerror("�������ѱ�ע�ᣡ","history.go(-1)",1);
		}
	}
	//ע��ʱ��
	if($user_register)
	{
		$registertime=time();
	}
	else
	{
		$registertime=date("Y-m-d H:i:s");
	}
	$rnd=make_password(20);//�����������
	//����
	if(empty($user_dopass))//����md5
	{
		$password=md5($password);
	}
	elseif($user_dopass==2)//˫��md5
	{
		$salt=make_password($user_saltnum);
		$password=md5(md5($password).$salt);
	}
	elseif($user_dopass==3)//16λmd5
	{
		$password=substr(md5($password),8,16);
	}
	$regdownfen=$public_r[regdownfen];
	$mchecked=$public_r[memberchecked]?0:1;
	$sql=$empire->query("insert into ".$user_tablename."($user_username,$user_password,$user_email,$user_registertime,$user_group,$user_rnd,$user_downfen,$user_checked) values('$username','$password','$email','$registertime','$user_groupid','$rnd','$regdownfen','$mchecked');");
	//ȡ��userid
	$userid=$empire->lastid();
	if($sql)
	{
		//���ӱ�
		EditMemberAddInfo($userid,$_POST);
		//���
		if($mchecked==0)
		{
			printerror("ע��ɹ�����ȴ�����Ա�����","../",1);
		}
		$logincookie=0;
		if($user_regcookietime)
		{
			$logincookie=time()+$user_regcookietime;
		}
		esetcookie("memberuserid",$userid,$logincookie);
		esetcookie("memberusername",$username,$logincookie);
		esetcookie("membergroupid",$user_groupid,$logincookie);
		esetcookie("memberrnd",$rnd,$logincookie);
		$location="../webPage/login.php";
		$returnurl=getcvar('returnurl');
		if($returnurl&&!strstr($returnurl,"/iframe"))
		{
			$location=$returnurl;
		}
		esetcookie("checkplkey","");
		esetcookie("returnurl","");
		printerror("ע��ɹ�",$location,1);
	}
	else
	{
		printerror("���ݿ����","history.go(-1)",1);
	}
}

//��Ϣ�޸�
function EditInfo($password,$repassword,$oldpassword,$email){
	global $empire,$dbtbpre,$user_tablename,$public_r,$user_userid,$user_username,$user_password,$user_dopass,$user_email,$user_salt,$user_saltnum,$user_group;
	//�Ƿ��½
	$user_r=islogin();
	$userid=$user_r[userid];
	$username=$user_r[username];
	$rnd=$user_r[rnd];
	$dousername=$username;
	$groupid=$user_r[groupid];
	if(!$userid||!$username||!trim($email))
	{
		printerror("���䲻��Ϊ��","history.go(-1)",1);
	}
	if(!chemail($email))
	{
		printerror("��������ȷ������","history.go(-1)",1);
	}
	$email=RepPostStr($email);
	//����ת��
	$username=doUtfAndGbk($username,0);
	$email=doUtfAndGbk($email,0);
	//�޸�����
	$add='';
	if($password)
	{
		$sa='';
		if($password!=$repassword)
		{
			printerror("������������벻һ��","history.go(-1)",1);
		}
		$password=RepPostVar($password);
		$oldpassword=RepPostVar($oldpassword);
		$password=doUtfAndGbk($password,0);
		$oldpassword=doUtfAndGbk($oldpassword,0);
		if(empty($user_dopass))//���ؼ���
		{
			$password=md5($password);
			$oldpassword=md5($oldpassword);
	    }
		elseif($user_dopass==2)//˫�ؼ���
		{
			$salt=make_password($user_saltnum);
			$password=md5(md5($password).$salt);
			$sa=",".$user_salt."='$salt'";
		}
		elseif($user_dopass==3)//16λmd5
		{
			$password=substr(md5($password),8,16);
			$oldpassword=substr(md5($oldpassword),8,16);
		}
		else
		{}
	    $num=0;
		//˫��md5
		if($user_dopass==2)
		{
			$ur=$empire->fetch1("select ".$user_userid.",".$user_salt.",".$user_password." from ".$user_tablename." where ".$user_userid."='$userid'");
			$oldpassword=md5(md5($oldpassword).$ur[$user_salt]);
			$num=0;
			if($oldpassword==$ur[$user_password])
			{$num=1;}
			if(empty($ur[$user_userid]))
			{$num=0;}
		}
		else
		{
			$num=$empire->gettotal("select count(*) as total from ".$user_tablename." where ".$user_userid."='$userid' and ".$user_password."='".$oldpassword."'");
		}
		if(!$num)
		{
			printerror("�����������޸����벻�ɹ�","history.go(-1)",1);
		}
		$add=",".$user_password."='".$password."'".$sa;
	}
    $sql=$empire->query("update ".$user_tablename." set ".$user_email."='$email'".$add." where ".$user_userid."='$userid'");
    if($sql)
    {
		//���ӱ�
		EditMemberAddInfo($userid,$_POST);
		printerror("��Ϣ�޸ĳɹ���","../EditInfo",1);
	}
    else
    {
		printerror("���ݿ����","history.go(-1)",1);
	}
}

//�Ƿ��½
function islogin($uid=0,$uname='',$urnd=''){
	global $empire,$public_r,$editor,$user_userid,$user_rnd,$user_tablename,$user_username,$user_email,$user_downfen,$user_group,$user_groupid,$user_zgroup,$user_downdate,$user_todaydown,$user_todaydate,$ecmsreurl,$eloginurl,$user_checked;
	if($uid)
	{$userid=(int)$uid;}
	else
	{$userid=(int)getcvar('memberuserid');}
	if($uname)
	{$username=$uname;}
	else
	{$username=getcvar('memberusername');}
	$username=RepPostVar($username);
	if($urnd)
	{$rnd=$urnd;}
	else
	{$rnd=getcvar('memberrnd');}
	if($eloginurl)
	{$gotourl=$eloginurl;}
	else
	{$gotourl="http://114.115.175.207:80/upload/webPage/login.php";}
	$petype=1;
	if(!$userid)
	{
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$_SERVER['HTTP_REFERER'],0);
		}
		if($ecmsreurl==1)
		{
			$gotourl="history.go(-1)";
			$petype=9;
		}
		elseif($ecmsreurl==2)
		{
			$phpmyself=urlencode($_SERVER['PHP_SELF']."?".$_SERVER["QUERY_STRING"]);
//			$gotourl="../webPage/login.php?prt=1&from=".$phpmyself;
            $gotourl="http://114.115.175.207:80/upload/webPage/login.php?prt=1&from=".$phpmyself;
            $petype=9;
		}
		printerror("����û��½!",$gotourl,$petype);
	}
	$rnd=RepPostVar($rnd);
	$cr=$empire->fetch1("select ".$user_userid.",".$user_username.",".$user_email.",".$user_group.",".$user_downfen.",".$user_downdate.",".$user_todaydown.",".$user_zgroup.",".$user_todaydate.",".$user_checked." from ".$user_tablename." where ".$user_userid."='$userid' and ".$user_username."='$username' and ".$user_rnd."='$rnd' limit 1");
	if(!$cr[$user_userid])
	{
		EmptyEdownCookie();
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$_SERVER['HTTP_REFERER'],0);
		}
		if($ecmsreurl==1)
		{
			$gotourl="history.go(-1)";
			$petype=9;
		}
		elseif($ecmsreurl==2)
		{
			$phpmyself=urlencode($_SERVER['PHP_SELF']."?".$_SERVER["QUERY_STRING"]);
			$gotourl="http://114.115.175.207:80/upload/webPage/login.php?prt=1&from=".$phpmyself;
//            $gotourl="../webPage/login.php?prt=1&from=".$phpmyself;
            $petype=9;
		}
		printerror("ͬһ�ʺ�ֻ��һ��ͬʱ����!",$gotourl,$petype);
	}
	if($cr[$user_checked]==0)
	{
		EmptyEdownCookie();
		if($ecmsreurl==1)
		{
			$gotourl="history.go(-1)";
			$petype=9;
		}
		elseif($ecmsreurl==2)
		{
			$phpmyself=urlencode($_SERVER['PHP_SELF']."?".$_SERVER["QUERY_STRING"]);
//			$gotourl=$public_r['sitedown']."/login.php?prt=1&from=".$phpmyself;
//            $gotourl="../webPage/login.php?prt=1&from=".$phpmyself;
            $gotourl="http://114.115.175.207:80/upload/webPage/login.php?prt=1&from=".$phpmyself;
            $petype=9;
		}
		printerror("�����ʺŻ�û��ͨ�����",$gotourl,$petype);
	}
	//Ĭ�ϻ�Ա��
	if(empty($cr[$user_group]))
	{
		$usql=$empire->query("update ".$user_tablename." set ".$user_group."='$user_groupid' where ".$user_userid."='".$cr[$user_userid]."'");
		$cr[$user_group]=$user_groupid;
	}
	//�Ƿ����
	if($cr[$user_downdate])
	{
		if($cr[$user_downdate]-time()<=0)
		{
			OutTimeZGroup($cr[$user_userid],$cr[$user_zgroup]);
			$cr[$user_downdate]=0;
			if($cr[$user_zgroup])
			{
				$cr[$user_group]=$cr[$user_zgroup];
				$cr[$user_zgroup]=0;
			}
		}
	}
	$re[userid]=$cr[$user_userid];
	$re[rnd]=$rnd;
	$re[username]=doUtfAndGbk($cr[$user_username],1);
	$re[email]=doUtfAndGbk($cr[$user_email],1);
	$re[downfen]=$cr[$user_downfen];
	$re[groupid]=$cr[$user_group];
	$re[downdate]=$cr[$user_downdate];
	$re[zgroupid]=$cr[$user_zgroup];
	$re[todaydown]=$cr[$user_todaydown];
	$re[todaydate]=$cr[$user_todaydate];
	return $re;
}

//��½
function login1($username,$password,$lifetime,$key,$location){
	global $empire,$user_tablename,$user_userid,$user_username,$user_password,$user_dopass,$user_group,$user_groupid,$user_rnd,$public_r,$user_salt,$user_saltnum,$dbtbpre,$eloginurl,$user_checked;
	if($eloginurl)
	{
		Header("Location:$eloginurl");
		exit();
	}
	$dopr=1;
	if($_POST['prtype'])
	{
		$dopr=9;
	}
	if(!trim($username)||!trim($password))
	{
		printerror("�û��������벻��Ϊ��","history.go(-1)",$dopr);
	}
	//��֤��
	if($public_r['loginkey'])
	{
		$checkplkey=getcvar('checkplkey');
		if($key<>$checkplkey||empty($checkplkey))
		{printerror("��֤�����","history.go(-1)",$dopr);}
	}
	$username=RepPostVar($username);
	$password=RepPostVar($password);
	//����ת��
	$utfusername=doUtfAndGbk($username,0);
	$password=doUtfAndGbk($password,0);
	//����
	if(empty($user_dopass))//����md5
	{
		$password=md5($password);
	}
	if($user_dopass==3)//16λmd5
	{
		$password=substr(md5($password),8,16);
	}
	//˫��md5
	$num=0;
	if($user_dopass==2)
	{
	    $ur=$empire->fetch1("select ".$user_userid.",".$user_salt.",".$user_password." from ".$user_tablename." where ".$user_username."='$utfusername' limit 1");
		$password=md5(md5($password).$ur[$user_salt]);
		$num=0;
		if($password==$ur[$user_password])
		{$num=1;}
		if(empty($ur[$user_userid]))
		{$num=0;}
    }
	else
	{
		$num=$empire->gettotal("select count(*) as total from ".$user_tablename." where ".$user_username."='$utfusername' and ".$user_password."='".$password."' limit 1");
	}
	if(!$num)
	{
		printerror("�����û�������������!","history.go(-1)",$dopr);
	}
	$r=$empire->fetch1("select * from ".$user_tablename." where ".$user_username."='$utfusername' limit 1");
	if($r[$user_checked]==0)
	{
		printerror("�����ʺŻ�û��ͨ�����","",$dopr);
	}
	$time=date("Y-m-d H:i:s");
	$rnd=make_password(20);
	//Ĭ�ϻ�Ա��
	if(empty($r[$user_group]))
	{$r[$user_group]=$user_groupid;}
	$r[$user_group]=(int)$r[$user_group];
	$usql=$empire->query("update ".$user_tablename." set ".$user_rnd."='$rnd',".$user_group."=".$r[$user_group]." where ".$user_userid."='$r[$user_userid]'");
	//����cookie
	$logincookie=0;
	if($lifetime)
	{
		$logincookie=time()+$lifetime;
	}
	$set1=esetcookie("memberusername",$username,$logincookie);
	$set2=esetcookie("memberuserid",$r[$user_userid],$logincookie);
	$set3=esetcookie("membergroupid",$r[$user_group],$logincookie);
	$set4=esetcookie("memberrnd",$rnd,$logincookie);
	//��¼����cookie
	AddLoginCookie($r);
	$location="../webPage/intro.php";
	$returnurl=getcvar('returnurl');
	if($returnurl)
	{
		$location=$returnurl;
	}
	if(strstr($_SERVER['HTTP_REFERER'],"/iframe"))
	{
		$location="../iframe";
	}
	if(strstr($location,"phome=exit"))
	{
		$location="../webPage/mainPage.php";
	}
	$set5=esetcookie("checkplkey","");
	$set6=esetcookie("returnurl","");
	if($set1&&$set2)
	{
		$location=DoingReturnUrl($location,$_POST['ecmsfrom']);
		printerror("��½�ɹ�",$location,$dopr);
    }
	else
	{
		printerror("��½���ɹ�����ȷ������cookie�Ƿ��ѿ���!","history.go(-1)",$dopr);
	}
}

//�˳�ϵͳ
function LoginOut1($userid,$username,$rnd){
	global $empire,$public_r,$equiturl;
	//�Ƿ��½
	$user_r=islogin();
	if($equiturl)
	{
		Header("Location:$equiturl");
		exit();
	}
	EmptyEdownCookie();
	$dopr=1;
	if($_GET['prtype'])
	{
		$dopr=9;
	}
	$gotourl="../webPage/login.php";
	if(strstr($_SERVER['HTTP_REFERER'],"/iframe"))
	{
		$gotourl=$public_r['sitedown']."/iframe";
	}
	$gotourl=DoingReturnUrl($gotourl,$_GET['ecmsfrom']);
	printerror("�˳���½�ɹ�",$gotourl,$dopr);
}

//���COOKIE
function EmptyEdownCookie(){
	esetcookie("memberuserid","",0);
	esetcookie("memberusername","",0);
	esetcookie("membergroupid","",0);
	esetcookie("memberrnd","",0);
}

//�������͵���
function GetDown_all($downfen,$userid,$username){
	global $empire,$dbtbpre,$user_tablename,$user_downfen;
	$downfen=(int)$downfen;
	if(!$downfen)
	{
		printerror("������Ҫ���ӵĵ���","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"card");
	$sql=$empire->query("update ".$user_tablename." set ".$user_downfen."=".$user_downfen."+$downfen");
	if($sql)
	{
		printerror("�������ӵ����ɹ�","GetDown.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//���ӵ���
function AddInfoFen($cardfen,$userid){
	global $empire,$user_tablename,$user_downfen,$user_userid;
	$cardfen=(int)$cardfen;
	$sql=$empire->query("update ".$user_tablename." set ".$user_downfen."=".$user_downfen."+".$cardfen." where ".$user_userid."='$userid'");
}

//ת���Ա��
function OutTimeZGroup($userid,$zgroupid){
	global $empire,$user_tablename,$user_group,$user_zgroup,$user_downdate,$user_userid;
	if($zgroupid)
	{
		$sql=$empire->query("update ".$user_tablename." set ".$user_group."='".$zgroupid."',".$user_downdate."=0 where ".$user_userid."='$userid'");
	}
	else
	{
		$sql=$empire->query("update ".$user_tablename." set ".$user_downdate."=0 where ".$user_userid."='$userid'");
	}
}

//��ֵ
function eAddFenToUser($fen,$date,$groupid,$zgroupid,$user){
	global $empire,$dbtbpre,$user_tablename,$user_downfen,$user_downdate,$user_userid,$user_username,$user_zgroup,$user_group;
	if(!($fen||$date))
	{
		return '';
	}
	$update='';
	//����
	if($fen)
	{
		$update.="$user_downfen=$user_downfen+$fen";
	}
	//��Ч��
	if($date)
	{
		$dh='';
		if($update)
		{
			$dh=',';
		}
		if($user[$user_downdate]<time())
		{
			$downdate=time()+$date*24*3600;
		}
		else
		{
			$downdate=$user[$user_downdate]+$date*24*3600;
		}
		$update.=$dh."$user_downdate='$downdate'";
		//ת���Ա��
		if($groupid)
		{
			$update.=",".$user_group."='$groupid'";
		}
		if($zgroupid)
		{
			$update.=",".$user_zgroup."='$zgroupid'";
		}
	}
	$sql=$empire->query("update ".$user_tablename." set ".$update." where ".$user_userid."='".$user[$user_userid]."'");
	if(!$sql)
	{
		printerror('���ݿ����','../',1);
	}
}
?>