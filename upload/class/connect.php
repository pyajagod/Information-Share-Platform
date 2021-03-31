<?php
error_reporting(E_ALL ^ E_NOTICE);

define('InEmpireDown',TRUE);
define('EDOWN_PATH',substr(dirname(__FILE__),0,-5));
$editor=0;

require_once EDOWN_PATH.'data/config.php';

//页面编码
if($phome_headercharset==1)
{
	if($phome_edown_charver=='gb2312'||$phome_edown_charver=='big5'||$phome_edown_charver=='utf-8')
	{
		@header('Content-Type: text/html; charset='.$phome_edown_charver);
	}
}

//时区
if(function_exists('date_default_timezone_set'))
{
	@date_default_timezone_set("PRC");
}

function db_connect(){
	global $phome_db_server,$phome_db_username,$phome_db_password,$phome_db_dbname,$phome_db_port,$phome_db_char,$phome_db_ver;
	$dblocalhost=$phome_db_server;
	//端口
	if($phome_db_port)
	{
		$dblocalhost.=":".$phome_db_port;
	}
	$link=@mysql_connect($dblocalhost,$phome_db_username,$phome_db_password);
	if(!$link)
	{
		echo"Cann't connect to DB!";
		exit();
	}
	//编码
	if($phome_db_ver>='4.1')
	{
		$q='';
		if($phome_db_char)
		{
			$q='character_set_connection='.$phome_db_char.',character_set_results='.$phome_db_char.',character_set_client=binary';
		}
		if($phome_db_ver>='5.0')
		{
			$q.=(empty($q)?'':',').'sql_mode=\'\'';
		}
		if($q)
		{
			@mysql_query('SET '.$q);
		}
	}
	@mysql_select_db($phome_db_dbname);
	return $link;
}

//设置编码
function DoSetDbChar($dbchar){
	if($dbchar&&$dbchar!='auto')
	{
		@mysql_query("set names '".$dbchar."';");
	}
}

function db_close(){
	global $link;
	@mysql_close($link);
}

//设置COOKIE
function esetcookie($var,$val,$life=0){
	global $phome_cookiedomain,$phome_cookiepath,$phome_cookievarpre;
	return setcookie($phome_cookievarpre.$var,$val,$life,$phome_cookiepath,$phome_cookiedomain);
}

//返回cookie
function getcvar($var){
	global $phome_cookievarpre;
	$tvar=$phome_cookievarpre.$var;
	return $_COOKIE[$tvar];
}

//错误提示
function printerror($error="",$gotourl="",$phome=0,$noautourl=0){
	global $empire,$public_r,$editor;
	if($editor==1){$a="../";}
	elseif($editor==2){$a="../../";}
	elseif($editor==3){$a="../../../";}
	else{$a="";}
	if(strstr($gotourl,"(")||empty($gotourl))
	{
		$gotourl_js="history.go(-1)";
		$gotourl="javascript:history.go(-1)";
	}
	else
	{
		$gotourl_js="self.location.href='$gotourl';";
	}
	if($phome==9)//弹出对话框
	{
		echo"<script>alert('".$error."');".$gotourl_js."</script>";
	}
	elseif($phome==0)//后台
	{
		@include(EDOWN_PATH."message/message.php");
	}
	else//前台
	{
		@include(EDOWN_PATH."message/index.php");
	}
	@db_close();
	$empire=null;
	exit();
}

//---------------------------字符截取函数
function sub($string,$start=0,$length,$mode=false,$dot=''){
	global $phome_edown_charver;
	if(empty($length))
	{
		return $string;
	}
	$strlen=strlen($string);
	if($strlen<=$length)
	{
		return $string;
	}

	$string = str_replace(array('&nbsp;','&amp;','&quot;','&lt;','&gt;','&#039;'), array(' ','&','"','<','>',"'"), $string);

	$strcut = '';
	if(strtolower($phome_edown_charver) == 'utf-8') {

		$n = $tn = $noc = 0;
		while($n < $strlen) {

			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t < 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}

			if($noc >= $length) {
				break;
			}

		}
		if($noc > $length) {
			$n -= $tn;
		}

		$strcut = substr($string, 0, $n);

	} else {
		for($i = 0; $i < $length; $i++) {
			$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	}

	$strcut = str_replace(array('&','"','<','>',"'"), array('&amp;','&quot;','&lt;','&gt;','&#039;'), $strcut);

	return $strcut.$dot;
}

