<?php
//���ർ��
function GetClassNavCache($line,$navfh){
	global $empire,$dbtbpre,$public_r;
	$limit='';
	if($line)
	{
		$limit=" limit ".$line;
	}
	$navs='';
	$fh='';
	$sql=$empire->query("select classid,classname from {$dbtbpre}downclass where bclassid=0 order by myorder,classid".$limit);
	while($r=$empire->fetch($sql))
	{
		$classurl=EDReturnClassUrl($r[classid]);
		if($navs)
		{
			$fh=$navfh;
		}
		$navs.=$fh."<a href=\"".$classurl."\">".$r[classname]."</a>";
	}
	return $navs;
}

//��ҳ��ǩ�滻
function DownBq($indextext){
	global $empire,$dbtbpre,$public_r;
	$indextext=stripSlashes($indextext);
	$pagetitle=htmlspecialchars($public_r['sitename']);
	$pagekey=htmlspecialchars($public_r['sitekey']);
	$pagedes=htmlspecialchars($public_r['siteintro']);
	$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/top.js'></script>";
	$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new.js'></script>";
	$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
	$url="<a href=\"".$public_r[sitedown]."\">��ҳ</a>";
	//�滻
	$indextext=Rep_templatevars($indextext,$url,$pagetitle,$pagekey,$pagedes,$navadd);
	$truefile="../index".$public_r['refiletype'];
	$file="../data/tmp/index.php";
	$indextext=AddCheckViewTempCode().RepTempBq($indextext);
	WriteFiletext($file,$indextext);
	//��ȡ�ļ�����
    @ob_start();
	@include($file);
	$string=@ob_get_contents();
	@ob_end_clean();
	WriteFiletext($truefile,$string);
}

//��ģ����֤����
function AddCheckViewTempCode(){
	$code="<?php
if(!defined('InEmpireDown'))
{
	exit();
}
?>";
	return $code;
}

//��ǩ�滻
function RepTempBq($indextext){
	//����
	$indextext=DoRepEdownLoopBq($indextext);
	$preg_str="/\[phomedown\](.+?)\[\/phomedown\]/is";
	$indextext=preg_replace($preg_str,"<?php @sys_GetClassDown(\\1);?>",$indextext);
	$preg_str="/\[downpic\](.+?)\[\/downpic\]/is";
	$indextext=preg_replace($preg_str,"<?php @sys_GetDownPic(\\1);?>",$indextext);
	//���
	$preg_str="/\[downad\](.+?)\[\/downad\]/is";
	$indextext=preg_replace($preg_str,"<?php @sys_GetDownAd(\\1);?>",$indextext);
	//ͶƱ
	$preg_str="/\[downvote\](.+?)\[\/downvote\]/is";
	$indextext=preg_replace($preg_str,"<?php @sys_GetDownVote(\\1);?>",$indextext);
	//ͳ������
	$preg_str="/\[downtotal\](.+?)\[\/downtotal\]/is";
	$indextext=preg_replace($preg_str,"<?php @sys_GetTotalSoftnum(\\1);?>",$indextext);
	//��������
	$preg_str="/\[downlink\](.+?)\[\/downlink\]/is";
	$indextext=preg_replace($preg_str,"<?php @sys_GetSitelink(\\1);?>",$indextext);
	return $indextext;
}

//ģ��ͷ�������滻
function Rep_templatevars($temp,$url,$title,$key,$des,$add){
	global $public_r;
	$temp=ReplaceTempvar($temp);//ģ�����
	$temp=str_replace("[!--class.menu--]",$public_r['classnavs'],$temp);
	$temp=str_replace("[!--empiredown.url--]",$url,$temp);
	$temp=str_replace("[!--pagetitle--]",$title,$temp);
	$temp=str_replace("[!--pagekey--]",$key,$temp);
	$temp=str_replace("[!--pagedes--]",$des,$temp);
	$temp=str_replace("[!--edown.url--]",$public_r['sitedown'],$temp);
	$temp=str_replace("[!--empiredown.topjs--]",$add['topjs'],$temp);
	$temp=str_replace("[!--empiredown.newjs--]",$add['newjs'],$temp);
	$temp=str_replace("[!--empiredown.class--]",$add['navclass'],$temp);
	return $temp;
}

//�б�ģ������滻
function Rep_ListTempVars($no,$temptext,$subsay,$subtitle,$formatdate,$haveclass,$r){
	global $public_r,$class_r,$class_lr,$class_sr,$class_zr,$class_sqr;
	//����
	$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
	$temptext=str_replace("[!--softurl--]",$softurl,$temptext);
	$temptext=str_replace("[!--softid--]",$r[softid],$temptext);
	//����
	$tclassurl=EDReturnClassUrl($r[classid]);
	$tclassname=EdReturnClassname($r[classid]);
	$addclass='';
	if($haveclass)
	{
		$addclass="[<a href=\"".$tclassurl."\">".$tclassname."</a>]&nbsp;";
	}
	$temptext=str_replace("[!--classname--]",$addclass,$temptext);
	$temptext=str_replace("[!--classid--]",$r[classid],$temptext);
	$temptext=str_replace("[!--thisclassname--]",$tclassname,$temptext);
	$temptext=str_replace("[!--thisclassurl--]",$tclassurl,$temptext);
	//��Ȩ��ʽ
	$temptext=str_replace("[!--soft_sq--]",$class_sqr[$r[soft_sq]][sqname],$temptext);
	//�������
	$t_softtype="<a href=\"".EDReturnTypeUrl($r[softtype])."\">".$class_sr[$r[softtype]][softtype]."</a>";
	$temptext=str_replace("[!--softtype--]",$t_softtype,$temptext);
	//����
	$temptext=str_replace("[!--language--]",$class_lr[$r[language]][language],$temptext);
	//ר��
	$t_ztname="<a href=\"".EDReturnZtUrl($r[ztid])."\">".$class_zr[$r[ztid]][ztname]."</a>";
	$temptext=str_replace("[!--ztname--]",$t_ztname,$temptext);
	//ͼƬ
	$t_softpic=$r[softpic]?$r[softpic]:$public_r[sitedown]."data/images/notimg.gif";
	$temptext=str_replace("[!--softpic--]",$t_softpic,$temptext);
	//�����
	$softname=DoTitleFont($r[titlefont],esub($r[softname],$subtitle));
	$temptext=str_replace("[!--softname--]",$softname,$temptext);
	$temptext=str_replace("[!--oldsoftname--]",$r[softname],$temptext);
	//����
	$softsay=nl2br(GetEBBcode(esub(strip_tags(trim($r[softsay])),$subsay)));
	$temptext=str_replace("[!--softsay--]",$softsay,$temptext);
	//ʱ��
	$temptext=str_replace("[!--softtime--]",date($formatdate,$r[softtime]),$temptext);
	//�ֶ�
	$temptext=str_replace("[!--homepage--]",$r[homepage],$temptext);
	$temptext=str_replace("[!--adduser--]",$r[adduser],$temptext);
	$temptext=str_replace("[!--writer--]",$r[writer],$temptext);
	$temptext=str_replace("[!--filesize--]",$r[filesize],$temptext);
	$temptext=str_replace("[!--filetype--]",$r[filetype],$temptext);
	$temptext=str_replace("[!--demo--]",$r[demo],$temptext);
	$temptext=str_replace("[!--count_all--]",$r[count_all],$temptext);
	$temptext=str_replace("[!--count_month--]",$r[count_month],$temptext);
	$temptext=str_replace("[!--count_week--]",$r[count_week],$temptext);
	$temptext=str_replace("[!--count_day--]",$r[count_day],$temptext);
	$temptext=str_replace("[!--soft_fj--]",$r[soft_fj],$temptext);
	$temptext=str_replace("[!--downfen--]",$r[downfen],$temptext);
	$temptext=str_replace("[!--star--]","<img src='".$public_r[sitedown]."data/images/".$r[star]."star.gif'>",$temptext);
	$temptext=str_replace("[!--soft_version--]",$r[soft_version],$temptext);
	return $temptext;
}

//�б�ģ������滻
function SearchListTemp($temptext){
	global $public_r;
	//����
	$temptext=str_replace("[!--softurl--]","<?=\$softurl?>",$temptext);
	$temptext=str_replace("[!--softid--]","<?=\$r[softid]?>",$temptext);
	//����
	$temptext=str_replace("[!--classname--]","<?=\$classname?>",$temptext);
	$temptext=str_replace("[!--classid--]","<?=\$r[classid]?>",$temptext);
	$temptext=str_replace("[!--thisclassname--]","<?=\$thisclassname?>",$temptext);
	$temptext=str_replace("[!--thisclassurl--]","<?=\$thisclassurl?>",$temptext);
	//��Ȩ��ʽ
	$temptext=str_replace("[!--soft_sq--]","<?=\$soft_sq?>",$temptext);
	//�������
	$temptext=str_replace("[!--softtype--]","<?=\$softtype?>",$temptext);
	//����
	$temptext=str_replace("[!--language--]","<?=\$language?>",$temptext);
	//ר��
	$temptext=str_replace("[!--ztname--]","<?=\$ztname?>",$temptext);
	//ͼƬ
	$temptext=str_replace("[!--softpic--]","<?=\$softpic?>",$temptext);
	//�����
	$temptext=str_replace("[!--softname--]","<?=\$softname?>",$temptext);
	$temptext=str_replace("[!--oldsoftname--]","<?=\$r[softname]?>",$temptext);
	//����
	$temptext=str_replace("[!--softsay--]","<?=\$softsay?>",$temptext);
	//ʱ��
	$temptext=str_replace("[!--softtime--]","<?=\$softtime?>",$temptext);
	//�ֶ�
	$temptext=str_replace("[!--homepage--]","<?=\$r[homepage]?>",$temptext);
	$temptext=str_replace("[!--adduser--]","<?=\$r[adduser]?>",$temptext);
	$temptext=str_replace("[!--writer--]","<?=\$r[writer]?>",$temptext);
	$temptext=str_replace("[!--filesize--]","<?=\$r[filesize]?>",$temptext);
	$temptext=str_replace("[!--filetype--]","<?=\$r[filetype]?>",$temptext);
	$temptext=str_replace("[!--demo--]","<?=\$r[demo]?>",$temptext);
	$temptext=str_replace("[!--count_all--]","<?=\$r[count_all]?>",$temptext);
	$temptext=str_replace("[!--count_month--]","<?=\$r[count_month]?>",$temptext);
	$temptext=str_replace("[!--count_week--]","<?=\$r[count_week]?>",$temptext);
	$temptext=str_replace("[!--count_day--]","<?=\$r[count_day]?>",$temptext);
	$temptext=str_replace("[!--soft_fj--]","<?=\$r[soft_fj]?>",$temptext);
	$temptext=str_replace("[!--downfen--]","<?=\$r[downfen]?>",$temptext);
	$temptext=str_replace("[!--star--]","<img src='../../data/images/<?=\$r[star]?>star.gif'>",$temptext);
	$temptext=str_replace("[!--soft_version--]","<?=\$r[soft_version]?>",$temptext);
	return $temptext;
}

//���ط��ർ���ַ���
function ReturnClassLink($classid){
	global $class_r,$public_r;
	if(empty($class_r[$classid][featherclass]))
	{
		$class_r[$classid][featherclass]="|";
	}
	$r=explode("|",$class_r[$classid][featherclass].$classid."|");
	$string="<a href=\"".$public_r[sitedown]."\">��ҳ</a>";
	$count=count($r);
	for($i=1;$i<$count-1;$i++)
	{
		$string.="&nbsp;".$public_r[navfh]."&nbsp;<a href=\"".EDReturnClassUrl($r[$i])."\">".$class_r[$r[$i]][classname]."</a>";
    }
	return $string;
}

