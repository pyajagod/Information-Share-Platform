<?php
//�滻�ļ�ǰ׺
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

//�������ر�������
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
	//��ϱ�������
	$add[mytitlefont]=TitleFont($add[titlefont],$add[titlecolor]);
	if(empty($add['zm']))
	{
		$add['zm']=GetInfoZm($add['softname']);
	}
	$add['softname']=htmlspecialchars($add['softname']);
	return $add;
}

//����ƴ��
function ReturnPinyinFun($hz){
	include('../class/getpinyin.php');
	return c($hz);
}

//ȡ����ĸ
function GetInfoZm($hz){
	if(!trim($hz))
	{
		return '';
	}
	$py=ReturnPinyinFun($hz);
	$zm=substr($py,0,1);
	return strtoupper($zm);
}

//����ҳ��
function AddSoftToReHtml($classid,$dore){
	AddSoftReHtml($classid,$dore);
	printerror('����ҳ�����','history.go(-1)');
}

//����ҳ��
function AddSoftReHtml($classid,$dohtml){
	global $class_r;
	if($dohtml==0)//������
	{
		return '';
	}
	elseif($dohtml==1)//���ɵ�ǰ����ҳ
	{
		hReClassHtml('|'.$classid.'|');
	}
	elseif($dohtml==2)//������ҳ
	{
		hReIndex();
	}
	elseif($dohtml==3)//���ɸ�����ҳ
	{
		$featherclass=$class_r[$classid]['featherclass'];
		if($featherclass&&$featherclass!="|")
		{
			hReClassHtml($featherclass);
		}
	}
	elseif($dohtml==4)//���ɵ�ǰ����ҳ�븸����ҳ
	{
		$featherclass=$class_r[$classid]['featherclass'];
		if(empty($featherclass))
		{
			$featherclass="|";
		}
		$featherclass.=$classid."|";
		hReClassHtml($featherclass);
	}
	elseif($dohtml==5)//���ɸ�����ҳ����ҳ
	{
		hReIndex();
		$featherclass=$class_r[$classid]['featherclass'];
		if($featherclass&&$featherclass!="|")
		{
			hReClassHtml($featherclass);
		}
	}
	elseif($dohtml==6)//���ɵ�ǰ����ҳ��������ҳ����ҳ
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

//�������ɷ���
function hReClassHtml($sonclass){
	global $empire,$dbtbpre,$class_r;
	$r=explode("|",$sonclass);
	$count=count($r);
	for($i=1;$i<$count-1;$i++)
	{
		ListHtml($r[$i],$listtemp_r,0);
	}
}

//����������ҳ
function hReIndex(){
	DownBq(GetDownTemp("indextemp"));
}

//���ɵ���Ϣ
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
		printerror('�����Ե����Ӳ�����','history.go(-1)');
	}
	$count=count($softid);
	if(empty($count))
	{
		printerror("��ѡ��Ҫ����ҳ������","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$add.="softid='".intval($softid[$i])."' or ";
    }
	$add=substr($add,0,strlen($add)-4);
	$sql=$empire->query("select * from {$dbtbpre}down where ".$add);
	while($r=$empire->fetch($sql))
	{
		GetHtml($r,$softtemp_r);//���������ļ�
	}
	printerror("��������ҳ��ɹ�",$_SERVER['HTTP_REFERER']);
}

