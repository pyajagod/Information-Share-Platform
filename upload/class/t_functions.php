<?php
//列表模板分页函数
function sys_ShowListPage($num,$pagenum,$dolink,$dotype,$page,$lencord,$ok,$search=""){
	//首页
	if($pagenum<>1)
	{
		$pagetop="<a href='".$dolink."_1".$dotype."'>首页</a>&nbsp;&nbsp;";
	}
	else
	{
		$pagetop="首页&nbsp;&nbsp;";
	}
	//上一页
	if($pagenum<>1)
	{
		$pagepr=$pagenum-1;
		if($pagepr==1)
		{
			$prido="_1".$dotype;
		}
		else
		{
			$prido="_".$pagepr.$dotype;
		}
		$pagepri="<a href='".$dolink.$prido."'>上一页</a>&nbsp;&nbsp;";
	}
	else
	{
		$pagepri="上一页&nbsp;&nbsp;";
	}
	//下一页
	if($pagenum<>$page)
	{
		$pagenex=$pagenum+1;
		$pagenext="<a href='".$dolink."_".$pagenex.$dotype."'>下一页</a>&nbsp;&nbsp;";
	}
	else
	{
		$pagenext="下一页&nbsp;&nbsp;";
	}
	//尾页
	if($pagenum==$page)
	{
		$pageeof='尾页';
	}
	else
	{
		$pageeof="<a href='".$dolink."_".$page.$dotype."'>尾页</a>";
	}
	$options="";
	//取得下拉页码
	if(empty($search))
	{
		for($go=1;$go<=$page;$go++)
		{
			$file="_".$go.$dotype;
			if($ok==$go)
			{$select=" selected";}
			else
			{$select="";}
			$myoptions.="<option value='".$dolink.$file."'>第 ".$go." 页</option>";
			$options.="<option value='".$dolink.$file."'".$select.">第 ".$go." 页</option>";
		}
	}
	else
	{
		$myoptions=$search;
		$options=str_replace("value='".$dolink."_".$ok.$dotype."'>","value='".$dolink."_".$ok.$dotype."' selected>",$search);
	}
	$options="<select name='select' onchange=\"self.location.href=this.options[this.selectedIndex].value\">".$options."</select>";
	//分页
	$pagelink=$pagetop.$pagepri.$pagenext.$pageeof;
	//替换模板变量
	$pager['showpage']=ReturnListpageStr($pagenum,$page,$lencord,$num,$pagelink,$options);
	$pager['option']=$myoptions;
	return $pager;
}

//返回分页
function ReturnListpageStr($pagenum,$page,$lencord,$num,$pagelink,$options){
	global $public_r;
	$temp=stripSlashes(stripSlashes($public_r['listpagetemp']));
	$temp=str_replace("[!--thispage--]",$pagenum,$temp);//页次
	$temp=str_replace("[!--pagenum--]",$page,$temp);//总页数
	$temp=str_replace("[!--lencord--]",$lencord,$temp);//每页显示条数
	$temp=str_replace("[!--num--]",$num,$temp);//总条数
	$temp=str_replace("[!--pagelink--]",$pagelink,$temp);//页面链接
	$temp=str_replace("[!--options--]",$options,$temp);//下拉分页
	return $temp;
}

