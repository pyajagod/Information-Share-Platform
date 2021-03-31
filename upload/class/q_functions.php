<?php
function DownVideo($path_id,$p,$pass){
    global $empire,$dbtbpre,$public_r,$level_r,$user_tablename,$user_userid,$user_username,$user_rnd,$user_group,$user_downfen,$user_downdate,$user_todaydate,$user_todaydown;
    $path_id=(int)$path_id;
    $p=RepPostVar($p);
    if(empty($path_id)||empty($p))
    {
        printerror("您来自的链接不存在","history.go(-1)",1);
    }
    $p_r=explode(":::",$p);
    $userid=$p_r[0];
    $rnd=$p_r[1];
    //验证码
    $cpass=md5("wm_chief".$public_r[downpass].$userid);
    if($cpass<>$pass)
    {
        printerror("下载验证码不正确,请重新刷新下载页面,然后在点击下载.","history.go(-1)",1);
    }
    $ok=1;
    $r=$empire->fetch1("select * from ccxm_path where path_id='$path_id'");
    if(empty($r[path_id]))
    {
        printerror("此下载不存在","history.go(-1)",1);
    }
    //下载权限
    if(1)
    {
        $userid=(int)$userid;
        //取得会员资料
        $u=$empire->fetch1("select * from ".$user_tablename." where ".$user_userid."='$userid' and ".$user_rnd."='$rnd'");
        if(empty($u[$user_userid]))
        {
            printerror("同时只能一人在线,请重新登陆","history.go(-1)",1);
        }
        //下载次数限制
        $setuserday="";
        if($level_r[$u[$user_group]][daydown])
        {
            $thetoday=date("Y-m-d");
            if($thetoday!=$u[$user_todaydate])
            {
                $setuserday="update ".$user_tablename." set ".$user_todaydate."='".$thetoday."',".$user_todaydown."=1 where ".$user_userid."='$userid'";
            }
            else
            {
                if($u[$user_todaydown]>=$level_r[$u[$user_group]][daydown])
                {
                    printerror("您的下载与观看次数已超过系统限制次数","history.go(-1)",1);
                }
                $setuserday="update ".$user_tablename." set ".$user_todaydown."=".$user_todaydown."+1 where ".$user_userid."='$userid'";
            }
        }
        //点数是否足够

        if($r[path_need_point])
        {
            //---------是否有历史记录

            $bakr=$empire->fetch1("select path_id,truetime from {$dbtbpre}downdownrecord where  userid='$userid' and path_id='$path_id' order by down_id desc limit 1");
            if($bakr[path_id]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
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

                        printerror("您的点数不足 $r[path_need_point] 点，无法下载此软件","history.go(-1)",1);
                    }
                    //去除点数

                    $usql=$empire->query("update ".$user_tablename." set ".$user_downfen."=".$user_downfen."-".$r[path_need_point]." where ".$user_userid."='$userid'");

                }
                //备份下载记录
                $utfusername=doUtfAndGbk($u[$user_username],1);
                BakVideoDown($path_id,$userid,$utfusername,$r[path_address],$r[path_password],$r[path_need_point]);
            }
        }
        //更新用户下载次数
        if($setuserday)
        {
            $usql=$empire->query($setuserday);
        }
    }

    //防盗链

    @include('../DownVideo/downresult.php');
    db_close();
    $empire=null;

}
//下载软件
function DownSoft($softid,$pathid,$p,$pass){
	global $empire,$dbtbpre,$public_r,$level_r,$user_tablename,$user_userid,$user_username,$user_rnd,$user_group,$user_downfen,$user_downdate,$user_todaydate,$user_todaydown;
	$softid=(int)$softid;
	$pathid=(int)$pathid;
	$p=RepPostVar($p);
	if(empty($softid)||empty($p))
	{
		printerror("您来自的链接不存在","history.go(-1)",1);
	}
	$p_r=explode(":::",$p);
	$userid=$p_r[0];
	$rnd=$p_r[1];
	//验证码
	$cpass=md5("wm_chief".$public_r[downpass].$userid);
	if($cpass<>$pass)
	{
		printerror("下载验证码不正确,请重新刷新下载页面,然后在点击下载.","history.go(-1)",1);
    }
	$ok=1;
	$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid'");
	if(empty($r[softid]))
	{
		printerror("此下载不存在","history.go(-1)",1);
	}
	//区分下载地址
	$path_r=explode("\r\n",$r[downpath]);
	if(!$path_r[$pathid])
	{
		printerror("此下载不存在","",1);
	}
	$showdown_r=explode("::::::",$path_r[$pathid]);
	$downgroup=$showdown_r[2];
	//下载权限
	if($downgroup)
	{
		$userid=(int)$userid;
		//取得会员资料
		$u=$empire->fetch1("select * from ".$user_tablename." where ".$user_userid."='$userid' and ".$user_rnd."='$rnd'");
		if(empty($u[$user_userid]))
		{
			printerror("同时只能一人在线,请重新登陆","history.go(-1)",1);
		}
		//下载次数限制
		$setuserday="";
		if($level_r[$u[$user_group]][daydown])
		{
			$thetoday=date("Y-m-d");
			if($thetoday!=$u[$user_todaydate])
			{
				$setuserday="update ".$user_tablename." set ".$user_todaydate."='".$thetoday."',".$user_todaydown."=1 where ".$user_userid."='$userid'";
			}
			else
			{
				if($u[$user_todaydown]>=$level_r[$u[$user_group]][daydown])
				{
					printerror("您的下载与观看次数已超过系统限制次数","history.go(-1)",1);
				}
				$setuserday="update ".$user_tablename." set ".$user_todaydown."=".$user_todaydown."+1 where ".$user_userid."='$userid'";
			}
		}
		if($level_r[$downgroup][level]>$level_r[$u[$user_group]][level])
		{
			printerror("您的会员级别不足(".$level_r[$downgroup][groupname].")，没有下载此软件的权限!","history.go(-1)",1);
		}
		//点数是否足够
		$showdown_r[3]=intval($showdown_r[3]);
		if($showdown_r[3])
		{
			//---------是否有历史记录
			$bakr=$empire->fetch1("select softid,truetime from {$dbtbpre}downdown where softid='$softid' and userid='$userid' and pathid='$pathid' order by downid desc limit 1");
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
						printerror("您的点数不足 $showdown_r[3] 点，无法下载此软件","history.go(-1)",1);
					}
					//去除点数
					$usql=$empire->query("update ".$user_tablename." set ".$user_downfen."=".$user_downfen."-".$showdown_r[3]." where ".$user_userid."='$userid'");
				}
				//备份下载记录
				$utfusername=doUtfAndGbk($u[$user_username],1);
				BakDown($softid,$pathid,$userid,$utfusername,$r[softname],$showdown_r[3],0);
			}
		}
		//更新用户下载次数
		if($setuserday)
		{
			$usql=$empire->query($setuserday);
		}
	}
	//总下载数据增一
    DoOnclick($softid,$r);
	$downurl=$showdown_r[1];
	$downurlr=ReturnDownQzPath($downurl,$showdown_r[4]);
	$downurl=$downurlr['repath'];
	//防盗链
	@include("../class/enpath.php");
	$downurl=DoEnDownpath($downurl);
    db_close();
    $empire=null;
	DoTypeForDownurl($downurl,$downurlr['downtype']);
}