//����ר�⵼���ַ���
function ReturnZtLink($ztid){
	global $class_zr,$public_r;
	$string="<a href=\"".$public_r[sitedown]."\">��ҳ</a>";
	$string.="&nbsp;".$public_r[navfh]."&nbsp;<a href=\"".EDReturnZtUrl($ztid)."\">".$class_zr[$ztid][ztname]."</a>";
	return $string;
}

//����������͵����ַ���
function ReturnTypeLink($typeid){
	global $class_sr,$public_r;
	$string="<a href=\"".$public_r[sitedown]."\">��ҳ</a>";
	$string.="&nbsp;".$public_r[navfh]."&nbsp;<a href=\"".EDReturnTypeUrl($typeid)."\">".$class_sr[$typeid][softtype]."</a>";
	return $string;
}

//������ĸ�����ַ���
function ReturnZmLink($zm){
	global $public_r;
	$string="<a href=\"".$public_r[sitedown]."\">��ҳ</a>";
	$string.="&nbsp;".$public_r[navfh]."&nbsp;<a href=\"".EDReturnZmUrl($zm)."\">".$zm."</a>";
	return $string;
}

//�����Զ����б����ַ���
function ReturnUserlistLink($id,$listname){
	global $public_r;
	$string="<a href=\"".$public_r[sitedown]."\">��ҳ</a>";
	$string.="&nbsp;".$public_r[navfh]."&nbsp;<a href=\"".EDReturnUserlistUrl($id)."\">".$listname."</a>";
	return $string;
}

//��������б�
function NotSoftListHtml($path,$list_r){
	$word='�����໹û����������';
	$pagetext=$list_r[0].$word.$list_r[2];
	$pagetext=str_replace("[!--show.page--]","",$pagetext);
	$pagetext=str_replace("[!--show.listpage--]","",$pagetext);
	$pagetext=str_replace("[!--list.pageno--]",1,$pagetext);
	WriteFiletext($path,$pagetext);
}

//�����б�
function ListHtml($classid,$listtemp_r,$down=0){
	global $empire,$dbtbpre,$public_r,$class_r,$class_zr,$class_sr;
	$GLOBALS['navclassid']=$classid;
	$selectf='softid,softname,softsay,classid,softtime,homepage,adduser,writer,filesize,filetype,demo,softpic,count_all,count_month,count_week,soft_sq,soft_fj,downfen,star,language,softtype,foruser,soft_version,titleurl,titlefont,count_day,filename,ztid';
	$dotype=$public_r['refiletype'];
	$navadd['topjs']='';
	$navadd['newjs']='';
	$navadd['navclass']='';
	if($down==0)//����
	{
		$cr=$empire->fetch1("select classkey,classintro from {$dbtbpre}downclass where classid='$classid'");
		$pagetitle=$class_r[$classid][classname];
		$pagekey=$cr['classkey'];
		$pagedes=$cr['classintro'];
		$lencord=$class_r[$classid][lencord];//ÿҳ��
		if($class_r[$classid][islast])//�ռ�����
		{
			$where="classid='$classid'";
			$haveclass=0;
			$donavjs=$class_r[$classid][bclassid]?'_'.$class_r[$classid][bclassid]:'';
		}
		else//�����
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
			$haveclass=1;
			$donavjs='_'.$classid;
		}
		$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/".$classid.".js'></script>";
		$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new".$classid.".js'></script>";
		$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class".$donavjs.".js'></script>";
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where ".$where." and checked=1");;
		if($class_r[$classid][maxnum])
		{
			$limit=" limit ".$class_r[$classid][maxnum];
			$limitnum=$class_r[$classid][maxnum];
		}
		$query="select {$selectf} from {$dbtbpre}down where ".$where." and checked=1 order by istop desc,softtime desc".$limit;
		$dolink=$public_r[sitedown].$public_r['relistpath']."/".$classid;
		$dopath="../".$public_r['relistpath']."/".$classid;
		$url="<!--empire.url-->".ReturnClassLink($classid)."<!--empire.url-->";
		$listtempid=$class_r[$classid]['listtempid'];
	}
	elseif($down==1)//ר��
	{
		$cr=$empire->fetch1("select ztkey,ztintro from {$dbtbpre}downzt where ztid='$classid'");
		$lencord=$class_zr[$classid][lencord];
		if($class_zr[$classid][maxnum])
		{
			$limit=" limit ".$class_zr[$classid][maxnum];
			$limitnum=$class_zr[$classid][maxnum];
		}
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where ztid='".$classid."' and checked=1");
		$query="select {$selectf} from {$dbtbpre}down where ztid='".$classid."' and checked=1 order by istop desc,softtime desc".$limit;
		$pagetitle=$class_zr[$classid][ztname];
		$pagekey=$cr[ztkey];
		$pagedes=$cr[ztintro];
		$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/zt".$classid.".js'></script>";
		$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/newzt".$classid.".js'></script>";
		$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
		$dolink=$public_r[sitedown].$public_r['relistpath']."/zt".$classid;
		$dopath="../".$public_r['relistpath']."/zt".$classid;
		$url="<!--empire.url-->".ReturnZtLink($classid)."<!--empire.url-->";
		$listtempid=$class_zr[$classid]['listtempid'];
		$haveclass=1;
	}
	elseif($down==2)//�������
	{
		$lencord=$class_sr[$classid][lencord];
		if($class_sr[$classid][maxnum])
		{
			$limit=" limit ".$class_sr[$classid][maxnum];
			$limitnum=$class_sr[$classid][maxnum];
		}
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where softtype='".$classid."' and checked=1");
		$query="select {$selectf} from {$dbtbpre}down where softtype='".$classid."' and checked=1 order by istop desc,softtime desc".$limit;
		$pagetitle=$class_sr[$classid][softtype];
		$pagekey=$class_sr[$classid][softtype];
		$pagedes=$class_sr[$classid][softtype];
		$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/type".$classid.".js'></script>";
		$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/newtype".$classid.".js'></script>";
		$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
		$dolink=$public_r[sitedown].$public_r['relistpath']."/type".$classid;
		$dopath="../".$public_r['relistpath']."/type".$classid;
		$url="<!--empire.url-->".ReturnTypeLink($classid)."<!--empire.url-->";
		$listtempid=$class_sr[$classid]['listtempid'];
		$haveclass=1;
	}
	elseif($down==3)//��ĸ
	{
		$lencord=$public_r[zmnum];
		if($public_r[zmmaxnum])
		{
			$limit=" limit ".$public_r[zmmaxnum];
			$limitnum=$public_r[zmmaxnum];
		}
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where zm='".$classid."' and checked=1");
		$query="select {$selectf} from {$dbtbpre}down where zm='".$classid."' and checked=1 order by istop desc,softtime desc".$limit;
		$pagetitle=$classid;
		$pagekey=$classid;
		$pagedes=$classid;
		$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/top.js'></script>";
		$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new.js'></script>";
		$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
		$dolink=$public_r[sitedown].$public_r['relistpath']."/zm_".$classid;
		$dopath="../".$public_r['relistpath']."/zm_".$classid;
		$url="<!--empire.url-->".ReturnZmLink($classid)."<!--empire.url-->";
		$listtempid=$public_r[zmlisttempid];
		$haveclass=1;
	}
	elseif($down==4)//��sql��������б�
	{
		$cr=$empire->fetch1("select pagetitle,pagekey,pagedes,totalsql,listsql,lencord,maxnum,listtempid from {$dbtbpre}downuserlist where id='$classid'");
		$cr['listsql']=RepSqlTbpre($cr['listsql']);
		$cr['totalsql']=RepSqlTbpre($cr['totalsql']);
		$lencord=$cr['lencord'];
		$pagetitle=$cr['pagetitle'];
		$pagekey=$cr['pagekey'];
		$pagedes=$cr['pagedes'];
		$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/top.js'></script>";
		$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new.js'></script>";
		$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
		if($cr['maxnum'])
		{
			$limit=" limit ".$cr['maxnum'];
			$limitnum=$cr['maxnum'];
		}
		$query=stripSlashes($cr['listsql']).$limit;
		$totalquery=stripSlashes($cr['totalsql']);
		$num=$empire->gettotal($totalquery);
		$dolink=$public_r[sitedown].$public_r['relistpath']."/list".$classid;
		$dopath="../".$public_r['relistpath']."/list".$classid;
		$url="<!--empire.url-->".ReturnUserlistLink($classid,$cr['pagetitle'])."<!--empire.url-->";
		$listtempid=$cr[listtempid];
		$haveclass=1;
	}
	if(empty($lencord))
	{
		$lencord=25;
	}
	//�б�ģ��
	if(empty($listtemp_r[temptext]))
	{
		$listtemp_r=GetListtemp($listtempid);
	}
	$listtemp=$listtemp_r[temptext];
	$subsay=$listtemp_r[subsay];
	$subtitle=$listtemp_r[subtitle];
	$formatdate=$listtemp_r[showdate];
	//�滻
	$listtemp=Rep_templatevars($listtemp,$url,htmlspecialchars($pagetitle),htmlspecialchars($pagekey),htmlspecialchars($pagedes),$navadd);
	if($down==0)
	{
		$bclassid=$class_r[$classid][bclassid];
		$listtemp=str_replace("[!--bclass.name--]",$class_r[$bclassid][classname],$listtemp);
		$listtemp=str_replace("[!--bclass.id--]",$bclassid,$listtemp);
		$listtemp=str_replace("[!--class.name--]",$pagetitle,$listtemp);
		$listtemp=str_replace("[!--class.id--]",$classid,$listtemp);
	}
	//��ҳ����
	if(strstr($listtemp,"[!--show.page--]"))//����ʽ
	{
		$thefun='sys_ShowListPage';
		$bereplistpage="[!--show.page--]";
	}
	else//�б�ʽ
	{
		$thefun='sys_ShowListMorePage';
		$bereplistpage="[!--show.listpage--]";
	}
	//ȡ���б�ģ��
	$list_exp="[!--empiredown.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	//������
	if(empty($num))
	{
		$noinfopath=$dopath."_1".$dotype;
		NotSoftListHtml($noinfopath,$list_r);
		return "";
	}
	//�����
	if($limitnum&&$limitnum<$num)
	{
		$num=$limitnum;
	}
	$sql=$empire->query($query);
	$no=1;
	$ok=0;
	$page=ceil($num/$lencord);
	while($k=$empire->fetch($sql))
	{
		//�滻�б����
		$string.=Rep_ListTempVars($no,$list_r[1],$subsay,$subtitle,$formatdate,$haveclass,$k);
		if($no%$lencord==0||($num%$lencord<>0&&$num==$no))
		{
			$ok+=1;
			$pagenum=ceil($no/$lencord);
			$string=$list_r[0].$string.$list_r[2];
			//ȡ�÷�ҳ����
			$returnpager=$thefun($num,$pagenum,$dolink,$dotype,$page,$lencord,$ok,$myoptions);
			$showpage=$returnpager['showpage'];
			$myoptions=$returnpager['option'];
			$string=str_replace($bereplistpage,$showpage,$string);
			//�滻��ҳ��
			$string=str_replace("[!--list.pageno--]",$pagenum,$string);
			$path=$dopath."_".$ok.$dotype;
			WriteFiletext($path,$string);
			$string="";
		}
		$no++;
	}
	$empire->free($sql);
}

//ȡ��ģ��
function GetDownTemp($templatename){
	global $empire,$dbtbpre;
	$temp_r=$empire->fetch1("select ".$templatename." from {$dbtbpre}downpubtemp limit 1");
	return $temp_r[$templatename];
}