//列表模板之列表式分页
function sys_ShowListMorePage($num,$page,$dolink,$type,$totalpage,$line,$ok,$search=""){
	global $fun_r,$public_r;
	if($num<=$line)
	{
		$pager['showpage']='';
		return $pager;
	}
	$page_line=$public_r['listpagelistnum'];
	$snum=2;
	//$totalpage=ceil($num/$line);//取得总页数
	$firststr='<a title="总数">&nbsp;<b>'.$num.'</b> </a>&nbsp;&nbsp;';
	//上一页
	if($page<>1)
	{
		$toppage='<a href="'.$dolink.'_1'.$type.'">首页</a>&nbsp;';
		$pagepr=$page-1;
		if($pagepr==1)
		{
			$prido="_1".$type;
		}
		else
		{
			$prido="_".$pagepr.$type;
		}
		$prepage='<a href="'.$dolink.$prido.'">上一页</a>';
	}
	//下一页
	if($page!=$totalpage)
	{
		$pagenex=$page+1;
		$nextpage='&nbsp;<a href="'.$dolink.'_'.$pagenex.$type.'">下一页</a>';
		$lastpage='&nbsp;<a href="'.$dolink.'_'.$totalpage.$type.'">尾页</a>';
	}
	$starti=$page-$snum<1?1:$page-$snum;
	$no=0;
	for($i=$starti;$i<=$totalpage&&$no<$page_line;$i++)
	{
		$no++;
		if($page==$i)
		{
			$is_1="<b>";
			$is_2="</b>";
		}
		else
		{
			$is_1='<a href="'.$dolink.'_'.$i.$type.'">';
			$is_2="</a>";
		}
		$returnstr.='&nbsp;'.$is_1.$i.$is_2;
	}
	$returnstr=$firststr.$toppage.$prepage.$returnstr.$nextpage.$lastpage;
	$pager['showpage']=$returnstr;
	return $pager;
}

//返回sql语句
function sys_ReturnBqQuery($classid,$line,$edown=0,$do=0){
	global $empire,$public_r,$class_r,$navclassid,$dbtbpre;
	if($edown==6||$edown==7||$edown==8||$edown==9||$edown==10||$edown==11)
	{
		if($class_r[$classid][islast])//终极类别
		{
			$where="classid='$classid'";
		}
		else
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
		}
	}
	if($edown==0)//所有最新
	{
		$query="checked=1";
		$order="softtime";
	}
	elseif($edown==1)//所有推荐
	{
		$query="isgood=1 and checked=1";
		$order="softtime";
	}
	elseif($edown==2)//所有总排行
	{
		$query="checked=1";
		$order="count_all";
	}
	elseif($edown==3)//所有月排行
	{
		$query="checked=1";
		$order="count_month";
	}
	elseif($edown==4)//所有周排行
	{
		$query="checked=1";
		$order="count_week";
	}
	elseif($edown==5)//所有日排行
	{
		$query="checked=1";
		$order="count_day";
	}
	//分类
	elseif($edown==6)//分类最新
	{
		$query="(".$where.") and checked=1";
		$order="softtime";
	}
	elseif($edown==7)//分类推荐
	{
		$query="isgood=1 and (".$where.") and checked=1";
		$order="softtime";
	}
	elseif($edown==8)//分类总排行
	{
		$query="(".$where.") and checked=1";
		$order="count_all";
	}
	elseif($edown==9)//分类月排行
	{
		$query="(".$where.") and checked=1";
		$order="count_month";
	}
	elseif($edown==10)//分类周排行
	{
		$query="(".$where.") and checked=1";
		$order="count_week";
	}
	elseif($edown==11)//分类日排行
	{
		$query="(".$where.") and checked=1";
		$order="count_day";
	}
	//专题
	elseif($edown==12)//专题最新
	{
		$query="ztid='$classid' and checked=1";
		$order="softtime";
	}
	elseif($edown==13)//专题推荐
	{
		$query="isgood=1 and ztid='$classid' and checked=1";
		$order="softtime";
	}
	elseif($edown==14)//专题总排行
	{
		$query="ztid='$classid' and checked=1";
		$order="count_all";
	}
	elseif($edown==15)//专题月排行
	{
		$query="ztid='$classid' and checked=1";
		$order="count_month";
	}
	elseif($edown==16)//专题周排行
	{
		$query="ztid='$classid' and checked=1";
		$order="count_week";
	}
	elseif($edown==17)//专题日排行
	{
		$query="ztid='$classid' and checked=1";
		$order="count_day";
	}
	//软件类型
	elseif($edown==18)//软件类型最新
	{
		$query="softtype='$classid' and checked=1";
		$order="softtime";
	}
	elseif($edown==19)//软件类型推荐
	{
		$query="isgood=1 and softtype='$classid' and checked=1";
		$order="softtime";
	}
	elseif($edown==20)//软件类型总排行
	{
		$query="softtype='$classid' and checked=1";
		$order="count_all";
	}
	elseif($edown==21)//软件类型月排行
	{
		$query="softtype='$classid' and checked=1";
		$order="count_month";
	}
	elseif($edown==22)//软件类型周排行
	{
		$query="softtype='$classid' and checked=1";
		$order="count_week";
	}
	elseif($edown==23)//软件类型日排行
	{
		$query="softtype='$classid' and checked=1";
		$order="count_day";
	}
	//图片信息
	if($do)
	{
		$query.=" and softpic<>''";
    }
	$sql=$empire->query("select softid,softname,softsay,classid,softtime,homepage,adduser,writer,filesize,filetype,demo,softpic,count_all,count_month,count_week,soft_sq,soft_fj,downfen,star,language,softtype,foruser,soft_version,titleurl,titlefont,count_day,filename,ztid from {$dbtbpre}down where ".$query." order by ".$order." desc limit ".$line);
	return $sql;
}