//下载操作
function DoTypeForDownurl($downurl,$type=0){
	global $public_r;
	if($type==1)//meta
	{
		echo"<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;url=$downurl\">";
	}
	elseif($type==2)//read
	{
		QDownLoadFile($downurl);
	}
	else//header
	{
		Header("Location:$downurl");
	}
	exit();
}

//下载
function QDownLoadFile($file){
	global $public_r;
	if(strstr($file,"\\"))
	{
		$exp="\\";
	}
	elseif(strstr($file,"/"))
	{
		$exp="/";
	}
	else
	{
		Header("Location:$file");
		exit();
	}
	if(strstr($file,"..")||strstr($file,"?")||strstr($file,"#"))
	{
		Header("Location:$file");
		exit();
    }
	if(strstr($file,"://")&&strstr($file,'/data/'.$public_r[downpath].'/'))
	{
		$file=str_replace(eReturnDomain().'/data/'.$public_r[downpath].'/','/data/'.$public_r[downpath].'/',$file);
	}
	if(!strstr($file,"://"))
	{
		if(!file_exists($file))
		{
			$file="..".$file;
		}
	}
	$filename=GetDownurlFilename($file,$exp);
	if(empty($filename))
	{
		Header("Location:$file");
		exit();
	}
	//下载
	Header("Content-type: application/octet-stream");
	//Header("Accept-Ranges: bytes");
	//Header("Accept-Length: ".$filesize);
	Header("Content-Disposition: attachment; filename=".$filename);
	echo ReadFiletext($file);
}