//������������ҳ
function GetHtml($add,$softtemp_r){
	global $empire,$dbtbpre,$public_r,$class_r,$class_zr,$class_sr,$class_lr,$class_sqr,$level_r;
	//�ⲿ����
	if($add['titleurl']||$add['checked']==0)
	{
		return "";
	}
	$GLOBALS['navclassid']=$add[classid];
	$GLOBALS['navinfor']=$add;
	//ȡ������ģ��
	if(empty($softtemp_r[temptext]))
	{
		$softtemp_r=GetSofttemp($class_r[$add[classid]][softtempid]);
	}
	$temptext=$softtemp_r[temptext];
	$formatdate=$softtemp_r[showdate];
	//������
	$url="<!--empire.url-->".ReturnClassLink($add[classid])."<!--empire.url-->";
	//�滻
	$donavjs=$class_r[$add[classid]][bclassid]?'_'.$class_r[$add[classid]][bclassid]:'';
	$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/".$add[classid].".js'></script>";
	$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new".$add[classid].".js'></script>";
	$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class".$donavjs.".js'></script>";
	$temptext=Rep_templatevars($temptext,$url,htmlspecialchars($add[softname]),htmlspecialchars($add[keyboard]),htmlspecialchars(strip_tags($add[softsay])),$navadd);
	$bclassid=$class_r[$add[classid]][bclassid];
	$temptext=str_replace("[!--bclass.name--]",$class_r[$bclassid][classname],$temptext);
	$temptext=str_replace("[!--bclass.id--]",$bclassid,$temptext);
	$temptext=str_replace("[!--class.name--]",$class_r[$add[classid]][classname],$temptext);
	$temptext=str_replace("[!--class.id--]",$add[classid],$temptext);
	//�ļ�
	$file="../".$public_r['resoftpath']."/".$add[filename].$public_r['refiletype'];
	$downtempstr=$temptext;
	//�������
	$softurl=EDReturnSoftPageUrl($add[filename],$add[titleurl]);
	$downtempstr=str_replace("[!--softurl--]",$softurl,$downtempstr);
	$downtempstr=str_replace("[!--softid--]",$add[softid],$downtempstr);
	//��Ȩ��ʽ
	$downtempstr=str_replace("[!--soft_sq--]",$class_sqr[$add[soft_sq]][sqname],$downtempstr);
	//�������
	$t_softtype="<a href=\"".EDReturnTypeUrl($add[softtype])."\">".$class_sr[$add[softtype]][softtype]."</a>";
	$downtempstr=str_replace("[!--softtype--]",$t_softtype,$downtempstr);
	//����
	$downtempstr=str_replace("[!--language--]",$class_lr[$add[language]][language],$downtempstr);
	//ר��
	$t_ztname="<a href=\"".EDReturnZtUrl($add[ztid])."\">".$class_zr[$add[ztid]][ztname]."</a>";
	$downtempstr=str_replace("[!--ztname--]",$t_ztname,$downtempstr);
	//ͼƬ
	$t_softpic=$add[softpic]?$add[softpic]:$public_r[sitedown]."data/images/notimg.gif";
	$downtempstr=str_replace("[!--softpic--]",$t_softpic,$downtempstr);
	//������
	$softsay=nl2br(GetEBBcode($add[softsay]));
	$downtempstr=str_replace("[!--softsay--]",$softsay,$downtempstr);
	//���ص�ַ
	$all_downpath=ReturnDownSoftHtml($add);
	$downtempstr=str_replace("[!--downpath--]",$all_downpath,$downtempstr);
	//���߹ۿ�
	$all_onlinepath=ReturnOnlinepathHtml($add);
	$downtempstr=str_replace("[!--onlinepath--]",$all_onlinepath,$downtempstr);
	//ʱ��
	$downtempstr=str_replace("[!--softtime--]",date($formatdate,$add[softtime]),$downtempstr);
	//���ؼ���
	$t_foruser=$add[foruser]?$level_r[$add[foruser]][groupname]:"�ο�";
	$downtempstr=str_replace("[!--foruser--]",$t_foruser,$downtempstr);
	$downtempstr=str_replace("[!--downfen--]",$add[downfen],$downtempstr);
	//�ֶ�
	$downtempstr=str_replace("[!--softname--]",$add[softname],$downtempstr);
	$downtempstr=str_replace("[!--adduser--]",$add[adduser],$downtempstr);
	$downtempstr=str_replace("[!--writer--]",$add[writer],$downtempstr);
	$downtempstr=str_replace("[!--filesize--]",$add[filesize],$downtempstr);
	$downtempstr=str_replace("[!--filetype--]",$add[filetype],$downtempstr);
	$downtempstr=str_replace("[!--homepage--]",$add[homepage],$downtempstr);
	$downtempstr=str_replace("[!--soft_version--]",$add[soft_version],$downtempstr);
	$downtempstr=str_replace("[!--count_all--]",$add[count_all],$downtempstr);
	$downtempstr=str_replace("[!--count_week--]",$add[count_week],$downtempstr);
	$downtempstr=str_replace("[!--count_month--]",$add[count_month],$downtempstr);
	$downtempstr=str_replace("[!--count_day--]",$add[count_day],$downtempstr);
	$downtempstr=str_replace("[!--demo--]",$add[demo],$downtempstr);
	$downtempstr=str_replace("[!--soft_fj--]",$add[soft_fj],$downtempstr);
	$downtempstr=str_replace("[!--star--]","<img src='".$public_r[sitedown]."data/images/".$add[star]."star.gif'>",$downtempstr);
	$downtempstr=str_replace("[!--keyboard--]",$add[keyboard],$downtempstr);
	//ȡ��������
	if(strstr($downtempstr,'[!--otherlink--]'))
	{
		$keyboardtext=GetKeyboard($add[keyboard],$add[classid],$class_r[$add[classid]][link_num],$add[softid]);
		$downtempstr=str_replace("[!--otherlink--]",$keyboardtext,$downtempstr);
	}
	WriteFiletext($file,$downtempstr);
}

//ȡ���������
function GetKeyboard($keyboard,$classid,$link_num,$softid){
	global $empire,$dbtbpre,$public_r;
	if($keyboard)
	{
		if(empty($link_num))
		{
			$link_num=10;
		}
		$keyboard=str_replace("'","",$keyboard);
		$r=explode(",",$keyboard);
		for($i=0;$i<count($r);$i++)
		{
			$add.="softname like '%".$r[$i]."%' or ";
		}
		$add=substr($add,0,strlen($add)-4);
		$temp_r=explode("[!--empiredown.listtemp--]",$public_r[otherlinktemp]);
		$key_sql=$empire->query("select softid,softtime,softname,filename,titleurl,softpic,classid from {$dbtbpre}down where (".$add.") and softid<>$softid order by softid desc limit $link_num");
		while($link_r=$empire->fetch($key_sql))
		{
			$keyboardtext.=RepOtherTemp($temp_r[1],$link_r);
		}
		$keyboardtext=$temp_r[0].$keyboardtext.$temp_r[2];
	}
	else
	{
		$keyboardtext="���������";
	}
	return $keyboardtext;
}

//�滻�������ģ��
function RepOtherTemp($temptext,$r){
	global $public_r,$class_r;
	$softname=sub($r[softname],0,$public_r['otherlinktempsub'],false);
	$temptext=str_replace("[!--softname--]",$softname,$temptext);
	$temptext=str_replace("[!--oldsoftname--]",$r[softname],$temptext);
	$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
	$temptext=str_replace("[!--softurl--]",$softurl,$temptext);
	//ʱ��
	$r['softtime']=date($public_r['otherlinktempdate'],$r['softtime']);
	$temptext=str_replace("[!--softtime--]",$r[softtime],$temptext);
	//��ͼ
	$softpic=$r[softpic]?$r[softpic]:$public_r[sitedown]."data/images/notimg.gif";
	$temptext=str_replace("[!--softpic--]",$softpic,$temptext);
	$temptext=str_replace("[!--softid--]",$r[softid],$temptext);
	//����
	$classname=EdReturnClassname($r[classid]);
	$temptext=str_replace("[!--classname--]",$classname,$temptext);
	$classurl=EDReturnClassUrl($r[classid]);
	$temptext=str_replace("[!--classurl--]",$classurl,$temptext);
	$temptext=str_replace("[!--classid--]",$r[classid],$temptext);
	return $temptext;
}

//�������ص�ַhtml����
function ReturnDownSoftHtml($add){
	global $class_r,$public_r,$level_r;
	if(empty($add[downpath]))
	{
		return "";
	}
	//ÿ����ʾ����
	$down_num=$class_r[$add[classid]][downnum];
	if(empty($down_num))
	{
		$down_num=1;
	}
	//��ϵ�ַ
	$all_downpath="";
	$path_r=explode("\r\n",$add[downpath]);
	$count=count($path_r);
    for($pj=0;$pj<$count;$pj++)
    {
		$p=$pj+1;
        if($p%$down_num==0)
        {
			$ok="<br>";
		}
        else
        {
			$ok="";
		}
		//��ͬ
		if($count==$p)
		{
			$ok="";
		}
		if($pj%$down_num==0||$pj==0)
        {
			$nbsp="";
		}
        else
        {
			$nbsp="&nbsp;&nbsp;";
		}
	    $showdown_r=explode("::::::",$path_r[$pj]);
	    if(count($showdown_r)<2)
		{
			$showdown_r[0]='���ص�ַ'.$p;
		}
		//ģ��
		$downsofttemp=RepDownOnlinePathTemp($add,stripSlashes(stripSlashes($public_r[downsofttemp])),$pj,$showdown_r,0);
        $all_downpath.=$nbsp.stripSlashes($downsofttemp).$ok;
    }
	$value=$all_downpath;
	return $value;
}

//�滻�������ߵ�ַģ��
function RepDownOnlinePathTemp($add,$downsofttemp,$pj,$showdown_r,$phome){
	global $public_r,$level_r;
	if($phome==0)//����
	{
		$downurl=$public_r[sitedown]."DownSoft/?softid=$add[softid]&pathid=$pj";
	}
	else//����
	{
		$downurl=$public_r[sitedown]."play/?softid=$add[softid]&pathid=$pj";
	}
	$downsofttemp=str_replace("[!--down.url--]",$downurl,$downsofttemp);
	$downsofttemp=str_replace("[!--down.name--]",$showdown_r[0],$downsofttemp);
	$downsofttemp=str_replace("[!--pathid--]",$pj,$downsofttemp);
	$downsofttemp=str_replace("[!--classid--]",$add[classid],$downsofttemp);
	$downsofttemp=str_replace("[!--softid--]",$add[softid],$downsofttemp);
	$downsofttemp=str_replace("[!--softname--]",$add[softname],$downsofttemp);
	$downsofttemp=str_replace("[!--fen--]",$showdown_r[3],$downsofttemp);
	$group=$showdown_r[2]?$level_r[$showdown_r[2]][groupname]:'�ο�';
	$downsofttemp=str_replace("[!--group--]",$group,$downsofttemp);
	if(strstr($downsofttemp,'[!--true.down.url--]'))
	{
		$durl=stripSlashes($showdown_r[1]);
		$durlr=ReturnDownQzPath($durl,$showdown_r[4]);
		$durl=$durlr['repath'];
		$downsofttemp=str_replace("[!--true.down.url--]",$durl,$downsofttemp);
	}
	return $downsofttemp;
}

//�������ߵ�ַhtml����
function ReturnOnlinepathHtml($add){
	global $class_r,$public_r,$level_r;
	if(empty($add[onlinepath]))
	{
		return "";
	}
	//ÿ����ʾ����
	$down_num=$class_r[$add[classid]][onlinenum];
	if(empty($down_num))
	{
		$down_num=1;
	}
	$all_downpath="";
	$path_r=explode("\r\n",$add[onlinepath]);
	$count=count($path_r);
    for($pj=0;$pj<$count;$pj++)
    {
		$p=$pj+1;
        if($p%$down_num==0)
        {
			$ok="<br>";
		}
        else
        {
			$ok="";
		}
		//��ͬ
		if($count==$p)
		{
			$ok="";
		}
		if($pj%$down_num==0||$pj==0)
        {
			$nbsp="";
		}
        else
        {
			$nbsp="&nbsp;&nbsp;";
		}
	    $showdown_r=explode("::::::",$path_r[$pj]);
	    if(count($showdown_r)<2)
		{
			$showdown_r[0]=$p;
		}
		//ģ��
		$downsofttemp=RepDownOnlinePathTemp($add,stripSlashes(stripSlashes($public_r[onlinesofttemp])),$pj,$showdown_r,1);
        $all_downpath.=$nbsp.stripSlashes($downsofttemp).$ok;
	}
	$value=$all_downpath;
	return $value;
}

