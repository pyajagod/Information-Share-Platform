<?php
//增加列表模板
function AddListtemp($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[tempname])
	{
		printerror("请输入模板名","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$add[subsay]=(int)$add[subsay];
	$add[subtitle]=(int)$add[subtitle];
	$sql=$empire->query("insert into {$dbtbpre}downlisttemp(tempname,subsay,temptext,showdate,isdefault,subtitle) values('$add[tempname]','$add[subsay]','".addslashes($add[temptext])."','$add[showdate]',0,'$add[subtitle]');");
	if($sql)
	{
		printerror("增加列表模板成功","AddListtemp.php?phome=AddListtemp");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改列表模板
function EditListtemp($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[tempid]=(int)$add[tempid];
	if(!$add[tempname]||!$add[tempid])
	{
		printerror("请输入模板名","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$add[subsay]=(int)$add[subsay];
	$add[subtitle]=(int)$add[subtitle];
	$sql=$empire->query("update {$dbtbpre}downlisttemp set tempname='$add[tempname]',subsay='$add[subsay]',temptext='".addslashes($add[temptext])."',showdate='$add[showdate]',subtitle='$add[subtitle]' where tempid='$add[tempid]'");
	if($sql)
	{
		printerror("修改列表模板成功","ListListtemp.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除列表模板
function DelListtemp($tempid,$userid,$username){
	global $empire,$dbtbpre;
	$tempid=(int)$tempid;
	if(!$tempid)
	{
		printerror("请选择要删除的列表模板","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$sql=$empire->query("delete from {$dbtbpre}downlisttemp where tempid='$tempid'");
	if($sql)
	{
		printerror("删除列表模板成功","ListListtemp.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//默认列表模板
function DefaultListtemp($tempid,$userid,$username){
	global $empire,$dbtbpre;
	$tempid=(int)$tempid;
	if(!$tempid)
	{
		printerror("请选择要默认的列表模板","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$usql=$empire->query("update {$dbtbpre}downlisttemp set isdefault=0");
	$sql=$empire->query("update {$dbtbpre}downlisttemp set isdefault=1 where tempid='$tempid'");
	$usql=$empire->query("update {$dbtbpre}downpublic set defaultlistid='$tempid'");
	GetPublic();
	if($sql)
	{
		printerror("默认列表模板成功","ListListtemp.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//增加内容模板
function AddSofttemp($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[tempname])
	{
		printerror("请输入模板名","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$sql=$empire->query("insert into {$dbtbpre}downsofttemp(tempname,temptext,showdate) values('$add[tempname]','".addslashes($add[temptext])."','$add[showdate]');");
	if($sql)
	{
		printerror("增加内容模板成功","AddSofttemp.php?phome=AddSofttemp");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改内容模板
function EditSofttemp($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[tempid]=(int)$add[tempid];
	if(!$add[tempname]||!$add[tempid])
	{
		printerror("请输入模板名","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$sql=$empire->query("update {$dbtbpre}downsofttemp set tempname='$add[tempname]',temptext='".addslashes($add[temptext])."',showdate='$add[showdate]' where tempid='$add[tempid]'");
	if($sql)
	{
		printerror("修改内容模板成功","ListSofttemp.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除内容模板
function DelSofttemp($tempid,$userid,$username){
	global $empire,$dbtbpre;
	$tempid=(int)$tempid;
	if(!$tempid)
	{
		printerror("请选择要删除的内容模板","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$sql=$empire->query("delete from {$dbtbpre}downsofttemp where tempid='$tempid'");
	if($sql)
	{
		printerror("删除内容模板成功","ListSofttemp.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改模板
function EditTemplate($templatename,$temptext,$add,$changedown,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$templatename=RepPostVar($templatename);
	if(!$templatename||!$temptext)
	{
		printerror("请输入模板内容","history.go(-1)");
	}
	$addsql='';
	if($templatename=="softclasstemp")
	{
		$addsql.=",softclassbgcolor='$add[softclassbgcolor]',softclasstdcolor='$add[softclasstdcolor]',softclassnum='$add[softclassnum]'";
	}
	elseif($templatename=="searchtemp")
	{
		$addsql.=",schsubtitle='$add[schsubtitle]',schsubsay='$add[schsubsay]',schformatdate='$add[schformatdate]'";
	}
	elseif($templatename=="classjstemp")
	{
		$addsql.=",classjsshowdate='$add[classjsshowdate]'";
	}
	elseif($templatename=="otherlinktemp")
	{
		$addsql.=",otherlinktempsub='$add[otherlinktempsub]',otherlinktempdate='$add[otherlinktempdate]'";
	}
	$sql=$empire->query("update {$dbtbpre}downpubtemp set ".$templatename."='".addslashes($temptext)."'".$addsql);
	if($templatename=="indextemp")//首页模板
	{
		DownBq(addslashes($temptext));
	}
	elseif($templatename=="softclasstemp")//分类导航模板
	{
		GetSoftClass();
	}
	elseif($templatename=="cptemp")//控制面板模板
	{
		ChangeMemberCpPage();
	}
	elseif($templatename=="ggtemp")//公告模板
	{
		GetGgHtml();
	}
	elseif($templatename=="searchtemp")//搜索列表模板
	{
        ReSearchFile('');
	}
	elseif($templatename=="ggjstemp")//公告js模板
	{
		GetGgJs();
	}
	elseif($templatename=="searchformtemp"||$templatename=="searchjstemp1"||$templatename=="searchjstemp2")//修改搜索表单模板
	{
		GetSearch();
	}
	elseif($templatename=="downsofttemp"||$templatename=="onlinesofttemp"||$templatename=="listpagetemp"||$templatename=="otherlinktemp")//下载地址/在线地址模板
	{
		GetPublic();
	}
	elseif($templatename=="loginiframe"||$templatename=="loginjstemp")
	{
		ReLoginIframe();
	}
	elseif($templatename=="downpagetemp")
	{
		ReDownPageFile();
	}
	if($sql)
	{
		printerror("修改模板成功","ListTemplate.php?tname=$templatename");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//增加模板全局变量
function AddTempvar($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[myvar]||!$add[varvalue]||!$add[varname])
	{
		printerror("请输入变量名、变量标识及变量值","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$isclose=(int)$add[isclose];
	$add[myorder]=(int)$add[myorder];
	$sql=$empire->query("insert into {$dbtbpre}downtempvar(myvar,varname,varvalue,isclose,myorder) values('$add[myvar]','$add[varname]','".addslashes($add[varvalue])."',".$isclose.",$add[myorder]);");
	$lastid=$empire->lastid();
	if($sql)
	{
		printerror("增加模板变量成功","AddTempvar.php?enews=AddTempvar");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改模板变量
function EditTempvar($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[varid]=(int)$add['varid'];
	if(!$add[varid]||!$add[myvar]||!$add[varvalue]||!$add[varname])
	{
		printerror("请输入变量名、变量标识及变量值","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$isclose=(int)$add[isclose];
	$add[myorder]=(int)$add[myorder];
	$sql=$empire->query("update {$dbtbpre}downtempvar set myvar='$add[myvar]',varname='$add[varname]',varvalue='".addslashes($add[varvalue])."',isclose=$isclose,myorder=$add[myorder] where varid='$add[varid]'");
	if($sql)
	{
		printerror("修改模板变量成功","ListTempvar.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除模板变量
function DelTempvar($varid,$userid,$username){
	global $empire,$dbtbpre;
	$varid=(int)$varid;
	if(!$varid)
	{
		printerror("请选择要删除的模板变量","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$sql=$empire->query("delete from {$dbtbpre}downtempvar where varid='$varid'");
	if($sql)
	{
		printerror("删除模板变量成功","ListTempvar.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//------------------- 导入与导出模板 -------------------

//返回模板表
function ReturnTemptbList(){
	$templist="downlisttemp,downsofttemp,downpubtemp,downtempvar";
	return $templist;
}

//清空模板数据表
function ClearTempTb(){
	global $empire,$dbtbpre;
	$templist=ReturnTemptbList();
	$r=explode(",",$templist);
	$count=count($r);
	for($i=0;$i<$count;$i++)
	{
		$tb=$dbtbpre.$r[$i];
		$empire->query("TRUNCATE `".$tb."`;");
	}
}

//导出模板组
function LoadTempGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	$pageexp="<!---ecms.temp--->";
	$record="<!---ecms.record--->";
	$field="<!---ecms.field--->";
	$listtemp=LoadTGListtemp($pageexp,$record,$field);//列表模板
	$softtemp=LoadTGNewstemp($pageexp,$record,$field);//内容模板
	$pubtemp=LoadTGPubtemp($pageexp,$record,$field);//公共模板
	$tempvar=LoadTGTempvar($pageexp,$record,$field);//模板变量
	$loadtemptext=$listtemp.$pageexp.$softtemp.$pageexp.$pubtemp.$pageexp.$tempvar;
	$loadtemptext=stripSlashes($loadtemptext);
	$file="e".time().".temp";
	$filepath="../data/trantmp/".$file;
	WriteFiletext_n($filepath,$loadtemptext);
	DownLoadFile($file,$filepath,1);
	exit();
}

//导入模板组
function LoadInTempGroup($add,$file,$file_name,$file_type,$file_size,$userid,$username){
	global $empire,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"template");
	if(!$file_name||!$file_size)
	{
		printerror("请选择要导入的模板","");
	}
	//扩展名
	$filetype=GetFiletype($file_name);
	if($filetype!=".temp")
	{
		printerror("模板扩展名要为.temp","");
	}
	//上传文件
	$path="../data/trantmp/uploadtg".time().".temp";
	$cp=@move_uploaded_file($file,$path);
	DoChmodFile($path);
	$data=ReadFiletext($path);
	DelFiletext($path);
	if(empty($data))
	{
		printerror("请选择要导入的模板","");
	}
	//入库
	$pageexp="<!---ecms.temp--->";
	$record="<!---ecms.record--->";
	$field="<!---ecms.field--->";
	$pr=explode($pageexp,$data);
	ClearTempTb();//清空表
	LoadInTGListtemp($record,$field,$pr[0]);//列表模板
	LoadInTGNewstemp($record,$field,$pr[1]);//内容模板
	LoadInTGPubtemp($record,$field,$pr[2]);//公共模板
	LoadInTGTempvar($record,$field,$pr[3]);//模板变量
	printerror("导入模板完毕","TempGroup.php");
}

//替换模板组存放格式
function ReplaceLoadTGTemp($pageexp,$record,$field,$text){
	$text=str_replace($pageexp,"",$text);
	$text=str_replace($record,"",$text);
	$text=str_replace($field,"",$text);
	return $text;
}

//列表模板
function LoadTGListtemp($pageexp,$record,$field){
	global $empire,$dbtbpre;
	$tb=$dbtbpre."downlisttemp";
	$sql=$empire->query("select * from ".$tb." order by tempid");
	$classid=0;
	while($r=$empire->fetch($sql))
	{
		$r['temptext']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['temptext']);
		$text.=$r['tempid'].$field.$r['tempname'].$field.$r['subsay'].$field.$r['temptext'].$field.$r['showdate'].$field.$r['subtitle'].$field.$r['isdefault'].$record;
	}
	return $text;
}

function LoadInTGListtemp($record,$field,$text){
	global $empire,$dbtbpre;
	if(empty($text))
	{
		return "";
	}
	$tb=$dbtbpre."downlisttemp";
	$rr=explode($record,$text);
	$count=count($rr);
	for($i=0;$i<$count-1;$i++)
	{
		$r=explode($field,$rr[$i]);
		$sql=$empire->query("insert into ".$tb."(tempid,tempname,subsay,temptext,showdate,subtitle,isdefault) values('$r[0]','".addslashes($r[1])."','$r[2]','".addslashes($r[3])."','".addslashes($r[4])."','$r[5]','$r[6]');");
	}
}

//内容模板
function LoadTGNewstemp($pageexp,$record,$field){
	global $empire,$dbtbpre;
	$tb=$dbtbpre."downsofttemp";
	$sql=$empire->query("select * from ".$tb." order by tempid");
	$classid=0;
	while($r=$empire->fetch($sql))
	{
		$r['temptext']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['temptext']);
		$text.=$r['tempid'].$field.$r['tempname'].$field.$r['temptext'].$field.$r['showdate'].$record;
	}
	return $text;
}

function LoadInTGNewstemp($record,$field,$text){
	global $empire,$dbtbpre;
	if(empty($text))
	{
		return "";
	}
	$tb=$dbtbpre."downsofttemp";
	$rr=explode($record,$text);
	$count=count($rr);
	for($i=0;$i<$count-1;$i++)
	{
		$r=explode($field,$rr[$i]);
		$sql=$empire->query("insert into ".$tb."(tempid,tempname,temptext,showdate) values('$r[0]','".addslashes($r[1])."','".addslashes($r[2])."','".addslashes($r[3])."');");
	}
}

//模板变量
function LoadTGTempvar($pageexp,$record,$field){
	global $empire,$dbtbpre;
	$tb=$dbtbpre."downtempvar";
	$sql=$empire->query("select * from ".$tb." order by varid");
	$classid=0;
	while($r=$empire->fetch($sql))
	{
		$r['varvalue']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['varvalue']);
		$text.=$r['varid'].$field.$r['myvar'].$field.$r['varname'].$field.$r['varvalue'].$field.$r['isclose'].$field.$r['myorder'].$record;
	}
	return $text;
}

function LoadInTGTempvar($record,$field,$text){
	global $empire,$dbtbpre;
	if(empty($text))
	{
		return "";
	}
	$tb=$dbtbpre."downtempvar";
	$rr=explode($record,$text);
	$count=count($rr);
	for($i=0;$i<$count-1;$i++)
	{
		$r=explode($field,$rr[$i]);
		$sql=$empire->query("insert into ".$tb."(varid,myvar,varname,varvalue,isclose,myorder) values('$r[0]','".addslashes($r[1])."','".addslashes($r[2])."','".addslashes($r[3])."','$r[4]','$r[5]');");
	}
}

//公共模板
function LoadTGPubtemp($pageexp,$record,$field){
	global $empire,$dbtbpre;
	$tb=$dbtbpre."downpubtemp";
	$r=$empire->fetch1("select * from ".$tb." limit 1");
	$r['indextemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['indextemp']);
	$r['softclasstemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['softclasstemp']);
	$r['searchtemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['searchtemp']);
	$r['ggtemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['ggtemp']);
	$r['cptemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['cptemp']);
	$r['classjstemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['classjstemp']);
	$r['ggjstemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['ggjstemp']);
	$r['navtemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['navtemp']);
	$r['searchformtemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['searchformtemp']);
	$r['searchjstemp1']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['searchjstemp1']);
	$r['searchjstemp2']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['searchjstemp2']);
	$r['downsofttemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['downsofttemp']);
	$r['onlinesofttemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['onlinesofttemp']);
	$r['votetemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['votetemp']);
	$r['otherlinktemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['otherlinktemp']);
	$r['loginiframe']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['loginiframe']);
	$r['loginjstemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['loginjstemp']);
	$r['listpagetemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['listpagetemp']);
	$r['downpagetemp']=ReplaceLoadTGTemp($pageexp,$record,$field,$r['downpagetemp']);
	$text.=$r['id'].$field.$r['indextemp'].$field.$r['softclasstemp'].$field.$r['searchtemp'].$field.$r['ggtemp'].$field.$r['cptemp'].$field.$r['classjstemp'].$field.$r['ggjstemp'].$field.$r['navtemp'].$field.$r['searchformtemp'].$field.$r['searchjstemp1'].$field.$r['searchjstemp2'].$field.$r['downsofttemp'].$field.$r['onlinesofttemp'].$field.$r['votetemp'].$field.$r['schsubtitle'].$field.$r['schsubsay'].$field.$r['schformatdate'].$field.$r['classjsshowdate'].$field.$r['softclassbgcolor'].$field.$r['softclasstdcolor'].$field.$r['otherlinktemp'].$field.$r['loginiframe'].$field.$r['loginjstemp'].$field.$r['otherlinktempsub'].$field.$r['otherlinktempdate'].$field.$r['listpagetemp'].$field.$r['softclassnum'].$field.$r['downpagetemp'].$record;
	return $text;
}

function LoadInTGPubtemp($record,$field,$text){
	global $empire,$dbtbpre;
	if(empty($text))
	{
		return "";
	}
	$tb=$dbtbpre."downpubtemp";
	$rr=explode($record,$text);
	$r=explode($field,$rr[0]);
	$sql=$empire->query("insert into ".$tb."(id,indextemp,softclasstemp,searchtemp,ggtemp,cptemp,classjstemp,ggjstemp,navtemp,searchformtemp,searchjstemp1,searchjstemp2,downsofttemp,onlinesofttemp,votetemp,schsubtitle,schsubsay,schformatdate,classjsshowdate,softclassbgcolor,softclasstdcolor,otherlinktemp,loginiframe,loginjstemp,otherlinktempsub,otherlinktempdate,listpagetemp,softclassnum,downpagetemp) values('$r[0]','".addslashes($r[1])."','".addslashes($r[2])."','".addslashes($r[3])."','".addslashes($r[4])."','".addslashes($r[5])."','".addslashes($r[6])."','".addslashes($r[7])."','".addslashes($r[8])."','".addslashes($r[9])."','".addslashes($r[10])."','".addslashes($r[11])."','".addslashes($r[12])."','".addslashes($r[13])."','".addslashes($r[14])."','$r[15]','$r[16]','".addslashes($r[17])."','".addslashes($r[18])."','".addslashes($r[19])."','".addslashes($r[20])."','".addslashes($r[21])."','".addslashes($r[22])."','".addslashes($r[23])."','$r[24]','".addslashes($r[25])."','".addslashes($r[26])."','$r[27]','".addslashes($r[28])."');");
}
?>