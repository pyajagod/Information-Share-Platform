<?php
$editor=1;
//�ַ�����
function escape_str($str){
	$str=mysql_escape_string($str);
	$str=str_replace('\\\'','\'\'',$str);
	$str=str_replace("\\\\","\\\\\\\\",$str);
	$str=str_replace('$','\$',$str);
	return $str;
}

//�޸���
function Ebak_Rep($tablename,$dbname,$userid,$username){
	global $empire,$phome_db_dbname;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	$empire->query("use `$dbname`");
	$count=count($tablename);
	if(empty($count))
	{printerror("������ѡ��һ����","history.go(-1)");}
	for($i=0;$i<$count;$i++)
	{
		//$sql1=$empire->query("OPTIMIZE TABLE `$tablename[$i]`;");
		//$sql2=$empire->query("CHECK TABLE `$tablename[$i]`;");
		//$sql3=$empire->query("ANALYZE TABLE `$tablename[$i]`;");
		$sql4=$empire->query("REPAIR TABLE `$tablename[$i]`;");
    }
	printerror("�޸���ɹ�","ChangeTable.php?mydbname=$dbname");
}

//�ǻ���
function Ebak_Opi($tablename,$dbname,$userid,$username){
	global $empire,$phome_db_dbname;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	$empire->query("use `$dbname`");
	$count=count($tablename);
	if(empty($count))
	{printerror("������ѡ��һ����","history.go(-1)");}
	for($i=0;$i<$count;$i++)
	{
		$sql1=$empire->query("OPTIMIZE TABLE `$tablename[$i]`;");
    }
	printerror("�ǻ���ɹ�","ChangeTable.php?mydbname=$dbname");
}

//ɾ�����ݱ�
function Ebak_Drop($tablename,$dbname,$userid,$username){
	global $empire,$phome_db_dbname;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	$empire->query("use `$dbname`");
	$count=count($tablename);
	if(empty($count))
	{printerror("������ѡ��һ��Ҫɾ���ı�","history.go(-1)");}
	$a="";
	$first=1;
	for($i=0;$i<$count;$i++)
	{
		if(empty($first))
		{
			$a.=",";
	    }
		else
		{
			$first=0;
		}
		$a.="`".$tablename[$i]."`";
    }
	$sql1=$empire->query("DROP TABLE IF EXISTS ".$a.";");
	printerror("ɾ�����ݱ�ɹ�","ChangeTable.php?mydbname=$dbname");
}

//ɾ�����ݿ�
function Ebak_DropDb($dbname,$userid,$username){
	global $empire;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	if(empty($dbname))
	{printerror("��ѡ��Ҫɾ�������ݿ�","history.go(-1)");}
	$sql=$empire->query("DROP DATABASE `$dbname`");
	if($sql)
	{
		printerror("ɾ�����ݿ�ɹ�","ChangeDb.php");
	}
	else
	{printerror("���ݿ����","history.go(-1)");}
}