//ȡ������
function GetLanguage($languageid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select language from {$dbtbpre}language where languageid='$languageid'");
	return $r[language];
}

//ȡ���������
function GetSofttype($softtypeid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select softtype from {$dbtbpre}softtype where softtypeid='$softtypeid'");
	return $r[softtype];
}

//ȡ����Ȩ
function GetSq($sqid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select sqname from {$dbtbpre}sq where sqid='$sqid'");
	return $r[sqname];
}

//���ص�ַ���
function ReturnDown($downname,$downpath,$delpathid,$pathid,$downuser,$fen,$thedownqz,$add,$foruser,$downurl,$down=0){
	$f_exp="::::::";
	$r_exp="\r\n";
	$returnstr="";
	$downurl=str_replace($f_exp,"",$downurl);
	$downurl=str_replace($r_exp,"",$downurl);
	//�������
	if(empty($down))
	{
		for($i=0;$i<count($downname);$i++)
		{
			//�滻�Ƿ��ַ�
			$name=str_replace($f_exp,"",$downname[$i]);
			$name=str_replace($r_exp,"",$downname[$i]);
			$path=str_replace($f_exp,"",$downpath[$i]);
			$path=str_replace($r_exp,"",$downpath[$i]);
			//��������Ȩ��
			if($add[doforuser])
			{
				if(empty($foruser))
				{
					$foruser=0;
			    }
				$fuser=$foruser;
		    }
			else
			{
				if(empty($downuser[$i]))
				{
					$fuser=0;
			    }
				else
				{
					$fuser=$downuser[$i];
				}
		    }
			//�������µ���
			if($add[dodownfen])
			{
				if(empty($add[downfen]))
				{
					$add[downfen]=0;
				}
				$ffen=$add[downfen];
			}
			else
			{
				if(empty($fen[$i]))
				{
					$ffen=0;
				}
				else
				{
					$ffen=$fen[$i];
				}
			}
			$downqz=$thedownqz[$i];
			if($path&&$name)
			{$returnstr.=$name.$f_exp.$downurl.$path.$f_exp.$fuser.$f_exp.$ffen.$f_exp.$downqz.$r_exp;}
		}
	}
	else//�޸����
	{
		for($i=0;$i<count($downname);$i++)
		{
			//ɾ�����ص�ַ
			$del=0;
			for($j=0;$j<count($delpathid);$j++)
			{
				if($delpathid[$j]==$pathid[$i])
				{$del=1;}
			}
			if($del)
			{continue;}
			//�滻�Ƿ��ַ�
			$name=str_replace($f_exp,"",$downname[$i]);
			$name=str_replace($r_exp,"",$downname[$i]);
			$path=str_replace($f_exp,"",$downpath[$i]);
			$path=str_replace($r_exp,"",$downpath[$i]);
			//��������Ȩ��
			if($add[doforuser])
			{
				if(empty($foruser))
				{
					$foruser=0;
			    }
				$fuser=$foruser;
		    }
			else
			{
				if(empty($downuser[$i]))
				{
					$fuser=0;
			    }
				else
				{
					$fuser=$downuser[$i];
				}
		    }
			//�������µ���
			if($add[dodownfen])
			{
				if(empty($add[downfen]))
				{
					$add[downfen]=0;
				}
				$ffen=$add[downfen];
			}
			else
			{
				if(empty($fen[$i]))
				{
					$ffen=0;
				}
				else
				{
					$ffen=$fen[$i];
				}
			}
			$downqz=$thedownqz[$i];
			if($path&&$name)
			{$returnstr.=$name.$f_exp.$downurl.$path.$f_exp.$fuser.$f_exp.$ffen.$f_exp.$downqz.$r_exp;}
		}
	}
	//ȥ�������ַ�
	$returnstr=substr($returnstr,0,strlen($returnstr)-2);
	$returnstr=str_replace("'","",$returnstr);
	return $returnstr;
}

//-�滻Ŀ¼ֵ
function RepPathStr($path){
	$path=str_replace("\\","",$path);
	$path=str_replace("/","",$path);
	return $path;
}

//�����ļ�����
function GetPublic(){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}downpublic limit 1");
	$tr=$empire->fetch1("select downsofttemp,onlinesofttemp,listpagetemp,otherlinktemp,otherlinktempsub,otherlinktempdate from {$dbtbpre}downpubtemp limit 1");
	$GLOBALS['public_r']['sitedown']=$r['sitedown'];
	$classnavs=GetClassNavCache($r[classnavline],$r[classnavfh]);
	$file="../data/cache/public.php";
	$string="<?php
\$public_r=array('sitename'=>'".addslashes($r[sitename])."',
'sitedown'=>'".addslashes($r[sitedown])."',
'email'=>'".addslashes($r[email])."',
'downpath'=>'".addslashes($r[downpath])."',
'trantype'=>'".addslashes($r[trantype])."',
'transize'=>".$r[transize].",
'topnum'=>".$r[topnum].",
'save_soft'=>".$r[save_soft].",
'relist_num'=>".$r[relist_num].",
'resoft_num'=>".$r[resoft_num].",
'openregister'=>".$r[openregister].",
'openadd'=>".$r[openadd].",
'checked'=>".$r[checked].",
'newnum'=>".$r[newnum].",
'sub_top'=>".$r[sub_top].",
'sub_new'=>".$r[sub_new].",
'exittime'=>".$r[exittime].",
'defaultgroupid'=>".$r[defaultgroupid].",
'bakdbpath'=>'".addslashes($r[bakdbpath])."',
'bakdbzip'=>'".addslashes($r[bakdbzip])."',
'downpass'=>'".addslashes($r[downpass])."',
'redodown'=>".$r[redodown].",
'reindextime'=>".$r[reindextime].",
'defaultlistid'=>".$r[defaultlistid].",
'dohtml'=>".$r[dohtml].",
'repnum'=>".$r[repnum].",
'ebakthisdb'=>".$r[ebakthisdb].",
'limittype'=>".$r[limittype].",
'filechmod'=>".$r[filechmod].",
'defdownnum'=>".$r[defdownnum].",
'defonlinenum'=>".$r[defonlinenum].",
'imgtrantype'=>'".addslashes($r[imgtrantype])."',
'imgtransize'=>".$r[imgtransize].",
'qtrantype'=>'".addslashes($r[qtrantype])."',
'qtransize'=>".$r[qtransize].",
'qimgtrantype'=>'".addslashes($r[qimgtrantype])."',
'qimgtransize'=>".$r[qimgtransize].",
'ebakcanlistdb'=>".$r[ebakcanlistdb].",
'refiletype'=>'".addslashes($r[refiletype])."',
'relistpath'=>'".addslashes($r[relistpath])."',
'resoftpath'=>'".addslashes($r[resoftpath])."',
'retime'=>".$r[retime].",
'sitekey'=>'".addslashes($r[sitekey])."',
'siteintro'=>'".addslashes($r[siteintro])."',
'openpl'=>".$r[openpl].",
'plsize'=>".$r[plsize].",
'plcloseword'=>'".addslashes($r[plcloseword])."',
'adminloginkey'=>".$r[adminloginkey].",
'loginkey'=>".$r[loginkey].",
'registerkey'=>".$r[registerkey].",
'opengetdown'=>".$r[opengetdown].",
'navfh'=>'".addslashes($r[navfh])."',
'zmnum'=>".$r[zmnum].",
'zmmaxnum'=>".$r[zmmaxnum].",
'zmlisttempid'=>".$r[zmlisttempid].",
'adfile'=>'".addslashes($r[adfile])."',
'gg_num'=>".$r[gg_num].",
'downsofttemp'=>'".addslashes(stripSlashes($tr[downsofttemp]))."',
'onlinesofttemp'=>'".addslashes(stripSlashes($tr[onlinesofttemp]))."',
'listpagetemp'=>'".addslashes(stripSlashes($tr[listpagetemp]))."',
'otherlinktemp'=>'".addslashes(stripSlashes($tr[otherlinktemp]))."',
'otherlinktempdate'=>'".addslashes($tr[otherlinktempdate])."',
'otherlinktempsub'=>".$tr[otherlinktempsub].",
'classnavs'=>'".addslashes($classnavs)."',
'regdownfen'=>".$r[regdownfen].",
'dozthtml'=>".$r[dozthtml].",
'memberchecked'=>".$r[memberchecked].",
'checkresoftname'=>".$r[checkresoftname].",
'reuserpagenum'=>".$r[reuserpagenum].",
'listpagelistnum'=>".$r[listpagelistnum].",
'emailonly'=>".$r[emailonly].",
'plkey'=>".$r[plkey].");";
	WriteFiletext_n($file,$string);
}

//���ز���Ȩ��
function ReturnLeftLevel($groupid){
	global $empire,$dbtbpre;
	if(empty($groupid))
	{return "";}
	$groupid=(int)$groupid;
	$r=$empire->fetch1("select * from {$dbtbpre}downgroup where groupid='$groupid'");
	return $r;
}

//���ز���Ȩ��
function CheckLevel($userid,$username,$classid,$enews){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select groupid,adminclass from {$dbtbpre}downuser where userid='$userid' limit 1");
	//��������
	if($enews=="soft")
	{
		//����������ĿȨ��
		$gr=$empire->fetch1("select doall from {$dbtbpre}downgroup where groupid='$r[groupid]'");
		if(empty($gr[doall]))
		{
			$e_r=explode("|".$classid."|",$r[adminclass]);
			if(count($e_r)!=2)
			{printerror("����Ȩ�����˷���","history.go(-1)");}
		}
    }
	else
	{
		//�û���
		$gr=$empire->fetch1("select * from {$dbtbpre}downgroup where groupid='$r[groupid]'");
		$enews="do".$enews;
		if(empty($gr[$enews]))
		{
			printerror("����Ȩ�����˹���","history.go(-1)");
	    }
    }
}

//���ɹ����ļ�
function GetGgHtml(){
	global $empire,$dbtbpre,$public_r;
	//ȡ��ģ��
	$ggtemp=GetDownTemp("ggtemp");
	$exp_str="[!--empiredown.listtemp--]";
	$pagetitle='��վ����';
	$pagekey='��վ����';
	$pagedes='��վ����';
	$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/top.js'></script>";
	$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new.js'></script>";
	$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
	//������
	$url="<!--empire.url--><a href='".$public_r[sitedown]."'>��ҳ</a>&nbsp;>&nbsp;��վ����<!--empire.url-->";
	//����ģ�����
	$ggtemp=Rep_templatevars($ggtemp,$url,$pagetitle,$pagekey,$pagedes,$navadd);
	$gg_r=explode($exp_str,$ggtemp);
	$sql=$empire->query("select ggid,title,ggtext,ggtime from {$dbtbpre}downgg order by ggid desc");
	while($r=$empire->fetch($sql))
	{
		$gg=$gg_r[1];
		$gg=str_replace("[!--ggid--]",$r[ggid],$gg);
		$gg=str_replace("[!--title--]",$r[title],$gg);
		$gg=str_replace("[!--ggtext--]",nl2br(GetEBBcode($r[ggtext])),$gg);
		$gg=str_replace("[!--ggtime--]",$r[ggtime],$gg);
		$allgg.=$gg;
	}
	$string=$gg_r[0].$allgg.$gg_r[2];
	$filename="../".$public_r['relistpath']."/gg".$public_r['refiletype'];
	WriteFiletext($filename,$string);
}

