<?php
//�б�ģ���ҳ����
function sys_ShowListPage($num,$pagenum,$dolink,$dotype,$page,$lencord,$ok,$search=""){
	//��ҳ
	if($pagenum<>1)
	{
		$pagetop="<a href='".$dolink."_1".$dotype."'>��ҳ</a>&nbsp;&nbsp;";
	}
	else
	{
		$pagetop="��ҳ&nbsp;&nbsp;";
	}
	//��һҳ
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
		$pagepri="<a href='".$dolink.$prido."'>��һҳ</a>&nbsp;&nbsp;";
	}
	else
	{
		$pagepri="��һҳ&nbsp;&nbsp;";
	}
	//��һҳ
	if($pagenum<>$page)
	{
		$pagenex=$pagenum+1;
		$pagenext="<a href='".$dolink."_".$pagenex.$dotype."'>��һҳ</a>&nbsp;&nbsp;";
	}
	else
	{
		$pagenext="��һҳ&nbsp;&nbsp;";
	}
	//βҳ
	if($pagenum==$page)
	{
		$pageeof='βҳ';
	}
	else
	{
		$pageeof="<a href='".$dolink."_".$page.$dotype."'>βҳ</a>";
	}
	$options="";
	//ȡ������ҳ��
	if(empty($search))
	{
		for($go=1;$go<=$page;$go++)
		{
			$file="_".$go.$dotype;
			if($ok==$go)
			{$select=" selected";}
			else
			{$select="";}
			$myoptions.="<option value='".$dolink.$file."'>�� ".$go." ҳ</option>";
			$options.="<option value='".$dolink.$file."'".$select.">�� ".$go." ҳ</option>";
		}
	}
	else
	{
		$myoptions=$search;
		$options=str_replace("value='".$dolink."_".$ok.$dotype."'>","value='".$dolink."_".$ok.$dotype."' selected>",$search);
	}
	$options="<select name='select' onchange=\"self.location.href=this.options[this.selectedIndex].value\">".$options."</select>";
	//��ҳ
	$pagelink=$pagetop.$pagepri.$pagenext.$pageeof;
	//�滻ģ�����
	$pager['showpage']=ReturnListpageStr($pagenum,$page,$lencord,$num,$pagelink,$options);
	$pager['option']=$myoptions;
	return $pager;
}

//���ط�ҳ
function ReturnListpageStr($pagenum,$page,$lencord,$num,$pagelink,$options){
	global $public_r;
	$temp=stripSlashes(stripSlashes($public_r['listpagetemp']));
	$temp=str_replace("[!--thispage--]",$pagenum,$temp);//ҳ��
	$temp=str_replace("[!--pagenum--]",$page,$temp);//��ҳ��
	$temp=str_replace("[!--lencord--]",$lencord,$temp);//ÿҳ��ʾ����
	$temp=str_replace("[!--num--]",$num,$temp);//������
	$temp=str_replace("[!--pagelink--]",$pagelink,$temp);//ҳ������
	$temp=str_replace("[!--options--]",$options,$temp);//������ҳ
	return $temp;
}