//截取字数
function esub($string,$length,$dot=''){
	if(empty($length))
	{
		return $string;
	}
	return sub($string,0,$length,false,$dot);
}

//取得随机数
function make_password($pw_length){
	$low_ascii_bound=50;
	$upper_ascii_bound=122;
	$notuse=array(58,59,60,61,62,63,64,73,79,91,92,93,94,95,96,108,111);
	while($i<$pw_length)
	{
		mt_srand((double)microtime()*1000000);
		$randnum=mt_rand($low_ascii_bound,$upper_ascii_bound);
		if(!in_array($randnum,$notuse))
		{
			$password1=$password1.chr($randnum);
			$i++;
		}
	}
	return $password1;
}

//取得随机数(数字)
function no_make_password($pw_length){
	$low_ascii_bound=48;
	$upper_ascii_bound=57;
	$notuse=array(58,59,60,61,62,63,64,73,79,91,92,93,94,95,96,108,111);
	while($i<$pw_length)
	{
		mt_srand((double)microtime()*1000000);
		$randnum=mt_rand($low_ascii_bound,$upper_ascii_bound);
		if(!in_array($randnum,$notuse))
		{
			$password1=$password1.chr($randnum);
			$i++;
		}
	}
	return $password1;
}

//EMAIL地址检查
function chemail($email){
	if(empty($email)||!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$email))
	{
		printerror("Email地址有误","history.go(-1)",1);
		return false;
	}
	else
	{
		return true;
	}
}

//取得文件内容
function ReadFiletext($filepath){
	$filepath=trim($filepath);
	$htmlfp=@fopen($filepath,"r");
	if(strstr($filepath,"://"))//远程
	{
		while($data=@fread($htmlfp,500000))
	    {
			$string.=$data;
		}
	}
	else//本地
	{
		$string=@fread($htmlfp,@filesize($filepath));
	}
	@fclose($htmlfp);
	return $string;
}

//写文件
function WriteFiletext($filepath,$string){
	global $public_r;
	$string=stripSlashes($string);
	$fp=@fopen($filepath,"w");
	@fputs($fp,$string);
	@fclose($fp);
	if($public_r[filechmod]==1)
	{}
	else
	{
		@chmod($filepath,0777);
	}
}

//写文件
function WriteFiletext_n($filepath,$string){
	global $public_r;
	$fp=@fopen($filepath,"w");
	@fputs($fp,$string);
	@fclose($fp);
	if($public_r[filechmod]==1)
	{}
	else
	{
		@chmod($filepath,0777);
	}
}

//删除文件
function DelFiletext($filename){
	@unlink($filename);
}

//返回文件名
function ReturnPathFile($filename){
	$fr=explode("/",$filename);
	$count=count($fr)-1;
	return $fr[$count];
}