//ȡ�������ļ�����
function GetSearch(){
	global $empire,$public_r,$dbtbpre;
	//ȡ��ģ��
	$t_r=$empire->fetch1("select searchjstemp1,searchjstemp2,searchformtemp from {$dbtbpre}downpubtemp limit 1");
	//���ط���
	$fcjsfile="../data/fc/searchclass.js";
	if(file_exists($fcjsfile))
	{
		$options=GetFcfiletext($fcjsfile);
	}
	else
	{
		$options=ShowClass_AddClass("","n",0,"|-",1);
	}
	$text="";
	//--- ��������
	$text2=str_replace("[!--class--]",$options,$t_r[searchjstemp1]);
	$text2=str_replace("[!--edown.url--]",$public_r[sitedown],$text2);
	$text2=$text."document.write(\"".$text2."\");";
	//--- ��������
	$text3=str_replace("[!--class--]",$options,$t_r[searchjstemp2]);
	$text3=str_replace("[!--edown.url--]",$public_r[sitedown],$text3);
	$text3=$text."document.write(\"".$text3."\");";
	//--- �߼�����
	//ȡ���������
	$languagesql=$empire->query("select languageid,language from {$dbtbpre}language");
	while($language_r=$empire->fetch($languagesql))
	{
		$language.="<option value='".$language_r[languageid]."'>".$language_r[language]."</option>";
	}
	//ȡ���������
	$softtypesql=$empire->query("select softtypeid,softtype from {$dbtbpre}softtype");
	while($softtype_r=$empire->fetch($softtypesql))
	{
		$softtype.="<option value='".$softtype_r[softtypeid]."'>".$softtype_r[softtype]."</option>";
	}
	//ȡ�������Ȩ
	$sqsql=$empire->query("select sqid,sqname from {$dbtbpre}sq");
	while($sq_r=$empire->fetch($sqsql))
	{
		$sq.="<option value='".$sq_r[sqid]."'>".$sq_r[sqname]."</option>";
	}
	//ȡ��ר��
	$ztsql=$empire->query("select ztid,ztname from {$dbtbpre}downzt");
	while($zt_r=$empire->fetch($ztsql))
	{
		$zt.="<option value='".$zt_r[ztid]."'>".$zt_r[ztname]."</option>";
	}
	$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/top.js'></script>";
	$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new.js'></script>";
	$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
	$url="<a href='".$public_r[sitedown]."'>��ҳ</a>&nbsp;>&nbsp;�߼�����";
	//����ģ�����
	$s=Rep_templatevars($t_r[searchformtemp],$url,'�߼�����','�߼�����','�߼�����',$navadd);
	//ȡ������ģ��
	$s=str_replace("[!--class--]",$options,$s);
    $s=str_replace("[!--zt--]",$zt,$s);
	$s=str_replace("[!--softtype--]",$softtype,$s);
	$s=str_replace("[!--language--]",$language,$s);
	$s=str_replace("[!--soft_sq--]",$sq,$s);
	$text4=$s;
	//------------�������ѡ��
	$options1=ShowClass_AddClass("","n",0,"|-",2);
	$addsoft="document.write(\"<select name=classid><option value=0>ѡ�����</option>".$options1."</select>\");";
	$filename="../data/js/search_soft1.js";
	WriteFiletext($filename,$text2);
	$filename1="../data/js/search_soft2.js";
	WriteFiletext($filename1,$text3);
	$filename2="../".$public_r['relistpath']."/search".$public_r['refiletype'];
	WriteFiletext($filename2,$text4);
	$filename3="../data/js/addsoft_class.js";
	WriteFiletext($filename3,$addsoft);
}

//���ɷ��ർ���ļ�
function GetSoftClass(){
	global $empire,$public_r,$dbtbpre;
	//ȡ��ģ��
	$temp_r=$empire->fetch1("select softclasstemp,softclassbgcolor,softclasstdcolor,softclassnum from {$dbtbpre}downpubtemp limit 1");
	$sql=$empire->query("select classname,classid from {$dbtbpre}downclass where bclassid=0");
	while($r=$empire->fetch($sql))
	{
		$text.="<table width='100%' border=0 cellpadding=3 cellspacing=1 bgcolor='".$temp_r[softclassbgcolor]."'><tr><td><strong>&nbsp;<a href='".EDReturnClassUrl($r[classid])."'>".$r[classname]."</a></strong></td></tr><tr><td bgcolor='".$temp_r[softclasstdcolor]."'>";
		$sql1=$empire->query("select classname,classid from {$dbtbpre}downclass where bclassid='$r[classid]'");
		$i=0;
		$class_text="";
		while($r1=$empire->fetch($sql1))
		{
			$i++;
			if(($i-1)%$temp_r[softclassnum]==0||$i==1)
			{
				$class_text.="<tr>";
			}
			$class_text.="<td align='center' height=25><a href='".EDReturnClassUrl($r1[classid])."'>".$r1[classname]."</a></td>";
			//�ָ�
			if($i%$temp_r[softclassnum]==0)
			{
				$class_text.="</tr>";
			}
		}
		$table='';
		$table1='';
		if($i<>0)
		{
			$table="<table width='100%' border=0 cellpadding=3 cellspacing=1>";
			$table1="</table>";
			$ys=$temp_r[softclassnum]-$i%$temp_r[softclassnum];
			$p=0;
			for($j=0;$j<$ys&&$ys!=$temp_r[softclassnum];$j++)
			{
				$p=1;
				$class_text.="<td>&nbsp;</td>";
			}
			if($p==1)
			{
				$class_text.="</tr>";
			}
		}
		$text.=$table.$class_text.$table1."</td></tr></table>";
	}
	$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/top.js'></script>";
	$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new.js'></script>";
	$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
	$url="<a href='".$public_r[sitedown]."'>��ҳ</a>&nbsp;>&nbsp;���ط���";
	//����ģ�����
	$temp_r[softclasstemp]=Rep_templatevars($temp_r[softclasstemp],$url,'���ط���','���ط���','���ط���',$navadd);
	$text=str_replace('[!--empiredown.template--]',$text,$temp_r[softclasstemp]);
	$file="../".$public_r['relistpath']."/class".$public_r['refiletype'];
	WriteFiletext($file,$text);
}

//���¿������ģ��
function ChangeMemberCpPage(){
	global $empire,$public_r,$dbtbpre;
	//ȡ��ģ��
	$temptext=GetDownTemp("cptemp");
	$file1="../data/template/cp_1.php";
	$file2="../data/template/cp_2.php";
	$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/top.js'></script>";
	$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new.js'></script>";
	$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
	//����ģ�����
	$temptext=Rep_templatevars($temptext,"<?=\$url?>","��Ա����","��Ա����","��Ա����",$navadd);
	$temp_r=explode('[!--empiredown.template--]',$temptext);
	WriteFiletext($file1,$temp_r[0]);
	WriteFiletext($file2,$temp_r[1]);
}

//ɾ�������б��ļ�
function DelListFile($classid,$lencord,$num){
	global $public_r;
	$page=ceil($num/$lencord);
	for($j=1;$j<=$page;$j++)
	{
		$listfile="../".$public_r['relistpath']."/".$classid."_".$j.$public_r['refiletype'];
		DelFiletext($listfile);
	}
}

//���ɷ��ർ��
function ClassJS($bclassid,$classid,$temp,$down=0){
	global $empire,$public_r,$dbtbpre;
	if(!$bclassid&&!$classid)
	{
		$add="bclassid=0";
		$file="../data/js/class.js";
	}
	else
	{
		$add="bclassid='$classid'";
		$file="../data/js/class_".$classid.".js";
	}
	$sql=$empire->query("select classid,classname,sonclass,islast from {$dbtbpre}downclass where ".$add." order by myorder");
	//ȡ��ģ��
	if(empty($temp))
	{
		$temp=stripSlashes(RepJsTemptext(GetDownTemp("navtemp")));
	}
	$temp=str_replace('[!--edown.url--]',$public_r[sitedown],$temp);
	$havenum=0;
	if(strstr($temp,'[!--num--]'))
	{
		$havenum=1;
	}
	$temp_r=explode("[!--empiredown.listtemp--]",$temp);
	while($r=$empire->fetch($sql))
	{
		if($havenum==1)
		{
			if($r[islast])//�ռ����
			{
				$where="classid='$r[classid]'";
			}
			else
			{
				$where=ReturnClass($r[sonclass]);
			}
			$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where ".$where." and checked=1");
		}
		$string.=RepNavtemp($r,$temp_r[1],$num,$havenum);
	}
	$string=addslashes($temp_r[0].$string.$temp_r[2]);
	$string="document.write(\"".$string."\");";
	WriteFiletext_n($file,$string);
}

//�滻��Ŀ����jsģ��
function RepNavtemp($r,$temp,$num,$havenum=0){
	global $public_r;
	$classname=$r[classname];
	$classurl=EDReturnClassUrl($r[classid]);
	$temp=str_replace("[!--classid--]",$r[classid],$temp);
	$temp=str_replace("[!--classname--]",$classname,$temp);
	$temp=str_replace("[!--classurl--]",$classurl,$temp);
	if($havenum==1)
	{
		$temp=str_replace("[!--num--]",$num,$temp);
	}
	return $temp;
}

//����search�ļ�
function ReSearchFile($temptext){
	global $empire,$public_r,$dbtbpre;
	//ȡ��ģ��
	$sr=$empire->fetch1("select searchtemp,schsubtitle,schsubsay,schformatdate from {$dbtbpre}downpubtemp limit 1");
	$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/top.js'></script>";
	$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new.js'></script>";
	$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
	//�滻����
	$searchtemp=Rep_templatevars($sr[searchtemp],"<?=\$url?>","�������","�������","�������",$navadd);
	$searchtemp=str_replace("[!--show.page--]","<?=\$listpage?>",$searchtemp);
	$searchtemp=str_replace("[!--keyboard--]","<?=\$keyboard?>",$searchtemp);
	$listtemp_exp="[!--empiredown.listtemp--]";
	$list_r=explode($listtemp_exp,$searchtemp);
	//ȡ��search�ļ�����
	$file="../data/template/searchtemp.txt";
	$old_str=ReadFiletext($file);
	$old_str=str_replace("[!--strlen--]",$sr[schsubsay],$old_str);
	$old_str=str_replace("[!--subtitle--]",$sr[schsubtitle],$old_str);
	$old_str=str_replace("[!--formatdate--]",$sr[schformatdate],$old_str);
	$search_list_top="<!--empire.listtemp.top-->";
	$search_list_center="<!--empire.listtemp.center-->";
	$search_list_footer="<!--empire.listtemp.footer-->";
	$return_search=SearchListTemp($list_r[1]);
	$new_str=str_replace($search_list_top,$list_r[0],$old_str);
	$new_str=str_replace($search_list_center,$return_search,$new_str);
	$new_str=str_replace($search_list_footer,$list_r[2],$new_str);
	$newfile="../search/result/index.php";
	WriteFiletext($newfile,$new_str);
}

//COOKIE����
function DoECookieRnd($userid,$username,$rnd,$dbdata,$groupid){
	global $do_ecookiernd;
	$ecmsckpass=md5(md5($rnd.$do_ecookiernd).'-'.$userid.'-'.$username.'-'.$dbdata.$rnd.$groupid);
	esetcookie("loginecmsckpass",$ecmsckpass,0);
}

function DoChECookieRnd($userid,$username,$rnd,$dbdata,$groupid){
	global $do_ecookiernd;
	$ecmsckpass=md5(md5($rnd.$do_ecookiernd).'-'.$userid.'-'.$username.'-'.$dbdata.$rnd.$groupid);
	if($ecmsckpass<>getcvar('loginecmsckpass'))
	{
		printerror("����δ��½","index.php");
	}
}