//灵动标签：返回SQL内容函数
function sys_ReturnEdownLoopBq($classid=0,$line=10,$edown=0,$doing=0){
	return sys_ReturnBqQuery($classid,$line,$edown,$doing);
}

//灵动标签：返回特殊内容函数
function sys_ReturnEdownLoopStext($r){
	global $class_r;
	$sr['softurl']=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
	$sr['classname']=EdReturnClassname($r[classid]);
	$sr['classurl']=EDReturnClassUrl($r[classid]);
	return $sr;
}

//调用下载内容函数
function sys_GetClassDown($classid,$line,$strlen,$showdate=true,$edown=0,$showclass=0,$formatdate='(m-d)'){
	global $empire,$public_r,$class_r,$dbtbpre;
	$sql=sys_ReturnBqQuery($classid,$line,$edown,0);
	$record=0;
	while($r=$empire->fetch($sql))
	{
		$record=1;
		//栏目名
		if($showclass)
		{
			$classurl=EDReturnClassUrl($r[classid]);
			$myadd="[<a href='$classurl'>".EdReturnClassname($r[classid])."</a>]";
		}
		//软件名
		$oldsoftname=$r[softname];
		$softname=sub($r[softname],0,$strlen,false);
		$softname=DoTitleFont($r[titlefont],$softname);
		//时间
		if($showdate)
		{
			$bsofttime=date($formatdate,$r[softtime]);
			$softtime="&nbsp;".$bsofttime;
		}
		//链接
		$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
		$softname="·".$myadd."<a href='".$softurl."' target=_blank title='".$oldsoftname."'>".$softname."</a>".$softtime;
        $allsoft.="<tr><td height=20>".$softname."</td></tr>";
	}
	if($record)
	{
		echo"<table border=0 cellpadding=0 cellspacing=0>$allsoft</TABLE>";
	}
}

//按图片调用下载
function sys_GetDownPic($classid,$line,$num,$width,$height,$showtitle=true,$strlen,$down=0){
	global $empire,$public_r,$class_r,$dbtbpre;
	$sql=sys_ReturnBqQuery($classid,$line,$down,1);
	$i=0;
	while($r=$empire->fetch($sql))
	{
		$i++;
		if(($i-1)%$num==0||$i==1)
		{
			$class_text.="<tr>";
		}
		//链接
		$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
		//是否显示软件名
		if($showtitle)
		{
			$oldsoftname=$r[softname];
			$softname=sub($r[softname],0,$strlen,false);
			//标题属性
			$softname=DoTitleFont($r[titlefont],$softname);
			$softname="<br><span style='line-height=15pt'>".$softname."</span>";
		}
		$class_text.="<td align=center><a href='".$softurl."' title='".$oldsoftname."' target=_blank><img src='".$r[softpic]."' width='".$width."' height='".$height."' border=0>".$softname."</a></td>";
		//分割
		if($i%$num==0)
		{
			$class_text.="</tr>";
		}
	}
	if($i<>0)
	{
		$table="<table width='100%' border=0 cellpadding=3 cellspacing=0>";
		$table1="</table>";
		$ys=$num-$i%$num;
		$p=0;
		for($j=0;$j<$ys&&$ys!=$num;$j++)
		{
			$p=1;
			$class_text.="<td></td>";
		}
		if($p==1)
		{
			$class_text.="</tr>";
		}
	}
	$text=$table.$class_text.$table1;
	echo"$text";
}

