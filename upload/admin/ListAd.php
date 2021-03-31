<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"ad");

//���ӹ�����
function AddAdClass($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[classname])
	{
		printerror("���������Ϊ��","history.go(-1)");
    }
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"ad");
	$sql=$empire->query("insert into {$dbtbpre}downadclass(classname) values('$add[classname]');");
	$classid=$empire->lastid();
	if($sql)
	{
		printerror("���ӹ�����ɹ�","AdClass.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸Ĺ�����
function EditAdClass($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[classid]=(int)$add[classid];
	if(!$add[classname]||!$add[classid])
	{
		printerror("���������Ϊ��","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"ad");
	$sql=$empire->query("update {$dbtbpre}downadclass set classname='$add[classname]' where classid='$add[classid]'");
    if($sql)
	{
		printerror("�޸Ĺ�����ɹ�","AdClass.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ��������
function DelAdClass($classid,$userid,$username){
	global $empire,$dbtbpre;
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("��ѡ��Ҫɾ���Ĺ�����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"ad");
	$sql=$empire->query("delete from {$dbtbpre}downadclass where classid='$classid'");
	if($sql)
	{
		printerror("ɾ��������ɹ�","AdClass.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//���ӹ��
function AddAd($add,$titlefont,$titlecolor,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[classid]||!$add[title]||!$add[adtype])
	{
		printerror("��ѡ�������������������","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"ad");
	$ttitlefont=TitleFont($titlefont,'no');
	//��������
	$add[pic_width]=(int)$add[pic_width];
	$add[pic_height]=(int)$add[pic_height];
	$add[classid]=(int)$add[classid];
	$add[adtype]=(int)$add[adtype];
	$add[t]=(int)$add[t];
	$add[ylink]=(int)$add[ylink];
	$sql=$empire->query("insert into {$dbtbpre}downad(picurl,url,pic_width,pic_height,onclick,classid,adtype,title,target,alt,starttime,endtime,adsay,titlefont,titlecolor,htmlcode,t,ylink) values('$add[picurl]','$add[url]',$add[pic_width],$add[pic_height],0,$add[classid],$add[adtype],'$add[title]','$add[target]','$add[alt]','$add[starttime]','$add[endtime]','$add[adsay]','$ttitlefont','$titlecolor','$add[htmlcode]',$add[t],$add[ylink]);");
	$adid=$empire->lastid();
	GetAdJs($adid);
	if($sql)
	{
		printerror("���ӹ��ɹ�","AddAd.php?phome=AddAd&t=".$add[t]);
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸Ĺ��
function EditAd($add,$titlefont,$titlecolor,$userid,$username){
	global $empire,$time,$dbtbpre;
	$add[adid]=(int)$add[adid];
	if(!$add[classid]||!$add[title]||!$add[adtype]||!$add[adid])
	{
		printerror("��ѡ�������������������","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"ad");
	$ttitlefont=TitleFont($titlefont,'no');
	//����
	if($add[reset])
	{$a=",onclick=0";}
	//��������
	$add[pic_width]=(int)$add[pic_width];
	$add[pic_height]=(int)$add[pic_height];
	$add[classid]=(int)$add[classid];
	$add[adtype]=(int)$add[adtype];
	$add[t]=(int)$add[t];
	$add[ylink]=(int)$add[ylink];
	$sql=$empire->query("update {$dbtbpre}downad set picurl='$add[picurl]',url='$add[url]',pic_width=$add[pic_width],pic_height=$add[pic_height],classid=$add[classid],adtype=$add[adtype],title='$add[title]',target='$add[target]',alt='$add[alt]',starttime='$add[starttime]',endtime='$add[endtime]',adsay='$add[adsay]',titlefont='$ttitlefont',titlecolor='$titlecolor',htmlcode='$add[htmlcode]',t=$add[t],ylink=$add[ylink]".$a." where adid='$add[adid]'");
	GetAdJs($add[adid]);
	if($sql)
	{
		printerror("�޸Ĺ��ɹ�","ListAd.php?time=$time");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ�����
function DelAd($adid,$userid,$username){
	global $empire,$time,$public_r,$dbtbpre;
	$adid=(int)$adid;
	if(!$adid)
	{
		printerror("��ѡ��Ҫɾ���Ĺ��","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"ad");
	$r=$empire->fetch1("select title from {$dbtbpre}downad where adid='$adid'");
	$sql=$empire->query("delete from {$dbtbpre}downad where adid='$adid'");
	$file="../data/js/acmsd/".$public_r[adfile].$adid.".js";
	DelFiletext($file);
	if($sql)
	{
		printerror("ɾ�����ɹ�","ListAd.php?time=$time");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�������ɹ��
function ReAdJs_all($start=0,$from,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$start=(int)$start;
	if(empty($start))
	{
		$start=0;
    }
	$b=0;
	$sql=$empire->query("select adid from {$dbtbpre}downad where adid>$start order by adid limit ".$public_r['resoft_num']);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[adid];
		GetAdJs($r[adid]);
	}
	if(empty($b))
	{
		printerror("�������ɹ�����",$from);
	}
	echo "һ����������ɣ���������һ��......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='ListAd.php?phome=ReAdJs_all&start=$newstart&from=$from';</script>";
	exit();
}

//���ɹ��js
function GetAdJs($adid){
	global $empire,$public_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}downad where adid='$adid'");
	$file="../data/js/acmsd/".$public_r[adfile].$adid.".js";
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
			$html="document.write(\"".$h."\")";
	    }
		//���ƶ�͸���Ի���
		else
		{
			$html="document.write(\"<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_dialog.js></script>\"); 
document.write(\"<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >�ر�>>><img border='0' src='".$public_r[sitedown]."data/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>\");";
	    }
    }
	//------------------html���
	elseif($r[t]==2)
	{
		$h=addslashes(str_replace("\r\n","",$r[htmlcode]));
		//��ͨ��ʾ
		if($r[adtype]==1)
		{
			$html="document.write(\"".$h."\")";
		}
		//���ƶ�͸���Ի���
		else
		{
			$html="document.write(\"<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_dialog.js></script>\"); 
document.write(\"<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >�ر�>>><img border='0' src='".$public_r[sitedown]."data/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>\");";
		}
    }
	//------------------�������
	elseif($r[t]==3)
	{
		//���´���
		if($r[adtype]==8)
		{
			$html="window.open('".$r[url]."');";
		}
		//��������
	    elseif($r[adtype]==9)
		{
			$html="window.open('".$r[url]."','','width=".$r[pic_width].",height=".$r[pic_height].",scrollbars=yes');";
		}
		//������ҳ����
		else
		{
			$html="window.showModalDialog('".$r[url]."','','dialogWidth:".$r[pic_width]."px;dialogHeight:".$r[pic_height]."px;scroll:no;status:no;help:no');";
		}
    }
	//---------------------ͼƬ��flash���
	else
	{
	$filetype=GetFiletype($r[picurl]);
	
	//flash
		if($filetype==".swf")
		{
		$h="<object classid=\\\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\\\" codebase=\\\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\\\" name=\\\"movie\\\" width=\\\"".$r[pic_width]."\\\" height=\\\"".$r[pic_height]."\\\" id=\\\"movie\\\"><param name=\\\"movie\\\" value=\\\"".$r[picurl]."\\\"><param name=\\\"quality\\\" value=\\\"high\\\"><param name=\\\"menu\\\" value=\\\"false\\\"><embed src=\\\"".$r[picurl]."\\\" width=\\\"".$r[pic_width]."\\\" height=\\\"".$r[pic_height]."\\\" quality=\\\"high\\\" pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" type=\\\"application/x-shockwave-flash\\\" id=\\\"movie\\\" name=\\\"movie\\\" menu=\\\"false\\\"></embed><PARAM NAME='wmode' VALUE='Opaque'></object>";
	    }
	else
		{
		$h="<a href='".$ad_url."' target=".$r[target]."><img src='".$r[picurl]."' border=0 width='".$r[pic_width]."' height='".$r[pic_height]."' alt='".$r[alt]."'></a>";
	    }
		//��ͨ��ʾ
			if($r[adtype]==1)
		{
			$html="document.write(\"".$h."\");";
		}
		//����������ʾ
		elseif($r[adtype]==4)
		{
			$html="ns4=(document.layers)?true:false;
ie4=(document.all)?true:false;
if(ns4){document.write(\"<layer id=DGbanner2 width=".$r[pic_width]." height=".$r[pic_height]." onmouseover=stopme('DGbanner2') onmouseout=movechip('DGbanner2')>".$h."</layer>\");}
else{document.write(\"<div id=DGbanner2 style='position:absolute; width:".$r[pic_width]."px; height:".$r[pic_height]."px; z-index:9; filter: Alpha(Opacity=90)' onmouseover=stopme('DGbanner2') onmouseout=movechip('DGbanner2')>".$h."</div>\");}
document.write(\"<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_float_fullscreen.js></script>\");";
		}
		//���¸�����ʾ - ��
		elseif($r[adtype]==5)
		{
			$html="if (navigator.appName == 'Netscape')
{document.write(\"<layer id=DGbanner3 top=150 width=".$r[pic_width]." height=".$r[pic_height].">".$h."</layer>\");}
else{document.write(\"<div id=DGbanner3 style='position: absolute;width:".$r[pic_height].";top:150;visibility: visible;z-index: 1'>".$h."</div>\");}
document.write(\"<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_float_upanddown.js></script>\");";
		}
		//���¸�����ʾ - ��
		elseif($r[adtype]==6)
		{
			$html="if(navigator.appName == 'Netscape')
{document.write(\"<layer id=DGbanner10 top=150 width=".$r[pic_width]." height=".$r[pic_height].">".$h."</layer>\");}
else{document.write(\"<div id=DGbanner10 style='position: absolute;width:".$r[pic_width].";top:150;visibility: visible;z-index: 1'>".$h."</div>\");}
document.write(\"<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_float_upanddown_L.js></script>\");";
		}
		//ȫ��Ļ������ʧ
		elseif($r[adtype]==7)
		{
			$html="ns4=(document.layers)?true:false;
if(ns4){document.write(\"<layer id=DGbanner4Cont onLoad='moveToAbsolute(layer1.pageX-160,layer1.pageY);clip.height=".$r[pic_height].";clip.width=".$r[pic_width]."; visibility=show;'><layer id=DGbanner4News position:absolute; top:0; left:0>".$h."</layer></layer>\");}
else{document.write(\"<div id=DGbanner4 style='position:absolute;top:0; left:0;'><div id=DGbanner4Cont style='position:absolute;width:".$r[pic_width].";height:".$r[pic_height].";clip:rect(0,".$r[pic_width].",".$r[pic_height].",0)'><div id=DGbanner4News style='position:absolute;top:0;left:0;right:820'>".$h."</div></div></div>\");} 
document.write(\"<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_fullscreen.js></script>\");";
		}
		//���ƶ�͸���Ի���
		elseif($r[adtype]==3)
		{
			$html="document.write(\"<script language=javascript src=".$public_r[sitedown]."data/js/acmsd/ecms_dialog.js></script>\"); 
document.write(\"<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >�ر�>>><img border='0' src='".$public_r[sitedown]."data/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>\");";
		}
		else
		{
			$html="function closeAd(){huashuolayer2.style.visibility='hidden';huashuolayer3.style.visibility='hidden';}function winload(){huashuolayer2.style.top=109;huashuolayer2.style.left=5;huashuolayer3.style.top=109;huashuolayer3.style.right=5;}//if(document.body.offsetWidth>800){
				{document.write(\"<div id=huashuolayer2 style='position: absolute;visibility:visible;z-index:1'><table width=0  border=0 cellspacing=0 cellpadding=0><tr><td height=10 align=right bgcolor=666666><a href=javascript:closeAd()><img src=".$public_r[sitedown]."data/js/acmsd/close.gif width=12 height=10 border=0></a></td></tr><tr><td>".$h."</td></tr></table></div>\"+\"<div id=huashuolayer3 style='position: absolute;visibility:visible;z-index:1'><table width=0  border=0 cellspacing=0 cellpadding=0><tr><td height=10 align=right bgcolor=666666><a href=javascript:closeAd()><img src=".$public_r[sitedown]."data/js/acmsd/close.gif width=12 height=10 border=0></a></td></tr><tr><td>".$h."</td></tr></table></div>\");}winload()//}";
		}
    }
	WriteFiletext_n($file,$html);
}

$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
if($phome=="AddAdClass")//���ӹ�����
{
	$add=$_POST['add'];
	AddAdClass($add,$myuserid,$myusername);
}
elseif($phome=="EditAdClass")//�޸Ĺ�����
{
	$add=$_POST['add'];
	EditAdClass($add,$myuserid,$myusername);
}
elseif($phome=="DelAdClass")//ɾ���������
{
	$classid=$_GET['classid'];
	DelAdClass($classid,$myuserid,$myusername);
}
elseif($phome=="AddAd")//���ӹ��
{
	$add=$_POST['add'];
	$add[picurl]=$_POST['picurl'];
	$titlefont=$_POST['titlefont'];
	$titlecolor=$_POST['titlecolor'];
	AddAd($add,$titlefont,$titlecolor,$myuserid,$myusername);
}
elseif($phome=="EditAd")//�޸Ĺ��
{
	$add=$_POST['add'];
	$add[picurl]=$_POST['picurl'];
	$titlefont=$_POST['titlefont'];
	$titlecolor=$_POST['titlecolor'];
	EditAd($add,$titlefont,$titlecolor,$myuserid,$myusername);
}
elseif($phome=="DelAd")//ɾ�����
{
	$adid=$_GET['adid'];
	DelAd($adid,$myuserid,$myusername);
}
elseif($phome=="ReAdJs_all")//����ˢ�¹��JS
{
	ReAdJs_all($_GET['start'],$_GET['from'],$myuserid,$myusername);
}

$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=10;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
$query="select * from {$dbtbpre}downad";
//���ڹ��
$time=$_GET['time'];
$where=" where";
if($time)
{
	$date=date("Y-m-d");
	$query.=" where endtime<'$date'";
	$where=" and";
	$search="&time=$time";
}
//����
$sear=$_GET['sear'];
if($sear)
{
	$keyboard=RepPostVar2($_GET['keyboard']);
	if($keyboard)
	{
		$show=$_GET['show'];
		if($show==1)
		{
			$where.=" title like '%$keyboard%'";
		}
		elseif($show==2)
		{
			$where.=" adsay like '%$keyboard%'";
		}
		else
		{
			$where.=" (title like '%$keyboard%' or adsay like '%$keyboard%')";
		}
	}
	$classid=(int)$_GET['classid'];
	if($classid)
	{
		$where.=" and classid='$classid'";
	}
	$t=(int)$_GET['t'];
	if($t!=9)
	{
		$where.=" and t='$t'";
	}
	$search.="&classid=$classid&show=$show&t=$t&sear=1&keyboard=$keyboard";
	$query.=$where;
}
$num=$empire->num($query);//ȡ��������
$query=$query." order by adid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
$ty[1]="��ͨ��ʾ";
$ty[2]="";
$ty[3]="���ƶ�͸���Ի���";
$ty[4]="����������ʾ";
$ty[5]="���¸�����ʾ - ��";
$ty[6]="���¸�����ʾ - ��";
$ty[7]="ȫ��Ļ������ʧ";
$ty[8]="���´���";
$ty[9]="��������";
$ty[10]="��ͨ��ҳ�Ի���";
$ty[11]="����ʽ���";
$myt[1]="���ֹ��";
$myt[2]="html���";
$myt[3]="�������";
$myt[0]="ͼƬ��flash���";
//������
$csql=$empire->query("select classid,classname from {$dbtbpre}downadclass");
while($cr=$empire->fetch($csql))
{
	$options.="<option value=".$cr[classid].">".$cr[classname]."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>������</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">λ�ã�<a href="ListAd.php">������</a></td>
    <td><div align="right"> 
        <input type="button" name="Submit5" value="���ӹ��" onclick="self.location.href='AddAd.php?phome=AddAd';">
        &nbsp;&nbsp; 
        <input type="button" name="Submit52" value="������ڹ��" onclick="self.location.href='ListAd.php?time=1';">
        &nbsp;&nbsp; 
        <input type="button" name="Submit522" value="���������" onclick="self.location.href='AdClass.php';">
      </div></td>
  </tr>
</table>
<form name="form1" method="get" action="ListAd.php">
  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
    <input type=hidden name=time value=<?=$time?>>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ؼ��֣�
        <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
        <input name="show" type="radio" value="0" checked>
        ���� 
        <input name="show" type="radio" value="1">
        ������� 
        <input name="show" type="radio" value="2">
        ��ע 
        <select name="classid" id="classid">
          <option value="0">�������</option>
		  <?=$options?>
        </select>
        <select name="t" id="t">
          <option value="9">���޹������</option>
          <option value="0">ͼƬ��flash���</option>
          <option value="1">���ֹ��</option>
          <option value="2">html���</option>
          <option value="3">�������</option>
        </select>
        <input type="submit" name="Submit" value="����">
        <input name="sear" type="hidden" id="sear" value="1"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">˵�������÷�ʽ��&lt;script src=���js��ַ&gt;&lt;/script&gt;���ñ�ǩ����</td>
    </tr>
  </table>
</form>
<?
  while($r=$empire->fetch($sql))
  {
  ?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <tr> 
    <td width="12%" height="25">������ƣ�</td>
    <td width="35%" height="25"> 
      <?=$r[title]?>&nbsp;(���ID��<?=$r[adid]?>)
    </td>
    <td width="15%" height="25">����� 
      <?=$r[onclick]?>
    </td>
    <td width="38%" height="25">����[<a href="view/js.php?js=<?=$public_r['adfile']?><?=$r[adid]?>&p=acmsd" target="_blank">Ԥ��</a>]��[<a href="AddAd.php?phome=EditAd&adid=<?=$r[adid]?>">�޸�</a>]��[<a href="ListAd.php?phome=DelAd&adid=<?=$r[adid]?>" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��</a>]</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="38">������ͣ�</td>
    <td height="38"> 
      <?=$myt[$r[t]]?>
      &nbsp;(
      <?=$ty[$r[adtype]]?>
      ) </td>
    <td rowspan="2">��ע��</td>
    <td height="25" rowspan="2"> <textarea name="textarea" cols="42" rows="5"><?=$r[adsay]?></textarea></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">����ʱ�䣺</td>
    <td height="25"> 
      <?=$r[starttime]?>
      &nbsp;-&nbsp; 
      <?=$r[endtime]?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">���JS��ַ��</td>
    <td height="25" colspan="3"> <input name="textfield" type="text" value="<?=$public_r[sitedown]?>data/js/acmsd/<?=$public_r['adfile']?><?=$r[adid]?>.js" size="70">
      (ID:<b>
      <?=$r[adid]?>
      </b>)</td>
  </tr>
</table>
<?
  }
  ?>
<br><table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td>��ҳ��<?=$returnpage?></td>
  </tr>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>