//�Ƿ��½
function is_login($uid=0,$uname='',$urnd=''){
	global $empire,$public_r,$dbtbpre;
	$userid=$uid?$uid:getcvar('dloginuid');
	$username=$uname?$uname:getcvar('dloginuname');
	$rnd=$urnd?$urnd:getcvar('dloginrnd');
	$userid=(int)$userid;
	$username=RepPostVar($username);
	$rnd=RepPostVar($rnd);
	if(!$userid||!$username||!$rnd)
	{
		printerror("����δ��½","index.php");
	}
	$groupid=(int)getcvar('dlogingroupid');
	//COOKIE��֤
	if(getcvar('dloginuname'))
	{
		$cdbdata=getcvar('ecmsdodbdata')?1:0;
		DoChECookieRnd($userid,$username,$rnd,$cdbdata,$groupid);
	}
	$num=$empire->num("select userid from {$dbtbpre}downuser where userid='$userid' and username='".$username."' and rnd='".$rnd."' limit 1");
	if(!$num)
	{
		printerror("ͬһ�ʺ�ͬʱֻ��һ������","index.php");
	}
	//��½��ʱ
	$logintime=getcvar('logintime');
	if($logintime)
	{
		if(time()-$logintime>$public_r[exittime]*60)
		{
			printerror("��½��ʱ","index.php");
	    }
		esetcookie("logintime",time(),0);
	}
	$ur[userid]=$userid;
	$ur[username]=$username;
	$ur[rnd]=$rnd;
	$ur[groupid]=$groupid;
	return $ur;
}

//�Ƿ��½
function is_login_ebak($userid,$username,$rnd){
	global $empire,$public_r,$dbtbpre;
	$userid=(int)$userid;
	$username=RepPostVar($username);
	$dodbdata=getcvar('ecmsdodbdata');
	if(!$userid||!$username)
	{
		printerror("����δ��½","index.php");
	}
	if($dodbdata!="empirecms")
	{
		printerror("����δ��½","index.php");
	}
	$rnd=RepPostVar($rnd);
	//COOKIE��֤
	$cdbdata=$dodbdata?1:0;
	$groupid=(int)getcvar('dlogingroupid');
	DoChECookieRnd($userid,$username,$rnd,$cdbdata,$groupid);
	//��½��ʱ
	$logintime=getcvar('logintime');
	if($logintime)
	{
		if(time()-$logintime>$public_r[exittime]*60)
        {
			printerror("��½��ʱ","index.php");
	    }
		esetcookie("logintime",time(),0);
	}
	$ur[userid]=$userid;
	$ur[username]=$username;
	$ur[rnd]=$rnd;
	$ur[groupid]=$groupid;
	return $ur;
}

//����ͶƱjs
function GetVoteJs($voteid){
	global $empire,$public_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}downvote where voteid='$voteid'");
	//ģ��
	$votetemp=GetDownTemp("votetemp");
	$votetemp=RepJsTemptext($votetemp);
	$votetemp=RepVoteTempAllvar($votetemp,$r);
	$listexp="[!--empiredown.listtemp--]";
	$listtemp_r=explode($listexp,$votetemp);
	$file="../data/js/vote/vote".$voteid.".js";
	$r_exp="\r\n";
	$f_exp="::::::";
	//��Ŀ��
	$r_r=explode($r_exp,$r[votetext]);
	$checked=0;
	for($i=0;$i<count($r_r);$i++)
	{
		$checked++;
		$f_r=explode($f_exp,$r_r[$i]);
		//ͶƱ����
		if($r[voteclass])
		{$vote="<input type=checkbox name=vote[] value=".$checked.">";}
		else
		{$vote="<input type=radio name=vote value=".$checked.">";}
		$votetext.=RepVoteTempListvar($listtemp_r[1],$vote,$f_r[0]);
    }
	$votetext="document.write(\"".addslashes(stripSlashes($listtemp_r[0].$votetext.$listtemp_r[2]))."\");";
	WriteFiletext_n($file,$votetext);
}

//�滻ͶƱģ���������
function RepVoteTempAllvar($temptext,$r){
	global $public_r;
	$action=$public_r['sitedown']."phome/index.php";
	$temptext=str_replace("[!--edown.url--]",$public_r['sitedown'],$temptext);
	$temptext=str_replace("[!--vote.action--]",$action,$temptext);
	$temptext=str_replace("[!--title--]",$r[title],$temptext);
	$viewurl=$public_r[sitedown]."vote?voteid=".$r[voteid];
	$temptext=str_replace("[!--vote.view--]",$viewurl,$temptext);
	$temptext=str_replace("[!--width--]",$r[width],$temptext);
	$temptext=str_replace("[!--height--]",$r[height],$temptext);
	$temptext=str_replace("[!--voteid--]",$r[voteid],$temptext);
	return $temptext;
}

//�滻ͶƱģ���б�
function RepVoteTempListvar($temptext,$votebox,$votename){
	$temptext=str_replace("[!--vote.box--]",$votebox,$temptext);
	$temptext=str_replace("[!--vote.name--]",$votename,$temptext);
	return $temptext;
}

//js����ȥ���س�
function RepJsTemptext($temptext){
	return str_replace("\r\n","",$temptext);
}

//���ɹ���js
function GetGgJs(){
	global $empire,$dbtbpre,$public_r;
	$sql=$empire->query("select ggid,title,ggtime,ggtext from {$dbtbpre}downgg order by ggid desc limit ".$public_r[gg_num]);
	//ȡ��ģ��
	$temp=GetDownTemp("ggjstemp");
	$temp=RepJsTemptext($temp);
	$temp_r=explode("[!--empiredown.listtemp--]",$temp);
	while($r=$empire->fetch($sql))
	{
		$string.=RepGgjstemp($r,$temp_r[1]);
	}
	$string=addslashes(stripSlashes($temp_r[0].$string.$temp_r[2]));
	$string="document.write(\"".$string."\");";
	$filename="../data/js/gg.js";
	WriteFiletext_n($filename,$string);
	//���ɹ����ļ�
	GetGgHtml();
}

//�滻����js
function RepGgjstemp($r,$temp){
	global $public_r;
	$t=explode(" ",$r[ggtime]);
	$title="<a href='".EDReturnGgUrl()."?#gg".$r[ggid]."' target=_blank>".$r[title]."</a>";
	$temp=str_replace("[!--ggid--]",$r[ggid],$temp);
	$temp=str_replace("[!--title--]",$title,$temp);
	$temp=str_replace("[!--ggtime--]",$t[0],$temp);
	$temp=str_replace("[!--ggtext--]",$r[ggtext],$temp);
	return $temp;
}

//����JS
function ReEdownJs($classid,$line,$sub,$showdate,$edown=0,$tempr){
	global $empire,$dbtbpre,$class_r,$public_r;
	if($edown==6||$edown==7||$edown==8||$edown==9||$edown==10||$edown==11)
	{
		if($class_r[$classid][islast])//�ռ����
		{
			$where="classid='$classid'";
		}
		else
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
		}
	}
	if($edown==0)//��������
	{
		$query="checked=1";
		$order="softtime";
		$js="new.js";
	}
	elseif($edown==1)//�����Ƽ�
	{
		$query="isgood=1 and checked=1";
		$order="softtime";
		$js="good.js";
	}
	elseif($edown==2)//����������
	{
		$query="checked=1";
		$order="count_all";
		$js="top.js";
	}
	elseif($edown==3)//����������
	{
		$query="checked=1";
		$order="count_month";
		$js="topmonth.js";
	}
	elseif($edown==4)//����������
	{
		$query="checked=1";
		$order="count_week";
		$js="topweek.js";
	}
	elseif($edown==5)//����������
	{
		$query="checked=1";
		$order="count_day";
		$js="topday.js";
	}
	//����
	elseif($edown==6)//��������
	{
		$query="(".$where.") and checked=1";
		$order="softtime";
		$js="new".$classid.".js";
	}
	elseif($edown==7)//�����Ƽ�
	{
		$query="isgood=1 and (".$where.") and checked=1";
		$order="softtime";
		$js="good".$classid.".js";
	}
	elseif($edown==8)//����������
	{
		$query="(".$where.") and checked=1";
		$order="count_all";
		$js=$classid.".js";
	}
	elseif($edown==9)//����������
	{
		$query="(".$where.") and checked=1";
		$order="count_month";
		$js="month".$classid.".js";
	}
	elseif($edown==10)//����������
	{
		$query="(".$where.") and checked=1";
		$order="count_week";
		$js="week".$classid.".js";
	}
	elseif($edown==11)//����������
	{
		$query="(".$where.") and checked=1";
		$order="count_day";
		$js="day".$classid.".js";
	}
	//ר��
	elseif($edown==12)//ר������
	{
		$query="ztid='$classid' and checked=1";
		$order="softtime";
		$js="newzt".$classid.".js";
	}
	elseif($edown==13)//ר���Ƽ�
	{
		$query="isgood=1 and ztid='$classid' and checked=1";
		$order="softtime";
		$js="goodzt".$classid.".js";
	}
	elseif($edown==14)//ר��������
	{
		$query="ztid='$classid' and checked=1";
		$order="count_all";
		$js="zt".$classid.".js";
	}
	elseif($edown==15)//ר��������
	{
		$query="ztid='$classid' and checked=1";
		$order="count_month";
		$js="ztmonth".$classid.".js";
	}
	elseif($edown==16)//ר��������
	{
		$query="ztid='$classid' and checked=1";
		$order="count_week";
		$js="ztweek".$classid.".js";
	}
	elseif($edown==17)//ר��������
	{
		$query="ztid='$classid' and checked=1";
		$order="count_day";
		$js="ztday".$classid.".js";
	}
	//�������
	elseif($edown==18)//�����������
	{
		$query="softtype='$classid' and checked=1";
		$order="softtime";
		$js="newtype".$classid.".js";
	}
	elseif($edown==19)//��������Ƽ�
	{
		$query="isgood=1 and softtype='$classid' and checked=1";
		$order="softtime";
		$js="goodtype".$classid.".js";
	}
	elseif($edown==20)//�������������
	{
		$query="softtype='$classid' and checked=1";
		$order="count_all";
		$js="type".$classid.".js";
	}
	elseif($edown==21)//�������������
	{
		$query="softtype='$classid' and checked=1";
		$order="count_month";
		$js="typemonth".$classid.".js";
	}
	elseif($edown==22)//�������������
	{
		$query="softtype='$classid' and checked=1";
		$order="count_week";
		$js="typeweek".$classid.".js";
	}
	elseif($edown==23)//�������������
	{
		$query="softtype='$classid' and checked=1";
		$order="count_day";
		$js="typeday".$classid.".js";
	}
	$jsfile="../data/js/".$js;
	$sql=$empire->query("select softid,softname,filename,titleurl,classid,softtime,softpic,count_all,count_month,count_week,count_day,titlefont from {$dbtbpre}down where ".$query." order by ".$order." desc limit ".$line);
	//ȡ��jsģ��
	$tempr[classjstemp]=stripSlashes(RepJsTemptext($tempr[classjstemp]));
	$tempr[classjstemp]=str_replace('[!--edown.url--]',$public_r[sitedown],$tempr[classjstemp]);
	$temp_r=explode("[!--empiredown.listtemp--]",$tempr[classjstemp]);
	while($r=$empire->fetch($sql))
	{
		$softtime=date($tempr[classjsshowdate],$r[softtime]);
		$r[softname]=str_replace("\r\n","",$r[softname]);
		$oldsoftname=$r[softname];
		$softname=esub(stripSlashes($r[softname]),$sub);
		$title=RepJsTemp($temp_r[1],$r,$softname,$softtime,$oldsoftname);
		$allnew.=$title;
	}
	$allnew="document.write(\"".addslashes($temp_r[0].$allnew.$temp_r[2])."\");";
	WriteFiletext_n($jsfile,$allnew);
}