//取得下载文件名
function GetDownurlFilename($file,$expstr){
	$r=explode($expstr,$file);
	$count=count($r)-1;
	$filename=$r[$count];
	return $filename;
}

//取得验证码
function GetOnlinePass(){
	global $public_r;
	$onlinep=$public_r[downpass]."qwertyuiop.,mvcvxzzfdsfm,.dsa";
	$r[0]=time();
	$r[1]=md5($onlinep.$r[0]);
	return $r;
}

//验证验证码
function CheckOnlinePass($onlinetime,$onlinepass){
	global $movtime,$public_r;
	if($onlinetime+$movtime<time()||$onlinetime>time())
	{
		exit();
	}
	$onlinep=$public_r[downpass]."qwertyuiop.,mvcvxzzfdsfm,.dsa";
	$cpass=md5($onlinep.$onlinetime);
	if($onlinepass<>$cpass)
	{
		exit();
	}
}

//--------取得软件地址
function GetSofturl($softid,$pathid,$p,$pass,$onlinetime,$onlinepass){
	global $empire,$public_r,$level_r,$user_tablename,$user_userid,$user_username,$user_rnd,$user_group,$user_downfen,$user_downdate,$user_todaydate,$user_todaydown,$dbtbpre,$realplayertype,$mediaplayertype;
	$softid=(int)$softid;
	$pathid=(int)$pathid;
	$onlinetime=(int)$onlinetime;
	$p=RepPostVar($p);
	if(empty($softid)||empty($p))
	{exit();}
	$p_r=explode(":::",$p);
	$userid=$p_r[0];
	$rnd=$p_r[1];
	//验证码
	$cpass=md5("wm_chief".$public_r[downpass].$userid);
	if($cpass<>$pass)
	{exit();}
	//验证验证码
	CheckOnlinePass($onlinetime,$onlinepass);
	$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid'");
	if(empty($r[softid]))
	{exit();}
	//区分下载地址
	$path_r=explode("\r\n",$r[onlinepath]);
	if(!$path_r[$pathid])
	{
		exit();
	}
	$showdown_r=explode("::::::",$path_r[$pathid]);
	$downgroup=$showdown_r[2];
	//下载权限
	if($downgroup)
	{
		$userid=(int)$userid;
		//取得会员资料
		$u=$empire->fetch1("select * from ".$user_tablename." where ".$user_userid."='$userid' and ".$user_rnd."='$rnd'");
		if(empty($u[$user_userid]))
		{exit();}
		//下载次数限制
		$setuserday="";
		if($level_r[$u[$user_group]][daydown])
		{
			$thetoday=date("Y-m-d");
			if($thetoday!=$u[$user_todaydate])
			{
				$setuserday="update ".$user_tablename." set ".$user_todaydate."='".$thetoday."',".$user_todaydown."=1 where ".$user_userid."='$userid'";
			}
			else
			{
				if($u[$user_todaydown]>=$level_r[$u[$user_group]][daydown])
				{
					exit();
				}
				$setuserday="update ".$user_tablename." set ".$user_todaydown."=".$user_todaydown."+1 where ".$user_userid."='$userid'";
			}
		}
		if($level_r[$downgroup][level]>$level_r[$u[$user_group]][level])
		{
			exit();
		}
		//点数是否足够
		$showdown_r[3]=intval($showdown_r[3]);
		if($showdown_r[3])
		{
			//---------是否有历史记录
			$bakr=$empire->fetch1("select softid,truetime from {$dbtbpre}downdown where softid='$softid' and userid='$userid' and pathid='$pathid' order by downid desc limit 1");
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
				    exit();
			       }
			       //去除点数
			       $usql=$empire->query("update ".$user_tablename." set ".$user_downfen."=".$user_downfen."-".$showdown_r[3]." where ".$user_userid."='$userid'");
				}
				//备份下载记录
				$utfusername=doUtfAndGbk($u[$user_username],1);
				BakDown($softid,$pathid,$userid,$utfusername,$r[softname],$showdown_r[3],0);
			}
		}
		//更新用户下载次数
		if($setuserday)
		{
			$usql=$empire->query($setuserday);
		}
	}
	//总下载数据增一
    DoOnclick($softid,$r);
	//选择播放器
	$ftype=GetFiletype($showdown_r[1]);
	if(strstr($realplayertype,','.$ftype.','))
	{
		Header("Content-Type: audio/x-pn-realaudio");
	}
	else
	{
		Header("Content-Type: video/x-ms-asf");
	}
	$downurl=$showdown_r[1];
	$downurlr=ReturnDownQzPath($downurl,$showdown_r[4]);
	$downurl=$downurlr['repath'];
	//防盗链
	@include("../class/enpath.php");
	$downurl=DoEnOnlinepath($downurl);
    db_close();
    $empire=null;
	echo $downurl;
	exit();
}

