<?php
error_reporting(E_ALL ^ E_NOTICE);

define('InEmpireDown',TRUE);
define('EDOWN_PATH',substr(dirname(__FILE__),0,-5));
$editor=0;

require_once EDOWN_PATH.'data/config.php';

//ҳ�����
if($phome_headercharset==1)
{
	if($phome_edown_charver=='gb2312'||$phome_edown_charver=='big5'||$phome_edown_charver=='utf-8')
	{
		@header('Content-Type: text/html; charset='.$phome_edown_charver);
	}
}

//ʱ��
if(function_exists('date_default_timezone_set'))
{
	@date_default_timezone_set("PRC");
}

function db_connect(){
	global $phome_db_server,$phome_db_username,$phome_db_password,$phome_db_dbname,$phome_db_port,$phome_db_char,$phome_db_ver;
	$dblocalhost=$phome_db_server;
	//�˿�
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
	//����
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

//���ñ���
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

//����COOKIE
function esetcookie($var,$val,$life=0){
	global $phome_cookiedomain,$phome_cookiepath,$phome_cookievarpre;
	return setcookie($phome_cookievarpre.$var,$val,$life,$phome_cookiepath,$phome_cookiedomain);
}

//����cookie
function getcvar($var){
	global $phome_cookievarpre;
	$tvar=$phome_cookievarpre.$var;
	return $_COOKIE[$tvar];
}

//������ʾ
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
	if($phome==9)//�����Ի���
	{
		echo"<script>alert('".$error."');".$gotourl_js."</script>";
	}
	elseif($phome==0)//��̨
	{
		@include(EDOWN_PATH."message/message.php");
	}
	else//ǰ̨
	{
		@include(EDOWN_PATH."message/index.php");
	}
	@db_close();
	$empire=null;
	exit();
}

//---------------------------�ַ���ȡ����
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

//��ȡ����
function esub($string,$length,$dot=''){
	if(empty($length))
	{
		return $string;
	}
	return sub($string,0,$length,false,$dot);
}

//ȡ�������
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

//ȡ�������(����)
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

//EMAIL��ַ���
function chemail($email){
	if(empty($email)||!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$email))
	{
		printerror("Email��ַ����","history.go(-1)",1);
		return false;
	}
	else
	{
		return true;
	}
}

//ȡ���ļ�����
function ReadFiletext($filepath){
	$filepath=trim($filepath);
	$htmlfp=@fopen($filepath,"r");
	if(strstr($filepath,"://"))//Զ��
	{
		while($data=@fread($htmlfp,500000))
	    {
			$string.=$data;
		}
	}
	else//����
	{
		$string=@fread($htmlfp,@filesize($filepath));
	}
	@fclose($htmlfp);
	return $string;
}

//д�ļ�
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

//д�ļ�
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

//ɾ���ļ�
function DelFiletext($filename){
	@unlink($filename);
}

//�����ļ���
function ReturnPathFile($filename){
	$fr=explode("/",$filename);
	$count=count($fr)-1;
	return $fr[$count];
}

//��ҳ
function page1($num,$line,$page_line,$start,$page,$search){
	$pagetotal=$line*$page_line;//��Ҫ��ʾ��������
	$total=ceil(($num-$start)/$line);//ȡ����ҳ��
	$total_start=ceil($num/$pagetotal);//ȡ����ƫ����
	$returnstr="��&nbsp;".$num."&nbsp;����¼&nbsp;&nbsp;";
	$php_self=$_SERVER['PHP_SELF'];
	if($start!=0)
	{
		$old_start=$start-$pagetotal;
		$returnstr.="&nbsp;&nbsp;<a href=".$PHP_SELF."?page=0&start=".$old_start.$search." title='UP".$page_line."Pages'><strong>&lsaquo;&lsaquo;</strong></a>";
	}
	$pagestart=$start/$pagetotal*$page_line;//ȡ�õ�ǰҳ��
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

//������Ŀ����
function ReturnClass($sonclass){
	if($sonclass==""||$sonclass=="|"){
		return "classid=0";
	}
	$where="classid in (".RepSonclassSql($sonclass).")";
	return $where;
}

//�滻����Ŀ��
function RepSonclassSql($sonclass){
	if($sonclass==""||$sonclass=="|"){
		return 0;
	}
	$sonclass=substr($sonclass,1,strlen($sonclass)-2);
	$sonclass=str_replace("|",",",$sonclass);
	return $sonclass;
}

//���ض���Ŀ
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

//���ض�ר��
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

//��֤�Ƿ������Ŀ
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

//�������Ժ�
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
	//����
	if(strstr($r[1],"b"))
	{$title="<strong>".$title."</strong>";}
	//б��
	if(strstr($r[1],"i"))
	{$title="<i>".$title."</i>";}
	//ɾ����
	if(strstr($r[1],"s"))
	{$title="<s>".$title."</s>";}
	return $title;
}

