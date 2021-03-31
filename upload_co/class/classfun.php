<?php
//����ר��
function AddZt($add,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"zt");//��֤Ȩ��
	if(!$add[ztname])
	{
		printerror("������ר����","history.go(-1)");
	}
	$add[lencord]=(int)$add[lencord];
	$add[maxnum]=(int)$add[maxnum];
	$add[listtempid]=(int)$add[listtempid];
	$sql=$empire->query("insert into {$dbtbpre}downzt(ztname,lencord,maxnum,listtempid,ztkey,ztintro) values('$add[ztname]','$add[lencord]','$add[maxnum]','$add[listtempid]','$add[ztkey]','$add[ztintro]');");
	GetClassZt();
	if($sql)
	{
		printerror("����ר��ɹ�","AddZt.php?phome=AddZt");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸�ר��
function EditZt($add,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"zt");//��֤Ȩ��
	$ztid=(int)$add[ztid];
	if(!$add[ztname]||!$ztid)
	{
		printerror("������ר����","history.go(-1)");
	}
	$add[lencord]=(int)$add[lencord];
	$add[maxnum]=(int)$add[maxnum];
	$add[listtempid]=(int)$add[listtempid];
	$sql=$empire->query("update {$dbtbpre}downzt set ztname='$add[ztname]',lencord='$add[lencord]',maxnum='$add[maxnum]',listtempid='$add[listtempid]',ztkey='$add[ztkey]',ztintro='$add[ztintro]' where ztid='$ztid'");
	GetClassZt();
	if($sql)
	{
		printerror("�޸�ר��ɹ�","ListZt.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ��ר��
function DelZt($ztid,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"zt");//��֤Ȩ��
	$ztid=(int)$ztid;
	if(!$ztid)
	{
		printerror("��ѡ��Ҫɾ����ר��","history.go(-1)");
	}
	$zr=$empire->fetch1("select lencord from {$dbtbpre}downzt where ztid='$ztid'");
	$sql=$empire->query("delete from {$dbtbpre}downzt where ztid='$ztid'");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where ztid='$ztid'");
	GetClassZt();
	DelListFile('zt'.$ztid,$zr[lencord],$num);
	if($sql)
	{
		printerror("ɾ��ר��ɹ�","ListZt.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//����������
function DoClassVar($add){
	$add['lencord']=(int)$add['lencord'];
	if(!$add['lencord'])
	{
		$add['lencord']=25;
	}
	$add['link_num']=(int)$add['link_num'];
	if(!$add['link_num'])
	{
		$add['link_num']=10;
	}
	$add['downnum']=(int)$add['downnum'];
	if(!$add['downnum'])
	{
		$add['downnum']=1;
	}
	$add['onlinenum']=(int)$add['onlinenum'];
	if(!$add['onlinenum'])
	{
		$add['onlinenum']=1;
	}
	$add['bclassid']=(int)$add['bclassid'];
	$add['myorder']=(int)$add['myorder'];
	$add['islast']=(int)$add['islast'];
	$add['openadd']=(int)$add['openadd'];
	$add['groupid']=(int)$add['groupid'];
	$add['listtempid']=(int)$add['listtempid'];
	$add['softtempid']=(int)$add['softtempid'];
	$add['formtype']=(int)$add['formtype'];
	$add['maxnum']=(int)$add['maxnum'];
	$add['qaddgroupid']=(int)$add['qaddgroupid'];
	$add['qaddfen']=(int)$add['qaddfen'];
	return $add;
}

//���ӷ���
function AddClass($add,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"action");//��֤Ȩ��
	$add=DoClassVar($add);
	if(!$add[classname])
	{
		printerror("�����������","history.go(-1)");
	}
	$bclassid=$add['bclassid'];
	$islast=$add['islast'];
	//�����ռ�����
	if($islast)
	{
		if(empty($bclassid))//������
		{
			$featherclass="";
			$sonclass="";
	    }
		else
		{
			//ȡ�ø�������Ϣ
			$fr=$empire->fetch1("select sonclass,featherclass,islast from {$dbtbpre}downclass where classid='$bclassid'");
			//�����Ϊ�ռ�����
			if($fr[islast])
			{
				printerror("����������ռ�����","history.go(-1)");
			}
			//��ϸ�����
			if(empty($fr[featherclass]))
			{
				$fr[featherclass]="|";
			}
			$featherclass=$fr[featherclass].$bclassid."|";
			$sonclass="";
		}
		$sql=$empire->query("insert into {$dbtbpre}downclass(classname,bclassid,myorder,link_num,lencord,sonclass,featherclass,islast,openadd,groupid,listtempid,softtempid,downnum,onlinenum,bname,formtype,maxnum,qaddgroupid,qaddfen,classimg,classkey,classintro) values('$add[classname]','$bclassid','$add[myorder]','$add[link_num]','$add[lencord]','$sonclass','$featherclass','$islast','$add[openadd]','$add[groupid]','$add[listtempid]','$add[softtempid]','$add[downnum]','$add[onlinenum]','$add[bname]','$add[formtype]','$add[maxnum]','$add[qaddgroupid]','$add[qaddfen]','$add[classimg]','$add[classkey]','$add[classintro]');");
		$classid=$empire->lastid();
		//�޸ĸ�����
		$badd=ReturnClass($featherclass);
		$bsql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$badd);
		while($br=$empire->fetch($bsql))
		{
			if(empty($br[sonclass]))
			{
				$br[sonclass]="|";
			}
			$newsonclass=$br[sonclass].$classid."|";
			$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$br[classid]'");
	    }
		GetSearch();
		GetSoftClass();
		GetClass();
		GetPublic();
		DelListEdown();
		if($sql)
		{
			printerror("�����ռ�����ɹ�","AddClass.php?phome=AddClass");
		}
		else
		{
			printerror("���ݿ����","history.go(-1)");
		}
	}
	else//���Ӵ����
	{
		if(empty($bclassid))//������
		{
			$featherclass="";
			$sonclass="";
		}
		else
		{
			//ȡ�ø�������Ϣ
			$fr=$empire->fetch1("select featherclass,sonclass,islast from {$dbtbpre}downclass where classid='$bclassid'");
			//�������Ϊ�ռ�����
			if($fr[islast])
			{
				printerror("�����಻�����ռ�����","history.go(-1)");
			}
			//��ϸ�����
			if(empty($fr[featherclass]))
			{
			   $fr[featherclass]="|";
			}
			$featherclass=$fr[featherclass].$bclassid."|";
			$sonclass="";
		}
		$sql=$empire->query("insert into {$dbtbpre}downclass(classname,bclassid,myorder,link_num,lencord,sonclass,featherclass,islast,openadd,groupid,listtempid,softtempid,downnum,onlinenum,bname,formtype,maxnum,qaddgroupid,qaddfen,classimg,classkey,classintro) values('$add[classname]','$bclassid','$add[myorder]','$add[link_num]','$add[lencord]','$sonclass','$featherclass','$islast','$add[openadd]','$add[groupid]','$add[listtempid]','$add[softtempid]','$add[downnum]','$add[onlinenum]','$add[bname]','$add[formtype]','$add[maxnum]','$add[qaddgroupid]','$add[qaddfen]','$add[classimg]','$add[classkey]','$add[classintro]');");
		$classid=$empire->lastid();
		GetSearch();
		GetSoftClass();
		GetClass();
		GetPublic();
		DelListEdown();
	}
	if($sql)
	{
		printerror("���ӷ���ɹ�","AddClass.php?phome=AddClass");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸ķ���
function EditClass($add,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	CheckLevel($userid,$username,$classid,"action");//��֤Ȩ��
	$add=DoClassVar($add);
	$classid=(int)$add['classid'];
	if(!$classid||!$add['classname'])
	{
		printerror("�����������","history.go(-1)");
	}
	$islast=$add['islast'];
	$bclassid=$add['bclassid'];
	$oldbclassid=$add['oldbclassid'];
	//�����
	if(!$islast)
	{
		//�ı丸����Ļ�
		if($bclassid<>$oldbclassid)
		{
			//ת��������
			if(empty($bclassid))
			{
				$sonclass="";
				$featherclass="";
				//ȡ�ñ�������ӷ���
				$r=$empire->fetch1("select featherclass,sonclass from {$dbtbpre}downclass where classid='$classid'");
				//�޸ĸ�������ӷ���
				$where=ReturnClass($r[featherclass]);
				$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
				while($or=$empire->fetch($osql))
				{
					$newsonclass=str_replace($r[sonclass],"|",$or[sonclass]);
					$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
			    }
				//�޸��ӷ���ĸ���Ŀ
				$osql=$empire->query("select featherclass,classid from {$dbtbpre}downclass where featherclass like '%|".$classid."|%'");
				while($or=$empire->fetch($osql))
				{
					$newfeatherclass=str_replace($r[featherclass],"|",$or[featherclass]);
					$usql=$empire->query("update {$dbtbpre}downclass set featherclass='$newfeatherclass' where classid='$or[classid]'");
				}
		    }
			else//ת���м�����
			{
				if($classid==$bclassid)
				{
					printerror("���������ǰ���಻����ͬһ��","history.go(-1)");
				}
				//ȡ�ø�������Ϣ
				$b=$empire->fetch1("select sonclass,featherclass,islast from {$dbtbpre}downclass where classid='$bclassid'");
				if($b[islast])
				{
					printerror("�����಻��Ϊ�ռ�����","history.go(-1)");
				}
				//�Ƿ�Ƿ�����
			    if($b[featherclass])
			    {
					if(strstr($b[featherclass],'|'.$classid.'|'))
					{
						printerror("��ѡ��ĸ�������Ƿ��౾�������","history.go(-1)");
					}
			    }
			    if(empty($b[featherclass]))
			    {
					$b[featherclass]="|";
				}
				$featherclass=$b[featherclass].$bclassid."|";
				//ȡ�õ�ǰ����ĵ���Ϣ
				$r=$empire->fetch1("select sonclass,featherclass from {$dbtbpre}downclass where classid='$classid'");
				//�޸�����ĸ�����
				$osql=$empire->query("select featherclass,classid from {$dbtbpre}downclass where featherclass like '%|".$classid."|%'");
				while($or=$empire->fetch($osql))
				{
					if(empty($r[featherclass]))
					{
						$newfeatherclass=$b[featherclass].$bclassid.$or[featherclass];
					}
					else
					{
						$newfeatherclass=str_replace($r[featherclass],$featherclass,$or[featherclass]);
					}
					$usql=$empire->query("update {$dbtbpre}downclass set featherclass='$newfeatherclass' where classid='$or[classid]'");
				}
				//�޸ľɸ����������
				$where=ReturnClass($r[featherclass]);
				$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
				while($or=$empire->fetch($osql))
				{
					$newsonclass=str_replace($r[sonclass],"|",$or[sonclass]);
					$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
				}
				//�޸��¸���������
				$where=ReturnClass($featherclass);
				$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
				while($or=$empire->fetch($osql))
				{
					if(empty($or[sonclass]))
					{
						$or[sonclass]="|";
					}
					$newsonclass=$or[sonclass].substr($r[sonclass],1);
					$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
				}
			}
			$change=",bclassid='$bclassid',featherclass='$featherclass'";
	    }
		$sql=$empire->query("update {$dbtbpre}downclass set classname='$add[classname]',myorder='$add[myorder]',link_num='$add[link_num]',lencord='$add[lencord]',openadd='$add[openadd]',groupid='$add[groupid]',listtempid='$add[listtempid]',softtempid='$add[softtempid]',downnum='$add[downnum]',onlinenum='$add[onlinenum]',bname='$add[bname]',formtype='$add[formtype]',maxnum='$add[maxnum]',qaddgroupid='$add[qaddgroupid]',qaddfen='$add[qaddfen]',classimg='$add[classimg]',classkey='$add[classkey]',classintro='$add[classintro]'".$change." where classid='$classid'");
	}
	else//�ռ�����
	{
		//�ı丸����
		if($bclassid<>$oldbclassid)
		{
			if(empty($bclassid))//ת��������
			{
				$sonclass="";
				$featherclass="";
				//���¾ɸ�������ӷ���
				$b=$empire->fetch1("select featherclass from {$dbtbpre}downclass where classid='$classid'");
				$where=ReturnClass($b[featherclass]);
				$osql=$empire->query("select classid,sonclass from {$dbtbpre}downclass where ".$where);
				while($or=$empire->fetch($osql))
				{
					$newsonclass=str_replace("|".$classid."|","|",$or[sonclass]);
					$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
			    }
		    }
			else//ת���м�����
			{
				//ȡ���¸��������Ϣ
				$b=$empire->fetch1("select featherclass,islast from {$dbtbpre}downclass where classid='$bclassid'");
				//�Ƿ��ռ�����
				if($b[islast])
				{
					printerror("�������Ϊ�ռ����","history.go(-1)");
				}
				if(empty($b[featherclass]))
				{
					$b[featherclass]="|";
				}
				$featherclass=$b[featherclass].$bclassid."|";
				//�ı��¸����������
				$where=ReturnClass($featherclass);
				$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
				while($or=$empire->fetch($osql))
				{
					if(empty($or[sonclass]))
					{
						$or[sonclass]="|";
					}
					$newsonclass=$or[sonclass].$classid."|";
					$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
				}
				//�ı�ɸ����������
				$r=$empire->fetch1("select featherclass from {$dbtbpre}downclass where classid='$classid'");
				$where=ReturnClass($r[featherclass]);
				$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
				while($or=$empire->fetch($osql))
				{
					$newsonclass=str_replace("|".$classid."|","|",$or[sonclass]);
					$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
				}
			}
			$change=",bclassid='$bclassid',featherclass='$featherclass'";
	    }
		$sql=$empire->query("update {$dbtbpre}downclass set classname='$add[classname]',myorder='$add[myorder]',lencord='$add[lencord]',link_num='$add[link_num]',openadd='$add[openadd]',groupid='$add[groupid]',listtempid='$add[listtempid]',softtempid='$add[softtempid]',downnum='$add[downnum]',onlinenum='$add[onlinenum]',bname='$add[bname]',formtype='$add[formtype]',maxnum='$add[maxnum]',qaddgroupid='$add[qaddgroupid]',qaddfen='$add[qaddfen]',classimg='$add[classimg]',classkey='$add[classkey]',classintro='$add[classintro]'".$change." where classid='$classid'");
	}
	GetSearch();
	GetSoftClass();
	GetClass();
	GetPublic();
	DelListEdown();
	if($sql)
	{
		printerror("�޸ķ���ɹ�","ListClass.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ������
function DelClass($classid,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	CheckLevel($userid,$username,$classid,"action");//��֤Ȩ��
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("��ѡ��Ҫɾ���ķ���","history.go(-1)");
	}
	DelClass1($classid);
	GetSearch();
	GetSoftClass();
	GetClass();
	GetPublic();
	DelListEdown();
	printerror("ɾ������ɹ�","ListClass.php");
}

//ɾ�����ຯ��
function DelClass1($classid){
	global $empire,$dbtbpre,$public_r;
	$c_r=$empire->fetch1("select * from {$dbtbpre}downclass where classid='$classid'");
	//ɾ���ռ�����
	if($c_r[islast])
	{
		$del=$empire->query("delete from {$dbtbpre}downclass where classid='$classid'");
		//ɾ�����
		$sql=$empire->query("select softid,tranimg,checked,filename,titleurl from {$dbtbpre}down where classid='$classid'");
		$i=0;
		while($r=$empire->fetch($sql))
		{
			if($r[tranimg])//ɾ��Ԥ��ͼ
			{
				DelFiletext("../data/soft_img/".$r[tranimg]);
			}
			if($r['checked']&&!$r['titleurl'])//ɾ���ļ�
			{
				DelFiletext("../data/".$public_r['resoftpath']."/".$r['filename'].$public_r['refiletype']);
			}
			$i++;
		}
		ToDelSoftFile($classid,0);//ɾ������
		DelListFile($classid,$c_r[lencord],$i);
		$sql1=$empire->query("delete from {$dbtbpre}down where classid='$classid'");
		//�޸ĸ����������
		$where=ReturnClass($c_r[featherclass]);
		$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
		while($or=$empire->fetch($osql))
		{
			$newsonclass=str_replace("|".$classid."|","|",$or[sonclass]);
			$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
	    }
    }
	else//ɾ�������
	{
		$del=$empire->query("delete from {$dbtbpre}downclass where classid='$classid'");
		//ɾ�����
		$where=ReturnClass($c_r[sonclass]);
		$wheres=$where;
		$osql=$empire->query("select softid,tranimg,checked,filename,titleurl from {$dbtbpre}down where ".$where);
		while($r=$empire->fetch($osql))
		{
			if($r[tranimg])//ɾ��Ԥ��ͼ
			{
				DelFiletext("../data/soft_img/".$r[tranimg]);
			}
			if($r['checked']&&!$r['titleurl'])//ɾ���ļ�
			{
				DelFiletext("../data/".$public_r['resoftpath']."/".$r['filename'].$public_r['refiletype']);
			}
	    }
		//ɾ�������ļ�
		$osql=$empire->query("select classid,islast,sonclass,lencord from {$dbtbpre}downclass where featherclass like '%|".$classid."|%'");
		while($or=$empire->fetch($osql))
		{
			//�ռ�����
			if($or[islast])
			{
				$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where classid='$or[classid]'");
				ToDelSoftFile($or[classid],0);//ɾ������
			}
			else
			{
				$where=ReturnClass($or[sonclass]);
				$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where ".$where);
			}
			DelListFile($or[classid],$or[lencord],$num);
		}
		$delb=$empire->query("delete from {$dbtbpre}downclass where featherclass like '%|".$classid."|%'");
		//ɾ�������¼
		$dels=$empire->query("delete from {$dbtbpre}down where ".$wheres);
		//�ı丸���������
		$where=ReturnClass($c_r[featherclass]);
		$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
		while($or=$empire->fetch($osql))
		{
			$newsonclass=str_replace($c_r[sonclass],"|",$or[sonclass]);
			$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
		}
    }
}

//�޸����˳��
function EditClassOrder($classid,$myorder,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"action");//��֤Ȩ��
	for($i=0;$i<count($classid);$i++)
	{
		$sql=$empire->query("update {$dbtbpre}downclass set myorder='".intval($myorder[$i])."' where classid='".intval($classid[$i])."'");
	}
	GetPublic();
	GetSoftClass();
	DelListEdown();
	if($sql)
	{
		printerror("�޸ķ���˳��ɹ�","ListClass.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�ռ���������ռ�����֮���ת��
function ChangeClassIslast($classid,$userid,$username){
	global $empire,$dbtbpre;
	//����Ȩ��
	CheckLevel($userid,$username,$classid,"action");
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("��ѡ��Ҫת���ķ���","history.go(-1)");
	}
	//ȡ�ñ�������Ϣ
	$r=$empire->fetch1("select * from {$dbtbpre}downclass where classid='$classid'");
	if(empty($r[classid]))
	{
		printerror("��ѡ��Ҫת���ķ���","history.go(-1)");
	}
	//���ռ�����
	if(!$r[islast])
	{
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}downclass where bclassid='$classid'");
		if($num)
		{
			printerror("ת���ķ������治�����ӷ���","history.go(-1)");
		}
		//�޸ĸ�������ӷ���
		$where=ReturnClass($r[featherclass]);
		$sql=$empire->query("select classid,sonclass from {$dbtbpre}downclass where ".$where);
		while($br=$empire->fetch($sql))
		{
			if(empty($br[sonclass]))
			{
				$br[sonclass]="|";
			}
			$newsonclass=$br[sonclass].$classid."|";
			$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid=$br[classid]");
		}
		$dosql=$empire->query("update {$dbtbpre}downclass set islast=1 where classid='$classid'");
		$mess="ת��Ϊ�ռ�����ɹ�";
	}
	//�ռ�����
	else
	{
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where classid='$classid'");
		if($num)
		{
			printerror("�˷����������ݣ�����ת��","history.go(-1)");
		}
		//�޸ĸ�������ӷ���
		$where=ReturnClass($r[featherclass]);
		$sql=$empire->query("select classid,sonclass from {$dbtbpre}downclass where ".$where);
		while($br=$empire->fetch($sql))
		{
			if(empty($br[sonclass]))
			{
				$br[sonclass]="|";
			}
			$newsonclass=str_replace("|".$classid."|","|",$br[sonclass]);
			$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid=$br[classid]");
		}
		$dosql=$empire->query("update {$dbtbpre}downclass set islast=0 where classid='$classid'");
		$mess="ת��Ϊ���ռ�����ɹ�";
	}
	GetSearch();
	GetClass();
	GetPublic();
	DelListEdown();
	if($dosql)
	{
		printerror($mess,$_GET['from']);
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//���·����ϵ
function ChangeSonclass($start,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"changedata");
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select classid from {$dbtbpre}downclass where islast=0 and classid>".$start." order by classid limit ".$public_r[relist_num]);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[classid];
		//�ӷ���
		$sonclass="|";
		$ssql=$empire->query("select classid from {$dbtbpre}downclass where islast=1 and featherclass like '%|".$r[classid]."|%' order by classid");
		while($sr=$empire->fetch($ssql))
		{
			$sonclass.=$sr[classid]."|";
	    }
		$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$sonclass' where classid='$r[classid]'");
    }
	//���
	if(empty($b))
	{
		GetClass();
		printerror("���·����ϵ���","ChangeData.php");
	}
	echo "һ�����������,��������һ��......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='classphome.php?phome=ChangeSonclass&start=$newstart';</script>";
	exit();
}
?>