function Rdownpath($path)
{
	$path=urlencode(urldecode($path));
	$path=str_replace("%2F","/",$path);
	$path=str_replace("%3A",":",$path);
	$path=str_replace("%40","@",$path);
	return $path;
}

//下载统计
function DoOnclick($softid,$r){
	global $empire,$dbtbpre;
	$a='';
	//周统计
	$a.=date("W",$r['counttime'])<>date("W")?",count_week=1":",count_week=count_week+1";
	//月统计
	$a.=date("Y-m",$r['counttime'])<>date("Y-m")?",count_month=1":",count_month=count_month+1";
	//日统计
	$a.=date("Y-m-d",$r['counttime'])<>date("Y-m-d")?",count_day=1":",count_day=count_day+1";
	//总统计
	$empire->query("update {$dbtbpre}down set count_all=count_all+1,counttime='".time()."'".$a." where softid='$softid'");
}

//增加收藏
function AddFava($softid){
	global $empire,$level_r,$dbtbpre;
	//是否登陆
	$user_r=islogin();
	$softid=(int)$softid;
	if(empty($softid))
	{
		printerror("此下载不存在","history.go(-1)",1);
    }
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where softid='$softid'");
	if(empty($num))
	{
		printerror("此下载不存在","history.go(-1)",1);
	}
	//是否已收藏
	$softnum=$empire->gettotal("select count(*) as total from {$dbtbpre}downfava where softid='$softid' and userid='$user_r[userid]'");
	if($softnum)
	{
		printerror("此下载已收藏过","history.go(-1)",1);
	}
	$favanum=$empire->gettotal("select count(*) as total from {$dbtbpre}downfava where userid='$user_r[userid]'");
	$groupid=$user_r[groupid];
	if($level_r[$groupid][favanum]<=$favanum)
	{
		printerror("您的收藏夹已满","history.go(-1)",1);
	}
	$favatime=date("Y-m-d H:i:s");
	$sql=$empire->query("insert into {$dbtbpre}downfava(softid,favatime,userid,username) values('$softid','$favatime','$user_r[userid]','$user_r[username]');");
	if($sql)
	{
		printerror("增加收藏夹成功","history.go(-1)",1);
	}
	else
	{
		printerror("数据库出错","history.go(-1)",1);
	}
}

//批量删除收藏
function DelFava_All($favaid){
	global $empire,$dbtbpre;
	//是否登陆
	$user_r=islogin();
	$count=count($favaid);
	if(empty($count))
	{
		printerror("请选择要删除的收藏夹","history.go(-1)",1);
	}
	for($i=0;$i<$count;$i++)
	{
		$add.="favaid='".intval($favaid[$i])."' or ";
    }
	$add=substr($add,0,strlen($add)-4);
	$sql=$empire->query("delete from {$dbtbpre}downfava where (".$add.") and userid='$user_r[userid]'");
	if($sql)
	{
		printerror("删除收藏夹成功","../fava",1);
	}
	else
	{
		printerror("数据库出错","history.go(-1)",1);
	}
}

