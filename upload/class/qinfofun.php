<?php
//����ƴ��
function qReturnPinyinFun($hz){
	include('../class/getpinyin.php');
	return c($hz);
}

//ȡ����ĸ
function qGetInfoZm($hz){
	if(!trim($hz))
	{
		return '';
	}
	$py=qReturnPinyinFun($hz);
	$zm=substr($py,0,1);
	return strtoupper($zm);
}

//���ص�ַ���
function ReturnDown($downname,$downpath,$delpathid,$pathid,$downuser,$fen,$thedownqz,$add,$foruser,$downurl,$down=0){
	$f_exp="::::::";
	$r_exp="\r\n";
	$returnstr="";
	$downurl=str_replace($f_exp,"",$downurl);
	$downurl=str_replace($r_exp,"",$downurl);
	//��������
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
	else//�޸�����
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
	if(empty($returnstr))
	{
		printerror("���������ص�ַ","history.go(-1)",1);
	}
	//ȥ�������ַ�
	$returnstr=substr($returnstr,0,strlen($returnstr)-2);
	$returnstr=str_replace("'","",$returnstr);
	return $returnstr;
}

//����Ͷ��
function AddSoft($add,$file,$file_name,$file_size,$file_type,$imgfile,$imgfile_name,$imgfile_size,$imgfile_type,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre,$level_r;
	if($public_r[openadd])
	{
		printerror("Ͷ�幦�ܱ�����Ա�ر�","history.go(-1)",1);
	}
	$classid=(int)$add[classid];
	$filepass=time();
	if(!trim($add[softname])||!$classid||!$add[softsay])
	{
		printerror("�����������������ࡢ��鼰���ص�ַ","history.go(-1)",1);
	}
	if(empty($class_r[$classid][islast]))
	{
		printerror("��ѡ��ķ��಻���ռ�����","history.go(-1)",1);
	}
	$cr=$empire->fetch1("select classid,openadd,qaddgroupid,qaddfen from {$dbtbpre}downclass where classid='$classid'");
	if(!$cr['classid'])
	{
		printerror("��ѡ�����","history.go(-1)",1);
	}
	if($cr['openadd'])
	{
		printerror("�˷���δ����Ͷ�幦��","history.go(-1)",1);
	}
	$user_r[userid]=$userid?$userid:0;
	$user_r[username]=$username?$username:'����';
	if($cr['qaddgroupid'])
	{
		$user_r=islogin();//�Ƿ��½
		if($level_r[$cr[qaddgroupid]][level]>$level_r[$user_r[groupid]][level])
		{
			printerror("�˷����� ".$level_r[$cr[qaddgroupid]][groupname]." �������ϲ��ܷ���Ͷ��","history.go(-1)",1);
		}
	}
	//�ϴ�����ͼƬ
	$tranpic=0;
	$tranimg='';
	if($imgfile_name)
	{
		$filer=GoTranFile($imgfile,$imgfile_name,$imgfile_size,$imgfile_type,1,1,0);
		$tranpic=1;
		$add[softpic]=$filer['fileurl'];
		$tranimg=$filer['filename'];
	}
	//�ϴ��ļ�
	if($file_name)
	{
		$filer=GoTranFile($file,$file_name,$file_size,$file_type,0,1,0);
		$filetime=date("Y-m-d H:i:s");
		$empire->query("insert into {$dbtbpre}downfile(filename,filesize,adduser,filetime,fileno,classid,path,softid,cjid) values('$filer[filename]','$filer[filesize]','$user_r[username]','$filetime','[member]".$filer[filename]."','$classid','$filer[filepath]','$filepass','$filepass');");
		$f_exp="::::::";
		$r_exp="\r\n";
		$returndownpath='���ص�ַ'.$f_exp.$filer[fileurl].$f_exp.'0'.$f_exp.'0'.$f_exp.'0';
	}
	else
	{
		$returndownpath=ReturnDown($add[downname],$add[downpath],$add[delpathid],$add[pathid],$gadd[downuser],$gadd[fen],$gadd[thedownqz],$add,$gadd[foruser],$gadd[downurl],0);
	}
	$returndownpath=RepPostStr($returndownpath);
	//��������
	$add[star]=3;
	$add[softname]=RepPostStr($add[softname]);
	$add[softsay]=RepPostStr($add[softsay]);
	$add[homepage]=RepPostStr($add[homepage]);
	$add[writer]=RepPostStr($add[writer]);
	$add[filesize]=RepPostStr($add[filesize]);
	$add[filetype]=RepPostStr($add[filetype]);
	$add[demo]=RepPostStr($add[demo]);
	$add[softpic]=RepPostStr($add[softpic]);
	$add[soft_sq]=(int)$add[soft_sq];
	$add[soft_fj]=RepPostStr($add[soft_fj]);
	$add[star]=(int)$add[star];
	$add[keyboard]=RepPostStr($add[keyboard]);
	$add[language]=(int)$add[language];
	$add[softtype]=(int)$add[softtype];
	$add[soft_version]=RepPostStr($add[soft_version]);
	$add[ztid]=(int)$add[ztid];
	$add[downfen]=0;
	$add[foruser]=0;
	$add[checked]=0;
	$returnonlinepath='';
	//��ĸ
	$zm=qGetInfoZm($add[softname]);
	$zm=RepPostStr($zm);
	$softtime=time();
	$sql=$empire->query("insert into {$dbtbpre}down(softname,softsay,classid,softtime,isgood,homepage,adduser,writer,filesize,filetype,downpath,demo,softpic,count_all,count_month,count_week,soft_sq,soft_fj,downfen,star,keyboard,language,softtype,foruser,tranimg,istop,checked,soft_version,ismember,titleurl,titlefont,count_day,onlinepath,playerid,filename,ztid,zm,haveaddfen,userid) values('$add[softname]','$add[softsay]','$classid','$softtime','0','$add[homepage]','$user_r[username]','$add[writer]','$add[filesize]','$add[filetype]','$returndownpath','$add[demo]','$add[softpic]','0','0','0','$add[soft_sq]','$add[soft_fj]','$add[downfen]','$add[star]','$add[keyboard]','$add[language]','$add[softtype]','$add[foruser]','$tranimg','0','$add[checked]','$add[soft_version]','1','','','0','$returnonlinepath','0','','$add[ztid]','$zm',0,'$user_r[userid]');");
	$lastid=$empire->lastid();
	$empire->query("update {$dbtbpre}down set filename='$lastid' where softid='$lastid'");
	//���¸���
	if($lastid&&$filepass)
	{
		$empire->query("update {$dbtbpre}downfile set softid='$lastid',cjid=0 where cjid='$filepass'");
	}
	if($sql)
	{
		printerror("�ύ�ɹ�",$_SERVER['HTTP_REFERER'],1);
	}
	else
	{
		printerror("���ݿ����","history.go(-1)",1);
	}
}
?>