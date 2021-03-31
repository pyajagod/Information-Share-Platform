<?php
//替换文件前缀
function RepFilenameQz($qz){
	$qz=str_replace("/","",$qz);
	$qz=str_replace("\\","",$qz);
	$qz=str_replace("#","",$qz);
	$qz=str_replace("&","",$qz);
	$qz=str_replace(":","",$qz);
	$qz=str_replace(";","",$qz);
	$qz=str_replace("<","",$qz);
	$qz=str_replace(">","",$qz);
	$qz=str_replace("?","",$qz);
	$qz=str_replace("*","",$qz);
	$qz=str_replace("%","",$qz);
	$qz=str_replace("|","",$qz);
	$qz=str_replace("\"","",$qz);
	$qz=str_replace("'","",$qz);
	return $qz;
}

//增加下载变量处理
function DoSoftVar($add){
	$add[classid]=(int)$add[classid];
	$add[softtime]=to_time($add['softtime']);
	$add[isgood]=(int)$add[isgood];
	$add[count_all]=(int)$add[count_all];
	$add[count_month]=(int)$add[count_month];
	$add[count_week]=(int)$add[count_week];
	$add[soft_sq]=(int)$add[soft_sq];
	$add[downfen]=(int)$add[downfen];
	$add[star]=(int)$add[star];
	$add[language]=(int)$add[language];
	$add[softtype]=(int)$add[softtype];
	$add[foruser]=(int)$add[foruser];
	$add[istop]=(int)$add[istop];
	$add[checked]=(int)$add[checked];
	$add[count_day]=(int)$add[count_day];
	$add[playerid]=(int)$add[playerid];
	$add[ztid]=(int)$add[ztid];
	if($add[filename])
	{
		$add[filename]=RepFilenameQz($add[filename]);
	}
	//组合标题属性
	$add[mytitlefont]=TitleFont($add[titlefont],$add[titlecolor]);
	if(empty($add['zm']))
	{
		$add['zm']=GetInfoZm($add['softname']);
	}
	$add['softname']=htmlspecialchars($add['softname']);
	return $add;
}

//返回拼音
function ReturnPinyinFun($hz){
	include('../class/getpinyin.php');
	return c($hz);
}

//取得字母
function GetInfoZm($hz){
	if(!trim($hz))
	{
		return '';
	}
	$py=ReturnPinyinFun($hz);
	$zm=substr($py,0,1);
	return strtoupper($zm);
}

//生成页面
function AddSoftToReHtml($classid,$dore){
	AddSoftReHtml($classid,$dore);
	printerror('生成页面完毕','history.go(-1)');
}

//生成页面
function AddSoftReHtml($classid,$dohtml){
	global $class_r;
	if($dohtml==0)//不生成
	{
		return '';
	}
	elseif($dohtml==1)//生成当前分类页
	{
		hReClassHtml('|'.$classid.'|');
	}
	elseif($dohtml==2)//生成首页
	{
		hReIndex();
	}
	elseif($dohtml==3)//生成父分类页
	{
		$featherclass=$class_r[$classid]['featherclass'];
		if($featherclass&&$featherclass!="|")
		{
			hReClassHtml($featherclass);
		}
	}
	elseif($dohtml==4)//生成当前分类页与父分类页
	{
		$featherclass=$class_r[$classid]['featherclass'];
		if(empty($featherclass))
		{
			$featherclass="|";
		}
		$featherclass.=$classid."|";
		hReClassHtml($featherclass);
	}
	elseif($dohtml==5)//生成父分类页与首页
	{
		hReIndex();
		$featherclass=$class_r[$classid]['featherclass'];
		if($featherclass&&$featherclass!="|")
		{
			hReClassHtml($featherclass);
		}
	}
	elseif($dohtml==6)//生成当前分类页、父分类页与首页
	{
		hReIndex();
		$featherclass=$class_r[$classid]['featherclass'];
		if(empty($featherclass))
		{
			$featherclass="|";
		}
		$featherclass.=$classid."|";
		hReClassHtml($featherclass);
	}
}