//�ļ���С��ʽת��
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

//ʱ��ת������
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

//ʱ��ת����
function date_time($time,$format="Y-m-d H:i:s"){
	$threadtime=date($format,$time);
	return $threadtime;
}

//��ʽ������
function format_datetime($newstime,$format){
	if($newstime=="0000-00-00 00:00:00")
	{return $newstime;}
	$time=to_time($newstime);
	$newdate=date_time($time,$format);
	return $newdate;
}

//ʱ��ת������
function to_date($date){
	$date.=" 00:00:00";
	$r=explode(" ",$date);
	$t=explode("-",$r[0]);
	$k=explode(":",$r[1]);
	$dbtime=@mktime($k[0],$k[1],$k[2],$t[1],$t[2],$t[0]);
	return $dbtime;
}

//ѡ��ʱ��
function ToChangeTime($time,$day){
	$truetime=$time-$day*24*3600;
	$date=date_time($truetime,"Y-m-d");
	return $date;
}

//���ط����ַ
function EDReturnClassUrl($classid){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/".$classid."_1".$public_r['refiletype'];
}

//����������͵�ַ
function EDReturnTypeUrl($classid){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/type".$classid."_1".$public_r['refiletype'];
}

//����ר���ַ
function EDReturnZtUrl($classid){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/zt".$classid."_1".$public_r['refiletype'];
}

//������ĸ��ַ
function EDReturnZmUrl($zm){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/zm_".$zm."_1".$public_r['refiletype'];
}

//�����Զ����б��ַ
function EDReturnUserlistUrl($id){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/list".$id."_1".$public_r['refiletype'];
}

//���ط��ർ��ҳ��
function EDReturnClassNavUrl(){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/action".$public_r['refiletype'];
}

//���ع���ҳ��
function EDReturnGgUrl(){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/gg".$public_r['refiletype'];
}

//����������ҳ��
function EDReturnSearchFormUrl(){
	global $public_r;
	return $public_r['sitedown'].$public_r['relistpath']."/search".$public_r['refiletype'];
}

//������Ϣҳ��ַ
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

//���ط�������
function EdReturnClassname($classid){
	global $class_r;
	return $class_r[$classid][bname]?$class_r[$classid][bname]:$class_r[$classid][classname];
}

//�滻��ǰ׺
function RepSqlTbpre($sql){
	global $dbtbpre;
	$sql=str_replace("[!db.pre!]",$dbtbpre,$sql);
	return $sql;
}