//分页
function page1($num,$line,$page_line,$start,$page,$search){
	$pagetotal=$line*$page_line;//所要显示的总条数
	$total=ceil(($num-$start)/$line);//取得总页数
	$total_start=ceil($num/$pagetotal);//取得总偏移数
	$returnstr="共&nbsp;".$num."&nbsp;条记录&nbsp;&nbsp;";
	$php_self=$_SERVER['PHP_SELF'];
	if($start!=0)
	{
		$old_start=$start-$pagetotal;
		$returnstr.="&nbsp;&nbsp;<a href=".$PHP_SELF."?page=0&start=".$old_start.$search." title='UP".$page_line."Pages'><strong>&lsaquo;&lsaquo;</strong></a>";
	}
	$pagestart=$start/$pagetotal*$page_line;//取得当前页数
	for($i=0;$i<$total&&$i<$page_line;$i++)
	{
		if($page==$i)
		{$is_1="<b>[";$is_2="]</b>";}
		else
		{$is_1="<a href=".$PHP_SELF."?page=".$i."&start=".$start.$search.">";$is_2="</a>";}
		$pagenum=$pagestart+$i+1;
		$returnstr.="&nbsp;&nbsp;".$is_1.$pagenum.$is_2;
	}
	if($total_start!=($start/$pagetotal+1)&&$num!=0)
	{
		$new_start=$start+$pagetotal;
		$returnstr.="&nbsp;&nbsp;<a href=".$PHP_SELF."?page=0&start=".$new_start.$search." title='Next".$page_line."Pages'>&rsaquo;&rsaquo;</a>";
	}
	return $returnstr;
}

//返回栏目集合
function ReturnClass($sonclass){
	if($sonclass==""||$sonclass=="|"){
		return "classid=0";
	}
	$where="classid in (".RepSonclassSql($sonclass).")";
	return $where;
}

//替换子栏目子
function RepSonclassSql($sonclass){
	if($sonclass==""||$sonclass=="|"){
		return 0;
	}
	$sonclass=substr($sonclass,1,strlen($sonclass)-2);
	$sonclass=str_replace("|",",",$sonclass);
	return $sonclass;
}

//返回多栏目
function sys_ReturnMoreClass($sonclass,$son=0){
	global $class_r;
	$r=explode(",",$sonclass);
	$count=count($r);
	$return_r[0]=intval($r[0]);
	$where="";
	for($i=0;$i<$count;$i++)
	{
		$r[$i]=intval($r[$i]);
		$or=" or ";
		if($i==0)
		{
			$or="";
		}
		if($son==1)
		{
			if(!$class_r[$r[$i]]['islast'])
			{
				$where.=$or."classid in (".RepSonclassSql($class_r[$r[$i]]['sonclass']).")";
			}
			else
			{
				$where.=$or."classid='".$r[$i]."'";
			}
		}
		else
		{
			$where.=$or."classid='".$r[$i]."'";
		}
	}
	$return_r[1]=$where;
	return $return_r;
}

//返回多专题
function sys_ReturnMoreZt($zt){
	$r=explode(",",$zt);
	$count=count($r);
	$return_r[0]=intval($r[0]);
	$where="";
	for($i=0;$i<$count;$i++)
	{
		$r[$i]=intval($r[$i]);
		$or=" or ";
		if($i==0)
		{
			$or="";
		}
		$where.=$or."ztid='".$r[$i]."'";
	}
	$return_r[1]=$where;
	return $return_r;
}

//验证是否包含栏目
function CheckHaveInClassid($cr,$checkclass){
	global $class_r;
	if($cr['islast'])
	{
		$chclass='|'.$cr['classid'].'|';
	}
	else
	{
		$chclass=$cr['sonclass'];
	}
	$return=0;
	$r=explode('|',$chclass);
	$count=count($r);
	for($i=1;$i<$count-1;$i++)
	{
		if(strstr($checkclass,'|'.$r[$i].'|'))
		{
			$return=1;
			break;
		}
	}
	return $return;
}

//标题属性后
function DoTitleFont($titlefont,$title){
	if(empty($titlefont))
	{
		return $title;
	}
	$r=explode(',',$titlefont);
	if(!empty($r[0]))
	{
		$title="<font color='".$r[0]."'>".$title."</font>";
	}
	if(empty($r[1]))
	{return $title;}
	//粗体
	if(strstr($r[1],"b"))
	{$title="<strong>".$title."</strong>";}
	//斜体
	if(strstr($r[1],"i"))
	{$title="<i>".$title."</i>";}
	//删除线
	if(strstr($r[1],"s"))
	{$title="<s>".$title."</s>";}
	return $title;
}

