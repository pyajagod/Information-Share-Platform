<?php
//�����б�ģ��
function AddListtemp($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[tempname])
	{
		printerror("������ģ����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$add[subsay]=(int)$add[subsay];
	$add[subtitle]=(int)$add[subtitle];
	$sql=$empire->query("insert into {$dbtbpre}downlisttemp(tempname,subsay,temptext,showdate,isdefault,subtitle) values('$add[tempname]','$add[subsay]','".addslashes($add[temptext])."','$add[showdate]',0,'$add[subtitle]');");
	if($sql)
	{
		printerror("�����б�ģ��ɹ�","AddListtemp.php?phome=AddListtemp");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸��б�ģ��
function EditListtemp($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[tempid]=(int)$add[tempid];
	if(!$add[tempname]||!$add[tempid])
	{
		printerror("������ģ����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$add[subsay]=(int)$add[subsay];
	$add[subtitle]=(int)$add[subtitle];
	$sql=$empire->query("update {$dbtbpre}downlisttemp set tempname='$add[tempname]',subsay='$add[subsay]',temptext='".addslashes($add[temptext])."',showdate='$add[showdate]',subtitle='$add[subtitle]' where tempid='$add[tempid]'");
	if($sql)
	{
		printerror("�޸��б�ģ��ɹ�","ListListtemp.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ���б�ģ��
function DelListtemp($tempid,$userid,$username){
	global $empire,$dbtbpre;
	$tempid=(int)$tempid;
	if(!$tempid)
	{
		printerror("��ѡ��Ҫɾ�����б�ģ��","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$sql=$empire->query("delete from {$dbtbpre}downlisttemp where tempid='$tempid'");
	if($sql)
	{
		printerror("ɾ���б�ģ��ɹ�","ListListtemp.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//Ĭ���б�ģ��
function DefaultListtemp($tempid,$userid,$username){
	global $empire,$dbtbpre;
	$tempid=(int)$tempid;
	if(!$tempid)
	{
		printerror("��ѡ��ҪĬ�ϵ��б�ģ��","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$usql=$empire->query("update {$dbtbpre}downlisttemp set isdefault=0");
	$sql=$empire->query("update {$dbtbpre}downlisttemp set isdefault=1 where tempid='$tempid'");
	$usql=$empire->query("update {$dbtbpre}downpublic set defaultlistid='$tempid'");
	GetPublic();
	if($sql)
	{
		printerror("Ĭ���б�ģ��ɹ�","ListListtemp.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//��������ģ��
function AddSofttemp($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[tempname])
	{
		printerror("������ģ����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$sql=$empire->query("insert into {$dbtbpre}downsofttemp(tempname,temptext,showdate) values('$add[tempname]','".addslashes($add[temptext])."','$add[showdate]');");
	if($sql)
	{
		printerror("��������ģ��ɹ�","AddSofttemp.php?phome=AddSofttemp");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸�����ģ��
function EditSofttemp($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[tempid]=(int)$add[tempid];
	if(!$add[tempname]||!$add[tempid])
	{
		printerror("������ģ����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$sql=$empire->query("update {$dbtbpre}downsofttemp set tempname='$add[tempname]',temptext='".addslashes($add[temptext])."',showdate='$add[showdate]' where tempid='$add[tempid]'");
	if($sql)
	{
		printerror("�޸�����ģ��ɹ�","ListSofttemp.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ������ģ��
function DelSofttemp($tempid,$userid,$username){
	global $empire,$dbtbpre;
	$tempid=(int)$tempid;
	if(!$tempid)
	{
		printerror("��ѡ��Ҫɾ��������ģ��","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$sql=$empire->query("delete from {$dbtbpre}downsofttemp where tempid='$tempid'");
	if($sql)
	{
		printerror("ɾ������ģ��ɹ�","ListSofttemp.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸�ģ��
function EditTemplate($templatename,$temptext,$add,$changedown,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$templatename=RepPostVar($templatename);
	if(!$templatename||!$temptext)
	{
		printerror("������ģ������","history.go(-1)");
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
	if($templatename=="indextemp")//��ҳģ��
	{
		DownBq(addslashes($temptext));
	}
	elseif($templatename=="softclasstemp")//���ർ��ģ��
	{
		GetSoftClass();
	}
	elseif($templatename=="cptemp")//�������ģ��
	{
		ChangeMemberCpPage();
	}
	elseif($templatename=="ggtemp")//����ģ��
	{
		GetGgHtml();
	}
	elseif($templatename=="searchtemp")//�����б�ģ��
	{
        ReSearchFile('');
	}
	elseif($templatename=="ggjstemp")//����jsģ��
	{
		GetGgJs();
	}
	elseif($templatename=="searchformtemp"||$templatename=="searchjstemp1"||$templatename=="searchjstemp2")//�޸�������ģ��
	{
		GetSearch();
	}
	elseif($templatename=="downsofttemp"||$templatename=="onlinesofttemp"||$templatename=="listpagetemp"||$templatename=="otherlinktemp")//���ص�ַ/���ߵ�ַģ��
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
		printerror("�޸�ģ��ɹ�","ListTemplate.php?tname=$templatename");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//����ģ��ȫ�ֱ���
function AddTempvar($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[myvar]||!$add[varvalue]||!$add[varname])
	{
		printerror("�������������������ʶ������ֵ","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$isclose=(int)$add[isclose];
	$add[myorder]=(int)$add[myorder];
	$sql=$empire->query("insert into {$dbtbpre}downtempvar(myvar,varname,varvalue,isclose,myorder) values('$add[myvar]','$add[varname]','".addslashes($add[varvalue])."',".$isclose.",$add[myorder]);");
	$lastid=$empire->lastid();
	if($sql)
	{
		printerror("����ģ������ɹ�","AddTempvar.php?enews=AddTempvar");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸�ģ�����
function EditTempvar($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[varid]=(int)$add['varid'];
	if(!$add[varid]||!$add[myvar]||!$add[varvalue]||!$add[varname])
	{
		printerror("�������������������ʶ������ֵ","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$isclose=(int)$add[isclose];
	$add[myorder]=(int)$add[myorder];
	$sql=$empire->query("update {$dbtbpre}downtempvar set myvar='$add[myvar]',varname='$add[varname]',varvalue='".addslashes($add[varvalue])."',isclose=$isclose,myorder=$add[myorder] where varid='$add[varid]'");
	if($sql)
	{
		printerror("�޸�ģ������ɹ�","ListTempvar.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ��ģ�����
function DelTempvar($varid,$userid,$username){
	global $empire,$dbtbpre;
	$varid=(int)$varid;
	if(!$varid)
	{
		printerror("��ѡ��Ҫɾ����ģ�����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$sql=$empire->query("delete from {$dbtbpre}downtempvar where varid='$varid'");
	if($sql)
	{
		printerror("ɾ��ģ������ɹ�","ListTempvar.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//------------------- �����뵼��ģ�� -------------------

//����ģ���
function ReturnTemptbList(){
	$templist="downlisttemp,downsofttemp,downpubtemp,downtempvar";
	return $templist;
}

//���ģ�����ݱ�
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

//����ģ����
function LoadTempGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	$pageexp="<!---ecms.temp--->";
	$record="<!---ecms.record--->";
	$field="<!---ecms.field--->";
	$listtemp=LoadTGListtemp($pageexp,$record,$field);//�б�ģ��
	$softtemp=LoadTGNewstemp($pageexp,$record,$field);//����ģ��
	$pubtemp=LoadTGPubtemp($pageexp,$record,$field);//����ģ��
	$tempvar=LoadTGTempvar($pageexp,$record,$field);//ģ�����
	$loadtemptext=$listtemp.$pageexp.$softtemp.$pageexp.$pubtemp.$pageexp.$tempvar;
	$loadtemptext=stripSlashes($loadtemptext);
	$file="e".time().".temp";
	$filepath="../data/trantmp/".$file;
	WriteFiletext_n($filepath,$loadtemptext);
	DownLoadFile($file,$filepath,1);
	exit();
}

//����ģ����
function LoadInTempGroup($add,$file,$file_name,$file_type,$file_size,$userid,$username){
	global $empire,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"template");
	if(!$file_name||!$file_size)
	{
		printerror("��ѡ��Ҫ�����ģ��","");
	}
	//��չ��
	$filetype=GetFiletype($file_name);
	if($filetype!=".temp")
	{
		printerror("ģ����չ��ҪΪ.temp","");
	}
	//�ϴ��ļ�
	$path="../data/trantmp/uploadtg".time().".temp";
	$cp=@move_uploaded_file($file,$path);
	DoChmodFile($path);
	$data=ReadFiletext($path);
	DelFiletext($path);
	if(empty($data))
	{
		printerror("��ѡ��Ҫ�����ģ��","");
	}
	//���
	$pageexp="<!---ecms.temp--->";
	$record="<!---ecms.record--->";
	$field="<!---ecms.field--->";
	$pr=explode($pageexp,$data);
	ClearTempTb();//��ձ�
	LoadInTGListtemp($record,$field,$pr[0]);//�б�ģ��
	LoadInTGNewstemp($record,$field,$pr[1]);//����ģ��
	LoadInTGPubtemp($record,$field,$pr[2]);//����ģ��
	LoadInTGTempvar($record,$field,$pr[3]);//ģ�����
	printerror("����ģ�����","TempGroup.php");
}

//�滻ģ�����Ÿ�ʽ
function ReplaceLoadTGTemp($pageexp,$record,$field,$text){
	$text=str_replace($pageexp,"",$text);
	$text=str_replace($record,"",$text);
	$text=str_replace($field,"",$text);
	return $text;
}

//�б�ģ��
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

//����ģ��
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

//ģ�����
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

//����ģ��
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