//删除单个收藏夹
function DelFava($favaid){
	global $empire,$dbtbpre;
	//是否登陆
	$user_r=islogin();
	$favaid=(int)$favaid;
	if(empty($favaid))
	{
		printerror("请选择要删除的收藏夹","history.go(-1)",1);
	}
	$sql=$empire->query("delete from {$dbtbpre}downfava where favaid='$favaid' and userid='$user_r[userid]'");
	if($sql)
	{
		printerror("删除收藏夹成功","../fava",1);
	}
	else
	{
		printerror("数据库出错","history.go(-1)",1);
	}
}

//增加投票
function AddVote($voteid,$vote){
	global $empire,$dbtbpre;
	$voteid=(int)$voteid;
	if(empty($voteid))
	{
		printerror("此投票不存在","history.go(-1)",1);
	}
	$r=$empire->fetch1("select voteid,voteip,votetext,voteclass,doip,votetime,dotime from {$dbtbpre}downvote where voteid='$voteid'");
	if(empty($r[voteid]))
	{
		printerror("此投票不存在","history.go(-1)",1);
	}
	//投票期限
	if($r['dotime']<>"0000-00-00")
	{
		$endtime=to_date($r['dotime']);
		if($endtime<time())
		{
			printerror("此投票已过期,不能投票","history.go(-1)",1);
		}
	}
	//IP限制
	if(empty($r['voteip']))
	{
		$r['voteip']='|';
	}
	$ip=egetip();
	if($r[doip])
	{
		if(strstr($r['voteip'],'|'.$ip.'|'))
		{
			printerror("您已投票过,请不要重复投票","history.go(-1)",1);
		}
		$r['voteip']=$r['voteip'].$ip."|";
	}
	$new_voteip=$r['voteip'];
	$VoteField="::::::";
	$VoteRecord="\r\n";
	$vote_r=explode($VoteRecord,$r[votetext]);
	$new_vote_total=0;
	//多选
	if($r[voteclass])
	{
		$vote_count=count($vote);
		if(empty($vote_count))
		{
			printerror("请至少选择一个投票项","history.go(-1)",1);
		}
		for($j=0;$j<$vote_count;$j++)
		{
			$new_vote_total++;
			$v_r=explode($VoteField,$vote_r[$vote[$j]-1]);
			if(empty($v_r[0]))
			{
				continue;
			}
			$vote_num=$v_r[1]+1;
			$vote_r[$vote[$j]-1]=$v_r[0].$VoteField.$vote_num;
		}
	}
	//单选
	else
	{
		if(empty($vote))
		{
			printerror("请至少选择一个投票项","history.go(-1)",1);
		}
		$v_r=explode($VoteField,$vote_r[$vote-1]);
		if(empty($v_r[0]))
		{
			printerror("请至少选择一个投票项","history.go(-1)",1);
		}
		$vote_num=$v_r[1]+1;
		$vote_r[$vote-1]=$v_r[0].$VoteField.$vote_num;
		$new_vote_total=1;
	}
	for($n=0;$n<count($vote_r);$n++)
	{
		$new_votetext.=$vote_r[$n].$VoteRecord;
	}
	//去掉最后的字符
	$new_votetext=substr($new_votetext,0,strlen($new_votetext)-2);
	$sql=$empire->query("update {$dbtbpre}downvote set votetext='$new_votetext',voteip='$new_voteip',votenum=votenum+".$new_vote_total." where voteid='$voteid'");
	if($sql)
	{
		printerror("感谢您的投票","../vote?voteid=".$voteid,1);
	}
	else
	{
		printerror("数据库出错","history.go(-1)",1);
	}
}