//文件大小格式转换
function ChTheFilesize($size){
	if($size>=1024*1024)//MB
	{
		$filesize=number_format($size/(1024*1024),2,'.','')." MB";
	}
	elseif($size>=1024)//KB
	{
		$filesize=number_format($size/1024,2,'.','')." KB";
	}
	else
	{
		$filesize=$size." Bytes";
	}
	return $filesize;
}

//时间转换函数
function to_time($datetime){
	if(strlen($datetime)==10)
	{
		$datetime.=" 00:00:00";
	}
	$r=explode(" ",$datetime);
	$t=explode("-",$r[0]);
	$k=explode(":",$r[1]);
	$dbtime=mktime($k[0],$k[1],$k[2],$t[1],$t[2],$t[0]);
	return $dbtime;
}

//时期转日期
function date_time($time,$format="Y-m-d H:i:s"){
	$threadtime=date($format,$time);
	return $threadtime;
}

//格式化日期
function format_datetime($newstime,$format){
	if($newstime=="0000-00-00 00:00:00")
	{return $newstime;}
	$time=to_time($newstime);
	$newdate=date_time($time,$format);
	return $newdate;
}

//时间转换函数
function to_date($date){
	$date.=" 00:00:00";
	$r=explode(" ",$date);
	$t=explode("-",$r[0]);
	$k=explode(":",$r[1]);
	$dbtime=@mktime($k[0],$k[1],$k[2],$t[1],$t[2],$t[0]);
	return $dbtime;
}

//选择时间
function ToChangeTime($time,$day){
	$truetime=$time-$day*24*3600;
	$date=date_time($truetime,"Y-m-d");
	return $date;
}

//返回分类地址
function EDReturnClassUrl($classid){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/".$classid."_1".$public_r['refiletype'];
}

//返回软件类型地址
function EDReturnTypeUrl($classid){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/type".$classid."_1".$public_r['refiletype'];
}

//返回专题地址
function EDReturnZtUrl($classid){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/zt".$classid."_1".$public_r['refiletype'];
}

//返回字母地址
function EDReturnZmUrl($zm){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/zm_".$zm."_1".$public_r['refiletype'];
}

//返回自定义列表地址
function EDReturnUserlistUrl($id){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/list".$id."_1".$public_r['refiletype'];
}

//返回分类导航页面
function EDReturnClassNavUrl(){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/action".$public_r['refiletype'];
}

//返回公告页面
function EDReturnGgUrl(){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/gg".$public_r['refiletype'];
}

//返回搜索表单页面
function EDReturnSearchFormUrl(){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/search".$public_r['refiletype'];
}

//返回信息页地址
function EDReturnSoftPageUrl($filename,$titleurl){
	global $public_r;
	if($titleurl)
	{
		$url=$titleurl;
	}
	else
	{
		$url=$public_r['sitedown'].$public_r['resoftpath']."/".$filename.$public_r['refiletype'];
	}
	return $url;
}

//返回分类名称
function EdReturnClassname($classid){
	global $class_r;
	return $class_r[$classid][bname]?$class_r[$classid][bname]:$class_r[$classid][classname];
}

//替换表前缀
function RepSqlTbpre($sql){
	global $dbtbpre;
	$sql=str_replace("[!db.pre!]",$dbtbpre,$sql);
	return $sql;
}