//�������ؼ�¼
function BakDown($softid,$pathid,$userid,$username,$softname,$downfen,$type=0){
	global $empire,$dbtbpre;
	$downtime=date("y-m-d H:i:s");
	$truetime=time();
	$softname=addslashes($softname);
	$empire->query("insert into {$dbtbpre}downdown(softid,pathid,userid,username,downtime,softname,downfen,truetime,type) values('$softid','$pathid','$userid','$username','$downtime','$softname','$downfen','$truetime','$type');");
}
//����������Ƶ��¼
function BakVideoDown($path_id,$userid,$username,$path_address,$path_password,$downfen){
    global $empire,$dbtbpre;
    $downtime=date("y-m-d H:i:s");
    $truetime=time();
    $empire->query("insert into {$dbtbpre}downdownrecord(path_id,userid,username,path_address,path_password,downtime,downfen,truetime) values('$path_id','$userid','$username','$path_address','$path_password','$downtime','$downfen','$truetime');");
}
//���ݳ�ֵ��¼
function BakBuy($userid,$username,$buyname,$downfen,$money,$downdate,$type=0){
	global $empire,$dbtbpre;
	$buytime=date("y-m-d H:i:s");
	$buyname=addslashes($buyname);
	$empire->query("insert into {$dbtbpre}downbuy_bak(userid,username,card_no,downfen,money,buytime,downdate,type) values('$userid','$username','$buyname','$downfen','$money','$buytime','$downdate','$type');");
}

//���ؼ�ǰ׺�����ص�ַ
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

//���ش��������ľ��Ե�ַ
function ReturnDSofturl($downurl,$qz,$path='../',$isdown=0){
	$urlr=ReturnDownQzPath(stripSlashes($downurl),$qz);
	$url=$urlr['repath'];
	@include(EDOWN_PATH."action/enpath.php");//������
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

//���ظ���Ŀ¼
function ToReturnFileSavePath(){
	global $public_r;
	$path='data/'.$public_r[downpath];
	return $path;
}

//����������
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

//����������2
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

//����ԭ�ַ�
function ReturnDoYStr($val){
	return addslashes(stripSlashes($val));
}

//�����ύ�ַ�
function RepPostStr($val){
	$val=htmlspecialchars($val);
	$val=str_replace("'","&#039;",$val);
	return $val;
}

//ȥ��adds
function ClearAddsData($data){
	$magic_quotes_gpc=get_magic_quotes_gpc();
	if($magic_quotes_gpc)
	{
		$data=stripSlashes($data);
	}
	return $data;
}

//ȡ���ļ���չ��
function GetFiletype($filename){
	$filer=explode(".",$filename);
	$count=count($filer)-1;
	return strtolower(".".$filer[$count]);
}

//ȡ���ļ���
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

//������չ����֤
function CheckSaveTranFiletype($filetype){
	$savetranfiletype=',.php,.php3,.php4,.php5,.php6,.asp,.aspx,.jsp,.cgi,';
	if(stristr($savetranfiletype,','.$filetype.','))
	{
		return true;
	}
	return false;
}

//����Ŀ¼����
function DoMkdir($path){
	if(!file_exists($path))//����������
	{
		$mk=@mkdir($path,0777);
		@chmod($path,0777);
		if(empty($mk))
		{
			printerror("����Ŀ¼���ɹ�������Ŀ¼Ȩ��","history.go(-1)");
		}
	}
	return true;
}

//�����ϴ��ļ�Ȩ��
function DoChmodFile($file){
	global $public_r;
	if($public_r['filechmod']!=1)
	{
		@chmod($file,0777);
	}
}

//�ϴ��ļ�
function GoTranFile($file,$file_name,$file_size,$file_type,$isimg=0,$qh=0,$doetran=0){
	global $empire,$dbtbpre,$public_r,$tranpicturetype;
	if(!$file_name)
	{
		printerror("��ѡ��Ҫ�ϴ����ļ�","history.go(-1)",$qh);
	}
	//�ļ���չ��
	$filetype=GetFiletype($file_name);
	if(CheckSaveTranFiletype($filetype))
	{
		printerror('�ļ���չ������','history.go(-1)',$qh);
	}
	if($qh==0)//��̨
	{
		if($isimg==0)//����
		{
			$checkfiletype=$public_r['trantype'];
			$checkfilesize=$public_r['transize'];
		}
		else//ͼƬ
		{
			$checkfiletype=$public_r['imgtrantype'];
			$checkfilesize=$public_r['imgtransize'];
		}
	}
	else//ǰ̨
	{
		if($isimg==0)//����
		{
			$checkfiletype=$public_r['qtrantype'];
			$checkfilesize=$public_r['qtransize'];
		}
		else//ͼƬ
		{
			$checkfiletype=$public_r['qimgtrantype'];
			$checkfilesize=$public_r['qimgtransize'];
		}
	}
	if($file_size>$checkfilesize*1024)
	{
		printerror('�ļ�����','history.go(-1)',$qh);
	}
	if(!stristr($checkfiletype,','.$filetype.','))
	{
		printerror('�ļ���չ������','history.go(-1)',$qh);
	}
	//ͼƬ
	if($isimg)
	{
		if(!stristr($tranpicturetype,','.$filetype.','))
		{
			printerror('�ļ���չ������','history.go(-1)',$qh);
		}
		$savepath="data/soft_img";
		$fr['filepath']='';
	}
	else
	{
		if(empty($public_r['save_soft']))//�����ڴ��
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
	//�ļ���Ϣ
	$fr['tran']=1;
	$fr['filetype']=$filetype;
	$fr['insertfile']=time();
	$fr['filename']=$fr['insertfile'].$filetype;
	$fr['fileurl']=$public_r['sitedown'].$savepath.'/'.$fr['filename'];
	$path='../'.$savepath.'/'.$fr['filename'];
	$fr['savepath']='../'.$savepath;
	$fr['yname']=$path;
	$fr['filesize']=(int)$file_size;
	//��ʼ�ϴ�
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
			printerror('�ϴ����ɹ�','history.go(-1)',$qh);
		}
	}
	DoChmodFile($path);
	return $fr;
}