//�б�ģ��֮�б�ʽ��ҳ
function sys_ShowListMorePage($num,$page,$dolink,$type,$totalpage,$line,$ok,$search=""){
	global $fun_r,$public_r;
	if($num<=$line)
	{
		$pager['showpage']='';
		return $pager;
	}
	$page_line=$public_r['listpagelistnum'];
	$snum=2;
	//$totalpage=ceil($num/$line);//ȡ����ҳ��
	$firststr='<a title="����">&nbsp;<b>'.$num.'</b> </a>&nbsp;&nbsp;';
	//��һҳ
	if($page<>1)
	{
		$toppage='<a href="'.$dolink.'_1'.$type.'">��ҳ</a>&nbsp;';
		$pagepr=$page-1;
		if($pagepr==1)
		{
			$prido="_1".$type;
		}
		else
		{
			$prido="_".$pagepr.$type;
		}
		$prepage='<a href="'.$dolink.$prido.'">��һҳ</a>';
	}
	//��һҳ
	if($page!=$totalpage)
	{
		$pagenex=$page+1;
		$nextpage='&nbsp;<a href="'.$dolink.'_'.$pagenex.$type.'">��һҳ</a>';
		$lastpage='&nbsp;<a href="'.$dolink.'_'.$totalpage.$type.'">βҳ</a>';
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

//����sql���
function sys_ReturnBqQuery($classid,$line,$edown=0,$do=0){
	global $empire,$public_r,$class_r,$navclassid,$dbtbpre;
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
	}
	elseif($edown==1)//�����Ƽ�
	{
		$query="isgood=1 and checked=1";
		$order="softtime";
	}
	elseif($edown==2)//����������
	{
		$query="checked=1";
		$order="count_all";
	}
	elseif($edown==3)//����������
	{
		$query="checked=1";
		$order="count_month";
	}
	elseif($edown==4)//����������
	{
		$query="checked=1";
		$order="count_week";
	}
	elseif($edown==5)//����������
	{
		$query="checked=1";
		$order="count_day";
	}
	//����
	elseif($edown==6)//��������
	{
		$query="(".$where.") and checked=1";
		$order="softtime";
	}
	elseif($edown==7)//�����Ƽ�
	{
		$query="isgood=1 and (".$where.") and checked=1";
		$order="softtime";
	}
	elseif($edown==8)//����������
	{
		$query="(".$where.") and checked=1";
		$order="count_all";
	}
	elseif($edown==9)//����������
	{
		$query="(".$where.") and checked=1";
		$order="count_month";
	}
	elseif($edown==10)//����������
	{
		$query="(".$where.") and checked=1";
		$order="count_week";
	}
	elseif($edown==11)//����������
	{
		$query="(".$where.") and checked=1";
		$order="count_day";
	}
	//ר��
	elseif($edown==12)//ר������
	{
		$query="ztid='$classid' and checked=1";
		$order="softtime";
	}
	elseif($edown==13)//ר���Ƽ�
	{
		$query="isgood=1 and ztid='$classid' and checked=1";
		$order="softtime";
	}
	elseif($edown==14)//ר��������
	{
		$query="ztid='$classid' and checked=1";
		$order="count_all";
	}
	elseif($edown==15)//ר��������
	{
		$query="ztid='$classid' and checked=1";
		$order="count_month";
	}
	elseif($edown==16)//ר��������
	{
		$query="ztid='$classid' and checked=1";
		$order="count_week";
	}
	elseif($edown==17)//ר��������
	{
		$query="ztid='$classid' and checked=1";
		$order="count_day";
	}
	//�������
	elseif($edown==18)//�����������
	{
		$query="softtype='$classid' and checked=1";
		$order="softtime";
	}
	elseif($edown==19)//��������Ƽ�
	{
		$query="isgood=1 and softtype='$classid' and checked=1";
		$order="softtime";
	}
	elseif($edown==20)//�������������
	{
		$query="softtype='$classid' and checked=1";
		$order="count_all";
	}
	elseif($edown==21)//�������������
	{
		$query="softtype='$classid' and checked=1";
		$order="count_month";
	}
	elseif($edown==22)//�������������
	{
		$query="softtype='$classid' and checked=1";
		$order="count_week";
	}
	elseif($edown==23)//�������������
	{
		$query="softtype='$classid' and checked=1";
		$order="count_day";
	}
	//ͼƬ��Ϣ
	if($do)
	{
		$query.=" and softpic<>''";
    }
	$sql=$empire->query("select softid,softname,softsay,classid,softtime,homepage,adduser,writer,filesize,filetype,demo,softpic,count_all,count_month,count_week,soft_sq,soft_fj,downfen,star,language,softtype,foruser,soft_version,titleurl,titlefont,count_day,filename,ztid from {$dbtbpre}down where ".$query." order by ".$order." desc limit ".$line);
	return $sql;
}

//�鶯��ǩ������SQL���ݺ���
function sys_ReturnEdownLoopBq($classid=0,$line=10,$edown=0,$doing=0){
	return sys_ReturnBqQuery($classid,$line,$edown,$doing);
}

//�鶯��ǩ�������������ݺ���
function sys_ReturnEdownLoopStext($r){
	global $class_r;
	$sr['softurl']=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
	$sr['classname']=EdReturnClassname($r[classid]);
	$sr['classurl']=EDReturnClassUrl($r[classid]);
	return $sr;
}

//�����������ݺ���
function sys_GetClassDown($classid,$line,$strlen,$showdate=true,$edown=0,$showclass=0,$formatdate='(m-d)'){
	global $empire,$public_r,$class_r,$dbtbpre;
	$sql=sys_ReturnBqQuery($classid,$line,$edown,0);
	$record=0;
	while($r=$empire->fetch($sql))
	{
		$record=1;
		//��Ŀ��
		if($showclass)
		{
			$classurl=EDReturnClassUrl($r[classid]);
			$myadd="[<a href='$classurl'>".EdReturnClassname($r[classid])."</a>]";
		}
		//�����
		$oldsoftname=$r[softname];
		$softname=sub($r[softname],0,$strlen,false);
		$softname=DoTitleFont($r[titlefont],$softname);
		//ʱ��
		if($showdate)
		{
			$bsofttime=date($formatdate,$r[softtime]);
			$softtime="&nbsp;".$bsofttime;
		}
		//����
		$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
		$softname="��".$myadd."<a href='".$softurl."' target=_blank title='".$oldsoftname."'>".$softname."</a>".$softtime;
        $allsoft.="<tr><td height=20>".$softname."</td></tr>";
	}
	if($record)
	{
		echo"<table border=0 cellpadding=0 cellspacing=0>$allsoft</TABLE>";
	}
}

//��ͼƬ��������
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
		//����
		$softurl=EDReturnSoftPageUrl($r[filename],$r[titleurl]);
		//�Ƿ���ʾ�����
		if($showtitle)
		{
			$oldsoftname=$r[softname];
			$softname=sub($r[softname],0,$strlen,false);
			//��������
			$softname=DoTitleFont($r[titlefont],$softname);
			$softname="<br><span style='line-height=15pt'>".$softname."</span>";
		}
		$class_text.="<td align=center><a href='".$softurl."' title='".$oldsoftname."' target=_blank><img src='".$r[softpic]."' width='".$width."' height='".$height."' border=0>".$softname."</a></td>";
		//�ָ�
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

//��ʾ���������
function sys_GetTotalSoftnum($s,$down=0,$day=0){
	global $empire,$class_r,$dbtbpre;
	if($day)
	{
		if($day==1)//������Ϣ
		{
			$date=date("Y-m-d");
			$starttime=$date." 00:00:01";
			$endtime=$date." 23:59:59";
		}
		elseif($day==2)//������Ϣ
		{
			$date=date("Y-m");
			$starttime=$date."-01 00:00:01";
			$endtime=$date."-".date("t")." 23:59:59";
		}
		elseif($day==3)//������Ϣ
		{
			$date=date("Y");
			$starttime=$date."-01-01 00:00:01";
			$endtime=($date+1)."-01-01 00:00:01";
		}
		$and=" and softtime>=".to_time($starttime)." and softtime<=".to_time($endtime);
	}
	if($down==1)//����ͳ��
	{
		if($class_r[$s][islast])//�ռ�
		{
			$where="classid='$s'";
		}
		else
		{
			$where=ReturnClass($class_r[$s][sonclass]);
		}
		$query="select count(*) as total from {$dbtbpre}down where ".$where." and checked=1".$and;
	}
	elseif($down==2)//ר��
	{
		$query="select count(*) as total from {$dbtbpre}down where ztid='$s' and checked=1".$and;
	}
	elseif($down==3)//�������
	{
		$query="select count(*) as total from {$dbtbpre}down where softtype='$s' and checked=1".$and;
	}
	elseif($down==4)//��������
	{
		$query="select sum(count_all) as total from {$dbtbpre}down where checked=1".$and;
	}
	else//�������
	{
		$query="select count(*) as total from {$dbtbpre}down where checked=1".$and;
	}
	$num=$empire->gettotal($query);
	echo $num;
}

//ͶƱ��ǩ
function sys_GetDownVote($voteid){
	global $empire,$public_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}downvote where voteid='$voteid'");
	if(empty($r[votetext]))
	{
		return '';
	}
	//ģ��
	$votetemp=GetDownTemp("votetemp");
	$votetemp=RepVoteTempAllvar($votetemp,$r);
	$listexp="[!--empiredown.listtemp--]";
	$listtemp_r=explode($listexp,$votetemp);
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
	$votetext=$listtemp_r[0].$votetext.$listtemp_r[2];
	echo"$votetext";
}