//备份下载记录
function BakDown($softid,$pathid,$userid,$username,$softname,$downfen,$type=0){
	global $empire,$dbtbpre;
	$downtime=date("y-m-d H:i:s");
	$truetime=time();
	$softname=addslashes($softname);
	$empire->query("insert into {$dbtbpre}downdown(softid,pathid,userid,username,downtime,softname,downfen,truetime,type) values('$softid','$pathid','$userid','$username','$downtime','$softname','$downfen','$truetime','$type');");
}
//备份下载视频记录
function BakVideoDown($path_id,$userid,$username,$path_address,$path_password,$downfen){
    global $empire,$dbtbpre;
    $downtime=date("y-m-d H:i:s");
    $truetime=time();
    $empire->query("insert into {$dbtbpre}downdownrecord(path_id,userid,username,path_address,path_password,downtime,downfen,truetime) values('$path_id','$userid','$username','$path_address','$path_password','$downtime','$downfen','$truetime');");
}
//备份充值记录
function BakBuy($userid,$username,$buyname,$downfen,$money,$downdate,$type=0){
	global $empire,$dbtbpre;
	$buytime=date("y-m-d H:i:s");
	$buyname=addslashes($buyname);
	$empire->query("insert into {$dbtbpre}downbuy_bak(userid,username,card_no,downfen,money,buytime,downdate,type) values('$userid','$username','$buyname','$downfen','$money','$buytime','$downdate','$type');");
}

//返回加前缀的下载地址
function ReturnDownQzPath($path,$urlid){
	global $empire,$dbtbpre;
	if(empty($urlid))
	{
		$re['repath']=$path;
		$re['downtype']=0;
    }
	else
	{
		$r=$empire->fetch1("select urlid,url,downtype from {$dbtbpre}downurl where urlid='$urlid'");
		if($r['urlid'])
		{
			$re['repath']=$r['url'].$path;
		}
		else
		{
			$re['repath']=$path;
		}
		$re['downtype']=$r['downtype'];
	}
	return $re;
}

//返回带防盗链的绝对地址
function ReturnDSofturl($downurl,$qz,$path='../',$isdown=0){
	$urlr=ReturnDownQzPath(stripSlashes($downurl),$qz);
	$url=$urlr['repath'];
	@include(EDOWN_PATH."action/enpath.php");//防盗链
	if($isdown)
	{
		$url=DoEnDownpath($url);
	}
	else
	{
		$url=DoEnOnlinepath($url);
	}
	return $url;
}

//返回附件目录
function ToReturnFileSavePath(){
	global $public_r;
	$path='data/'.$public_r[downpath];
	return $path;
}

//参数处理函数
function RepPostVar($val){
	if($val!=addslashes($val))
	{
		exit();
	}
	$val=str_replace(" ","",$val);
	$val=str_replace("%20","",$val);
	$val=str_replace("%27","",$val);
	$val=str_replace("*","",$val);
	$val=str_replace("'","",$val);
	$val=str_replace("\"","",$val);
	$val=str_replace("/","",$val);
	$val=str_replace(";","",$val);
	$val=RepPostStr($val);
	$val=addslashes($val);
	return $val;
}

//参数处理函数2
function RepPostVar2($val){
	if($val!=addslashes($val))
	{
		exit();
	}
	$val=str_replace("%20","",$val);
	$val=str_replace("%27","",$val);
	$val=str_replace("*","",$val);
	$val=str_replace("'","",$val);
	$val=str_replace("\"","",$val);
	$val=str_replace("/","",$val);
	$val=str_replace(";","",$val);
	$val=RepPostStr($val);
	$val=addslashes($val);
	return $val;
}

//返回原字符
function ReturnDoYStr($val){
	return addslashes(stripSlashes($val));
}

//处理提交字符
function RepPostStr($val){
	$val=htmlspecialchars($val);
	$val=str_replace("'","&#039;",$val);
	return $val;
}

//去除adds
function ClearAddsData($data){
	$magic_quotes_gpc=get_magic_quotes_gpc();
	if($magic_quotes_gpc)
	{
		$data=stripSlashes($data);
	}
	return $data;
}

//取得文件扩展名
function GetFiletype($filename){
	$filer=explode(".",$filename);
	$count=count($filer)-1;
	return strtolower(".".$filer[$count]);
}

//取得文件名
function GetFilename($filename){
	if(strstr($filename,"\\"))
	{
		$exp="\\";
	}
	else
	{
		$exp='/';
	}
	$filer=explode($exp,$filename);
	$count=count($filer)-1;
	return $filer[$count];
}

