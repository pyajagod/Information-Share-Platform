<?php
//ȡ�������
function InstallMakePassword($pw_length){
	$low_ascii_bound=65;
	$upper_ascii_bound=90;
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
//�����Ƿ����
function HaveFun($fun){
	if(function_exists($fun))
	{
		$word="֧��";
	}
	else
	{
		$word="��֧��";
	}
	return $word;
}
//���ط���
function ReturnResult($st){
	if($st==1)
	{
		$w="��";
	}
	elseif($st==2)
	{
		$w="---";
	}
	else
	{
		$w="<font color=red>��</font>";
	}
	return $w;
}
//ȡ��php�汾
function GetPhpVer(){
	$r['ver']=PHP_VERSION;
	if($r['ver'])
	{
		$r['result']=($r['ver']<"4.2.3")?ReturnResult(0):ReturnResult(1);
	}
	else
	{
		$r['ver']="---";
		$r['result']=ReturnResult(2);
	}
	return $r;
}
//ȡ��php����ģʽ
function GetPhpMod(){
	$mod=strtoupper(php_sapi_name());
	if(empty($mod))
	{
		$mod="---";
	}
	return $mod;
}
//�Ƿ������ڰ�ȫģʽ
function GetPhpSafemod(){
	$phpsafemod=get_cfg_var("safe_mode");
	if($phpsafemod==1)
	{
		$r['word']="��";
		$r['result']=ReturnResult(0);
	}
	else
	{
		$r['word']="��";
		$r['result']=ReturnResult(1);
	}
	return $r;
}
//�Ƿ�֧��mysql
function CanMysql(){
	$r['can']=HaveFun("mysql_connect");
	$r['result']=$r[can]=="֧��"?ReturnResult(1):ReturnResult(0);
	return $r;
}
//ȡ��mysql�汾
function GetMysqlVer(){
	$r['ver']=@mysql_get_server_info();
	if(empty($r['ver']))
	{
		$r['ver']="---";
		$r['result']=ReturnResult(2);
	}
	else
	{
		$r['result']=ReturnResult(1);
	}
	return $r;
}
//ȡ��mysql�汾(���ݿ�)
function GetMysqlVerForDb(){
	$sql=mysql_query("select version() as version");
	$r=mysql_fetch_array($sql);
	return ReturnMysqlVer($r['version']);
}
//����mysql�汾
function ReturnMysqlVer($dbver){
	if(empty($dbver))
	{
		return '';
	}
	if($dbver>='6.0')
	{
		$dbver='6.0';
	}
	elseif($dbver>='5.0')
	{
		$dbver='5.0';
	}
	elseif($dbver>='4.1')
	{
		$dbver='4.1';
	}
	else
	{
		$dbver='4.0';
	}
	return $dbver;
}
//ȡ�ò���ϵͳ
function GetUseSys(){
	$phpos=explode(" ",php_uname());
	$sys=$phpos[0]."&nbsp;".$phpos[1];
	if(empty($phpos[0]))
	{
	$sys="---";
	}
	return $sys;
}
//�Ƿ�֧��zend
function GetZend(){
	@ob_start();
	@include("data/zend.php");
	$string=@ob_get_contents();
	@ob_end_clean();
	if($string=="www.phome.net"||strstr($string,"bytes in"))
	{
		$r['word']="֧��";
		$r['result']=ReturnResult(1);
	}
	else
	{
		$r['word']="��֧��";
		$r['result']=ReturnResult(0);
	}
	return $r;
}
//����ϴ�
function CheckTranMode(){
	@ob_start();
	@include("../class/connect.php");
	@include("../class/functions.php");
	$string=@ob_get_contents();
	@ob_end_clean();
	if(strstr($string,"bytes in"))
	{
		echo"��û�ж������ϴ��ļ��������¶������ϴ��ļ���Ȼ���ٰ�װ��";
		exit();
	}
}
//�Ƿ�֧�ֲɼ�
function GetCj(){
	$cj=get_cfg_var("allow_url_fopen");
	if($cj==1)
	{
		$r['word']="֧��";
		$r['result']=ReturnResult(1);
	}
	else
	{
		$r['word']="��֧��";
		$r['result']=ReturnResult(0);
	}
	return $r;
}
//���Բɼ�
function TestCj(){
	$r=@file("http://www.163.com");
	if($r[5])
	{
		echo"<br>���Խ����<b>֧�ֲɼ�</b>";
	}
	else
	{
		echo"<br>���Խ����<b>��֧�ֲɼ�</b>";
	}
	exit();
}
//�Ƿ�֧��gd��
function GetGd(){
	$r['can']=HaveFun("gd_info");
	$r['result']=$r[can]=="֧��"?ReturnResult(1):ReturnResult(0);
	return $r;
}
//�Ƿ�֧��ICONV��
function GetIconv(){
	$r['can']=HaveFun("iconv");
	$r['result']=$r[can]=="֧��"?ReturnResult(1):ReturnResult(0);
	return $r;
}

//��ʾ��Ϣ
function InstallShowMsg($msg,$url=''){
	if(empty($url))
	{
		echo"<script>alert('".$msg."');history.go(-1);</script>";
	}
	else
	{
		echo"<script>alert('".$msg."');self.location.href='$url';</script>";
	}
	exit();
}
//����Ŀ¼Ȩ�޽��
function ReturnPathLevelResult($path){
	$testfile=$path."/test.test";
	$fp=@fopen($testfile,"wb");
	if($fp)
	{
		@fclose($fp);
		@unlink($testfile);
		return 1;
	}
	else
	{
		return 0;
	}
}
//�����ļ�Ȩ�޽��
function ReturnFileLevelResult($filename){
	return is_writable($filename);
}
//���Ŀ¼Ȩ��
function CheckFileMod($filename,$smallfile=""){
	$succ="��";
	$error="<font color=red>��</font>";
	if(!file_exists($filename)||($smallfile&&!file_exists($smallfile)))
	{
		return $error;
	}
	if(is_dir($filename))//Ŀ¼
	{
		if(!ReturnPathLevelResult($filename))
		{
			return $error;
		}
		//��Ŀ¼
		if($smallfile)
		{
			if(is_dir($smallfile))
			{
				if(!ReturnPathLevelResult($smallfile))
				{
					return $error;
				}
			}
			else//�ļ�
			{
				if(!ReturnFileLevelResult($smallfile))
				{
					return $error;
				}
			}
		}
	}
	else//�ļ�
	{
		if(!ReturnFileLevelResult($filename))
		{
			return $error;
		}
		if($smallfile)
		{
			if(!ReturnFileLevelResult($smallfile))
			{
				return $error;
			}
		}
	}
	return $succ;
}
//����
function DoCreateTable($sql,$mysqlver,$dbcharset){
	$type=strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU","\\2",$sql));
	$type=in_array($type,array('MYISAM','HEAP'))?$type:'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU","\\1",$sql).
		($mysqlver>='4.1'?" ENGINE=$type DEFAULT CHARSET=$dbcharset":" TYPE=$type");
}
//����SQL
function DoRunQuery($sql,$mydbchar,$mydbtbpre,$mydbver){
	$sql=str_replace("\r","\n",str_replace(' `e_',' `'.$mydbtbpre,$sql));
	$ret=array();
	$num=0;
	foreach(explode(";\n",trim($sql)) as $query)
	{
		$queries=explode("\n",trim($query));
		foreach($queries as $query)
		{
			$ret[$num].=$query[0]=='#'||$query[0].$query[1]=='--'?'':$query;
		}
		$num++;
	}
	unset($sql);
	foreach($ret as $query)
	{
		$query=trim($query);
		if($query)
		{
			if(substr($query,0,12)=='CREATE TABLE')
			{
				$name=preg_replace("/CREATE TABLE `([a-z0-9_]+)` .*/is","\\1",$query);
				echo"�������ݱ�: <b>".$name."</b> ���......<br>";
				mysql_query(DoCreateTable($query,$mydbver,$mydbchar)) or die(mysql_error()."<br>".$query);
			}
			else
			{
				mysql_query($query) or die(mysql_error()."<br>".$query);
			}
		}
	}
}
//ȡ�������
function ins_make_password($pw_length){
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
//��ʹ������Ա
function FirstAdmin($add){
	if(!trim($add['username'])||!trim($add['password']))
	{
		InstallShowMsg('���������Ա�û���������');
	}
	if($add['password']!=$add['repassword'])
	{
		InstallShowMsg('������������벻һ�£�����������');
	}
	//�������ݿ�
	@include("../data/config.php");
	$dbver=InstallConnectDb($phome_use_dbver,$phome_db_server,$phome_db_port,$phome_db_username,$phome_db_password,$phome_db_dbname,$phome_db_char,$phome_db_dbchar);
	$salt=ins_make_password(8);
	$password=md5(md5($add['password']).$salt);
	$rnd=ins_make_password(20);
	$sql=mysql_query("INSERT INTO `".$dbtbpre."downuser`(userid,username,password,rnd,adminclass,groupid,salt,loginnum,lasttime,lastip) VALUES (1,'$add[username]','$password','$rnd','',1,'$salt',0,0,'');");
	mysql_close();
	if($sql)
	{
		echo"��ʼ������Ա�˺����!<script>self.location.href='changedata.php?defaultdata=$add[defaultdata]';</script>";
		exit();
	}
	else
	{
		InstallShowMsg('��ʹ������Ա���ɹ���������������°�װһ��.');
	}
}
//�����������
function InstallDefaultData($add){
	//�������ݿ�
	@include("../data/config.php");
	$dbver=InstallConnectDb($phome_db_ver,$phome_db_server,$phome_db_port,$phome_db_username,$phome_db_password,$phome_db_dbname,$phome_db_char,$phome_db_char);
	//ִ��SQL���
	DoRunQuery(ReturnInstallSql(1),$phome_db_char,$dbtbpre,$phome_db_ver);
	mysql_close();
	echo"��������������!<script>self.location.href='index.php?phome=firstadmin&f=5&defaultdata=$add[defaultdata]';</script>";
	exit();
}
//�������ݿ�
function InstallConnectDb($phome_use_dbver,$phome_db_server,$phome_db_port,$phome_db_username,$phome_db_password,$phome_db_dbname,$phome_db_char,$phome_db_dbchar){
	$dblocalhost=$phome_db_server;
	//�˿�
	if($phome_db_port)
	{
		$dblocalhost.=":".$phome_db_port;
	}
	$link=@mysql_connect($dblocalhost,$phome_db_username,$phome_db_password);
	if(!$link)
	{
		InstallShowMsg('�������ݿ��û����������������Ӳ���MYSQL���ݿ�');
	}
	//mysql�汾
	if($phome_use_dbver=='auto')
	{
		$phome_use_dbver=GetMysqlVerForDb();
		if(!$phome_use_dbver)
		{
			InstallShowMsg('ϵͳ�޷��Զ�ʶ��MYSQL�汾�����ֶ�ѡ��MYSQL�汾');
		}
	}
	//����
	if($phome_use_dbver>='4.1')
	{
		if($phome_db_char)
		{
			@mysql_query("SET names '".$phome_db_char."';");
		}
		if($phome_use_dbver>='5.0')
		{
			@mysql_query("SET sql_mode=''");
		}
	}
	$db=@mysql_select_db($phome_db_dbname);
	//���ݿⲻ����
	if(!$db)
	{
		if($phome_use_dbver>='4.1')
		{
			$createdb=@mysql_query("CREATE DATABASE IF NOT EXISTS ".$phome_db_dbname." DEFAULT CHARACTER SET ".$phome_db_char);
		}
		else
		{
			$createdb=@mysql_query("CREATE DATABASE IF NOT EXISTS ".$phome_db_dbname);
		}
		if(!$createdb)
		{
			InstallShowMsg('����������ݿ���������');
		}
		@mysql_select_db($phome_db_dbname);
	}
	return $phome_use_dbver;
}
//�������ݿ�
function SetDb($add){
	global $version;
	if(!$add['mydbver']||!$add['mydbhost']||!$add['mydbname']||!$add['mydbtbpre']||!$add['mycookievarpre'])
	{
		InstallShowMsg('��*���Ϊ��');
	}
	//�������ݿ�
	$dbver=InstallConnectDb($add['mydbver'],$add['mydbhost'],$add['mydbport'],$add['mydbusername'],$add['mydbpassword'],$add['mydbname'],$add['mysetchar'],$add['mydbchar']);
	if($add['mydbver']=='auto')
	{
		$add['mydbver']=$dbver;
	}
	//��ʹ����վ��Ϣ
	$siteurl=ReturnEdownSiteUrl();
	//�����ļ�
	RepEdownConfig($add,$siteurl);
	//ִ��SQL���
	DoRunQuery(ReturnInstallSql(0),$add['mydbchar'],$add['mydbtbpre'],$add['mydbver']);
	@mysql_query("update ".$add['mydbtbpre']."downpublic set sitedown='$siteurl' limit 1");
	@mysql_close();
	if(empty($add['defaultdata']))
	{
		echo"�������ݿ����!<script>self.location.href='index.php?phome=firstadmin&f=5&defaultdata=$add[defaultdata]';</script>";
	}
	else
	{
		echo"������������ݵ���......<script>self.location.href='index.php?phome=defaultdata&f=4&ok=1&defaultdata=$add[defaultdata]';</script>";
	}
	exit();
}
//���������ļ�
function RepEdownConfig($add,$siteurl){
	global $headerchar;
	//��ʹ�������ļ�
	$fp=@fopen("data/config.php","r");
	if(!$fp)
	{
		InstallShowMsg('���� /install/data/config.php �ļ��Ƿ����!');
	}
	$data=@fread($fp,filesize("data/config.php"));
	fclose($fp);
	$data=str_replace('<!--dbver.phome.net-->',$add['mydbver'],$data);
	$data=str_replace('<!--host.phome.net-->',$add['mydbhost'],$data);
	$data=str_replace('<!--port.phome.net-->',$add['mydbport'],$data);
	$data=str_replace('<!--username.phome.net-->',$add['mydbusername'],$data);
	$data=str_replace('<!--password.phome.net-->',$add['mydbpassword'],$data);
	$data=str_replace('<!--name.phome.net-->',$add['mydbname'],$data);
	$data=str_replace('<!--dbchar.phome.net-->',$add['mydbchar'],$data);
	$data=str_replace('<!--tbpre.phome.net-->',$add['mydbtbpre'],$data);
	$data=str_replace('<!--cookiepre.phome.net-->',$add['mycookievarpre'],$data);
	$data=str_replace('<!--headerchar.phome.net-->',$headerchar,$data);
	$data=str_replace('<!--cookiernd.phome.net-->',ins_make_password(30),$data);
	//д�������ļ�
	$fp1=@fopen("../data/config.php","w");
	if(!$fp1)
	{
		InstallShowMsg(' /data/config.php �ļ�Ȩ��û����Ϊ0777���������ݿⲻ�ɹ�');
	}
	@fputs($fp1,$data);
	@fclose($fp1);
}
//����SQL���
function ReturnInstallSql($defaultdata=1){
	if($defaultdata==0)
	{
		$sqlfile="data/empiredown.com.sql";
	}
	else
	{
		$sqlfile="data/empiredown.data.sql";
	}
	$fp=fopen($sqlfile,'r');
	$sql=fread($fp,filesize($sqlfile));
	fclose($fp);
	if(empty($sql))
	{
		InstallShowMsg(' /install/'.$sqlfile.' �ļ���ʧ,��װ���ɹ�','index.php?phome=setdb&f=4');
	}
	return $sql;
}
//ȡ����վ��ַ
function ReturnEdownSiteUrl(){
	return str_replace('install/index.php','',$_SERVER['PHP_SELF']);
}
?>