//发布生成分类
function hReClassHtml($sonclass){
	global $empire,$dbtbpre,$class_r;
	$r=explode("|",$sonclass);
	$count=count($r);
	for($i=1;$i<$count-1;$i++)
	{
		ListHtml($r[$i],$listtemp_r,0);
	}
}

//发布生成首页
function hReIndex(){
	DownBq(GetDownTemp("indextemp"));
}

//生成单信息
function ReSingleSoftHtml($userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	if($_GET['classid'])
	{
		$classid=(int)$_GET['classid'];
		$softid=$_GET['softid'];
	}
	else
	{
		$classid=(int)$_POST['classid'];
		$softid=$_POST['softid'];
	}
	if(empty($classid))
	{
		printerror('您来自的链接不存在','history.go(-1)');
	}
	$count=count($softid);
	if(empty($count))
	{
		printerror("请选择要生成页面的软件","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$add.="softid='".intval($softid[$i])."' or ";
    }
	$add=substr($add,0,strlen($add)-4);
	$sql=$empire->query("select * from {$dbtbpre}down where ".$add);
	while($r=$empire->fetch($sql))
	{
		GetHtml($r,$softtemp_r);//生成下载文件
	}
	printerror("生成内容页面成功",$_SERVER['HTTP_REFERER']);
}

//生成专题页面
function AddSoftReZtHtml($dozthtml,$ztid,$softtypeid,$zm){
	//字母
	if(!preg_match('/^[a-zA-Z]+$/',$zm))
	{
		$zm='';
	}
	if($dozthtml==0)//不生成
	{
		return '';
	}
	elseif($dozthtml==1)//生成软件类型页
	{
		if($softtypeid)
		{
			ListHtml($softtypeid,$listtemp_r,2);
		}
	}
	elseif($dozthtml==2)//生成专题页
	{
		if($ztid)
		{
			ListHtml($ztid,$listtemp_r,1);
		}
	}
	elseif($dozthtml==3)//生成字母导航页
	{
		if($zm)
		{
			ListHtml($zm,$listtemp_r,3);
		}
	}
	elseif($dozthtml==4)//生成软件类型页、专题页
	{
		if($softtypeid)
		{
			ListHtml($softtypeid,$listtemp_r,2);
		}
		if($ztid)
		{
			ListHtml($ztid,$listtemp_r,1);
		}
	}
	elseif($dozthtml==5)//生成软件类型页、专题页、字母页
	{
		if($softtypeid)
		{
			ListHtml($softtypeid,$listtemp_r,2);
		}
		if($ztid)
		{
			ListHtml($ztid,$listtemp_r,1);
		}
		if($zm)
		{
			ListHtml($zm,$listtemp_r,3);
		}
	}
}

//检查重复软件名
function CheckReSoftname($id,$softname){
	global $empire,$dbtbpre,$public_r;
	if($public_r['checkresoftname'])
	{
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where softname='$softname' limit 1");
		if($num)
		{
			printerror('此软件名已经存在','');
		}
	}
}

//增加软件
function AddSoft($add,$file,$file_name,$file_size,$file_type,$userid,$username){
	global $empire,$dbtbpre,$public_r,$class_r;
	$add=DoSoftVar($add);
	$classid=$add['classid'];
	if(!$add[softname]||!$add[classid])
	{
		printerror("请输入软件名与选择分类","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"soft");//验证权限
	if(!$class_r[$classid]['classid'])
	{
		printerror("您来自的链接不存在","history.go(-1)");
	}
	CheckReSoftname(0,$add[softname]);
	//组合下载地址
    $returndownpath=ReturnDown($add[downname],$add[downpath],$add[delpathid],$add[pathid],$add[downuser],$add[fen],$add[thedownqz],$add,$add[foruser],$add[downurl],0);
	//组合在线地址
	$returnonlinepath=ReturnDown($add[odownname],$add[odownpath],$add[odelpathid],$add[opathid],$add[odownuser],$add[ofen],$add[othedownqz],'','',$add[onlineurl],0);
	//上传软件图片
	$tranpic=0;
	if($file_name)
	{
		$filer=GoTranFile($file,$file_name,$file_size,$file_type,1,0,0);
		$tranpic=1;
		$add[softpic]=$filer['fileurl'];
		$tranimg=$filer['filename'];
	}
	$sql=$empire->query("insert into {$dbtbpre}down(softname,softsay,classid,softtime,isgood,homepage,adduser,writer,filesize,filetype,downpath,demo,softpic,count_all,count_month,count_week,soft_sq,soft_fj,downfen,star,keyboard,language,softtype,foruser,tranimg,istop,checked,soft_version,ismember,titleurl,titlefont,count_day,onlinepath,playerid,filename,ztid,zm,haveaddfen,userid) values('$add[softname]','$add[softsay]','$add[classid]','$add[softtime]','$add[isgood]','$add[homepage]','$username','$add[writer]','$add[filesize]','$add[filetype]','$returndownpath','$add[demo]','$add[softpic]','$add[count_all]','$add[count_month]','$add[count_week]','$add[soft_sq]','$add[soft_fj]','$add[downfen]','$add[star]','$add[keyboard]','$add[language]','$add[softtype]','$add[foruser]','$tranimg','$add[istop]','$add[checked]','$add[soft_version]','0','$add[titleurl]','$add[mytitlefont]','$add[count_day]','$returnonlinepath','$add[playerid]','$add[filename]','$add[ztid]','$add[zm]',0,'$userid');");
	$lastid=$empire->lastid();
	if(empty($add['filename']))
	{
		$empire->query("update {$dbtbpre}down set filename='$lastid' where softid='$lastid'");
	}
	//更新附件
	UpdateTheFile($lastid,$add['filepass']);
	$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$lastid'");
	//生成下载文件
	GetHtml($r,$softtemp_r);
	//生成列表
	AddSoftReHtml($add[classid],$public_r[dohtml]);
	//生成专题
	AddSoftReZtHtml($public_r[dozthtml],$add[ztid],$add[softtype],$add[zm]);
	if($sql)
	{
		printerror("增加软件成功","AddSoft.php?phome=AddSoft&classid=$classid");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改软件
function EditSoft($add,$file,$file_name,$file_size,$file_type,$userid,$username){
	global $empire,$dbtbpre,$public_r,$class_r;
	$add=DoSoftVar($add);
	$classid=$add['classid'];
	$softid=(int)$add['softid'];
	if(!$add[softname]||!$add[classid]||!$softid)
	{
		printerror("请输入软件名与选择分类","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"soft");
	$ysoftr=$empire->fetch1("select softid,tranimg,checked,filename,titleurl from {$dbtbpre}down where softid='$softid' and classid='$add[classid]'");
	if(!$ysoftr['softid'])
	{
		printerror("您来自的链接不存在","history.go(-1)");
	}
	//组合下载地址
	$returndownpath=ReturnDown($add[downname],$add[downpath],$add[delpathid],$add[pathid],$add[downuser],$add[fen],$add[thedownqz],$add,$add[foruser],$add[downurl],1);
	//组合在线地址
	$returnonlinepath=ReturnDown($add[odownname],$add[odownpath],$add[odelpathid],$add[opathid],$add[odownuser],$add[ofen],$add[othedownqz],$ak,$ak,$add[onlineurl],1);
	//上传软件图片
	$tranimg=$ysoftr['tranimg'];
	if($file_name)
	{
		$filer=GoTranFile($file,$file_name,$file_size,$file_type,1,0,0);
		$tranpic=1;
		$add[softpic]=$filer['fileurl'];
		$tranimg=$filer['filename'];
		//删除旧图片
		if($ysoftr['tranimg'])
		{
			DelFiletext("../data/soft_img/".$ysoftr['tranimg']);
		}
	}
	if(empty($add[filename]))
	{
		$add[filename]=$softid;
	}
	$sql=$empire->query("update {$dbtbpre}down set softname='$add[softname]',softsay='$add[softsay]',classid='$add[classid]',softtime='$add[softtime]',isgood='$add[isgood]',homepage='$add[homepage]',writer='$add[writer]',filesize='$add[filesize]',filetype='$add[filetype]',downpath='$returndownpath',demo='$add[demo]',softpic='$add[softpic]',count_all='$add[count_all]',count_month='$add[count_month]',count_week='$add[count_week]',soft_sq='$add[soft_sq]',soft_fj='$add[soft_fj]',downfen='$add[downfen]',star='$add[star]',keyboard='$add[keyboard]',language='$add[language]',softtype='$add[softtype]',foruser='$add[foruser]',tranimg='$tranimg',istop='$add[istop]',checked='$add[checked]',soft_version='$add[soft_version]',titleurl='$add[titleurl]',titlefont='$add[mytitlefont]',count_day='$add[count_day]',onlinepath='$returnonlinepath',playerid='$add[playerid]',filename='$add[filename]',ztid='$add[ztid]',zm='$add[zm]' where softid='$softid'");
	//更新附件
	UpdateTheFileEdit($classid,$softid);
	//是否审核
	if($ysoftr['checked']&&!$add[checked]&&!$ysoftr['titleurl'])
	{
		DelFiletext("../data/".$public_r['resoftpath']."/".$ysoftr['filename'].$public_r['refiletype']);
	}
	$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid'");
	//生成下载文件
	GetHtml($r,$softtemp_r);
	//生成列表
	AddSoftReHtml($add[classid],$public_r[dohtml]);
	//生成专题
	AddSoftReZtHtml($public_r[dozthtml],$add[ztid],$add[softtype],$add[zm]);
	if($sql)
	{
		printerror("修改软件成功","ListSoft.php?classid=$classid");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除软件
function DelSoft($add,$userid,$username){
	global $empire,$dbtbpre,$public_r,$class_r;
	$classid=(int)$add['classid'];
	$softid=(int)$add['softid'];
	if(!$softid)
	{
		printerror("请选择要删除软件","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"soft");
	$ysoftr=$empire->fetch1("select softid,tranimg,checked,filename,titleurl,ztid,softtype,zm from {$dbtbpre}down where softid='$softid' and classid='$classid'");
	if(!$ysoftr['softid'])
	{
		printerror("您来自的链接不存在","history.go(-1)");
	}
	//删除图片
	if($ysoftr['tranimg'])
	{
		DelFiletext("../data/soft_img/".$ysoftr['tranimg']);
	}
	//删除文件
	if($ysoftr['checked']&&!$ysoftr['titleurl'])
	{
		DelFiletext("../data/".$public_r['resoftpath']."/".$ysoftr['filename'].$public_r['refiletype']);
	}
	//删除附件
	ToDelSoftFile(0,$softid);
	$sql=$empire->query("delete from {$dbtbpre}down where softid='$softid'");
	//生成列表
	AddSoftReHtml($classid,$public_r[dohtml]);
	//生成专题
	AddSoftReZtHtml($public_r[dozthtml],$ysoftr[ztid],$ysoftr[softtype],$ysoftr[zm]);
	if($sql)
	{
		printerror("删除软件成功",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//批量删除软件
function DelSoft_all($add,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	$softid=$add['softid'];
	$classid=(int)$add['classid'];
	$count=count($softid);
	if(!$count)
	{
		printerror("你还没有选择要删除的软件","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"soft");
	$ids='';
	for($i=0;$i<$count;$i++)
	{
		$ids.=$dh.intval($softid[$i]);
		$dh=',';
	}
	$add1="softid in (".$ids.")";
	//删除文件
	$s_sql=$empire->query("select softid,tranimg,checked,filename,titleurl,ztid,softtype,zm from {$dbtbpre}down where ".$add1);
	while($r=$empire->fetch($s_sql))
	{
		if($r[tranimg])//删除预览图
		{
			DelFiletext("../data/soft_img/".$r[tranimg]);
		}
		if($r['checked']&&!$r['titleurl'])//删除文件
		{
			DelFiletext("../data/".$public_r['resoftpath']."/".$r['filename'].$public_r['refiletype']);
		}
		ToDelSoftFile(0,$r['softid']);//删除附件
	}
	$sql=$empire->query("delete from {$dbtbpre}down where ".$add1);
	//生成列表
	AddSoftReHtml($classid,$public_r[dohtml]);
	//生成专题
	AddSoftReZtHtml($public_r[dozthtml],$r[ztid],$r[softtype],$r[zm]);
	if($sql)
	{
		printerror("删除软件成功",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//批量审核软件
function CheckSoft_all($add,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	$softid=$add['softid'];
	$classid=(int)$add['classid'];
	$count=count($softid);
	if(!$count)
	{
		printerror("请选择要审核的软件","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"soft");
	for($i=0;$i<$count;$i++)
	{
		$softid[$i]=(int)$softid[$i];
		$empire->query("update {$dbtbpre}down set checked=1 where softid='$softid[$i]'");
		$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid[$i]'");
		//投稿增点
		if($r[ismember]&&$r[userid]&&!$r[haveaddfen])
		{
			$cr=$empire->fetch1("select classid,qaddfen from {$dbtbpre}downclass where classid='$r[classid]'");
			if($cr[qaddfen])
			{
				AddInfoFen($cr[qaddfen],$r[userid]);
			}
			$empire->query("update {$dbtbpre}down set haveaddfen=1 where softid=$r[softid]");
		}
		//生成下载文件
		if($oldsofttempid==$class_r[$r[classid]][softtempid])
		{
			$softtemp_r=$oldsofttemp_r;
	    }
		else
		{
			$softtemp_r=GetSofttemp($class_r[$r[classid]][softtempid]);
	    }
		GetHtml($r,$softtemp_r);
		$oldsofttempid=$class_r[$r[classid]][softtempid];
		$oldsofttemp_r=$softtemp_r;
	}
	printerror("审核软件成功",$_SERVER['HTTP_REFERER']);
}

//审核单个软件
function CheckSoft($add,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	$classid=(int)$add['classid'];
	$softid=(int)$add['softid'];
	if(empty($softid))
	{
		printerror("请选择要审核的软件","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"soft");
	$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid' and classid='$classid'");
	if(!$r['softid'])
	{
		printerror('请选择要审核的软件','history.go(-1)');
	}
	$sql=$empire->query("update {$dbtbpre}down set checked=1 where softid='$softid'");
	//投稿增点
	if($r[ismember]&&$r[userid]&&!$r[haveaddfen])
	{
		$cr=$empire->fetch1("select classid,qaddfen from {$dbtbpre}downclass where classid='$r[classid]'");
		if($cr[qaddfen])
		{
			AddInfoFen($cr[qaddfen],$r[userid]);
		}
		$empire->query("update {$dbtbpre}down set haveaddfen=1 where softid=$r[softid]");
	}
	$r['checked']=1;
	//生成下载文件
	GetHtml($r,$softtemp_r);
	//生成列表
	AddSoftReHtml($classid,$public_r[dohtml]);
	//生成专题
	AddSoftReZtHtml($public_r[dozthtml],$r[ztid],$r[softtype],$r[zm]);
	if($sql)
	{
		printerror("审核软件成功",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//软件置顶
function TopSoft_all($add,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	$classid=(int)$add['classid'];
	$softid=$add['softid'];
	$istop=(int)$add['istop'];
	//验证权限
	CheckLevel($userid,$username,$classid,"soft");
	$count=count($softid);
	if(!$count)
	{
		printerror("请选择要置顶的软件","history.go(-1)");
	}
	$ids='';
	for($i=0;$i<$count;$i++)
	{
		$ids.=$dh.intval($softid[$i]);
		$dh=',';
	}
	$add1="softid in (".$ids.")";
	$sql=$empire->query("update {$dbtbpre}down set istop='$istop' where ".$add1);
	//生成列表
	AddSoftReHtml($classid,$public_r[dohtml]);
	printerror("置顶成功",$_SERVER['HTTP_REFERER']);
}

//移动软件
function MoveSoft_all($classid,$to_classid,$softid,$userid,$username){
	global $empire,$class_r,$dbtbpre,$public_r;
	$classid=(int)$classid;
	$to_classid=(int)$to_classid;
	if(empty($classid)||empty($to_classid))
	{
		printerror("请选择要移动的分类","history.go(-1)");
	}
	if(empty($class_r[$classid][islast])||empty($class_r[$to_classid][islast]))
	{
		printerror("选择移动的目标分类是非终极分类","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"soft");
	$count=count($softid);
	if(empty($count))
	{
		printerror("请选择要移动的软件","history.go(-1)");
	}
	$ids='';
	for($i=0;$i<$count;$i++)
	{
		$ids.=$dh.intval($softid[$i]);
		$dh=',';
	}
	$add1="softid in (".$ids.")";
	$sql=$empire->query("update {$dbtbpre}down set classid='$to_classid' where ".$add1);
	//生成列表
	AddSoftReHtml($classid,$public_r[dohtml]);
	AddSoftReHtml($to_classid,$public_r[dohtml]);
	if($sql)
	{
		printerror("移动软件成功",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//复制软件
function CopySoft_all($classid,$to_classid,$softid,$userid,$username){
	global $empire,$class_r,$public_r,$dbtbpre;
	if(empty($classid)||empty($to_classid))
	{
		printerror("请选择要目标分类","history.go(-1)");
	}
	if(empty($class_r[$classid][islast])||empty($class_r[$to_classid][islast]))
	{
		printerror("选择复制的目标分类是非终极分类","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"soft");
	$count=count($softid);
	if(empty($count))
	{
		printerror("请选择要复制的软件","history.go(-1)");
	}
	$softtime=time();
	//入库
	for($i=0;$i<$count;$i++)
	{
		$softid[$i]=(int)$softid[$i];
		$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid[$i]'");
		$sql=$empire->query("insert into {$dbtbpre}down(softname,softsay,classid,softtime,isgood,homepage,adduser,writer,filesize,filetype,downpath,demo,softpic,count_all,count_month,count_week,soft_sq,soft_fj,downfen,star,keyboard,language,softtype,foruser,tranimg,istop,checked,soft_version,ismember,titleurl,titlefont,count_day,onlinepath,playerid,filename,ztid,zm,haveaddfen,userid) values('".ReturnDoYStr($r[softname])."','".ReturnDoYStr($r[softsay])."','$to_classid','$softtime','0','".ReturnDoYStr($r[homepage])."','$username','".ReturnDoYStr($r[writer])."','".ReturnDoYStr($r[filesize])."','".ReturnDoYStr($r[filetype])."','".ReturnDoYStr($r[downpath])."','".ReturnDoYStr($r[demo])."','".ReturnDoYStr($r[softpic])."','0','0','0','$r[soft_sq]','".ReturnDoYStr($r[soft_fj])."','$r[downfen]','$r[star]','".ReturnDoYStr($r[keyboard])."','$r[language]','$r[softtype]','$r[foruser]','','0','$r[checked]','".ReturnDoYStr($r[soft_version])."','0','".ReturnDoYStr($r[titleurl])."','','0','".ReturnDoYStr($r[onlinepath])."','$r[playerid]','','$r[ztid]','$r[zm]','$r[haveaddfen]','$r[userid]');");
		$newsoftid=$empire->lastid();
		$empire->query("update {$dbtbpre}down set filename='$newsoftid' where softid='$newsoftid'");
		$nr=$empire->fetch1("select * from {$dbtbpre}down where softid='$newsoftid'");
		//生成下载文件
		GetHtml($nr,$softtemp_r);
    }
	//生成列表
	AddSoftReHtml($to_classid,$public_r[dohtml]);
	printerror("复制软件成功",$_SERVER['HTTP_REFERER']);
}
?>