//保留扩展名验证
function CheckSaveTranFiletype($filetype){
	$savetranfiletype=',.php,.php3,.php4,.php5,.php6,.asp,.aspx,.jsp,.cgi,';
	if(stristr($savetranfiletype,','.$filetype.','))
	{
		return true;
	}
	return false;
}

//建立目录函数
function DoMkdir($path){
	if(!file_exists($path))//不存在则建立
	{
		$mk=@mkdir($path,0777);
		@chmod($path,0777);
		if(empty($mk))
		{
			printerror("建立目录不成功，请检查目录权限","history.go(-1)");
		}
	}
	return true;
}

//设置上传文件权限
function DoChmodFile($file){
	global $public_r;
	if($public_r['filechmod']!=1)
	{
		@chmod($file,0777);
	}
}

//上传文件
function GoTranFile($file,$file_name,$file_size,$file_type,$isimg=0,$qh=0,$doetran=0){
	global $empire,$dbtbpre,$public_r,$tranpicturetype;
	if(!$file_name)
	{
		printerror("请选择要上传的文件","history.go(-1)",$qh);
	}
	//文件扩展名
	$filetype=GetFiletype($file_name);
	if(CheckSaveTranFiletype($filetype))
	{
		printerror('文件扩展名有误','history.go(-1)',$qh);
	}
	if($qh==0)//后台
	{
		if($isimg==0)//附件
		{
			$checkfiletype=$public_r['trantype'];
			$checkfilesize=$public_r['transize'];
		}
		else//图片
		{
			$checkfiletype=$public_r['imgtrantype'];
			$checkfilesize=$public_r['imgtransize'];
		}
	}
	else//前台
	{
		if($isimg==0)//附件
		{
			$checkfiletype=$public_r['qtrantype'];
			$checkfilesize=$public_r['qtransize'];
		}
		else//图片
		{
			$checkfiletype=$public_r['qimgtrantype'];
			$checkfilesize=$public_r['qimgtransize'];
		}
	}
	if($file_size>$checkfilesize*1024)
	{
		printerror('文件过大','history.go(-1)',$qh);
	}
	if(!stristr($checkfiletype,','.$filetype.','))
	{
		printerror('文件扩展名有误','history.go(-1)',$qh);
	}
	//图片
	if($isimg)
	{
		if(!stristr($tranpicturetype,','.$filetype.','))
		{
			printerror('文件扩展名有误','history.go(-1)',$qh);
		}
		$savepath="data/soft_img";
		$fr['filepath']='';
	}
	else
	{
		if(empty($public_r['save_soft']))//按日期存放
		{
			$fr['filepath']=date("Y-m-d");
			$savepath='data/'.$public_r[downpath].'/'.$fr['filepath'];
			DoMkdir('../'.$savepath);
		}
		else
		{
			$fr['filepath']='';
			$savepath='data/'.$public_r[downpath];
		}
	}
	//文件信息
	$fr['tran']=1;
	$fr['filetype']=$filetype;
	$fr['insertfile']=time();
	$fr['filename']=$fr['insertfile'].$filetype;
	$fr['fileurl']=$public_r['sitedown'].$savepath.'/'.$fr['filename'];
	$path='../'.$savepath.'/'.$fr['filename'];
	$fr['savepath']='../'.$savepath;
	$fr['yname']=$path;
	$fr['filesize']=(int)$file_size;
	//开始上传
	$cp=@move_uploaded_file($file,$path);
	if(!$cp)
	{
		if($doetran)
		{
			$fr['tran']=0;
			return $fr;
		}
		else
		{
			printerror('上传不成功','history.go(-1)',$qh);
		}
	}
	DoChmodFile($path);
	return $fr;
}