//�������ݿ�
function Ebak_CreatDb($dbname,$dbchar,$userid,$username){
	global $empire,$phome_db_ver;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	if(!trim($dbname)){
		printerror("������Ҫ���������ݿ���","history.go(-1)");
	}
	$a="";
	if($dbchar&&$phome_db_ver>='4.1'){
		$a=" DEFAULT CHARACTER SET ".$dbchar;
	}
	$sql=$empire->query("CREATE DATABASE IF NOT EXISTS `$dbname`".$a);
	if($sql)
	{
		printerror("�������ݿ�ɹ�","ChangeDb.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//��ձ�
function Ebak_EmptyTable($tablename,$dbname,$userid,$username){
	global $empire,$phome_db_dbname;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	$empire->query("use `$dbname`");
	$count=count($tablename);
	if(empty($count))
	{printerror("������ѡ��һ����","history.go(-1)");}
	for($i=0;$i<$count;$i++)
	{
		$sql1=$empire->query("TRUNCATE `".$tablename[$i]."`;");
    }
	printerror("��ձ�ɹ�","ChangeTable.php?mydbname=$dbname");
}

//---------------------------����
//��ʹ������
function Ebak_DoEbak($add,$userid,$username){
	global $empire,$public_r,$phome_db_ver;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($add['mydbname']);
	if(empty($dbname)){
		printerror("����ûѡ�����ݿ�","history.go(-1)");
	}
	$tablename=$add['tablename'];
	$count=count($tablename);
	if(empty($count)){
		printerror("������ѡ��һ����","history.go(-1)");
	}
	$add['baktype']=(int)$add['baktype'];
	$add['filesize']=(int)$add['filesize'];
	$add['bakline']=(int)$add['bakline'];
	$add['autoauf']=(int)$add['autoauf'];
	if((!$add['filesize']&&!$add['baktype'])||(!$add['bakline']&&$add['baktype'])){
		printerror("�ļ���С����Ϊ��","history.go(-1)");
	}
	//Ŀ¼��
	$bakpath=$public_r['bakdbpath'];
	if(empty($add['mypath'])){
		$add['mypath']=$dbname."_".date("YmdHis");
	}
    DoMkdir($bakpath."/".$add['mypath']);
	//����˵���ļ�
	$readme=$add['readme'];
	$rfile=$bakpath."/".$add['mypath']."/readme.txt";
	$readme.="\r\n\r\nBaktime: ".date("Y-m-d H:i:s");
	WriteFiletext_n($rfile,$readme);

	$b_table="";
	$d_table="";
	for($i=0;$i<$count;$i++){
		$b_table.=$tablename[$i].",";
		$d_table.="\$tb[".$tablename[$i]."]=0;\r\n";
    }
	//ȥ�����һ��,
	$b_table=substr($b_table,0,strlen($b_table)-1);
	$bakstru=(int)$add['bakstru'];
	$bakstrufour=(int)$add['bakstrufour'];
	$beover=(int)$add['beover'];
	$waitbaktime=(int)$add['waitbaktime'];
	if($add['insertf']=='insert'){
		$insertf='insert';
	}
	else{
		$insertf='replace';
	}
	if($phome_db_ver=='4.0'&&$add['dbchar']=='auto')
	{
		$add['dbchar']='';
	}
	$string="<?php
	\$b_table=\"".$b_table."\";
	".$d_table."
	\$b_baktype=".$add['baktype'].";
	\$b_filesize=".$add['filesize'].";
	\$b_bakline=".$add['bakline'].";
	\$b_autoauf=".$add['autoauf'].";
	\$b_dbname=\"".$dbname."\";
	\$b_stru=".$bakstru.";
	\$b_strufour=".$bakstrufour.";
	\$b_dbchar=\"".addslashes($add['dbchar'])."\";
	\$b_beover=".$beover.";
	\$b_insertf=\"".addslashes($insertf)."\";
	\$b_autofield=\",".addslashes($add['autofield']).",\";
	?>";
	$cfile=$bakpath."/".$add['mypath']."/config.php";
	WriteFiletext_n($cfile,$string);
	if($add['baktype']){
		$phome='BakExeT';
	}
	else{
		$phome='BakExe';
	}
	echo "��ʹ�����ݳɹ������ڽ�����ݣ�����������<script>self.location.href='phome.php?phome=$phome&t=0&s=0&p=0&mypath=$add[mypath]&waitbaktime=$waitbaktime';</script>";
	exit();
}

//ִ�б���(���ļ���С)
function Ebak_BakExe($t,$s,$p,$mypath,$alltotal,$thenof,$fnum,$stime=0,$userid,$username){
	global $empire,$public_r;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	if(empty($mypath)){
		printerror("�����Ե����Ӳ�����","history.go(-1)");
	}
	$bakpath=$public_r['bakdbpath'];
	$path=$bakpath."/".$mypath;
	@include($path."/config.php");
	if(empty($b_table)){
		printerror("�����Ե����Ӳ�����","history.go(-1)");
	}
	$waitbaktime=(int)$_GET['waitbaktime'];
	if(empty($stime))
	{
		$stime=time();
	}
	$header="<?php
@include(\"../../inc/header.php\");
";
	$footer="
@include(\"../../inc/footer.php\");
?>";
	$btb=explode(",",$b_table);
	$count=count($btb);
	$t=(int)$t;
	$s=(int)$s;
	$p=(int)$p;
	//�������
	if($t>=$count)
	{
		$varmessage="�������.<br><br>������ʱ: ".ToChangeUseTime($stime);
		printerror($varmessage,'ChangeDb.php',0,1);
    }
	$dumpsql=Ebak_ReturnVer();
	//ѡ�����ݿ�
	$u=$empire->query("use `$b_dbname`");
	//����
	if($b_dbchar=='auto')
	{
		if(empty($s))
		{
			$status_r=Ebak_GetTotal($b_dbname,$btb[$t]);
			$collation=Ebak_GetSetChar($status_r['Collation']);
			DoSetDbChar($collation);
			//�ܼ�¼��
			$num=$public_r[limittype]?-1:$status_r['Rows'];
		}
		else
		{
			$collation=$_GET['collation'];
			DoSetDbChar($collation);
			$num=(int)$alltotal;
		}
		$dumpsql.=Ebak_ReturnSetNames($collation);
	}
	else
	{
		DoSetDbChar($b_dbchar);
		if(empty($s))
		{
			//�ܼ�¼��
			if($public_r[limittype])
			{
				$num=-1;
			}
			else
			{
				$status_r=Ebak_GetTotal($b_dbname,$btb[$t]);
				$num=$status_r['Rows'];
			}
		}
		else
		{
			$num=(int)$alltotal;
		}
	}
	//�������ݿ�ṹ
	if($b_stru&&empty($s))
	{
		$dumpsql.=Ebak_Returnstru($btb[$t],$b_strufour);
	}
	$sql=$empire->query("select * from `".$btb[$t]."` limit $s,$num");
	//ȡ���ֶ���
	if(empty($fnum))
	{
		$return_fr=Ebak_ReturnTbfield($b_dbname,$btb[$t],$b_autofield);
		$fieldnum=$return_fr['num'];
		$noautof=$return_fr['autof'];
	}
	else
	{
		$fieldnum=$fnum;
		$noautof=$thenof;
	}
	//��������
	$inf='';
	if($b_beover==1)
	{
		$inf='('.Ebak_ReturnInTbfield($b_dbname,$btb[$t]).')';
	}
	$b=0;
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$s++;
		$dumpsql.="E_D(\"".$b_insertf." into `".$btb[$t]."`".$inf." values(";
		$first=1;
		for($i=0;$i<$fieldnum;$i++)
		{
			//���ֶ�
			if(empty($first))
			{
				$dumpsql.=",";
			}
			else
			{
				$first=0;
			}
			$myi=$i+1;
			if(!isset($r[$i])||strstr($noautof,",".$myi.","))
			{
				$dumpsql.="NULL";
			}
			else
			{
				$dumpsql.="'".escape_str($r[$i])."'";
			}
		}
		$dumpsql.=");\");\r\n";
		//�Ƿ񳬹�����
		if(strlen($dumpsql)>=$b_filesize*1024)
		{
			$p++;
			$sfile=$path."/".$btb[$t]."_".$p.".php";
			$dumpsql=$header.$dumpsql.$footer;
			WriteFiletext_n($sfile,$dumpsql);
			$empire->free($sql);
			//echo '����һ�����ݳɹ������ڽ�����һ�飮����������'.Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s)."<script>self.location.href='phome.php?phome=BakExe&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&stime=$stime';</script>";

			echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phome.php?phome=BakExe&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&stime=$stime&waitbaktime=$waitbaktime&collation=$collation\">����һ�����ݳɹ������ڽ�����һ�飮����������".Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s);
			exit();
		}
	}
	//���һ������
	if(empty($p)||$b==1)
	{
		$p++;
		$sfile=$path."/".$btb[$t]."_".$p.".php";
		$dumpsql=$header.$dumpsql.$footer;
		WriteFiletext_n($sfile,$dumpsql);
	}
	Ebak_RepFilenum($p,$btb[$t],$path);
	$t++;
	$empire->free($sql);
	//������һ����
	//echo $btb[$t-1]."���ݳɹ������ڽ�����һ�����ݣ�����������<script>self.location.href='phome.php?phome=BakExe&s=0&p=0&t=$t&mypath=$mypath&stime=$stime';</script>";

	echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phome.php?phome=BakExe&s=0&p=0&t=$t&mypath=$mypath&stime=$stime&waitbaktime=$waitbaktime\">".$btb[$t-1]."���ݳɹ������ڽ�����һ�����ݣ�����������";
	exit();
}

//ִ�б��ݣ�����¼��
function Ebak_BakExeT($t,$s,$p,$mypath,$alltotal,$thenof,$fnum,$auf='',$aufval=0,$stime=0,$userid,$username){
	global $empire,$public_r;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	if(empty($mypath)){
		printerror("�����Ե����Ӳ�����","history.go(-1)");
	}
	$bakpath=$public_r['bakdbpath'];
	$path=$bakpath."/".$mypath;
	@include($path."/config.php");
	if(empty($b_table)){
		printerror("�����Ե����Ӳ�����","history.go(-1)");
	}
	$waitbaktime=(int)$_GET['waitbaktime'];
	if(empty($stime))
	{
		$stime=time();
	}
	$header="<?php
@include(\"../../inc/header.php\");
";
	$footer="
@include(\"../../inc/footer.php\");
?>";
	$btb=explode(",",$b_table);
	$count=count($btb);
	$t=(int)$t;
	$s=(int)$s;
	$p=(int)$p;
	//�������
	if($t>=$count)
	{
		$varmessage="�������.<br><br>������ʱ: ".ToChangeUseTime($stime);
		printerror($varmessage,'ChangeDb.php',0,1);
    }
	$dumpsql=Ebak_ReturnVer();
	//ѡ�����ݿ�
	$u=$empire->query("use `$b_dbname`");
	//����
	if($b_dbchar=='auto')
	{
		if(empty($s))
		{
			$status_r=Ebak_GetTotal($b_dbname,$btb[$t]);
			$collation=Ebak_GetSetChar($status_r['Collation']);
			DoSetDbChar($collation);
			//�ܼ�¼��
			$num=$public_r[limittype]?-1:$status_r['Rows'];
		}
		else
		{
			$collation=$_GET['collation'];
			DoSetDbChar($collation);
			$num=(int)$alltotal;
		}
		$dumpsql.=Ebak_ReturnSetNames($collation);
	}
	else
	{
		DoSetDbChar($b_dbchar);
		if(empty($s))
		{
			//�ܼ�¼��
			if($public_r[limittype])
			{
				$num=-1;
			}
			else
			{
				$status_r=Ebak_GetTotal($b_dbname,$btb[$t]);
				$num=$status_r['Rows'];
			}
		}
		else
		{
			$num=(int)$alltotal;
		}
	}
	//�������ݿ�ṹ
	if($b_stru&&empty($s))
	{
		$dumpsql.=Ebak_Returnstru($btb[$t],$b_strufour);
	}
	//ȡ���ֶ���
	if(empty($fnum))
	{
		$return_fr=Ebak_ReturnTbfield($b_dbname,$btb[$t],$b_autofield);
		$fieldnum=$return_fr['num'];
		$noautof=$return_fr['autof'];
		$auf=$return_fr['auf'];
	}
	else
	{
		$fieldnum=$fnum;
		$noautof=$thenof;
	}
	//�Զ�ʶ��������
	$aufval=(int)$aufval;
	if($b_autoauf==1&&$auf)
	{
		$sql=$empire->query("select * from `".$btb[$t]."` where ".$auf.">".$aufval." order by ".$auf." limit $b_bakline");
	}
	else
	{
		$sql=$empire->query("select * from `".$btb[$t]."` limit $s,$b_bakline");
	}
	//��������
	$inf='';
	if($b_beover==1)
	{
		$inf='('.Ebak_ReturnInTbfield($b_dbname,$btb[$t]).')';
	}
	$b=0;
	while($r=$empire->fetch($sql))
	{
		if($auf)
		{
			$lastaufval=$r[$auf];
		}
		$b=1;
		$s++;
		$dumpsql.="E_D(\"".$b_insertf." into `".$btb[$t]."`".$inf." values(";
		$first=1;
		for($i=0;$i<$fieldnum;$i++)
		{
			//���ֶ�
			if(empty($first))
			{
				$dumpsql.=",";
			}
			else
			{
				$first=0;
			}
			$myi=$i+1;
			if(!isset($r[$i])||strstr($noautof,",".$myi.","))
			{
				$dumpsql.="NULL";
			}
			else
			{
				$dumpsql.="'".escape_str($r[$i])."'";
			}
		}
		$dumpsql.=");\");\r\n";
	}
	if(empty($b))
	{
		//���һ������
		if(empty($p))
		{
			$p++;
			$sfile=$path."/".$btb[$t]."_".$p.".php";
			$dumpsql=$header.$dumpsql.$footer;
			WriteFiletext_n($sfile,$dumpsql);
		}
		Ebak_RepFilenum($p,$btb[$t],$path);
		$t++;
		$empire->free($sql);
		//������һ����
		//echo $btb[$t-1]."���ݳɹ������ڽ�����һ�����ݣ�����������<script>self.location.href='phome.php?phome=BakExeT&s=0&p=0&t=$t&mypath=$mypath&stime=$stime';</script>";

		echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phome.php?phome=BakExeT&s=0&p=0&t=$t&mypath=$mypath&stime=$stime&waitbaktime=$waitbaktime\">".$btb[$t-1]."���ݳɹ������ڽ�����һ�����ݣ�����������";
		exit();
	}
	//������һ��
	$p++;
	$sfile=$path."/".$btb[$t]."_".$p.".php";
	$dumpsql=$header.$dumpsql.$footer;
	WriteFiletext_n($sfile,$dumpsql);
	$empire->free($sql);
	//echo "����һ�����ݳɹ������ڽ�����һ�飮����������".Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s)."<script>self.location.href='phome.php?phome=BakExeT&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&auf=$auf&aufval=$lastaufval&stime=$stime';</script>";

	echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phome.php?phome=BakExeT&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&auf=$auf&aufval=$lastaufval&stime=$stime&waitbaktime=$waitbaktime&collation=$collation\">����һ�����ݳɹ������ڽ�����һ�飮����������".Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s);
	exit();
}

//������ݽ�����
function Ebak_EchoBakSt($tbname,$tbnum,$tb,$rnum,$r){
	$table=($tb+1).'/'.$tbnum;
	$record=$r;
	if($rnum!=-1)
	{
		$record=$r.'/'.$rnum;
	}
	?>
	<br><br>
	<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1">
		<tr><td height="25">Table Name&nbsp;:&nbsp;<b><?=$tbname?></b></td></tr>
		<tr><td height="25">Table&nbsp;:&nbsp;<b><?=$table?></b></td></tr>
		<tr><td height="25">Record&nbsp;:&nbsp;<b><?=$record?></b></td></tr>
	</table><br><br>
	<?
}

//����ָ�������
function Ebak_EchoReDataSt($tbname,$tbnum,$tb,$pnum,$p){
	$table=($tb+1).'/'.$tbnum;
	$record=$p.'/'.$pnum;
	?>
	<br><br>
	<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1">
		<tr><td height="25">Table Name&nbsp;:&nbsp;<b><?=$tbname?></b></td></tr>
		<tr><td height="25">Table&nbsp;:&nbsp;<b><?=$table?></b></td></tr>
		<tr><td height="25">File&nbsp;:&nbsp;<b><?=$record?></b></td></tr>
	</table><br><br>
	<?
}

//ȡ�ñ��¼��
function Ebak_GetTotal($dbname,$tbname){
	global $empire;
	/*
	$tr=$empire->fetch1("select count(*) AS total from ".$btb[$t]);
	$num=$tr[total];
	*/
	$tr=$empire->fetch1("SHOW TABLE STATUS LIKE '".$tbname."';");
	return $tr;
}

//�����ַ���set
function Ebak_GetSetChar($char){
	global $empire;
	if(empty($char))
	{
		return '';
	}
	$r=$empire->fetch1("SHOW COLLATION LIKE '".$char."';");
	return $r['Charset'];
}

//���ر��ֶ���Ϣ
function Ebak_ReturnTbfield($dbname,$tbname,$autofield){
	global $empire;
	$sql=$empire->query("SHOW FIELDS FROM `".$tbname."`");
	$i=0;//�ֶ���
	$autof=",";//ȥ�������ֶ��б�
	$f='';//�����ֶ���
	while($r=$empire->fetch($sql))
	{
		$i++;
		if(strstr($autofield,",".$tbname.".".$r[Field].","))
		{
			$autof.=$i.",";
	    }
		if($r['Extra']=='auto_increment')
		{
			$f=$r['Field'];
		}
    }
	$return_r['num']=$i;
	$return_r['autof']=$autof;
	$return_r['auf']=$f;
	return $return_r;
}

//���ز����ֶ�
function Ebak_ReturnInTbfield($dbname,$tbname){
	global $empire;
	$sql=$empire->query("SHOW FIELDS FROM `".$tbname."`");
	$f='';
	$dh='';
	while($r=$empire->fetch($sql))
	{
		if($f)
		{
			$dh=',';
		}
		$f.=$dh.'`'.$r['Field'].'`';
    }
	return $f;
}

//�滻�ļ���
function Ebak_RepFilenum($p,$table,$path){
	if(empty($p))
	{$p=0;}
	$file=$path."/config.php";
	$text=ReadFiletext($file);
	$rep1="\$tb[".$table."]=0;";
	$rep2="\$tb[".$table."]=".$p.";";
	$text=str_replace($rep1,$rep2,$text);
	WriteFiletext_n($file,$text);
}

//ִ��SQL
function E_D($sql){
	global $empire;
	$empire->query($sql);
}

//������
function E_C($sql){
	global $empire;
	$empire->query(Ebak_AddDbchar($sql));
}

//תΪMysql4.0��ʽ
function Ebak_ToMysqlFour($query){
	$exp="ENGINE=";
	if(!strstr($query,$exp))
	{
		return $query;
	}
	$exp1=" ";
	$r=explode($exp,$query);
	//ȡ�ñ�����
	$r1=explode($exp1,$r[1]);
	$returnquery=$r[0]."TYPE=".$r1[0];
	return $returnquery;
}

//---------------------�������ݿ�ṹ
function Ebak_Returnstru($table,$strufour){
	global $empire;
	$dumpsql.="E_D(\"DROP TABLE IF EXISTS `".$table."`;\");\r\n";
	//��������
	$usql=$empire->query("SET SQL_QUOTE_SHOW_CREATE=1;");
	//���ݱ�ṹ
	$r=$empire->fetch1("SHOW CREATE TABLE `$table`;");
	$create=str_replace("\"","\\\"",$r[1]);
	//תΪ4.0��ʽ
	if($strufour)
	{
		$create=Ebak_ToMysqlFour($create);
	}
	$dumpsql.="E_C(\"".$create."\");\r\n";
	return $dumpsql;
}

//�������ñ���
function Ebak_ReturnSetNames($char){
	if(empty($char))
	{
		return '';
	}
	$dumpsql="DoSetDbChar('".$char."');\r\n";
	return $dumpsql;
}

//ȥ���ֶ��еı���
function Ebak_ReplaceFieldChar($sql){
	global $phome_db_ver;
	if($phome_db_ver=='4.0'&&strstr($sql,' character set '))
	{
		$preg_str="/ character set (.+?) collate (.+?) /is";
		$sql=preg_replace($preg_str,' ',$sql);
	}
	return $sql;
}

//�ӱ���
function Ebak_AddDbchar($sql){
	global $phome_db_ver,$phome_db_char,$b_dbchar;
	//�ӱ���
	if($phome_db_ver>='4.1'&&!strstr($sql,'ENGINE=')&&($phome_db_char||$b_dbchar)&&$b_dbchar!='auto')
	{
		$dbcharset=$b_dbchar?$b_dbchar:$phome_db_char;
		$sql=Ebak_DoCreateTable($sql,$phome_db_ver,$dbcharset);
	}
	elseif($phome_db_ver=='4.0'&&strstr($sql,'ENGINE='))
	{
		$sql=Ebak_ToMysqlFour($sql);
	}
	//ȥ���ֶ��еı���
	$sql=Ebak_ReplaceFieldChar($sql);
	return $sql;
}

//����
function Ebak_DoCreateTable($sql,$mysqlver,$dbcharset){
	$type=strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU","\\2",$sql));
	$type=in_array($type,array('MYISAM','HEAP'))?$type:'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU","\\1",$sql).
		($mysqlver>='4.1'?" ENGINE=$type DEFAULT CHARSET=$dbcharset":" TYPE=$type");
}

//���ذ�Ȩ��Ϣ
function Ebak_ReturnVer()
{
	$string="
/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

";
	return $string;
}

//ת����С
function Ebak_ChangeSize($size){
	if($size<1024)
	{
		$str=$size." B";
	}
	elseif($size<1024*1024)
	{
		$str=round($size/1024,2)." KB";
	}
	elseif($size<1024*1024*1024)
	{
		$str=round($size/(1024*1024),2)." MB";
	}
	else
	{
		$str=round($size/(1024*1024*1024),2)." GB";
	}
	return $str;
}

//��������
function Ebak_ReData($add,$mypath,$userid,$username){
	global $empire,$public_r;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	if(empty($mypath)||empty($add[mydbname]))
	{printerror("������ָ�Ŀ¼��ѡ�����ݿ�","history.go(-1)");}
	$bakpath=$public_r['bakdbpath'];
	$path=$bakpath."/".$mypath;
	if(!file_exists($path))
	{
		printerror("�������Ŀ¼������","history.go(-1)");
    }
	@include($path."/config.php");
	if(empty($b_table))
	{
		printerror("���ݲ�������","history.go(-1)");
	}
	$waitbaktime=(int)$add['waitbaktime'];
	$btb=explode(",",$b_table);
	$nfile=$path."/".$btb[0]."_1.php?t=0&p=0&mydbname=$add[mydbname]&mypath=$mypath&waitbaktime=$waitbaktime";
	Header("Location:$nfile");
	exit();
}

//ɾ������Ŀ¼
function Ebak_DelBakpath($path,$userid,$username){
	global $public_r;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	if(strstr($path,".."))
	{printerror("��ѡ��Ҫɾ����Ŀ¼","history.go(-1)");}
	if(!trim($path))
	{printerror("��ѡ��Ҫɾ����Ŀ¼","history.go(-1)");}
	$bakpath=$public_r['bakdbpath'];
	$delpath=$bakpath."/".$path;
	if(!file_exists($delpath))
	{
		printerror("��Ŀ¼�����ڣ��������ɹ�","history.go(-1)");
    }
	@include_once("../../class/delpath.php");
	$delpath=DelPath($delpath);
	printerror("ɾ��Ŀ¼�ɹ�","ChangePath.php?change=".$_GET['change']);
}

//ɾ��Ŀ¼����
function DelPath($DelPath){
	$wm_chief=new del_path();
	$wm_chief_ok=$wm_chief->wm_chief_delpath($DelPath);
	return $wm_chief_ok;
}

//���Ŀ¼
function ZipFile($path,$zipname){
	global $public_r;
	$bakpath=$public_r['bakdbpath'];
	$bakzippath=$public_r['bakdbzip'];
	@include("../../class/phpzip.inc.php");
	$z=new PHPZip(); //�½���һ��zip����
    $z->Zip($bakpath."/".$path,$bakzippath."/".$zipname); //���ָ��Ŀ¼
}

//ɾ��ѹ����
function Ebak_DelZip($file,$userid,$username){
	global $public_r;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	if(strstr($file,".."))
	{printerror("�ļ�������","history.go(-1)");}
	if(empty($file))
	{
		printerror("�ļ�������","history.go(-1)");
    }
	$bakzippath=$public_r['bakdbzip'];
	$filename=$bakzippath."/".$file;
	if(!file_exists($filename))
	{
		printerror("�ļ�������","history.go(-1)");
	}
	DelFiletext($filename);
	printerror("ɾ��ѹ�����ɹ�","history.go(-1)");
}

//ѹ��Ŀ¼
function Ebak_Dozip($path,$userid,$username){
	global $public_r;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	if(strstr($path,".."))
	{printerror("��Ŀ¼������","history.go(-1)");}
	if(empty($path))
	{
		printerror("��Ŀ¼������","history.go(-1)");
    }
	$bakpath=$public_r['bakdbpath'];
    $bakzippath=$public_r['bakdbzip'];
	$mypath=$bakpath."/".$path;
	if(!file_exists($mypath))
	{
		printerror("��Ŀ¼������","history.go(-1)");
	}
	$zipname=$path.".zip";
	ZipFile($path,$zipname);
	echo"<script>self.location.href='DownZip.php?f=$zipname&p=$path';</script>";
}

//ת��ָ�ҳ��
function Ebak_PathGotoRedata($path,$userid,$username){
	global $public_r;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"dbdata");
	if(strstr($path,".."))
	{printerror("��Ŀ¼������","history.go(-1)");}
	if(!trim($path))
	{printerror("NotChangeDelPath","history.go(-1)");}
	$bakpath=$public_r['bakdbpath'];
	$repath=$bakpath."/".$path;
	if(!file_exists($repath))
	{
		printerror("��Ŀ¼������","history.go(-1)");
    }
	@include $repath.'/config.php';
	Header("Location:ReData.php?mydbname=$b_dbname&mypath=$path");
	exit();
}
?>