//��������
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

//���ؼ��ܺ��IP
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

//ȡ��IP
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

//���ص�ַ
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

//��֤�����ַ�
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

//ʱ��ת��
function ToChangeUseTime($time){
	$usetime=time()-$time;
	if($usetime<60)
	{
		$tstr=$usetime.' ��';
	}
	else
	{
		$usetime=round($usetime/60);
		$tstr=$usetime.' ����';
	}
	return $tstr;
}

//ebbcode����
function GetEBBcode($text){
	global $public_r;
	$text=RepFieldtextNbsp($text);
	$text=str_replace("javascript:","<font>javascript:</font>",$text);
	$text=str_replace("vbscript:","<font>vbscript:</font>",$text);
	//����
	$preg_str="/\[quote\](.+?)\[\/quote\]/is";
	$text=preg_replace($preg_str,"<table border=0 width=100% cellspacing=1 cellpadding=10 bgcolor='#cccccc'><tr><td width='100%' bgcolor='#FFFFFF' style='word-break:break-all'>\\1</td></tr></table>",$text);
	//���ӵ�ַ
	$preg_str="/\[url\](.+?)\[\/url\]/is";
	$text=preg_replace($preg_str,"<a href='\\1' target=_blank>\\1</a>",$text);
	//email��ַ
	$preg_str="/\[email\](.+?)\[\/email\]/is";
	$text=preg_replace($preg_str,"<a href='mailto:\\1'>\\1</a>",$text);
	//���ִ���
	$preg_str="/\[b\](.+?)\[\/b\]/is";
	$text=preg_replace($preg_str,"<b>\\1</b>",$text);
	//�»���
	$preg_str="/\[u\](.+?)\[\/u\]/is";
	$text=preg_replace($preg_str,"<u>\\1</u>",$text);
	//б��
	$preg_str="/\[i\](.+?)\[\/i\]/is";
	$text=preg_replace($preg_str,"<i>\\1</i>",$text);
	//ͼƬ
	$preg_str="/\[img\](.+?)\[\/img\]/is";
	$text=preg_replace($preg_str,"<img src='\\1' border=0>",$text);
	return $text;
}

//�滻�ո�
function RepFieldtextNbsp($text){
	return str_replace(array("\t",'   ','  '),array('&nbsp; &nbsp; &nbsp; &nbsp; ','&nbsp; &nbsp;','&nbsp;&nbsp;'),$text);
}
?>