<?php
//���ɷ��ർ��
function ReSoftClass($userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	GetSoftClass();
	if($_GET['OneReAll']==1)//һ������
	{
		echo "���ർ��ҳ���������,������һ������......<script>self.location.href='chtmlphome.php?phome=ChangeDtPage&OneReAll=1';</script>";
		exit();
	}
	printerror("���ɷ��ർ��ҳ��ɹ�","history.go(-1)");
}

//�����б�
function ReHtml($classid,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"class");
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("��ѡ��Ҫ���ɵķ���","history.go(-1)");
	}
	ListHtml($classid,$listtemp_r,0);
	printerror("���ɷ���ҳ��ɹ�","history.go(-1)");
}

//����ר��
function ReZtHtml($ztid,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"zt");
	$ztid=(int)$ztid;
	if(!$ztid)
	{
		printerror("��ѡ��Ҫ���ɵ�ר��","history.go(-1)");
	}
	ListHtml($ztid,$listtemp_r,1);
	printerror("����ר��ҳ��ɹ�","history.go(-1)");
}

//�����������
function ReSoftTypeHtml($softtypeid,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"softtype");
	$softtypeid=(int)$softtypeid;
	if(!$softtypeid)
	{
		printerror("��ѡ��Ҫ���ɵ��������","history.go(-1)");
	}
	ListHtml($softtypeid,$listtemp_r,2);
	printerror("�����������ҳ��ɹ�","history.go(-1)");
}

//�����Զ����б�
function ReUserlistHtml($id,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"userlist");
	$id=(int)$id;
	if(!$id)
	{
		printerror("��ѡ��Ҫ���ɵ��Զ����б�","history.go(-1)");
	}
	ListHtml($id,$listtemp_r,4);
	printerror("�����Զ����б�ҳ��ɹ�","history.go(-1)");
}

//������ҳ
function ReIndex(){
	global $empire;
	$temptext=GetDownTemp("indextemp");
	DownBq($temptext);
	if($_GET['OneReAll']==1)//һ������
	{
		echo "��ҳ�������,������һ������......<script>self.location.href='chtmlphome.php?phome=ReSoftClass&OneReAll=1';</script>";
		exit();
	}
	printerror("������ҳ�ɹ�","history.go(-1)");
}

//���������Զ����б�
function ReUserlistAll($start=0,$from,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select id,listtempid from {$dbtbpre}downuserlist where id>$start order by id limit ".$public_r[relist_num]);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[id];
		if($oldlisttempid==$r[listtempid])
		{
			$listtemp_r=$oldlisttemp_r;
	    }
		else
		{
			$listtemp_r=GetListtemp($r[listtempid]);
	    }
		ListHtml($r[id],$listtemp_r,4);
		$oldlisttempid=$r[listtempid];
		$oldlisttemp_r=$listtemp_r;
	}
	//���
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//һ������
		{
			echo "�Զ����б��������,������һ������......<script>self.location.href='chtmlphome.php?phome=ReUserpageAll&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("���������Զ����б�ɹ�",$from);
	}
	echo "һ���Զ����б�������ϣ���������һ��......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReUserlistAll&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//����ר���б�
function ReZtlistAll($start=0,$from,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select ztid,listtempid from {$dbtbpre}downzt where ztid>$start order by ztid limit ".$public_r[relist_num]);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[ztid];
		if($oldlisttempid==$r[listtempid])
		{
			$listtemp_r=$oldlisttemp_r;
	    }
		else
		{
			$listtemp_r=GetListtemp($r[listtempid]);
	    }
		ListHtml($r[ztid],$listtemp_r,1);
		$oldlisttempid=$r[listtempid];
		$oldlisttemp_r=$listtemp_r;
	}
	//���
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//һ������
		{
			echo "ר���б��������,������һ������......<script>self.location.href='chtmlphome.php?phome=ReSoftTypelistAll&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("��������ר���б�ɹ�",$from);
	}
	echo "һ��ר���б�������ϣ���������һ��......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReZtlistAll&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//������������б�
function ReSoftTypelistAll($start=0,$from,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select softtypeid,listtempid from {$dbtbpre}softtype where softtypeid>$start order by softtypeid limit ".$public_r[relist_num]);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[softtypeid];
		if($oldlisttempid==$r[listtempid])
		{
			$listtemp_r=$oldlisttemp_r;
	    }
		else
		{
			$listtemp_r=GetListtemp($r[listtempid]);
	    }
		ListHtml($r[softtypeid],$listtemp_r,2);
		$oldlisttempid=$r[listtempid];
		$oldlisttemp_r=$listtemp_r;
	}
	//���
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//һ������
		{
			echo "��������б��������,������һ������......<script>self.location.href='chtmlphome.php?phome=ReZmlistAll&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("����������������б�ɹ�",$from);
	}
	echo "һ����������б�������ϣ���������һ��......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReSoftTypelistAll&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//��ĸ�б�
function ReZmlistAll($start=0,$from,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$zmr=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$start=(int)$start;
	$b=0;
	$thisi=0;
	$listtemp_r=GetListtemp($public_r[zmlisttempid]);
	for($i=$start;$i<26&&$thisi<$public_r[relist_num];$i++)
	{
		$thisi++;
		$b=1;
		ListHtml($zmr[$i],$listtemp_r,3);
	}
	$newstart=$i;
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//һ������
		{
			echo "��ĸ�����б��������,������һ������......<script>self.location.href='chtmlphome.php?phome=ReUserlistAll&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("������ĸ�����б�ɹ�",$from);
	}
	echo "һ����ĸ�����б�������ϣ���������һ��......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReZmlistAll&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//���ɷ����б�
function ReHtml_all($start,$from,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select classid,listtempid from {$dbtbpre}downclass where classid>$start order by classid limit ".$public_r[relist_num]);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[classid];
		if($oldlisttempid==$r[listtempid])
		{
			$listtemp_r=$oldlisttemp_r;
	    }
		else
		{
			$listtemp_r=GetListtemp($r[listtempid]);
	    }
		ListHtml($r[classid],$listtemp_r,0);
		$oldlisttempid=$r[listtempid];
		$oldlisttemp_r=$listtemp_r;
	}
	//���
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//һ������
		{
			echo "�����б��������,������һ������......<script>self.location.href='chtmlphome.php?phome=ReSoftHtml&start=0&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("�������ɷ����б�ɹ�",$from);
	}
	echo "һ������б�������ϣ���������һ��......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReHtml_all&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//���ɷ��ർ��
function GetClassJS_all($start=0,$do,$from){
	global $empire,$public_r,$dbtbpre;
	$start=(int)$start;
	$line=$public_r[relist_num];
	$b=0;
	if($do=="all")
	{
		ClassJS(0,0,'',1);
		if($_GET['OneReAll']==1)//һ������
		{
			echo "���з��ർ���������,������һ������......<script>self.location.href='chtmlphome.php?phome=ReHtml_all&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("�������з��ർ���ɹ�",$from); 
    }
	else
	{
		$temp=stripSlashes(RepJsTemptext(GetDownTemp("navtemp")));
		$from=urlencode($from);
		$sql=$empire->query("select classid,bclassid from {$dbtbpre}downclass where islast=0 and classid>$start order by classid limit $line");
		while($r=$empire->fetch($sql))
		{
			$b=1;
			ClassJS($r[bclassid],$r[classid],$temp,0);
			$newstart=$r[classid];
		}
		//�������
		if(empty($b))
		{
			echo "���ɷ���JS�ɹ�,���ڽ���һ����������......<script>self.location.href='chtmlphome.php?phome=ReClassJS_all&do=all&start=0&from=$from&OneReAll=$_GET[OneReAll]';</script>";
			exit();
		}
		echo "һ�����JS���ɳɹ�,���ڽ�����һ��......<script>self.location.href='chtmlphome.php?phome=ReClassJS_all&do=class&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
		exit();
    }
}

//�����������ҳ��
function ReSoftHtml($start,$classid,$from,$retype,$startday,$endday,$startid,$endid){
	global $empire,$public_r,$class_r,$dbtbpre;
	$start=(int)$start;
	$classid=(int)$classid;
	//��ID����
	if($retype)
	{
		$startid=(int)$startid;
		$endid=(int)$endid;
		$add1=$endid?' and softid>='.$startid.' and softid<='.$endid:'';
    }
	else
	{
		$startday=RepPostVar($startday);
		$endday=RepPostVar($endday);
		$add1=$startday&&$endday?' and softtime>='.to_time($startday.' 00:00:00').' and softtime<='.to_time($endday.' 23:59:59'):'';
    }
	//���������
	if($classid)
	{
		if(empty($class_r[$classid][islast]))//�м����
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
		}
		else//�ռ����
		{
			$where="classid='$classid'";
		}
		$add1.=" and (".$where.")";
    }
	$b=0;
	$sql=$empire->query("select * from {$dbtbpre}down where softid>$start".$add1." order by softid limit ".$public_r[resoft_num]);
	while($n_r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$n_r[softid];
		if($oldsofttempid==$class_r[$n_r[classid]][softtempid])
		{
			$softtemp_r=$oldsofttemp_r;
	    }
		else
		{
			$softtemp_r=GetSofttemp($class_r[$n_r[classid]][softtempid]);
	    }
		GetHtml($n_r,$softtemp_r);
		$oldsofttempid=$class_r[$n_r[classid]][softtempid];
		$oldsofttemp_r=$softtemp_r;
	}
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//һ������
		{
			printerror('ȫվ�������!','ChangeData.php',0,1);
		}
		printerror("�����������ҳ��ɹ�",$from);
	}
	echo"һ�����ҳ���������,��������һ��......<script>self.location.href='chtmlphome.php?phome=ReSoftHtml&classid=$classid&start=$newstart&from=$from&retype=$retype&startday=$startday&endday=$endday&startid=$startid&endid=$endid&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//��������js
function ReJS_all($start=0,$do,$from,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$start=(int)$start;
	$b=0;
	$line=$public_r[relist_num];
	//ȡ��ģ��
	$tempr=$empire->fetch1("select classjsshowdate,classjstemp from {$dbtbpre}downpubtemp limit 1");
	if($do=="all")//�����ܵ�js
	{
		ReEdownJs(0,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],0,$tempr);
		ReEdownJs(0,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],1,$tempr);
		ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],2,$tempr);
		ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],3,$tempr);
		ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],4,$tempr);
		ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],5,$tempr);
		if($_GET['OneReAll']==1)//һ������
		{
			echo "����JS�����������,������һ������......<script>self.location.href=action;</script>";
			exit();
		}
		printerror("��������JS���óɹ�",$from);
    }
	elseif($do=="zt")//����ר��js
	{
		$from=urlencode($from);
		$zt_sql=$empire->query("select ztid from {$dbtbpre}downzt where ztid>$start order by ztid limit $line");
	    while($zt_r=$empire->fetch($zt_sql))
	    {
			$b=1;
			ReEdownJs($zt_r['ztid'],$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],12,$tempr);
			ReEdownJs($zt_r['ztid'],$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],13,$tempr);
			ReEdownJs($zt_r['ztid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],14,$tempr);
			ReEdownJs($zt_r['ztid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],15,$tempr);
			ReEdownJs($zt_r['ztid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],16,$tempr);
			ReEdownJs($zt_r['ztid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],17,$tempr);
			$newstart=$zt_r[ztid];
	    }
		//�������
		if(empty($b))
		{
			echo "����ר��JS�ɹ�,���ڽ����������JS����......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=softtype&start=0&from=$from&OneReAll=$_GET[OneReAll]';</script>";
			exit();
		}
		echo "һ��ר��JS���ɳɹ�,���ڽ�����һ��......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=zt&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
		exit();
	}
	elseif($do=="softtype")//�����������js
	{
		$from=urlencode($from);
		$st_sql=$empire->query("select softtypeid,softtype from {$dbtbpre}softtype where softtypeid>$start order by softtypeid limit $line");
	    while($st_r=$empire->fetch($st_sql))
	    {
			$b=1;
			ReEdownJs($st_r['softtypeid'],$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],18,$tempr);
			ReEdownJs($st_r['softtypeid'],$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],19,$tempr);
			ReEdownJs($st_r['softtypeid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],20,$tempr);
			ReEdownJs($st_r['softtypeid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],21,$tempr);
			ReEdownJs($st_r['softtypeid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],22,$tempr);
			ReEdownJs($st_r['softtypeid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],23,$tempr);
			$newstart=$st_r[softtypeid];
	    }
		//�������
		if(empty($b))
		{
			echo "�����������JS�ɹ�,���ڽ�����������......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=all&start=0&from=$from&OneReAll=$_GET[OneReAll]';</script>";
			exit();
		}
		echo "һ���������JS���ɳɹ�,���ڽ�����һ��......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=softtype&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
			exit();
	}
	else//����js
	{
		$from=urlencode($from);
		$sql=$empire->query("select classid from {$dbtbpre}downclass where classid>$start order by classid limit $line");
        while($r=$empire->fetch($sql))
	    {
			$b=1;
			ReEdownJs($r['classid'],$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],6,$tempr);
			ReEdownJs($r['classid'],$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],7,$tempr);
			ReEdownJs($r['classid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],8,$tempr);
			ReEdownJs($r['classid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],9,$tempr);
			ReEdownJs($r['classid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],10,$tempr);
			ReEdownJs($r['classid'],$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],11,$tempr);
			$newstart=$r[classid];
        }
		//�������
		if(empty($b))
		{
			echo "���ɷ���JS�ɹ�,���ڽ���ר��JS����......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=zt&start=0&from=$from&OneReAll=$_GET[OneReAll]';</script>";
			exit();
		}
		echo "һ�����JS���ɳɹ�,���ڽ�����һ��......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=class&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
		exit();
	}
}

//���ɵ�js
function ReJs_single($classid,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	if(!$classid)
	{
		printerror("��ѡ��Ҫ���ɵķ���","history.go(-1)");
	}
	//ȡ��ģ��
	$tempr=$empire->fetch1("select classjsshowdate,classjstemp from {$dbtbpre}downpubtemp limit 1");
	ReEdownJs($classid,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],6,$tempr);
	ReEdownJs($classid,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],7,$tempr);
	ReEdownJs($classid,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],8,$tempr);
	ReEdownJs($classid,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],9,$tempr);
	ReEdownJs($classid,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],10,$tempr);
	ReEdownJs($classid,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],11,$tempr);
	printerror("���ɷ���JS�ɹ�","history.go(-1)");
}

//������JS
function ReSjs_single($classid,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	//ȡ��ģ��
	$tempr=$empire->fetch1("select classjsshowdate,classjstemp from {$dbtbpre}downpubtemp limit 1");
	ReEdownJs(0,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],0,$tempr);
	ReEdownJs(0,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],1,$tempr);
	ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],2,$tempr);
	ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],3,$tempr);
	ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],4,$tempr);
	ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],5,$tempr);
	printerror("�����ܵ���JS�ɹ�","history.go(-1)");
}

//���ɹ���
function ReGg(){
	GetGgJs();
	printerror("���ɹ���ɹ�","history.go(-1)");
}

//���¶�̬ҳ��
function ChangeDtPage($mess=0,$userid,$username){
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"changedata");
	GetSearch();//������
	ReSearchFile('');//�����б�
	GetGgJs();//����
	ChangeMemberCpPage();//�������
	ReLoginIframe();//��½��
	ReDownPageFile();//����ҳ��
	if(empty($mess))
	{
		if($_GET['OneReAll']==1)//һ������
		{
			echo "��̬ҳ���������,������һ������......<script>self.location.href='chtmlphome.php?phome=ReZtlistAll&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror('���¶�̬ҳ�����','history.go(-1)');
	}
}

//����ˢ���Զ���ҳ��
function ReUserpageAll($start=0,$from,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select id from {$dbtbpre}downuserpage where id>$start order by id limit ".$public_r['reuserpagenum']);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[id];
		ReUserpage($r[id]);
	}
	//���
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//һ������
		{
			echo "�Զ���ҳ���������,������һ������......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=class&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("���������Զ���ҳ�����",$from);
	}
	echo "һ��ҳ��������ϣ���������һ��......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReUserpageAll&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}
?>