//����ǩ
function sys_GetDownAd($adid){
	global $empire,$public_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}downad where adid='$adid'");
	if($r['ylink'])
	{
		$ad_url=$r['url'];
	}
	else
	{
		$ad_url=$public_r[sitedown]."ClickAd?adid=".$adid;//�������
	}
	//----------------------���ֹ��
	if($r[t]==1)
	{
		$r[titlefont]=$r[titlecolor].','.$r[titlefont];
		$picurl=DoTitleFont($r[titlefont],$r[picurl]);//��������
		$h="<a href='".$ad_url."' target=".$r[target]." title='".$r[alt]."'>".addslashes($picurl)."</a>";
		//��ͨ��ʾ
		if($r[adtype]==1)
		{
			$html=$h;
	    }
		//���ƶ�͸���Ի���
		else
		{
			$html="<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_dialog.js></script> 
<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >�ر�>>><img border='0' src='".$public_r[sitedown]."data/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>";
	    }
    }
	//------------------html���
	elseif($r[t]==2)
	{
		$h=$r[htmlcode];
		//��ͨ��ʾ
		if($r[adtype]==1)
		{
			$html=$h;
		}
		//���ƶ�͸���Ի���
		else
		{
			$html="<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_dialog.js></script>
<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >�ر�>>><img border='0' src='".$public_r[sitedown]."data/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>";
		}
    }
	//------------------�������
	elseif($r[t]==3)
	{
		//���´���
		if($r[adtype]==8)
		{
			$html="<script>window.open('".$r[url]."');</script>";
		}
		//��������
	    elseif($r[adtype]==9)
		{
			$html="<script>window.open('".$r[url]."','','width=".$r[pic_width].",height=".$r[pic_height].",scrollbars=yes');</script>";
		}
		//������ҳ����
		else
		{
			$html="<script>window.showModalDialog('".$r[url]."','','dialogWidth:".$r[pic_width]."px;dialogHeight:".$r[pic_height]."px;scroll:no;status:no;help:no');</script>";
		}
    }
	//---------------------ͼƬ��flash���
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
		//��ͨ��ʾ
		if($r[adtype]==1)
		{
			$html=$h;
		}
		//����������ʾ
		elseif($r[adtype]==4)
		{
			$html="<script>ns4=(document.layers)?true:false;
ie4=(document.all)?true:false;
if(ns4){document.write(\"<layer id=DGbanner2 width=".$r[pic_width]." height=".$r[pic_height]." onmouseover=stopme('DGbanner2') onmouseout=movechip('DGbanner2')>".$h."</layer>\");}
else{document.write(\"<div id=DGbanner2 style='position:absolute; width:".$r[pic_width]."px; height:".$r[pic_height]."px; z-index:9; filter: Alpha(Opacity=90)' onmouseover=stopme('DGbanner2') onmouseout=movechip('DGbanner2')>".$h."</div>\");}</script>
<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_float_fullscreen.js></script>";
		}
		//���¸�����ʾ - ��
		elseif($r[adtype]==5)
		{
			$html="<script>if (navigator.appName == 'Netscape')
{document.write(\"<layer id=DGbanner3 top=150 width=".$r[pic_width]." height=".$r[pic_height].">".$h."</layer>\");}
else{document.write(\"<div id=DGbanner3 style='position: absolute;width:".$r[pic_height].";top:150;visibility: visible;z-index: 1'>".$h."</div>\");}</script>
<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_float_upanddown.js></script>";
		}
		//���¸�����ʾ - ��
		elseif($r[adtype]==6)
		{
			$html="<script>if(navigator.appName == 'Netscape')
{document.write(\"<layer id=DGbanner10 top=150 width=".$r[pic_width]." height=".$r[pic_height].">".$h."</layer>\");}
else{document.write(\"<div id=DGbanner10 style='position: absolute;width:".$r[pic_width].";top:150;visibility: visible;z-index: 1'>".$h."</div>\");}</script>
<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_float_upanddown_L.js></script>";
		}
		//ȫ��Ļ������ʧ
		elseif($r[adtype]==7)
		{
			$html="<script>ns4=(document.layers)?true:false;
if(ns4){document.write(\"<layer id=DGbanner4Cont onLoad='moveToAbsolute(layer1.pageX-160,layer1.pageY);clip.height=".$r[pic_height].";clip.width=".$r[pic_width]."; visibility=show;'><layer id=DGbanner4News position:absolute; top:0; left:0>".$h."</layer></layer>\");}
else{document.write(\"<div id=DGbanner4 style='position:absolute;top:0; left:0;'><div id=DGbanner4Cont style='position:absolute;width:".$r[pic_width].";height:".$r[pic_height].";clip:rect(0,".$r[pic_width].",".$r[pic_height].",0)'><div id=DGbanner4News style='position:absolute;top:0;left:0;right:820'>".$h."</div></div></div>\");}</script> 
<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_fullscreen.js></script>";
		}
		//���ƶ�͸���Ի���
		elseif($r[adtype]==3)
		{
			$html="<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_dialog.js></script> 
<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >�ر�>>><img border='0' src='".$public_r[sitedown]."data/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>";
		}
		else
		{
			$html="<script>function closeAd(){huashuolayer2.style.visibility='hidden';huashuolayer3.style.visibility='hidden';}function winload(){huashuolayer2.style.top=109;huashuolayer2.style.left=5;huashuolayer3.style.top=109;huashuolayer3.style.right=5;}//if(document.body.offsetWidth>800){
				{document.write(\"<div id=huashuolayer2 style='position: absolute;visibility:visible;z-index:1'><table width=0  border=0 cellspacing=0 cellpadding=0><tr><td height=10 align=right bgcolor=666666><a href=javascript:closeAd()><img src=".$public_r[sitedown]."data/js/acmsd/close.gif width=12 height=10 border=0></a></td></tr><tr><td>".$h."</td></tr></table></div>\"+\"<div id=huashuolayer3 style='position: absolute;visibility:visible;z-index:1'><table width=0  border=0 cellspacing=0 cellpadding=0><tr><td height=10 align=right bgcolor=666666><a href=javascript:closeAd()><img src=".$public_r[sitedown]."data/js/acmsd/close.gif width=12 height=10 border=0></a></td></tr><tr><td>".$h."</td></tr></table></div>\");}winload()//}</script>";
		}
	}
	echo $html;
}

//��������
function sys_GetSitelink($line,$num,$enews=0,$stats=0){
	global $empire,$public_r,$dbtbpre;
	if($enews==1)//ͼƬ
	{
		$a=" and lpic<>''";
	}
	elseif($enews==2)//����
	{
		$a=" and lpic=''";
	}
	else
	{
		$a="";
	}
	$sql=$empire->query("select * from {$dbtbpre}downlink where checked=1".$a." order by myorder,lid limit ".$num);
	//���
	$i=0;
	while($r=$empire->fetch($sql))
	{
		//����
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
		if(empty($r[lpic]))//����
		{
			$logo="<a href='".$linkurl."' title='".$r[lname]."' target=".$r[target].">".$r[lname]."</a>";
		}
		else//ͼƬ
		{
			$logo="<a href='".$linkurl."' target=".$r[target]."><img src='".$r[lpic]."' alt='".$r[lname]."' border=0 width='".$r[width]."' height='".$r[height]."'></a>";
		}
		$class_text.="<td align='center'>".$logo."</td>";
		//�ָ�
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