//显示所有软件数
function sys_GetTotalSoftnum($s,$down=0,$day=0){
	global $empire,$class_r,$dbtbpre;
	if($day)
	{
		if($day==1)//今日信息
		{
			$date=date("Y-m-d");
			$starttime=$date." 00:00:01";
			$endtime=$date." 23:59:59";
		}
		elseif($day==2)//本月信息
		{
			$date=date("Y-m");
			$starttime=$date."-01 00:00:01";
			$endtime=$date."-".date("t")." 23:59:59";
		}
		elseif($day==3)//本年信息
		{
			$date=date("Y");
			$starttime=$date."-01-01 00:00:01";
			$endtime=($date+1)."-01-01 00:00:01";
		}
		$and=" and softtime>=".to_time($starttime)." and softtime<=".to_time($endtime);
	}
	if($down==1)//分类统计
	{
		if($class_r[$s][islast])//终极
		{
			$where="classid='$s'";
		}
		else
		{
			$where=ReturnClass($class_r[$s][sonclass]);
		}
		$query="select count(*) as total from {$dbtbpre}down where ".$where." and checked=1".$and;
	}
	elseif($down==2)//专题
	{
		$query="select count(*) as total from {$dbtbpre}down where ztid='$s' and checked=1".$and;
	}
	elseif($down==3)//软件类型
	{
		$query="select count(*) as total from {$dbtbpre}down where softtype='$s' and checked=1".$and;
	}
	elseif($down==4)//总下载数
	{
		$query="select sum(count_all) as total from {$dbtbpre}down where checked=1".$and;
	}
	else//总软件数
	{
		$query="select count(*) as total from {$dbtbpre}down where checked=1".$and;
	}
	$num=$empire->gettotal($query);
	echo $num;
}

//投票标签
function sys_GetDownVote($voteid){
	global $empire,$public_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}downvote where voteid='$voteid'");
	if(empty($r[votetext]))
	{
		return '';
	}
	//模板
	$votetemp=GetDownTemp("votetemp");
	$votetemp=RepVoteTempAllvar($votetemp,$r);
	$listexp="[!--empiredown.listtemp--]";
	$listtemp_r=explode($listexp,$votetemp);
	$r_exp="\r\n";
	$f_exp="::::::";
	//项目数
	$r_r=explode($r_exp,$r[votetext]);
	$checked=0;
	for($i=0;$i<count($r_r);$i++)
	{
		$checked++;
		$f_r=explode($f_exp,$r_r[$i]);
		//投票类型
		if($r[voteclass])
		{$vote="<input type=checkbox name=vote[] value=".$checked.">";}
		else
		{$vote="<input type=radio name=vote value=".$checked.">";}
		$votetext.=RepVoteTempListvar($listtemp_r[1],$vote,$f_r[0]);
    }
	$votetext=$listtemp_r[0].$votetext.$listtemp_r[2];
	echo"$votetext";
}