//����ר��ҳ��
function AddSoftReZtHtml($dozthtml,$ztid,$softtypeid,$zm){
	//��ĸ
	if(!preg_match('/^[a-zA-Z]+$/',$zm))
	{
		$zm='';
	}
	if($dozthtml==0)//������
	{
		return '';
	}
	elseif($dozthtml==1)//�����������ҳ
	{
		if($softtypeid)
		{
			ListHtml($softtypeid,$listtemp_r,2);
		}
	}
	elseif($dozthtml==2)//����ר��ҳ
	{
		if($ztid)
		{
			ListHtml($ztid,$listtemp_r,1);
		}
	}
	elseif($dozthtml==3)//������ĸ����ҳ
	{
		if($zm)
		{
			ListHtml($zm,$listtemp_r,3);
		}
	}
	elseif($dozthtml==4)//�����������ҳ��ר��ҳ
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
	elseif($dozthtml==5)//�����������ҳ��ר��ҳ����ĸҳ
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

//����ظ������
function CheckReSoftname($id,$softname){
	global $empire,$dbtbpre,$public_r;
	if($public_r['checkresoftname'])
	{
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where softname='$softname' limit 1");
		if($num)
		{
			printerror('��������Ѿ�����','');
		}
	}
}

//�������
function AddSoft($add,$file,$file_name,$file_size,$file_type,$userid,$username){
	global $empire,$dbtbpre,$public_r,$class_r;
	$add=DoSoftVar($add);
	$classid=$add['classid'];
	if(!$add[softname]||!$add[classid])
	{
		printerror("�������������ѡ�����","history.go(-1)");
	}
	CheckLevel($userid,$username,$classid,"soft");//��֤Ȩ��
	if(!$class_r[$classid]['classid'])
	{
		printerror("�����Ե����Ӳ�����","history.go(-1)");
	}
	CheckReSoftname(0,$add[softname]);
	//������ص�ַ
    $returndownpath=ReturnDown($add[downname],$add[downpath],$add[delpathid],$add[pathid],$add[downuser],$add[fen],$add[thedownqz],$add,$add[foruser],$add[downurl],0);
	//������ߵ�ַ
	$returnonlinepath=ReturnDown($add[odownname],$add[odownpath],$add[odelpathid],$add[opathid],$add[odownuser],$add[ofen],$add[othedownqz],'','',$add[onlineurl],0);
	//�ϴ����ͼƬ
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
	//���¸���
	UpdateTheFile($lastid,$add['filepass']);
	$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$lastid'");
	//���������ļ�
	GetHtml($r,$softtemp_r);
	//�����б�
	AddSoftReHtml($add[classid],$public_r[dohtml]);
	//����ר��
	AddSoftReZtHtml($public_r[dozthtml],$add[ztid],$add[softtype],$add[zm]);
	if($sql)
	{
		printerror("��������ɹ�","AddSoft.php?phome=AddSoft&classid=$classid");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸����
function EditSoft($add,$file,$file_name,$file_size,$file_type,$userid,$username){
	global $empire,$dbtbpre,$public_r,$class_r;
	$add=DoSoftVar($add);
	$classid=$add['classid'];
	$softid=(int)$add['softid'];
	if(!$add[softname]||!$add[classid]||!$softid)
	{
		printerror("�������������ѡ�����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"soft");
	$ysoftr=$empire->fetch1("select softid,tranimg,checked,filename,titleurl from {$dbtbpre}down where softid='$softid' and classid='$add[classid]'");
	if(!$ysoftr['softid'])
	{
		printerror("�����Ե����Ӳ�����","history.go(-1)");
	}
	//������ص�ַ
	$returndownpath=ReturnDown($add[downname],$add[downpath],$add[delpathid],$add[pathid],$add[downuser],$add[fen],$add[thedownqz],$add,$add[foruser],$add[downurl],1);
	//������ߵ�ַ
	$returnonlinepath=ReturnDown($add[odownname],$add[odownpath],$add[odelpathid],$add[opathid],$add[odownuser],$add[ofen],$add[othedownqz],$ak,$ak,$add[onlineurl],1);
	//�ϴ����ͼƬ
	$tranimg=$ysoftr['tranimg'];
	if($file_name)
	{
		$filer=GoTranFile($file,$file_name,$file_size,$file_type,1,0,0);
		$tranpic=1;
		$add[softpic]=$filer['fileurl'];
		$tranimg=$filer['filename'];
		//ɾ����ͼƬ
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
	//���¸���
	UpdateTheFileEdit($classid,$softid);
	//�Ƿ����
	if($ysoftr['checked']&&!$add[checked]&&!$ysoftr['titleurl'])
	{
		DelFiletext("../data/".$public_r['resoftpath']."/".$ysoftr['filename'].$public_r['refiletype']);
	}
	$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid'");
	//���������ļ�
	GetHtml($r,$softtemp_r);
	//�����б�
	AddSoftReHtml($add[classid],$public_r[dohtml]);
	//����ר��
	AddSoftReZtHtml($public_r[dozthtml],$add[ztid],$add[softtype],$add[zm]);
	if($sql)
	{
		printerror("�޸�����ɹ�","ListSoft.php?classid=$classid");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ�����
function DelSoft($add,$userid,$username){
	global $empire,$dbtbpre,$public_r,$class_r;
	$classid=(int)$add['classid'];
	$softid=(int)$add['softid'];
	if(!$softid)
	{
		printerror("��ѡ��Ҫɾ�����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"soft");
	$ysoftr=$empire->fetch1("select softid,tranimg,checked,filename,titleurl,ztid,softtype,zm from {$dbtbpre}down where softid='$softid' and classid='$classid'");
	if(!$ysoftr['softid'])
	{
		printerror("�����Ե����Ӳ�����","history.go(-1)");
	}
	//ɾ��ͼƬ
	if($ysoftr['tranimg'])
	{
		DelFiletext("../data/soft_img/".$ysoftr['tranimg']);
	}
	//ɾ���ļ�
	if($ysoftr['checked']&&!$ysoftr['titleurl'])
	{
		DelFiletext("../data/".$public_r['resoftpath']."/".$ysoftr['filename'].$public_r['refiletype']);
	}
	//ɾ������
	ToDelSoftFile(0,$softid);
	$sql=$empire->query("delete from {$dbtbpre}down where softid='$softid'");
	//�����б�
	AddSoftReHtml($classid,$public_r[dohtml]);
	//����ר��
	AddSoftReZtHtml($public_r[dozthtml],$ysoftr[ztid],$ysoftr[softtype],$ysoftr[zm]);
	if($sql)
	{
		printerror("ɾ������ɹ�",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//����ɾ�����
function DelSoft_all($add,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	$softid=$add['softid'];
	$classid=(int)$add['classid'];
	$count=count($softid);
	if(!$count)
	{
		printerror("�㻹û��ѡ��Ҫɾ�������","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"soft");
	$ids='';
	for($i=0;$i<$count;$i++)
	{
		$ids.=$dh.intval($softid[$i]);
		$dh=',';
	}
	$add1="softid in (".$ids.")";
	//ɾ���ļ�
	$s_sql=$empire->query("select softid,tranimg,checked,filename,titleurl,ztid,softtype,zm from {$dbtbpre}down where ".$add1);
	while($r=$empire->fetch($s_sql))
	{
		if($r[tranimg])//ɾ��Ԥ��ͼ
		{
			DelFiletext("../data/soft_img/".$r[tranimg]);
		}
		if($r['checked']&&!$r['titleurl'])//ɾ���ļ�
		{
			DelFiletext("../data/".$public_r['resoftpath']."/".$r['filename'].$public_r['refiletype']);
		}
		ToDelSoftFile(0,$r['softid']);//ɾ������
	}
	$sql=$empire->query("delete from {$dbtbpre}down where ".$add1);
	//�����б�
	AddSoftReHtml($classid,$public_r[dohtml]);
	//����ר��
	AddSoftReZtHtml($public_r[dozthtml],$r[ztid],$r[softtype],$r[zm]);
	if($sql)
	{
		printerror("ɾ������ɹ�",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//����������
function CheckSoft_all($add,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	$softid=$add['softid'];
	$classid=(int)$add['classid'];
	$count=count($softid);
	if(!$count)
	{
		printerror("��ѡ��Ҫ��˵����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"soft");
	for($i=0;$i<$count;$i++)
	{
		$softid[$i]=(int)$softid[$i];
		$empire->query("update {$dbtbpre}down set checked=1 where softid='$softid[$i]'");
		$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid[$i]'");
		//Ͷ������
		if($r[ismember]&&$r[userid]&&!$r[haveaddfen])
		{
			$cr=$empire->fetch1("select classid,qaddfen from {$dbtbpre}downclass where classid='$r[classid]'");
			if($cr[qaddfen])
			{
				AddInfoFen($cr[qaddfen],$r[userid]);
			}
			$empire->query("update {$dbtbpre}down set haveaddfen=1 where softid=$r[softid]");
		}
		//���������ļ�
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
	printerror("�������ɹ�",$_SERVER['HTTP_REFERER']);
}

//��˵������
function CheckSoft($add,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	$classid=(int)$add['classid'];
	$softid=(int)$add['softid'];
	if(empty($softid))
	{
		printerror("��ѡ��Ҫ��˵����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"soft");
	$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid' and classid='$classid'");
	if(!$r['softid'])
	{
		printerror('��ѡ��Ҫ��˵����','history.go(-1)');
	}
	$sql=$empire->query("update {$dbtbpre}down set checked=1 where softid='$softid'");
	//Ͷ������
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
	//���������ļ�
	GetHtml($r,$softtemp_r);
	//�����б�
	AddSoftReHtml($classid,$public_r[dohtml]);
	//����ר��
	AddSoftReZtHtml($public_r[dozthtml],$r[ztid],$r[softtype],$r[zm]);
	if($sql)
	{
		printerror("�������ɹ�",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//����ö�
function TopSoft_all($add,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	$classid=(int)$add['classid'];
	$softid=$add['softid'];
	$istop=(int)$add['istop'];
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"soft");
	$count=count($softid);
	if(!$count)
	{
		printerror("��ѡ��Ҫ�ö������","history.go(-1)");
	}
	$ids='';
	for($i=0;$i<$count;$i++)
	{
		$ids.=$dh.intval($softid[$i]);
		$dh=',';
	}
	$add1="softid in (".$ids.")";
	$sql=$empire->query("update {$dbtbpre}down set istop='$istop' where ".$add1);
	//�����б�
	AddSoftReHtml($classid,$public_r[dohtml]);
	printerror("�ö��ɹ�",$_SERVER['HTTP_REFERER']);
}

//�ƶ����
function MoveSoft_all($classid,$to_classid,$softid,$userid,$username){
	global $empire,$class_r,$dbtbpre,$public_r;
	$classid=(int)$classid;
	$to_classid=(int)$to_classid;
	if(empty($classid)||empty($to_classid))
	{
		printerror("��ѡ��Ҫ�ƶ��ķ���","history.go(-1)");
	}
	if(empty($class_r[$classid][islast])||empty($class_r[$to_classid][islast]))
	{
		printerror("ѡ���ƶ���Ŀ������Ƿ��ռ�����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"soft");
	$count=count($softid);
	if(empty($count))
	{
		printerror("��ѡ��Ҫ�ƶ������","history.go(-1)");
	}
	$ids='';
	for($i=0;$i<$count;$i++)
	{
		$ids.=$dh.intval($softid[$i]);
		$dh=',';
	}
	$add1="softid in (".$ids.")";
	$sql=$empire->query("update {$dbtbpre}down set classid='$to_classid' where ".$add1);
	//�����б�
	AddSoftReHtml($classid,$public_r[dohtml]);
	AddSoftReHtml($to_classid,$public_r[dohtml]);
	if($sql)
	{
		printerror("�ƶ�����ɹ�",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�������
function CopySoft_all($classid,$to_classid,$softid,$userid,$username){
	global $empire,$class_r,$public_r,$dbtbpre;
	if(empty($classid)||empty($to_classid))
	{
		printerror("��ѡ��ҪĿ�����","history.go(-1)");
	}
	if(empty($class_r[$classid][islast])||empty($class_r[$to_classid][islast]))
	{
		printerror("ѡ���Ƶ�Ŀ������Ƿ��ռ�����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"soft");
	$count=count($softid);
	if(empty($count))
	{
		printerror("��ѡ��Ҫ���Ƶ����","history.go(-1)");
	}
	$softtime=time();
	//���
	for($i=0;$i<$count;$i++)
	{
		$softid[$i]=(int)$softid[$i];
		$r=$empire->fetch1("select * from {$dbtbpre}down where softid='$softid[$i]'");
		$sql=$empire->query("insert into {$dbtbpre}down(softname,softsay,classid,softtime,isgood,homepage,adduser,writer,filesize,filetype,downpath,demo,softpic,count_all,count_month,count_week,soft_sq,soft_fj,downfen,star,keyboard,language,softtype,foruser,tranimg,istop,checked,soft_version,ismember,titleurl,titlefont,count_day,onlinepath,playerid,filename,ztid,zm,haveaddfen,userid) values('".ReturnDoYStr($r[softname])."','".ReturnDoYStr($r[softsay])."','$to_classid','$softtime','0','".ReturnDoYStr($r[homepage])."','$username','".ReturnDoYStr($r[writer])."','".ReturnDoYStr($r[filesize])."','".ReturnDoYStr($r[filetype])."','".ReturnDoYStr($r[downpath])."','".ReturnDoYStr($r[demo])."','".ReturnDoYStr($r[softpic])."','0','0','0','$r[soft_sq]','".ReturnDoYStr($r[soft_fj])."','$r[downfen]','$r[star]','".ReturnDoYStr($r[keyboard])."','$r[language]','$r[softtype]','$r[foruser]','','0','$r[checked]','".ReturnDoYStr($r[soft_version])."','0','".ReturnDoYStr($r[titleurl])."','','0','".ReturnDoYStr($r[onlinepath])."','$r[playerid]','','$r[ztid]','$r[zm]','$r[haveaddfen]','$r[userid]');");
		$newsoftid=$empire->lastid();
		$empire->query("update {$dbtbpre}down set filename='$newsoftid' where softid='$newsoftid'");
		$nr=$empire->fetch1("select * from {$dbtbpre}down where softid='$newsoftid'");
		//���������ļ�
		GetHtml($nr,$softtemp_r);
    }
	//�����б�
	AddSoftReHtml($to_classid,$public_r[dohtml]);
	printerror("��������ɹ�",$_SERVER['HTTP_REFERER']);
}
?>