//�滻JSģ��
function RepJsTemp($temptext,$r,$softname,$softtime,$oldsoftname){
	global $public_r,$class_r;
	$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);//����
	$softname=DoTitleFont($r[titlefont],$softname);//��ɫ
	$classurl=EDReturnClassUrl($r[classid]);//��������
	$classname=EdReturnClassname($r[classid]);
	$temptext=str_replace("[!--softid--]",$r[softid],$temptext);
	$temptext=str_replace("[!--softurl--]",$softurl,$temptext);
	$temptext=str_replace("[!--softname--]",$softname,$temptext);
	$temptext=str_replace("[!--oldsoftname--]",$oldsoftname,$temptext);
	$temptext=str_replace("[!--softtime--]",$softtime,$temptext);
	$temptext=str_replace("[!--classid--]",$r[classid],$temptext);
	$temptext=str_replace("[!--classname--]",$classname,$temptext);
	$temptext=str_replace("[!--classurl--]",$classurl,$temptext);
	$r[softpic]=$r[softpic]?$r[softpic]:$public_r[sitedown]."data/images/notimg.gif";
	$temptext=str_replace("[!--softpic--]",$r[softpic],$temptext);
	$temptext=str_replace("[!--count_all--]",$r[count_all],$temptext);
	$temptext=str_replace("[!--count_month--]",$r[count_month],$temptext);
	$temptext=str_replace("[!--count_week--]",$r[count_week],$temptext);
	$temptext=str_replace("[!--count_day--]",$r[count_day],$temptext);
	return $temptext;
}

//��ʾ���޼�����[�������ʱ]
function ShowClass_AddClass($adminclass,$obclassid,$bclassid,$exp,$enews=0){
	global $empire,$dbtbpre;
	if(empty($bclassid))
	{
		$bclassid=0;
		$exp="|-";
    }
	else
	{$exp="&nbsp;&nbsp;".$exp;}
	$sql=$empire->query("select classid,classname,bclassid,islast,openadd from {$dbtbpre}downclass where bclassid='$bclassid' order by classid");
	$returnstr="";
	while($r=$empire->fetch($sql))
	{
		if($r[islast])
		{
			if(empty($enews)||$enews==2||$enews==3)
			{
				$color=" style='background:#99C4E3'";
			}
			//���ز���Ͷ�����Ŀ
			if($enews==2)
			{
				if($r[openadd])
				{continue;}
			}
		}
		else
		{$color="";}
		if($r[classid]==$obclassid)
		{$select=" selected";}
		else
		{$select="";}
		//�����û�ʱ
		if($enews==3)
		{
			$c=explode("|".$r[classid]."|",$adminclass);
			if(count($c)>1)
			{$select=" selected";}
			else
			{$select="";}
	    }
		$returnstr.="<option value=".$r[classid].$select.$color.">".$exp.$r[classname]."</option>";
		$returnstr.=ShowClass_AddClass($adminclass,$obclassid,$r[classid],$exp,$enews);
	}
	return $returnstr;
}

//���𻺴�
function GetMemberLevel(){
	global $empire,$dbtbpre;
	$file="../data/cache/MemberLevel.php";
	$sql=$empire->query("select * from {$dbtbpre}downmembergroup order by groupid");
	while($r=$empire->fetch($sql))
	{
	   $levels.="\$level_r[".$r[groupid]."]=Array('groupid'=>".$r[groupid].",
'groupname'=>'".addslashes($r[groupname])."',
'level'=>".$r[level].",
'checked'=>".$r[checked].",
'favanum'=>".$r[favanum].",
'daydown'=>".$r[daydown].");
";
	}
	$levels="<?php
//level
\$level_r=array();
".$levels."
//level
?>";
	WriteFiletext_n($file,$levels);
}

//���ɷ��໺��
function GetClass(){
	global $empire,$dbtbpre;
	$line=120;
	$filename="../data/cache/class.php";
	$sql=$empire->query("select * from {$dbtbpre}downclass order by classid");
	$num=$empire->num1($sql);
	$no=0;
	$p=0;
	while($r=$empire->fetch($sql))
	{
		$no++;
		$classes.="\$class_r[".$r[classid]."]=Array('classid'=>".$r[classid].",
'bclassid'=>".$r[bclassid].",
'classname'=>'".addslashes($r[classname])."',
'link_num'=>".$r[link_num].",
'lencord'=>".$r[lencord].",
'sonclass'=>'".addslashes($r[sonclass])."',
'featherclass'=>'".addslashes($r[featherclass])."',
'islast'=>".$r[islast].",
'openadd'=>".$r[openadd].",
'listtempid'=>".$r[listtempid].",
'softtempid'=>".$r[softtempid].",
'downnum'=>".$r[downnum].",
'onlinenum'=>".$r[onlinenum].",
'bname'=>'".addslashes($r[bname])."',
'formtype'=>".$r[formtype].",
'maxnum'=>".$r[maxnum].");
";
		if($no%$line==0||($num%$line<>0&&$num==$no))
		{
			$p++;
			$file="class".$p.".php";
			$include.="@include(\"".$file."\");\r\n";
			$classes="<?php
".$classes."	
?>";
			WriteFiletext_n("../data/cache/".$file,$classes);
			$classes="";
        }
    }
	$include.="@include(\"ztclass.php\");\r\n";
	$include="<?php
\$class_r=array();
".$include."
?>";
	WriteFiletext_n($filename,$include);
}

//ר�⻺��
function GetClassZt(){
	global $empire,$dbtbpre;
	$file="../data/cache/ztclass.php";
	//ר��
	$sql=$empire->query("select * from {$dbtbpre}downzt order by ztid");
	while($r=$empire->fetch($sql))
	{
		$zts.="\$class_zr[".$r[ztid]."]=Array('ztid'=>".$r[ztid].",
'ztname'=>'".addslashes($r[ztname])."',
'lencord'=>".$r[lencord].",
'maxnum'=>".$r[maxnum].",
'listtempid'=>".$r[listtempid].");
";
	}
	//����
	$sql=$empire->query("select * from {$dbtbpre}language order by languageid");
	while($r=$empire->fetch($sql))
	{
		$languages.="\$class_lr[".$r[languageid]."]=Array('languageid'=>".$r[languageid].",
'language'=>'".addslashes($r[language])."');
";
	}
	//�������
	$sql=$empire->query("select * from {$dbtbpre}softtype order by softtypeid");
	while($r=$empire->fetch($sql))
	{
		$softtypes.="\$class_sr[".$r[softtypeid]."]=Array('softtypeid'=>".$r[softtypeid].",
'softtype'=>'".addslashes($r[softtype])."',
'lencord'=>".$r[lencord].",
'maxnum'=>".$r[maxnum].",
'listtempid'=>".$r[listtempid].");
";
	}
	//��Ȩ��ʽ
	$sql=$empire->query("select * from {$dbtbpre}sq order by sqid");
	while($r=$empire->fetch($sql))
	{
		$sqs.="\$class_sqr[".$r[sqid]."]=Array('sqid'=>".$r[sqid].",
'sqname'=>'".addslashes($r[sqname])."');
";
	}
	$zts="<?php
\$class_zr=array();
\$class_lr=array();
\$class_sr=array();
\$class_sqr=array();
".$zts."
".$languages."
".$softtypes."
".$sqs."
?>";
	WriteFiletext_n($file,$zts);
}

//ͶƱ���
function ReturnVote($votename,$votenum,$delvid,$vid,$enews=0){
	$f_exp="::::::";
	$r_exp="\r\n";
	$returnstr="";
	//����ͶƱ
	if(empty($enews))
	{
		for($i=0;$i<count($votename);$i++)
		{
			//�滻�Ƿ��ַ�
			$name=str_replace($f_exp,"",$votename[$i]);
			$name=str_replace($r_exp,"",$votename[$i]);
			$num=str_replace($f_exp,"",$votenum[$i]);
			$num=str_replace($r_exp,"",$votenum[$i]);
			if($name)
			{
				if(empty($num))
				{$num=0;}
				$returnstr.=$name.$f_exp.$num.$r_exp;
			}
		}
	}
	else//�޸�ͶƱ
	{
		for($i=0;$i<count($votename);$i++)
		{
			//ɾ�����ص�ַ
			$del=0;
			for($j=0;$j<count($delvid);$j++)
			{
				if($delvid[$j]==$vid[$i])
				{$del=1;}
			}
			if($del)
			{continue;}
			//�滻�Ƿ��ַ�
			$name=str_replace($f_exp,"",$votename[$i]);
			$name=str_replace($r_exp,"",$votename[$i]);
			$num=str_replace($f_exp,"",$votenum[$i]);
			$num=str_replace($r_exp,"",$votenum[$i]);
			if($name)
			{
				if(empty($num))
				{$num=0;}
				$returnstr.=$name.$f_exp.$num.$r_exp;
			}
		}
	}
	if(empty($returnstr))
	{printerror("����������һ��ͶƱ��","history.go(-1)");}
	//ȥ�������ַ�
	$returnstr=substr($returnstr,0,strlen($returnstr)-2);
	return $returnstr;
}

//���»���
function ReSoftData($userid,$username){
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"changedata");
	GetPublic();
	GetMemberLevel();
	GetClass();
	GetClassZt();
	DelListEdown();
	printerror("�������ݿ⻺��ɹ�","history.go(-1)");
}

//��ʱˢ������
function DoTimeRepage($time){
	global $empire,$dbtbpre;
	if(empty($time))
	{$time=480;}
	echo"<meta http-equiv=\"refresh\" content=\"".$time.";url=DoTimeRepage.php\">";
	$todaytime=time();
	$r=$empire->fetch1("select lastreindextime,reindextime from {$dbtbpre}downpublic limit 1");
	if($r[reindextime]<12)
	{$r[reindextime]=12;}
	if($todaytime-$r[lastreindextime]>$r[reindextime]*60)
	{
		$temptext=GetDownTemp("indextemp");
		DownBq($temptext);
		$usql=$empire->query("update {$dbtbpre}downpublic set lastreindextime='$todaytime'");
    }
}

//ȡ���б�ģ��
function GetListtemp($tempid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select temptext,subsay,showdate,subtitle from {$dbtbpre}downlisttemp where tempid='$tempid'");
	return $r;
}

//ȡ������ģ��
function GetSofttemp($tempid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select temptext,showdate from {$dbtbpre}downsofttemp where tempid='$tempid'");
	return $r;
}

//ȡ�û����ļ�����
function GetFcfiletext($file){
	$str1="document.write(\"";
	$str2="\");";
	$text=ReadFiletext($file);
	$text=stripSlashes(str_replace($str2,"",str_replace($str1,"",$text)));
	return $text;
}

//��ϱ�������
function TitleFont($titlefont,$titlecolor=''){
	$add=$titlecolor.',';
	if($titlecolor=='no')
	{
		$add='';
	}
	if($titlefont[b])//����
	{$add.='b|';}
	if($titlefont[i])//б��
	{$add.='i|';}
	if($titlefont[s])//ɾ����
	{$add.='s|';}
	if($add==',')
	{
		$add='';
	}
	return $add;
}

//���غ�̨������ർ���ַ���
function AdminReturnClassLink($classid){
	global $class_r;
	if(empty($class_r[$classid][featherclass]))
	{
		$class_r[$classid][featherclass]="|";
	}
	$r=explode("|",$class_r[$classid][featherclass].$classid."|");
	$string="<a href=\"ListAllSoft.php\">��������</a>";
	$count=count($r);
	for($i=1;$i<$count-1;$i++)
	{
		$curl=$class_r[$r[$i]][islast]?"ListSoft.php?classid=".$r[$i]:"ListAllSoft.php?classid=".$r[$i];
		$string.="&nbsp;>&nbsp;<a href=\"$curl\">".$class_r[$r[$i]][classname]."</a>";
    }
	return $string;
}