//广告标签
function sys_GetDownAd($adid){
	global $empire,$public_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}downad where adid='$adid'");
	if($r['ylink'])
	{
		$ad_url=$r['url'];
	}
	else
	{
		$ad_url=$public_r[sitedown]."ClickAd?adid=".$adid;//广告链接
	}
	//----------------------文字广告
	if($r[t]==1)
	{
		$r[titlefont]=$r[titlecolor].','.$r[titlefont];
		$picurl=DoTitleFont($r[titlefont],$r[picurl]);//文字属性
		$h="<a href='".$ad_url."' target=".$r[target]." title='".$r[alt]."'>".addslashes($picurl)."</a>";
		//普通显示
		if($r[adtype]==1)
		{
			$html=$h;
	    }
		//可移动透明对话框
		else
		{
			$html="<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_dialog.js></script> 
<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >关闭>>><img border='0' src='".$public_r[sitedown]."data/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>";
	    }
    }
	//------------------html广告
	elseif($r[t]==2)
	{
		$h=$r[htmlcode];
		//普通显示
		if($r[adtype]==1)
		{
			$html=$h;
		}
		//可移动透明对话框
		else
		{
			$html="<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_dialog.js></script>
<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >关闭>>><img border='0' src='".$public_r[sitedown]."data/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>";
		}
    }
	//------------------弹出广告
	elseif($r[t]==3)
	{
		//打开新窗口
		if($r[adtype]==8)
		{
			$html="<script>window.open('".$r[url]."');</script>";
		}
		//弹出窗口
	    elseif($r[adtype]==9)
		{
			$html="<script>window.open('".$r[url]."','','width=".$r[pic_width].",height=".$r[pic_height].",scrollbars=yes');</script>";
		}
		//普能网页窗口
		else
		{
			$html="<script>window.showModalDialog('".$r[url]."','','dialogWidth:".$r[pic_width]."px;dialogHeight:".$r[pic_height]."px;scroll:no;status:no;help:no');</script>";
		}
    }
	//---------------------图片与flash广告
	else
	{
		$filetype=GetFiletype($r[picurl]);
		//flash
		if($filetype==".swf")
		{
			$h="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' name='movie' width='".$r[pic_width]."' height='".$r[pic_height]."' id='movie'><param name='movie' value='".$r[picurl]."'><param name='quality' value='high'><param name='menu' value='false'><embed src='".$r[picurl]."' width='".$r[pic_width]."' height='".$r[pic_height]."' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' id='movie' name='movie' menu='false'></embed><PARAM NAME='wmode' VALUE='Opaque'></object>";
		}
		else
		{
			$h="<a href='".$ad_url."' target=".$r[target]."><img src='".$r[picurl]."' border=0 width='".$r[pic_width]."' height='".$r[pic_height]."' alt='".$r[alt]."'></a>";
		}
		//普通显示
		if($r[adtype]==1)
		{
			$html=$h;
		}
		//满屏浮动显示
		elseif($r[adtype]==4)
		{
			$html="<script>ns4=(document.layers)?true:false;
ie4=(document.all)?true:false;
if(ns4){document.write(\"<layer id=DGbanner2 width=".$r[pic_width]." height=".$r[pic_height]." onmouseover=stopme('DGbanner2') onmouseout=movechip('DGbanner2')>".$h."</layer>\");}
else{document.write(\"<div id=DGbanner2 style='position:absolute; width:".$r[pic_width]."px; height:".$r[pic_height]."px; z-index:9; filter: Alpha(Opacity=90)' onmouseover=stopme('DGbanner2') onmouseout=movechip('DGbanner2')>".$h."</div>\");}</script>
<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_float_fullscreen.js></script>";
		}
		//上下浮动显示 - 右
		elseif($r[adtype]==5)
		{
			$html="<script>if (navigator.appName == 'Netscape')
{document.write(\"<layer id=DGbanner3 top=150 width=".$r[pic_width]." height=".$r[pic_height].">".$h."</layer>\");}
else{document.write(\"<div id=DGbanner3 style='position: absolute;width:".$r[pic_height].";top:150;visibility: visible;z-index: 1'>".$h."</div>\");}</script>
<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_float_upanddown.js></script>";
		}
		//上下浮动显示 - 左
		elseif($r[adtype]==6)
		{
			$html="<script>if(navigator.appName == 'Netscape')
{document.write(\"<layer id=DGbanner10 top=150 width=".$r[pic_width]." height=".$r[pic_height].">".$h."</layer>\");}
else{document.write(\"<div id=DGbanner10 style='position: absolute;width:".$r[pic_width].";top:150;visibility: visible;z-index: 1'>".$h."</div>\");}</script>
<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_float_upanddown_L.js></script>";
		}
		//全屏幕渐隐消失
		elseif($r[adtype]==7)
		{
			$html="<script>ns4=(document.layers)?true:false;
if(ns4){document.write(\"<layer id=DGbanner4Cont onLoad='moveToAbsolute(layer1.pageX-160,layer1.pageY);clip.height=".$r[pic_height].";clip.width=".$r[pic_width]."; visibility=show;'><layer id=DGbanner4News position:absolute; top:0; left:0>".$h."</layer></layer>\");}
else{document.write(\"<div id=DGbanner4 style='position:absolute;top:0; left:0;'><div id=DGbanner4Cont style='position:absolute;width:".$r[pic_width].";height:".$r[pic_height].";clip:rect(0,".$r[pic_width].",".$r[pic_height].",0)'><div id=DGbanner4News style='position:absolute;top:0;left:0;right:820'>".$h."</div></div></div>\");}</script> 
<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_fullscreen.js></script>";
		}
		//可移动透明对话框
		elseif($r[adtype]==3)
		{
			$html="<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_dialog.js></script> 
<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >关闭>>><img border='0' src='".$public_r[sitedown]."data/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>";
		}
		else
		{
			$html="<script>function closeAd(){huashuolayer2.style.visibility='hidden';huashuolayer3.style.visibility='hidden';}function winload(){huashuolayer2.style.top=109;huashuolayer2.style.left=5;huashuolayer3.style.top=109;huashuolayer3.style.right=5;}//if(document.body.offsetWidth>800){
				{document.write(\"<div id=huashuolayer2 style='position: absolute;visibility:visible;z-index:1'><table width=0  border=0 cellspacing=0 cellpadding=0><tr><td height=10 align=right bgcolor=666666><a href=javascript:closeAd()><img src=".$public_r[sitedown]."data/js/acmsd/close.gif width=12 height=10 border=0></a></td></tr><tr><td>".$h."</td></tr></table></div>\"+\"<div id=huashuolayer3 style='position: absolute;visibility:visible;z-index:1'><table width=0  border=0 cellspacing=0 cellpadding=0><tr><td height=10 align=right bgcolor=666666><a href=javascript:closeAd()><img src=".$public_r[sitedown]."data/js/acmsd/close.gif width=12 height=10 border=0></a></td></tr><tr><td>".$h."</td></tr></table></div>\");}winload()//}</script>";
		}
	}
	echo $html;
}

//友情链接
function sys_GetSitelink($line,$num,$enews=0,$stats=0){
	global $empire,$public_r,$dbtbpre;
	if($enews==1)//图片
	{
		$a=" and lpic<>''";
	}
	elseif($enews==2)//文字
	{
		$a=" and lpic=''";
	}
	else
	{
		$a="";
	}
	$sql=$empire->query("select * from {$dbtbpre}downlink where checked=1".$a." order by myorder,lid limit ".$num);
	//输出
	$i=0;
	while($r=$empire->fetch($sql))
	{
		//链接
		if(empty($stats))
		{
			$linkurl=$public_r[sitedown]."GotoSite?lid=".$r[lid]."&url=".urlencode($r[lurl]);
		}
		else
		{
			$linkurl=$r[lurl];
		}
		$i++;
		if(($i-1)%$line==0||$i==1)
		{
			$class_text.="<tr>";
		}
		if(empty($r[lpic]))//文字
		{
			$logo="<a href='".$linkurl."' title='".$r[lname]."' target=".$r[target].">".$r[lname]."</a>";
		}
		else//图片
		{
			$logo="<a href='".$linkurl."' target=".$r[target]."><img src='".$r[lpic]."' alt='".$r[lname]."' border=0 width='".$r[width]."' height='".$r[height]."'></a>";
		}
		$class_text.="<td align='center'>".$logo."</td>";
		//分割
		if($i%$line==0)
		{
			$class_text.="</tr>";
		}
	}
	if($i<>0)
	{
		$table="<table width='100%' border=0 cellpadding=3 cellspacing=0>";
		$table1="</table>";
		$ys=$line-$i%$line;
		$p=0;
		for($j=0;$j<$ys&&$ys!=$line;$j++)
		{
			$p=1;
			$class_text.="<td></td>";
		}
		if($p==1)
		{
			$class_text.="</tr>";
		}
	}
	$text=$table.$class_text.$table1;
	echo"$text";
}
?>