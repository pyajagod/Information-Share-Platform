<?php
//写入日志
function insert_log($username,$loginip){
	global $empire,$dbtbpre;
	$logintime=date("Y-m-d H:i:s");
	$empire->query("insert into {$dbtbpre}loginlog(username,loginip,logintime) values('$username','$loginip','$logintime');");
}

//增加用户
function AddUser($username,$password,$repassword,$groupid,$adminclass,$add,$loginuserid,$loginusername){
	global $empire,$class_r,$dbtbpre;
	//验证权限
	CheckLevel($loginuserid,$loginusername,$classid,"user");
	if(!$username||!$password||!$repassword)
	{
		printerror("请输入用户名与密码","history.go(-1)");
	}
	if($password!=$repassword)
	{
		printerror("两次输入的密码不一致","history.go(-1)");
	}
	$num=$empire->num("select username from {$dbtbpre}downuser where username='$username' limit 1");
	if($num)
	{
		printerror("此用户名已存在，请重输一个","history.go(-1)");
	}
	//管理目录
	for($i=0;$i<count($adminclass);$i++)
	{
		//大栏目
		if(empty($class_r[$adminclass[$i]][islast]))
		{
			if(empty($class_r[$adminclass[$i]][sonclass])||$class_r[$adminclass[$i]][sonclass]=="|")
			{
				continue;
			}
			else
			{
				$andclass=substr($class_r[$adminclass[$i]][sonclass],1);
			}
			$insert_class.=$andclass;
		}
		else
		{
			$insert_class.=$adminclass[$i]."|";
		}
    }
	$insert_class="|".$insert_class;
	$groupid=(int)$groupid;
	$rnd=make_password(20);
	$salt=make_password(8);
	$password=md5(md5($password).$salt);
	$sql=$empire->query("insert into {$dbtbpre}downuser(username,password,groupid,adminclass,rnd,salt,loginnum,lasttime,lastip) values('$username','".$password."','$groupid','$insert_class','$rnd','$salt',0,0,'');");
	if($sql)
	{
		printerror("增加用户成功","AddUser.php?phome=AddUser");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改用户
function EditUser($userid,$username,$password,$repassword,$groupid,$adminclass,$oldusername,$add,$loginuserid,$loginusername){
	global $empire,$class_r,$dbtbpre;
	//验证权限
	CheckLevel($loginuserid,$loginusername,$classid,"user");
	$userid=(int)$userid;
	if(!$userid||!$username)
	{
		printerror("请输入用户名","history.go(-1)");
	}
	//修改用户名
	if($oldusername<>$username)
	{
		$num=$empire->num("select username from {$dbtbpre}downuser where username='$username' and userid<>$userid limit 1");
		if($num)
		{
			printerror("此用户名已存在，请重输一个","history.go(-1)");
		}
	}
	//修改密码
	if($password)
	{
		if($password!=$repassword)
		{
			printerror("两次输入的密码不一致","history.go(-1)");
		}
		$salt=make_password(8);
		$password=md5(md5($password).$salt);
		$add1=",password='$password',salt='$salt'";
	}
	//管理目录
	for($i=0;$i<count($adminclass);$i++)
	{
		//大栏目
		if(empty($class_r[$adminclass[$i]][islast]))
		{
			if(empty($class_r[$adminclass[$i]][sonclass])||$class_r[$adminclass[$i]][sonclass]=="|")
			{
				continue;
			}
			else
			{
				$andclass=substr($class_r[$adminclass[$i]][sonclass],1);
			}
			$insert_class.=$andclass;
		}
		else
		{
			$insert_class.=$adminclass[$i]."|";
		}
    }
	$insert_class="|".$insert_class;
	$groupid=(int)$groupid;
	$sql=$empire->query("update {$dbtbpre}downuser set username='$username',groupid='$groupid',adminclass='$insert_class'".$add1." where userid='$userid'");
	if($sql)
	{
		printerror("修改用户成功","ListUser.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除用户
function DelUser($userid,$loginuserid,$loginusername){
	global $empire,$dbtbpre;
	//验证权限
	CheckLevel($loginuserid,$loginusername,$classid,"user");
	$userid=(int)$userid;
	if(!$userid)
	{
		printerror("请选择要删除的用户","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}downuser where userid='$userid'");
	if($sql)
	{
		printerror("删除用户成功","ListUser.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改密码
function EditPassword($username,$oldpassword,$password,$repassword){
	global $empire,$dbtbpre;
	$username=RepPostVar($username);
	$oldpassword=RepPostVar($oldpassword);
	$password=RepPostVar($password);
	if(!$username||!$oldpassword)
	{
		printerror("请输入旧密码","history.go(-1)");
	}
	if(!trim($password)||!trim($repassword))
	{
		printerror("新密码不能为空","history.go(-1)");
	}
	if($password<>$repassword)
	{
		printerror("两次输入的密码不致","history.go(-1)");
	}
	$user_r=$empire->fetch1("select userid,password,salt from {$dbtbpre}downuser where username='".$username."' limit 1");
	if(!$user_r['userid'])
	{
		printerror("旧密码错误","history.go(-1)");
	}
	$ch_oldpassword=md5(md5($oldpassword).$user_r['salt']);
	if($user_r['password']!=$ch_oldpassword)
	{
		printerror("旧密码错误","history.go(-1)");
	}
	$salt=make_password(8);
	$password=md5(md5($password).$salt);
	$sql=$empire->query("update {$dbtbpre}downuser set password='$password',salt='$salt' where username='$username'");
	if($sql)
	{
		printerror("修改密码成功","EditPassword.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//增加用户组
function AddGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($add[groupname]))
	{
		printerror("请输入用户组名称","history.go(-1)");
	}
	$sql=$empire->query("insert into {$dbtbpre}downgroup(groupname,doall,dopublic,doclass,dotemplate,dofile,douser,dolog,domember,dogroup,dolanguage,dosofttype,dosq,dofj,doerror,dorepip,doad,dogg,docard,dovote,dodbdata,dodownurl,dopl,dochangedata,dolink,dozt,douserlist,doplayer,dopay,dobuygroup,douserpage) values('$add[groupname]','$add[doall]','$add[dopublic]','$add[doclass]','$add[dotemplate]','$add[dofile]','$add[douser]','$add[dolog]','$add[domember]','$add[dogroup]','$add[dolanguage]','$add[dosofttype]','$add[dosq]','$add[dofj]','$add[doerror]','$add[dorepip]','$add[doad]','$add[dogg]','$add[docard]','$add[dovote]','$add[dodbdata]','$add[dodownurl]','$add[dopl]','$add[dochangedata]','$add[dolink]','$add[dozt]','$add[douserlist]','$add[doplayer]','$add[dopay]','$add[dobuygroup]','$add[douserpage]');");
	if($sql)
	{
		printerror("增加用户组成功","AddGroup.php?phome=AddGroup");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改用户组
function EditGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($add[groupname])||!$add[groupid])
	{
		printerror("请输入用户组名称","history.go(-1)");
	}
	$sql=$empire->query("update {$dbtbpre}downgroup set groupname='$add[groupname]',doall='$add[doall]',dopublic='$add[dopublic]',doclass='$add[doclass]',dotemplate='$add[dotemplate]',dofile='$add[dofile]',douser='$add[douser]',dolog='$add[dolog]',domember='$add[domember]',dogroup='$add[dogroup]',dolanguage='$add[dolanguage]',dosofttype='$add[dosofttype]',dosq='$add[dosq]',dofj='$add[dofj]',doerror='$add[doerror]',dorepip='$add[dorepip]',doad='$add[doad]',dogg='$add[dogg]',docard='$add[docard]',dovote='$add[dovote]',dodbdata='$add[dodbdata]',dodownurl='$add[dodownurl]',dopl='$add[dopl]',dochangedata='$add[dochangedata]',dolink='$add[dolink]',dozt='$add[dozt]',douserlist='$add[douserlist]',doplayer='$add[doplayer]',dopay='$add[dopay]',dobuygroup='$add[dobuygroup]',douserpage='$add[douserpage]' where groupid='$add[groupid]'");
	if($sql)
	{
		printerror("修改用户组成功","ListGroup.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除用户组
function DelGroup($groupid,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($groupid))
	{
		printerror("请选择要删除的用户组","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}downgroup where groupid='$groupid'");
    if($sql)
	{
		printerror("删除用户组成功","ListGroup.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//登陆
function login($username,$password,$key,$post){
	global $empire,$dbtbpre,$do_loginauth,$public_r;
	$username=RepPostVar($username);
	$password=RepPostVar($password);
	if(!$username||!$password)
	{
		printerror("请输入用户名与密码","index.php");
	}
	//验证码
	if($public_r['adminloginkey'])
	{
		$checkkey=getcvar('checkkey');
		if(!$checkkey||$key<>$checkkey)
		{
			printerror("验证码错误","index.php");
		}
	}
	if(strlen($username)>30||strlen($password)>30)
	{
		printerror("请输入用户名与密码","index.php");
	}
	//认证码
	if($do_loginauth&&$do_loginauth!=$post['loginauth'])
	{
		printerror("认证码错误","index.php");
	}
	$user_r=$empire->fetch1("select userid,password,salt from {$dbtbpre}downuser where username='".$username."' limit 1");
	if(!$user_r['userid'])
	{
		printerror("您的用户名与密码有误","history.go(-1)");
	}
	$ch_password=md5(md5($password).$user_r['salt']);
	if($user_r['password']!=$ch_password)
	{
		printerror("您的用户名与密码有误","history.go(-1)");
	}
	$loginip=egetip();
	$logintime=time();
	//取得随机密码
	$rnd=make_password(20);
	$sql=$empire->query("update {$dbtbpre}downuser set rnd='$rnd',loginnum=loginnum+1,lastip='$loginip',lasttime='$logintime' where username='$username' limit 1");
	$r=$empire->fetch1("select groupid,userid from {$dbtbpre}downuser where username='$username' limit 1");
	//备份
	$cdbdata=0;
	$bnum=$empire->gettotal("select count(*) as total from {$dbtbpre}downgroup where groupid='$r[groupid]' and dodbdata=1");
	if($bnum)
	{
		$cdbdata=1;
		esetcookie("ecmsdodbdata","empirecms",0);
    }
	else
	{
		esetcookie("ecmsdodbdata","",0);
	}
	$setkey=esetcookie("checkkey","");
	$set4=esetcookie("dloginuid",$r[userid],0);
	$set1=esetcookie("dloginuname",$username,0);
	$set2=esetcookie("dloginrnd",$rnd,0);
	$set3=esetcookie("dlogingroupid",$r[groupid],0);
	//COOKIE加密验证
	DoECookieRnd($r[userid],$username,$rnd,$cdbdata,$r[groupid]);
	//最后登陆时间
	$set4=esetcookie("logintime",$logintime,0);
	//写入日志
	insert_log($username,$loginip);
	if($set1&&$set2&&$set3)
	{
		printerror("登陆成功","admin.php");
	}
	else
	{
		printerror("您的Cookie没有开启，登陆不成功","history.go(-1)");
	}
}

//退出登陆
function loginout($userid,$username,$rnd){
	global $empire,$dbtbpre;
	$userid=(int)$userid;
	if(!$userid||!$username)
	{
		printerror("你还没有登陆","history.go(-1)");
	}
	$set1=esetcookie("dloginuid","",0);
	$set2=esetcookie("dloginuname","",0);
	$set3=esetcookie("dloginrnd","",0);
	$set4=esetcookie("dlogingroupid","",0);
	$set5=esetcookie("loginecmsckpass",'',0);
	esetcookie("ecmsdodbdata","",0);
	//取得随机密码
	$rnd=make_password(20);
	$sql=$empire->query("update {$dbtbpre}downuser set rnd='$rnd' where userid='$userid'");
	printerror("您已安全退出系统","index.php");
}
?>