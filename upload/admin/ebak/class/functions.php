<?php
$editor=1;
//字符过虑
function escape_str($str){
	$str=mysql_escape_string($str);
	$str=str_replace('\\\'','\'\'',$str);
	$str=str_replace("\\\\","\\\\\\\\",$str);
	$str=str_replace('$','\$',$str);
	return $str;
}

//修复表
function Ebak_Rep($tablename,$dbname,$userid,$username){
	global $empire,$phome_db_dbname;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	$empire->query("use `$dbname`");
	$count=count($tablename);
	if(empty($count))
	{printerror("请至少选择一个表","history.go(-1)");}
	for($i=0;$i<$count;$i++)
	{
		//$sql1=$empire->query("OPTIMIZE TABLE `$tablename[$i]`;");
		//$sql2=$empire->query("CHECK TABLE `$tablename[$i]`;");
		//$sql3=$empire->query("ANALYZE TABLE `$tablename[$i]`;");
		$sql4=$empire->query("REPAIR TABLE `$tablename[$i]`;");
    }
	printerror("修复表成功","ChangeTable.php?mydbname=$dbname");
}

//忧化表
function Ebak_Opi($tablename,$dbname,$userid,$username){
	global $empire,$phome_db_dbname;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	$empire->query("use `$dbname`");
	$count=count($tablename);
	if(empty($count))
	{printerror("请至少选择一个表","history.go(-1)");}
	for($i=0;$i<$count;$i++)
	{
		$sql1=$empire->query("OPTIMIZE TABLE `$tablename[$i]`;");
    }
	printerror("忧化表成功","ChangeTable.php?mydbname=$dbname");
}

//删除数据表
function Ebak_Drop($tablename,$dbname,$userid,$username){
	global $empire,$phome_db_dbname;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	$empire->query("use `$dbname`");
	$count=count($tablename);
	if(empty($count))
	{printerror("请至少选择一个要删除的表","history.go(-1)");}
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
	printerror("删除数据表成功","ChangeTable.php?mydbname=$dbname");
}

//删除数据库
function Ebak_DropDb($dbname,$userid,$username){
	global $empire;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	if(empty($dbname))
	{printerror("请选择要删除的数据库","history.go(-1)");}
	$sql=$empire->query("DROP DATABASE `$dbname`");
	if($sql)
	{
		printerror("删除数据库成功","ChangeDb.php");
	}
	else
	{printerror("数据库出错","history.go(-1)");}
}