//点卡充值
function CardGetDown($username,$reusername,$card_no,$password){
	global $empire,$dbtbpre,$user_tablename,$user_downfen,$user_downdate,$user_userid,$user_username,$user_zgroup,$user_group;
	$username=RepPostVar($username);
	$reusername=RepPostVar($reusername);
	$card_no=RepPostVar($card_no);
	$password=RepPostVar($password);
	if(!trim($username)||!trim($card_no)||!trim($password))
	{
		printerror("请输入用户名，卡号与密码","history.go(-1)",1);
	}
	if($username!=$reusername)
	{
		printerror("两次输入的用户名不一致","history.go(-1)",1);
	}
	//编码转换
	$utfusername=doUtfAndGbk($username,0);
	$user=$empire->fetch1("select ".$user_userid.",".$user_downdate.",".$user_username." from ".$user_tablename." where ".$user_username."='".$utfusername."' limit 1");
	if(!$user[$user_userid])
	{
		printerror("您输入的用户不存在","history.go(-1)",1);
	}
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}downcard where card_no='".$card_no."' and password='".$password."' limit 1");
	if(!$num)
	{
		printerror("您输入的充值卡号或密码有误","history.go(-1)",1);
	}
	//是否过期
	$buytime=date("Y-m-d H:i:s");
	$r=$empire->fetch1("select cardfen,money,endtime,carddate,cdgroupid,cdzgroupid from {$dbtbpre}downcard where card_no='$card_no' limit 1");
	if($r[endtime]<>"0000-00-00")
	{
		$endtime=to_date($r[endtime]);
		if($endtime<time())
		{
			printerror("此充值卡已经过期","history.go(-1)",1);
	    }
    }
	//充值
	eAddFenToUser($r[cardfen],$r[carddate],$r[cdgroupid],$r[cdzgroupid],$user);
	$sql1=$empire->query("delete from {$dbtbpre}downcard where card_no='$card_no'");//删除卡号
	//备份购买记录
	BakBuy($user[$user_userid],$username,$card_no,$r[cardfen],$r[money],$r[carddate],0);
	printerror("恭喜您！充值成功","../card",1);
}

//增加评论
function AddPl($softid,$plfen,$content){
	global $empire,$dbtbpre,$public_r;
	if(!$public_r['openpl'])
	{
		printerror("评论功能已关闭","history.go(-1)",1);
	}
	$softid=(int)$softid;
	if(!$softid||!trim($content))
	{
		printerror("请输入评论内容","history.go(-1)",1);
	}
	//验证码
	if($public_r['plkey'])
	{
		$checkplkey=getcvar('checkplkey');
		if($_POST['key']<>$checkplkey||empty($checkplkey))
		{printerror("验证码错误","history.go(-1)",1);}
	}
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where softid='$softid'");
	if(!$num)
	{
		printerror("此下载不存在","history.go(-1)",1);
	}
	if(strlen($content)>$public_r['plsize'])
	{
		printerror("评论内容限制在".$public_r['plsize']."个字节内","history.go(-1)",1);
	}
	//禁止字符
	$pr=$empire->fetch1("select plcloseword from {$dbtbpre}downpublic limit 1");
	toCheckCloseWord($content,$pr['plcloseword'],"内容包含禁用字符");
	$plfen=(int)$plfen;
	if($plfen>5)
	{
		$plfen=5;
	}
	if($plfen<1)
	{
		$plfen=1;
	}
	$pltime=date("Y-m-d H:i:s");
	$content=nl2br(RepPostStr($content));
	$plip=egetip();
	$sql=$empire->query("insert into {$dbtbpre}downpl(softid,pltime,plip,plfen,content) values('$softid','$pltime','$plip','$plfen','$content');");
	if($sql)
	{
		esetcookie("checkplkey","");
		printerror("发表成功","../pl?softid=$softid",1);
	}
	else
	{
		printerror("数据库出错","history.go(-1)",1);
	}
}

//发送错误报告
function AddError($softid,$errortext){
	global $empire,$dbtbpre;
	$softid=(int)$softid;
	if(!$softid||!trim($errortext))
	{
		printerror("请输入报告内容","history.go(-1)",1);
	}
	$sr=$empire->fetch1("select softid,filename,titleurl from {$dbtbpre}down where softid='$softid'");
	if(!$sr['softid'])
	{
		printerror("此下载不存在","history.go(-1)",1);
	}
	$errortext=nl2br(RepPostStr($errortext));
	$errortime=date("Y-m-d H:i:s");
	$errorip=egetip();
	$sql=$empire->query("insert into {$dbtbpre}downerror(softid,errortext,errorip,errortime) values('$softid','$errortext','$errorip','$errortime');");
	$location=EDReturnSoftPageUrl($sr['filename'],$sr['titleurl']);
	if($sql)
	{
		echo"<script>alert('感谢您的报告，我们会尽快处理');window.close();</script>";
		db_close();
		exit();
	}
	else
	{
		printerror("数据库出错","history.go(-1)",1);
	}
}
?>