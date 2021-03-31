<?php
//���ӻ�Ա��
function AddMemberGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($add[groupname]))
	{
		printerror("�������Ա������","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"member");
	$add[level]=(int)$add[level];
	$add[checked]=(int)$add[checked];
	$add[favanum]=(int)$add[favanum];
	$add[daydown]=(int)$add[daydown];
	$sql=$empire->query("insert into {$dbtbpre}downmembergroup(groupname,level,checked,favanum,daydown) values('$add[groupname]','$add[level]','$add[checked]','$add[favanum]','$add[daydown]');");
	//���»���
	GetMemberLevel();
	if($sql)
	{
		printerror("���ӻ�Ա��ɹ�","AddMemberGroup.php?phome=AddMemberGroup");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//�޸Ļ�Ա��
function EditMemberGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[groupid]=(int)$add[groupid];
	if(empty($add[groupid])||empty($add[groupname]))
	{
		printerror("�������Ա������","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"member");
	$add[level]=(int)$add[level];
	$add[checked]=(int)$add[checked];
	$add[favanum]=(int)$add[favanum];
	$add[daydown]=(int)$add[daydown];
	$sql=$empire->query("update {$dbtbpre}downmembergroup set groupname='$add[groupname]',level='$add[level]',checked='$add[checked]',favanum='$add[favanum]',daydown='$add[daydown]' where groupid='$add[groupid]'");
	//���»���
	GetMemberLevel();
	if($sql)
	{
		printerror("�޸Ļ�Ա��ɹ�","ListMemberGroup.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//ɾ����Ա��
function DelMemberGroup($groupid,$userid,$username){
	global $empire,$dbtbpre;
	$groupid=(int)$groupid;
	if(empty($groupid))
	{
		printerror("��ѡ��Ҫɾ���Ļ�Ա��","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"member");
	$sql=$empire->query("delete from {$dbtbpre}downmembergroup where groupid='$groupid'");
	//���»���
	GetMemberLevel();
	if($sql)
	{
		printerror("ɾ����Ա��ɹ�","ListMemberGroup.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//���ӵ㿨
function AddCard($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[card_no]||!$add[password]||!$add[money])
	{
		printerror("��*��Ϊ����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"card");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}downcard where card_no='$add[card_no]' limit 1");
	if($num)
	{
		printerror("�˵㿨�Ѵ���","history.go(-1)");
	}
	$cardtime=date("Y-m-d H:i:s");
	$add[cardfen]=(int)$add[cardfen];
	$add[money]=(int)$add[money];
	$add[carddate]=(int)$add[carddate];
	$add[cdgroupid]=(int)$add[cdgroupid];
	$add[cdzgroupid]=(int)$add[cdzgroupid];
	$sql=$empire->query("insert into {$dbtbpre}downcard(card_no,password,cardfen,money,cardtime,endtime,carddate,cdgroupid,cdzgroupid) values('$add[card_no]','$add[password]',$add[cardfen],$add[money],'$cardtime','$add[endtime]',$add[carddate],$add[cdgroupid],$add[cdzgroupid]);");
	$cardid=$empire->lastid();
	if($sql)
	{
		printerror("���ӵ㿨�ɹ�!","AddCard.php?phome=AddCard");
	}
	else
	{printerror("���ݿ����","history.go(-1)");}
}

//�������ӵ㿨
function AddMoreCard($add,$userid,$username){
	global $empire,$dbtbpre;
	$donum=(int)$add['donum'];
	$cardnum=(int)$add['cardnum'];
	$passnum=(int)$add['passnum'];
	$add[cardfen]=(int)$add[cardfen];
	$add[money]=(int)$add[money];
	$add[carddate]=(int)$add[carddate];
	$add[cdgroupid]=(int)$add[cdgroupid];
	$add[cdzgroupid]=(int)$add[cdzgroupid];
	if(!$donum||!$cardnum||!$passnum||!$add[money])
	{
		printerror("��*��Ϊ����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"card");
	$cardtime=date("Y-m-d H:i:s");
	//д�뿨��
	$no=1;
    while($no<=$donum)
	{
		$card_no=strtolower(no_make_password($cardnum));
		$password=strtolower(no_make_password($passnum));
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}downcard where card_no='$card_no' limit 1");
		if(!$num)
		{
			$sql=$empire->query("insert into {$dbtbpre}downcard(card_no,password,cardfen,money,cardtime,endtime,carddate,cdgroupid,cdzgroupid) values('$card_no','$password',$add[cardfen],$add[money],'$cardtime','$add[endtime]',$add[carddate],$add[cdgroupid],$add[cdzgroupid]);");
			$no+=1;
	    }
    }
	if($sql)
	{
		printerror("�������ӵ㿨�ɹ�","AddMoreCard.php");
	}
	else
	{printerror("���ݿ����","history.go(-1)");}
}

//�޸ĵ㿨
function EditCard($add,$userid,$username){
	global $empire,$time,$dbtbpre;
	$add[cardid]=(int)$add[cardid];
	if(!$add[card_no]||!$add[password]||!$add[money]||!$add[cardid])
	{
		printerror("��*��Ϊ����","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"card");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}downcard where card_no='$add[card_no]' and cardid<>".$add[cardid]." limit 1");
	if($num)
	{printerror("�˵㿨�Ѵ���","history.go(-1)");}
	$add[cardfen]=(int)$add[cardfen];
	$add[money]=(int)$add[money];
	$add[carddate]=(int)$add[carddate];
	$add[cdgroupid]=(int)$add[cdgroupid];
	$add[cdzgroupid]=(int)$add[cdzgroupid];
	$sql=$empire->query("update {$dbtbpre}downcard set card_no='$add[card_no]',password='$add[password]',cardfen=$add[cardfen],money=$add[money],endtime='$add[endtime]',carddate=$add[carddate],cdgroupid=$add[cdgroupid],cdzgroupid=$add[cdzgroupid] where cardid='$add[cardid]'");
	if($sql)
	{
		printerror("�޸ĵ㿨�ɹ�","ListCard.php?time=$time");
	}
	else
	{printerror("���ݿ����","history.go(-1)");}
}

//ɾ���㿨
function DelCard($cardid,$userid,$username){
	global $empire,$time,$dbtbpre;
	$cardid=(int)$cardid;
	if(!$cardid)
	{printerror("��ѡ����Ҫɾ���ĵ㿨","history.go(-1)");}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"card");
	$r=$empire->fetch1("select card_no,cardfen,carddate from {$dbtbpre}downcard where cardid='$cardid'");
	$sql=$empire->query("delete from {$dbtbpre}downcard where cardid='$cardid'");
	if($sql)
	{
		printerror("ɾ���㿨�ɹ�!","ListCard.php?time=$time");
	}
	else
	{printerror("���ݿ����","history.go(-1)");}
}

//��ֵ����
function ReturnBuyGroupVar($add){
	$add[gmoney]=(int)$add[gmoney];
	$add[gfen]=(int)$add[gfen];
	$add[gdate]=(int)$add[gdate];
	$add[ggroupid]=(int)$add[ggroupid];
	$add[gzgroupid]=(int)$add[gzgroupid];
	$add[buygroupid]=(int)$add[buygroupid];
	$add[myorder]=(int)$add[myorder];
	return $add;
}

//���ӳ�ֵ����
function AddBuyGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"buygroup");
	$add=ReturnBuyGroupVar($add);
	if(!$add[gname]||!$add[gmoney])
	{
		printerror('���������������빺����','history.go(-1)');
	}
	$sql=$empire->query("insert into {$dbtbpre}downbuygroup(gname,gmoney,gfen,gdate,ggroupid,gzgroupid,buygroupid,gsay,myorder) values('$add[gname]','$add[gmoney]','$add[gfen]','$add[gdate]','$add[ggroupid]','$add[gzgroupid]','$add[buygroupid]','$add[gsay]','$add[myorder]');");
	if($sql)
	{
		printerror('���ӳ�ֵ���ͳɹ�','AddBuyGroup.php');
	}
	else
	{
		printerror('���ݿ����','');
	}
}

//�޸ĳ�ֵ����
function EditBuyGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"buygroup");
	$id=(int)$add['id'];
	$add=ReturnBuyGroupVar($add);
	if(!$id||!$add[gname]||!$add[gmoney])
	{
		printerror('���������������빺����','history.go(-1)');
	}
	$sql=$empire->query("update {$dbtbpre}downbuygroup set gname='$add[gname]',gmoney='$add[gmoney]',gfen='$add[gfen]',gdate='$add[gdate]',ggroupid='$add[ggroupid]',gzgroupid='$add[gzgroupid]',buygroupid='$add[buygroupid]',gsay='$add[gsay]',myorder='$add[myorder]' where id='$id'");
	if($sql)
	{
		printerror('�޸ĳ�ֵ���ͳɹ�','ListBuyGroup.php');
	}
	else
	{
		printerror('���ݿ����','');
	}
}

//ɾ����ֵ����
function DelBuyGroup($id,$userid,$username){
	global $empire,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"buygroup");
	$id=(int)$id;
	if(!$id)
	{
		printerror('��ѡ��Ҫɾ���ĳ�ֵ����','');
	}
	$sql=$empire->query("delete from {$dbtbpre}downbuygroup where id='$id'");
	if($sql)
	{
		printerror('ɾ����ֵ���ͳɹ�','ListBuyGroup.php');
	}
	else
	{
		printerror('���ݿ����','');
	}
}
?>