//建立数据库
function Ebak_CreatDb($dbname,$dbchar,$userid,$username){
	global $empire,$phome_db_ver;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	if(!trim($dbname)){
		printerror("请输入要建立的数据库名","history.go(-1)");
	}
	$a="";
	if($dbchar&&$phome_db_ver>='4.1'){
		$a=" DEFAULT CHARACTER SET ".$dbchar;
	}
	$sql=$empire->query("CREATE DATABASE IF NOT EXISTS `$dbname`".$a);
	if($sql)
	{
		printerror("增加数据库成功","ChangeDb.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//清空表
function Ebak_EmptyTable($tablename,$dbname,$userid,$username){
	global $empire,$phome_db_dbname;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($dbname);
	$empire->query("use `$dbname`");
	$count=count($tablename);
	if(empty($count))
	{printerror("请至少选择一个表","history.go(-1)");}
	for($i=0;$i<$count;$i++)
	{
		$sql1=$empire->query("TRUNCATE `".$tablename[$i]."`;");
    }
	printerror("清空表成功","ChangeTable.php?mydbname=$dbname");
}

//---------------------------备份
//初使化备份
function Ebak_DoEbak($add,$userid,$username){
	global $empire,$public_r,$phome_db_ver;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	$dbname=RepPostVar($add['mydbname']);
	if(empty($dbname)){
		printerror("您还没选择数据库","history.go(-1)");
	}
	$tablename=$add['tablename'];
	$count=count($tablename);
	if(empty($count)){
		printerror("请至少选择一个表","history.go(-1)");
	}
	$add['baktype']=(int)$add['baktype'];
	$add['filesize']=(int)$add['filesize'];
	$add['bakline']=(int)$add['bakline'];
	$add['autoauf']=(int)$add['autoauf'];
	if((!$add['filesize']&&!$add['baktype'])||(!$add['bakline']&&$add['baktype'])){
		printerror("文件大小不能为空","history.go(-1)");
	}
	//目录名
	$bakpath=$public_r['bakdbpath'];
	if(empty($add['mypath'])){
		$add['mypath']=$dbname."_".date("YmdHis");
	}
    DoMkdir($bakpath."/".$add['mypath']);
	//生成说明文件
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
	//去掉最后一个,
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
	echo "初使化备份成功，正在进入表备份．．．．．．<script>self.location.href='phome.php?phome=$phome&t=0&s=0&p=0&mypath=$add[mypath]&waitbaktime=$waitbaktime';</script>";
	exit();
}

//执行备份(按文件大小)
function Ebak_BakExe($t,$s,$p,$mypath,$alltotal,$thenof,$fnum,$stime=0,$userid,$username){
	global $empire,$public_r;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	if(empty($mypath)){
		printerror("您来自的链接不存在","history.go(-1)");
	}
	$bakpath=$public_r['bakdbpath'];
	$path=$bakpath."/".$mypath;
	@include($path."/config.php");
	if(empty($b_table)){
		printerror("您来自的链接不存在","history.go(-1)");
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
	//备份完毕
	if($t>=$count)
	{
		$varmessage="备份完毕.<br><br>共计用时: ".ToChangeUseTime($stime);
		printerror($varmessage,'ChangeDb.php',0,1);
    }
	$dumpsql=Ebak_ReturnVer();
	//选择数据库
	$u=$empire->query("use `$b_dbname`");
	//编码
	if($b_dbchar=='auto')
	{
		if(empty($s))
		{
			$status_r=Ebak_GetTotal($b_dbname,$btb[$t]);
			$collation=Ebak_GetSetChar($status_r['Collation']);
			DoSetDbChar($collation);
			//总记录数
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
			//总记录数
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
	//备份数据库结构
	if($b_stru&&empty($s))
	{
		$dumpsql.=Ebak_Returnstru($btb[$t],$b_strufour);
	}
	$sql=$empire->query("select * from `".$btb[$t]."` limit $s,$num");
	//取得字段数
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
	//完整插入
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
			//首字段
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
		//是否超过限制
		if(strlen($dumpsql)>=$b_filesize*1024)
		{
			$p++;
			$sfile=$path."/".$btb[$t]."_".$p.".php";
			$dumpsql=$header.$dumpsql.$footer;
			WriteFiletext_n($sfile,$dumpsql);
			$empire->free($sql);
			//echo '备份一组数据成功，正在进入下一组．．．．．．'.Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s)."<script>self.location.href='phome.php?phome=BakExe&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&stime=$stime';</script>";

			echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phome.php?phome=BakExe&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&stime=$stime&waitbaktime=$waitbaktime&collation=$collation\">备份一组数据成功，正在进入下一组．．．．．．".Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s);
			exit();
		}
	}
	//最后一个备份
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
	//进入下一个表
	//echo $btb[$t-1]."表备份成功，正在进入下一个表备份．．．．．．<script>self.location.href='phome.php?phome=BakExe&s=0&p=0&t=$t&mypath=$mypath&stime=$stime';</script>";

	echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phome.php?phome=BakExe&s=0&p=0&t=$t&mypath=$mypath&stime=$stime&waitbaktime=$waitbaktime\">".$btb[$t-1]."表备份成功，正在进入下一个表备份．．．．．．";
	exit();
}

//执行备份（按记录）
function Ebak_BakExeT($t,$s,$p,$mypath,$alltotal,$thenof,$fnum,$auf='',$aufval=0,$stime=0,$userid,$username){
	global $empire,$public_r;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	if(empty($mypath)){
		printerror("您来自的链接不存在","history.go(-1)");
	}
	$bakpath=$public_r['bakdbpath'];
	$path=$bakpath."/".$mypath;
	@include($path."/config.php");
	if(empty($b_table)){
		printerror("您来自的链接不存在","history.go(-1)");
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
	//备份完毕
	if($t>=$count)
	{
		$varmessage="备份完毕.<br><br>共计用时: ".ToChangeUseTime($stime);
		printerror($varmessage,'ChangeDb.php',0,1);
    }
	$dumpsql=Ebak_ReturnVer();
	//选择数据库
	$u=$empire->query("use `$b_dbname`");
	//编码
	if($b_dbchar=='auto')
	{
		if(empty($s))
		{
			$status_r=Ebak_GetTotal($b_dbname,$btb[$t]);
			$collation=Ebak_GetSetChar($status_r['Collation']);
			DoSetDbChar($collation);
			//总记录数
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
			//总记录数
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
	//备份数据库结构
	if($b_stru&&empty($s))
	{
		$dumpsql.=Ebak_Returnstru($btb[$t],$b_strufour);
	}
	//取得字段数
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
	//自动识别自增项
	$aufval=(int)$aufval;
	if($b_autoauf==1&&$auf)
	{
		$sql=$empire->query("select * from `".$btb[$t]."` where ".$auf.">".$aufval." order by ".$auf." limit $b_bakline");
	}
	else
	{
		$sql=$empire->query("select * from `".$btb[$t]."` limit $s,$b_bakline");
	}
	//完整插入
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
			//首字段
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
		//最后一个备份
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
		//进入下一个表
		//echo $btb[$t-1]."表备份成功，正在进入下一个表备份．．．．．．<script>self.location.href='phome.php?phome=BakExeT&s=0&p=0&t=$t&mypath=$mypath&stime=$stime';</script>";

		echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phome.php?phome=BakExeT&s=0&p=0&t=$t&mypath=$mypath&stime=$stime&waitbaktime=$waitbaktime\">".$btb[$t-1]."表备份成功，正在进入下一个表备份．．．．．．";
		exit();
	}
	//进入下一组
	$p++;
	$sfile=$path."/".$btb[$t]."_".$p.".php";
	$dumpsql=$header.$dumpsql.$footer;
	WriteFiletext_n($sfile,$dumpsql);
	$empire->free($sql);
	//echo "备份一组数据成功，正在进入下一组．．．．．．".Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s)."<script>self.location.href='phome.php?phome=BakExeT&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&auf=$auf&aufval=$lastaufval&stime=$stime';</script>";

	echo"<meta http-equiv=\"refresh\" content=\"".$waitbaktime.";url=phome.php?phome=BakExeT&s=$s&p=$p&t=$t&mypath=$mypath&alltotal=$num&thenof=$noautof&fieldnum=$fieldnum&auf=$auf&aufval=$lastaufval&stime=$stime&waitbaktime=$waitbaktime&collation=$collation\">备份一组数据成功，正在进入下一组．．．．．．".Ebak_EchoBakSt($btb[$t],$count,$t,$num,$s);
	exit();
}

//输出备份进度条
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

//输出恢复进度条
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

//取得表记录数
function Ebak_GetTotal($dbname,$tbname){
	global $empire;
	/*
	$tr=$empire->fetch1("select count(*) AS total from ".$btb[$t]);
	$num=$tr[total];
	*/
	$tr=$empire->fetch1("SHOW TABLE STATUS LIKE '".$tbname."';");
	return $tr;
}

//返回字符集set
function Ebak_GetSetChar($char){
	global $empire;
	if(empty($char))
	{
		return '';
	}
	$r=$empire->fetch1("SHOW COLLATION LIKE '".$char."';");
	return $r['Charset'];
}

//返回表字段信息
function Ebak_ReturnTbfield($dbname,$tbname,$autofield){
	global $empire;
	$sql=$empire->query("SHOW FIELDS FROM `".$tbname."`");
	$i=0;//字段数
	$autof=",";//去除自增字段列表
	$f='';//自增字段名
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

//返回插入字段
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

//替换文件数
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

//执行SQL
function E_D($sql){
	global $empire;
	$empire->query($sql);
}

//建立表
function E_C($sql){
	global $empire;
	$empire->query(Ebak_AddDbchar($sql));
}

//转为Mysql4.0格式
function Ebak_ToMysqlFour($query){
	$exp="ENGINE=";
	if(!strstr($query,$exp))
	{
		return $query;
	}
	$exp1=" ";
	$r=explode($exp,$query);
	//取得表类型
	$r1=explode($exp1,$r[1]);
	$returnquery=$r[0]."TYPE=".$r1[0];
	return $returnquery;
}

//---------------------返回数据库结构
function Ebak_Returnstru($table,$strufour){
	global $empire;
	$dumpsql.="E_D(\"DROP TABLE IF EXISTS `".$table."`;\");\r\n";
	//设置引号
	$usql=$empire->query("SET SQL_QUOTE_SHOW_CREATE=1;");
	//数据表结构
	$r=$empire->fetch1("SHOW CREATE TABLE `$table`;");
	$create=str_replace("\"","\\\"",$r[1]);
	//转为4.0格式
	if($strufour)
	{
		$create=Ebak_ToMysqlFour($create);
	}
	$dumpsql.="E_C(\"".$create."\");\r\n";
	return $dumpsql;
}

//返回设置编码
function Ebak_ReturnSetNames($char){
	if(empty($char))
	{
		return '';
	}
	$dumpsql="DoSetDbChar('".$char."');\r\n";
	return $dumpsql;
}

//去除字段中的编码
function Ebak_ReplaceFieldChar($sql){
	global $phome_db_ver;
	if($phome_db_ver=='4.0'&&strstr($sql,' character set '))
	{
		$preg_str="/ character set (.+?) collate (.+?) /is";
		$sql=preg_replace($preg_str,' ',$sql);
	}
	return $sql;
}

//加编码
function Ebak_AddDbchar($sql){
	global $phome_db_ver,$phome_db_char,$b_dbchar;
	//加编码
	if($phome_db_ver>='4.1'&&!strstr($sql,'ENGINE=')&&($phome_db_char||$b_dbchar)&&$b_dbchar!='auto')
	{
		$dbcharset=$b_dbchar?$b_dbchar:$phome_db_char;
		$sql=Ebak_DoCreateTable($sql,$phome_db_ver,$dbcharset);
	}
	elseif($phome_db_ver=='4.0'&&strstr($sql,'ENGINE='))
	{
		$sql=Ebak_ToMysqlFour($sql);
	}
	//去除字段中的编码
	$sql=Ebak_ReplaceFieldChar($sql);
	return $sql;
}

//建表
function Ebak_DoCreateTable($sql,$mysqlver,$dbcharset){
	$type=strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU","\\2",$sql));
	$type=in_array($type,array('MYISAM','HEAP'))?$type:'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU","\\1",$sql).
		($mysqlver>='4.1'?" ENGINE=$type DEFAULT CHARSET=$dbcharset":" TYPE=$type");
}

//返回版权信息
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

//转换大小
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

//导入数据
function Ebak_ReData($add,$mypath,$userid,$username){
	global $empire,$public_r;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	if(empty($mypath)||empty($add[mydbname]))
	{printerror("请输入恢复目录与选择数据库","history.go(-1)");}
	$bakpath=$public_r['bakdbpath'];
	$path=$bakpath."/".$mypath;
	if(!file_exists($path))
	{
		printerror("您输入的目录不存在","history.go(-1)");
    }
	@include($path."/config.php");
	if(empty($b_table))
	{
		printerror("备份参数有误","history.go(-1)");
	}
	$waitbaktime=(int)$add['waitbaktime'];
	$btb=explode(",",$b_table);
	$nfile=$path."/".$btb[0]."_1.php?t=0&p=0&mydbname=$add[mydbname]&mypath=$mypath&waitbaktime=$waitbaktime";
	Header("Location:$nfile");
	exit();
}

//删除备份目录
function Ebak_DelBakpath($path,$userid,$username){
	global $public_r;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	if(strstr($path,".."))
	{printerror("请选择要删除的目录","history.go(-1)");}
	if(!trim($path))
	{printerror("请选择要删除的目录","history.go(-1)");}
	$bakpath=$public_r['bakdbpath'];
	$delpath=$bakpath."/".$path;
	if(!file_exists($delpath))
	{
		printerror("此目录不存在，操作不成功","history.go(-1)");
    }
	@include_once("../../class/delpath.php");
	$delpath=DelPath($delpath);
	printerror("删除目录成功","ChangePath.php?change=".$_GET['change']);
}

//删除目录函数
function DelPath($DelPath){
	$wm_chief=new del_path();
	$wm_chief_ok=$wm_chief->wm_chief_delpath($DelPath);
	return $wm_chief_ok;
}

//打包目录
function ZipFile($path,$zipname){
	global $public_r;
	$bakpath=$public_r['bakdbpath'];
	$bakzippath=$public_r['bakdbzip'];
	@include("../../class/phpzip.inc.php");
	$z=new PHPZip(); //新建立一个zip的类
    $z->Zip($bakpath."/".$path,$bakzippath."/".$zipname); //添加指定目录
}

//删除压缩包
function Ebak_DelZip($file,$userid,$username){
	global $public_r;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	if(strstr($file,".."))
	{printerror("文件不存在","history.go(-1)");}
	if(empty($file))
	{
		printerror("文件不存在","history.go(-1)");
    }
	$bakzippath=$public_r['bakdbzip'];
	$filename=$bakzippath."/".$file;
	if(!file_exists($filename))
	{
		printerror("文件不存在","history.go(-1)");
	}
	DelFiletext($filename);
	printerror("删除压缩包成功","history.go(-1)");
}

//压缩目录
function Ebak_Dozip($path,$userid,$username){
	global $public_r;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	if(strstr($path,".."))
	{printerror("此目录不存在","history.go(-1)");}
	if(empty($path))
	{
		printerror("此目录不存在","history.go(-1)");
    }
	$bakpath=$public_r['bakdbpath'];
    $bakzippath=$public_r['bakdbzip'];
	$mypath=$bakpath."/".$path;
	if(!file_exists($mypath))
	{
		printerror("此目录不存在","history.go(-1)");
	}
	$zipname=$path.".zip";
	ZipFile($path,$zipname);
	echo"<script>self.location.href='DownZip.php?f=$zipname&p=$path';</script>";
}

//转向恢复页面
function Ebak_PathGotoRedata($path,$userid,$username){
	global $public_r;
	//验证权限
	CheckLevel($userid,$username,$classid,"dbdata");
	if(strstr($path,".."))
	{printerror("此目录不存在","history.go(-1)");}
	if(!trim($path))
	{printerror("NotChangeDelPath","history.go(-1)");}
	$bakpath=$public_r['bakdbpath'];
	$repath=$bakpath."/".$path;
	if(!file_exists($repath))
	{
		printerror("此目录不存在","history.go(-1)");
    }
	@include $repath.'/config.php';
	Header("Location:ReData.php?mydbname=$b_dbname&mypath=$path");
	exit();
}
?>