//ɾ�����໺���ļ�
function DelListEdown(){
	$file="../data/fc/downclass.js";
	DelFiletext($file);
}

//������Ӧ�ĸ���
function UpdateTheFile($id,$checkpass){
	global $empire,$dbtbpre;
	if(empty($id)||empty($checkpass))
	{
		return "";
    }
	$id=(int)$id;
	$checkpass=(int)$checkpass;
	$empire->query("update {$dbtbpre}downfile set softid='$id',cjid=0 where cjid='$checkpass'");
}

//�޸�ʱ���¸���
function UpdateTheFileEdit($classid,$id){
	global $empire,$dbtbpre;
	$empire->query("update {$dbtbpre}downfile set cjid=0 where softid='$id' and classid='$classid'");
}

//ɾ������
function DelPathFile($r){
	if(empty($r[path]))
	{
		$filename="../".ToReturnFileSavePath()."/".$r[filename];
	}
	else
	{
		$filename="../".ToReturnFileSavePath()."/".$r[path]."/".$r[filename];
	}
	DelFiletext($filename);
}

//�滻�鶯��ǩ
function DoRepEdownLoopBq($temp){
	$yzz="/\[e:loop={(.+?)}\](.+?)\[\/e:loop\]/is";
	$xzz="<?php
\$bqno=0;
\$ecms_bq_sql=sys_ReturnEdownLoopBq(\\1);
while(\$bqr=\$empire->fetch(\$ecms_bq_sql)){
\$bqsr=sys_ReturnEdownLoopStext(\$bqr);
\$bqno++;
?>\\2<?php
}
?>";
	return preg_replace($yzz,$xzz,$temp);
}

//ɾ���������
function ToDelSoftFile($classid,$softid){
	global $empire,$public_r,$class_r,$dbtbpre;
	if($softid)
	{
		$where="softid='$softid'";
	}
	else
	{
		$where=$class_r[$classid][islast]?"classid='$classid'":ReturnClass($class_r[$classid][sonclass]);
	}
	$sql=$empire->query("select filename,path from {$dbtbpre}downfile where ".$where);
	while($r=$empire->fetch($sql))
	{
		DelPathFile($r);
	}
	$empire->query("delete from {$dbtbpre}downfile where ".$where);
}

//����
function DownLoadFile($file,$filepath,$ecms=0){
	if(empty($file))
	{
		printerror("�ļ�������","history.go(-1)");
    }
	if(!file_exists($filepath))
	{
		printerror("�ļ�������","");
	}
	$filesize=@filesize($filepath);
	//����
	Header("Content-type: application/octet-stream");
	Header("Accept-Ranges: bytes");
	Header("Accept-Length: ".$filesize);
	Header("Content-Disposition: attachment; filename=".$file);
	echo ReadFiletext($filepath);
	if($ecms==1)
	{
		DelFiletext($filepath);
	}
}

//�滻ȫ��ģ�����
function ReplaceTempvar($temp){
	global $empire,$dbtbpre;
	if(empty($temp))
	{return $temp;}
	$sql=$empire->query("select myvar,varvalue from {$dbtbpre}downtempvar where isclose=0 order by myorder desc,varid");
	while($r=$empire->fetch($sql))
	{
		$myvar="[!--temp.".$r[myvar]."--]";
		$temp=str_replace($myvar,$r[varvalue],$temp);;
    }
	return $temp;
}

//���µ�½״̬ģ��
function ReLoginIframe(){
	global $empire,$public_r,$dbtbpre;
	$tfile="../data/template/loginiframetemp.txt";
	$loginiframetemp=ReadFiletext($tfile);
	$pr=$empire->fetch1("select loginiframe,loginjstemp from {$dbtbpre}downpubtemp limit 1");
	//��ܵ�½״̬����
	$temptext=str_replace("[!--edown.url--]",$public_r['sitedown'],$pr['loginiframe']);
	$temptext=str_replace("[!--userid--]","<?=\$myuserid?>",$temptext);
	$temptext=str_replace("[!--username--]","<?=\$myusername?>",$temptext);
	$temptext=str_replace("[!--groupname--]","<?=\$groupname?>",$temptext);
	$temptext=str_replace("[!--downdate--]","<?=\$downdate?>",$temptext);
	$temptext=str_replace("[!--downfen--]","<?=\$downfen?>",$temptext);
	$r=explode("[!--empirenews.template--]",$temptext);
	$text=str_replace("<!--login-->",$r[0],$loginiframetemp);
	$text=str_replace("<!--loginin-->",$r[1],$text);
	$file="../iframe/index.php";
	WriteFiletext($file,$text);
	//JS��½״̬����
	$temptext=str_replace("[!--edown.url--]",$public_r['sitedown'],$pr['loginjstemp']);
	$temptext=str_replace("[!--userid--]","<?=\$myuserid?>",$temptext);
	$temptext=str_replace("[!--username--]","<?=\$myusername?>",$temptext);
	$temptext=str_replace("[!--groupname--]","<?=\$groupname?>",$temptext);
	$temptext=str_replace("[!--downdate--]","<?=\$downdate?>",$temptext);
	$temptext=str_replace("[!--downfen--]","<?=\$downfen?>",$temptext);
	$r=explode("[!--empirenews.template--]",$temptext);
	$login="document.write(\"".addslashes(stripSlashes(str_replace("\r\n","",$r[0])))."\");";
	$loginin="document.write(\"".addslashes(stripSlashes(str_replace("\r\n","",$r[1])))."\");";
	$text=str_replace("<!--login-->",$login,$loginiframetemp);
	$text=str_replace("<!--loginin-->",$loginin,$text);
	$file="../iframe/loginjs.php";
	WriteFiletext_n($file,$text);
}

//�����Զ���ҳ��
function ReUserpage($id){
	global $empire,$public_r,$dbtbpre;
	$r=$empire->fetch1("select id,title,pagetext,filename,pagetitle,pagekeywords,pagedescription from {$dbtbpre}downuserpage where id='$id'");
	if(empty($r[filename]))
	{
		return "";
	}
	if(empty($r[pagetitle]))
	{
		$r[pagetitle]=$r[title];
	}
	$pagetext=$r[pagetext];
	//������
	$url="<a href='".$public_r[sitedown]."'>��ҳ</a>&nbsp;>&nbsp;".$r[title];
	//�滻
	$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/top.js'></script>";
	$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new.js'></script>";
	$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
	$pagetext=Rep_templatevars($pagetext,$url,htmlspecialchars($r[pagetitle]),htmlspecialchars($r[pagekeywords]),htmlspecialchars($r[pagedescription]),$navadd);
	$path='../page/'.$r[filename];
	WriteFiletext($path,$pagetext);
}

//��������ҳ��ģ��
function ReDownPageFile(){
	global $empire,$public_r,$dbtbpre;
	$pr=$empire->fetch1("select downpagetemp from {$dbtbpre}downpubtemp limit 1");
	$temptext=$pr['downpagetemp'];
	$navadd['topjs']="<script src='".$public_r[sitedown]."data/js/top.js'></script>";
	$navadd['newjs']="<script src='".$public_r[sitedown]."data/js/new.js'></script>";
	$navadd['navclass']="<script src='".$public_r[sitedown]."data/js/class.js'></script>";
	$url="<a href='".$public_r[sitedown]."'>��ҳ</a>&nbsp;>&nbsp;<a href='<?=\$softurl?>'><?=\$r[softname]?></a>&nbsp;>&nbsp;<?=\$thisdownname?>";
	//����ģ�����
	$pagetitle="<?=htmlspecialchars(\$r[softname])?> - <?=htmlspecialchars(\$thisdownname)?>";
	$pagekey="<?=htmlspecialchars(\$r[keyboard])?>";
	$pagedes="<?=htmlspecialchars(strip_tags(\$r[softsay]))?>";
	$temptext=Rep_templatevars($temptext,$url,$pagetitle,$pagekey,$pagedes,$navadd);
	//����
	$temptext=str_replace("[!--class.id--]","<?=\$r[classid]?>",$temptext);
	$temptext=str_replace("[!--class.name--]","<?=\$classname?>",$temptext);
	$temptext=str_replace("[!--bclass.id--]","<?=\$bclassid?>",$temptext);
	$temptext=str_replace("[!--bclass.name--]","<?=\$bclassname?>",$temptext);
	//���
	$temptext=str_replace("[!--softid--]","<?=\$r[softid]?>",$temptext);
	$temptext=str_replace("[!--softurl--]","<?=\$softurl?>",$temptext);
	$temptext=str_replace("[!--softname--]","<?=\$r[softname]?>",$temptext);
	$temptext=str_replace("[!--softtime--]","<?=date('Y-m-d',\$r[softtime])?>",$temptext);
	$temptext=str_replace("[!--softsay--]","<?=nl2br(GetEBBcode(\$r[softsay]))?>",$temptext);
	$temptext=str_replace("[!--softpic--]","<?=\$r[softpic]?\$r[softpic]:\$public_r[sitedown].'data/images/notimg.gif'?>",$temptext);
	$temptext=str_replace("[!--soft_version--]","<?=\$r[soft_version]?>",$temptext);
	$temptext=str_replace("[!--keyboard--]","<?=\$r[keyboard]?>",$temptext);
	$temptext=str_replace("[!--filetype--]","<?=\$r[filetype]?>",$temptext);
	$temptext=str_replace("[!--filesize--]","<?=\$r[filesize]?>",$temptext);
	$temptext=str_replace("[!--writer--]","<?=\$r[writer]?>",$temptext);
	$temptext=str_replace("[!--homepage--]","<?=\$r[homepage]?>",$temptext);
	$temptext=str_replace("[!--demo--]","<?=\$r[demo]?>",$temptext);
	$temptext=str_replace("[!--adduser--]","<?=\$r[adduser]?>",$temptext);
	$temptext=str_replace("[!--star--]","<img src='<?=\$public_r[sitedown]?>data/images/<?=\$r[star]?>star.gif'>",$temptext);
	$temptext=str_replace("[!--soft_fj--]","<?=\$r[soft_fj]?>",$temptext);
	//����
	$temptext=str_replace("[!--softtype--]","<?=\$class_sr[\$r[softtype]][softtype]?>",$temptext);
	$temptext=str_replace("[!--soft_sq--]","<?=\$class_sqr[\$r[soft_sq]][sqname]?>",$temptext);
	$temptext=str_replace("[!--language--]","<?=\$class_lr[\$r[language]][language]?>",$temptext);
	//���ص�ַ
	$temptext=str_replace("[!--thisdownpath--]","<?=\$url?>",$temptext);
	$temptext=str_replace("[!--thistruedownpath--]","<?=\$trueurl?>",$temptext);
	$temptext=str_replace("[!--thisdownname--]","<?=\$thisdownname?>",$temptext);
	//����Ȩ��
	$temptext=str_replace("[!--downfen--]","<?=\$downfen?>",$temptext);
	$temptext=str_replace("[!--foruser--]","<?=\$downuser?>",$temptext);
	//����ͳ��
	$temptext=str_replace("[!--count_all--]","<?=\$r[count_all]?>",$temptext);
	$temptext=str_replace("[!--count_month--]","<?=\$r[count_month]?>",$temptext);
	$temptext=str_replace("[!--count_week--]","<?=\$r[count_week]?>",$temptext);
	$temptext=str_replace("[!--count_day--]","<?=\$r[count_day]?>",$temptext);
	$temptext=AddCheckViewTempCode().$temptext;
	$file="../data/template/downpagetemp.php";
	WriteFiletext($file,$temptext);
}

//�������ݱ�
function SetCreateTable($sql,$dbcharset) {
	global $phome_db_ver;
	$type=strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $sql));
	$type = in_array($type, array('MYISAM', 'HEAP')) ? $type : 'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql).
		($phome_db_ver>='4.1'&&$dbcharset ? " ENGINE=$type DEFAULT CHARSET=$dbcharset" : " TYPE=$type");
}
?>