//返回域名
function eReturnDomain(){
	$domain=$_SERVER['HTTP_HOST'];
	if(empty($domain))
	{
		return '';
	}
	if($_SERVER['SERVER_PORT']&&$_SERVER['SERVER_PORT']!='80')
	{
		$domain.=':'.$_SERVER['SERVER_PORT'];
	}
	return 'http://'.$domain;
}

//返回加密后的IP
function ToReturnXhIp($ip){
	$newip='';
	$ipr=explode(".",$ip);
	$ipnum=count($ipr);
	for($i=0;$i<$ipnum;$i++)
	{
		if($i!=0)
		{$d=".";}
		if($i==$ipnum-1)
		{
			$ipr[$i]="*";
		}
		$newip.=$d.$ipr[$i];
	}
	return $newip;
}

//取得IP
function egetip(){
	if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')) 
	{
		$ip=getenv('HTTP_CLIENT_IP');
	} 
	elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown'))
	{
		$ip=getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown'))
	{
		$ip=getenv('REMOTE_ADDR');
	}
	elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown'))
	{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return preg_replace("/^([\d\.]+).*/", "\\1",RepPostVar($ip));
}

//返回地址
function DoingReturnUrl($url,$from=''){
	if(empty($from))
	{
		return $url;
	}
	elseif($from==9)
	{
		$from=$_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:$url;
	}
	return $from;
}

//验证包含字符
function toCheckCloseWord($word,$closestr,$mess){
	if($closestr&&$closestr!='|')
	{
		$checkr=explode('|',$closestr);
		$ckcount=count($checkr);
		for($i=0;$i<$ckcount;$i++)
		{
			if($checkr[$i]&&stristr($word,$checkr[$i]))
			{
				printerror($mess,"history.go(-1)",1);
			}
		}
	}
}

//时间转换
function ToChangeUseTime($time){
	$usetime=time()-$time;
	if($usetime<60)
	{
		$tstr=$usetime.' 秒';
	}
	else
	{
		$usetime=round($usetime/60);
		$tstr=$usetime.' 分钟';
	}
	return $tstr;
}

//ebbcode代码
function GetEBBcode($text){
	global $public_r;
	$text=RepFieldtextNbsp($text);
	$text=str_replace("javascript:","<font>javascript:</font>",$text);
	$text=str_replace("vbscript:","<font>vbscript:</font>",$text);
	//引用
	$preg_str="/\[quote\](.+?)\[\/quote\]/is";
	$text=preg_replace($preg_str,"<table border=0 width=100% cellspacing=1 cellpadding=10 bgcolor='#cccccc'><tr><td width='100%' bgcolor='#FFFFFF' style='word-break:break-all'>\\1</td></tr></table>",$text);
	//连接地址
	$preg_str="/\[url\](.+?)\[\/url\]/is";
	$text=preg_replace($preg_str,"<a href='\\1' target=_blank>\\1</a>",$text);
	//email地址
	$preg_str="/\[email\](.+?)\[\/email\]/is";
	$text=preg_replace($preg_str,"<a href='mailto:\\1'>\\1</a>",$text);
	//文字粗体
	$preg_str="/\[b\](.+?)\[\/b\]/is";
	$text=preg_replace($preg_str,"<b>\\1</b>",$text);
	//下划线
	$preg_str="/\[u\](.+?)\[\/u\]/is";
	$text=preg_replace($preg_str,"<u>\\1</u>",$text);
	//斜体
	$preg_str="/\[i\](.+?)\[\/i\]/is";
	$text=preg_replace($preg_str,"<i>\\1</i>",$text);
	//图片
	$preg_str="/\[img\](.+?)\[\/img\]/is";
	$text=preg_replace($preg_str,"<img src='\\1' border=0>",$text);
	return $text;
}

//替换空格
function RepFieldtextNbsp($text){
	return str_replace(array("\t",'   ','  '),array('&nbsp; &nbsp; &nbsp; &nbsp; ','&nbsp; &nbsp;','&nbsp;&nbsp;'),$text);
}
?>