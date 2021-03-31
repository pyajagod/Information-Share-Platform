<?php
//增加会员组
function AddMemberGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($add[groupname]))
	{
		printerror("请输入会员组名称","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"member");
	$add[level]=(int)$add[level];
	$add[checked]=(int)$add[checked];
	$add[favanum]=(int)$add[favanum];
	$add[daydown]=(int)$add[daydown];
	$sql=$empire->query("insert into {$dbtbpre}downmembergroup(groupname,level,checked,favanum,daydown) values('$add[groupname]','$add[level]','$add[checked]','$add[favanum]','$add[daydown]');");
	//更新缓存
	GetMemberLevel();
	if($sql)
	{
		printerror("增加会员组成功","AddMemberGroup.php?phome=AddMemberGroup");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改会员组
function EditMemberGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[groupid]=(int)$add[groupid];
	if(empty($add[groupid])||empty($add[groupname]))
	{
		printerror("请输入会员组名称","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"member");
	$add[level]=(int)$add[level];
	$add[checked]=(int)$add[checked];
	$add[favanum]=(int)$add[favanum];
	$add[daydown]=(int)$add[daydown];
	$sql=$empire->query("update {$dbtbpre}downmembergroup set groupname='$add[groupname]',level='$add[level]',checked='$add[checked]',favanum='$add[favanum]',daydown='$add[daydown]' where groupid='$add[groupid]'");
	//更新缓存
	GetMemberLevel();
	if($sql)
	{
		printerror("修改会员组成功","ListMemberGroup.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除会员组
function DelMemberGroup($groupid,$userid,$username){
	global $empire,$dbtbpre;
	$groupid=(int)$groupid;
	if(empty($groupid))
	{
		printerror("请选择要删除的会员组","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"member");
	$sql=$empire->query("delete from {$dbtbpre}downmembergroup where groupid='$groupid'");
	//更新缓存
	GetMemberLevel();
	if($sql)
	{
		printerror("删除会员组成功","ListMemberGroup.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//增加点卡
function AddCard($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[card_no]||!$add[password]||!$add[money])
	{
		printerror("带*的为必填","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"card");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}downcard where card_no='$add[card_no]' limit 1");
	if($num)
	{
		printerror("此点卡已存在","history.go(-1)");
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
		printerror("增加点卡成功!","AddCard.php?phome=AddCard");
	}
	else
	{printerror("数据库出错","history.go(-1)");}
}

//批量增加点卡
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
		printerror("带*的为必填","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"card");
	$cardtime=date("Y-m-d H:i:s");
	//写入卡号
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
		printerror("批量增加点卡成功","AddMoreCard.php");
	}
	else
	{printerror("数据库出错","history.go(-1)");}
}

//修改点卡
function EditCard($add,$userid,$username){
	global $empire,$time,$dbtbpre;
	$add[cardid]=(int)$add[cardid];
	if(!$add[card_no]||!$add[password]||!$add[money]||!$add[cardid])
	{
		printerror("带*的为必填","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"card");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}downcard where card_no='$add[card_no]' and cardid<>".$add[cardid]." limit 1");
	if($num)
	{printerror("此点卡已存在","history.go(-1)");}
	$add[cardfen]=(int)$add[cardfen];
	$add[money]=(int)$add[money];
	$add[carddate]=(int)$add[carddate];
	$add[cdgroupid]=(int)$add[cdgroupid];
	$add[cdzgroupid]=(int)$add[cdzgroupid];
	$sql=$empire->query("update {$dbtbpre}downcard set card_no='$add[card_no]',password='$add[password]',cardfen=$add[cardfen],money=$add[money],endtime='$add[endtime]',carddate=$add[carddate],cdgroupid=$add[cdgroupid],cdzgroupid=$add[cdzgroupid] where cardid='$add[cardid]'");
	if($sql)
	{
		printerror("修改点卡成功","ListCard.php?time=$time");
	}
	else
	{printerror("数据库出错","history.go(-1)");}
}

//删除点卡
function DelCard($cardid,$userid,$username){
	global $empire,$time,$dbtbpre;
	$cardid=(int)$cardid;
	if(!$cardid)
	{printerror("请选择你要删除的点卡","history.go(-1)");}
	//验证权限
	CheckLevel($userid,$username,$classid,"card");
	$r=$empire->fetch1("select card_no,cardfen,carddate from {$dbtbpre}downcard where cardid='$cardid'");
	$sql=$empire->query("delete from {$dbtbpre}downcard where cardid='$cardid'");
	if($sql)
	{
		printerror("删除点卡成功!","ListCard.php?time=$time");
	}
	else
	{printerror("数据库出错","history.go(-1)");}
}

//充值类型
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

//增加充值类型
function AddBuyGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"buygroup");
	$add=ReturnBuyGroupVar($add);
	if(!$add[gname]||!$add[gmoney])
	{
		printerror('请输入类型名称与购买金额','history.go(-1)');
	}
	$sql=$empire->query("insert into {$dbtbpre}downbuygroup(gname,gmoney,gfen,gdate,ggroupid,gzgroupid,buygroupid,gsay,myorder) values('$add[gname]','$add[gmoney]','$add[gfen]','$add[gdate]','$add[ggroupid]','$add[gzgroupid]','$add[buygroupid]','$add[gsay]','$add[myorder]');");
	if($sql)
	{
		printerror('增加充值类型成功','AddBuyGroup.php');
	}
	else
	{
		printerror('数据库出错','');
	}
}

//修改充值类型
function EditBuyGroup($add,$userid,$username){
	global $empire,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"buygroup");
	$id=(int)$add['id'];
	$add=ReturnBuyGroupVar($add);
	if(!$id||!$add[gname]||!$add[gmoney])
	{
		printerror('请输入类型名称与购买金额','history.go(-1)');
	}
	$sql=$empire->query("update {$dbtbpre}downbuygroup set gname='$add[gname]',gmoney='$add[gmoney]',gfen='$add[gfen]',gdate='$add[gdate]',ggroupid='$add[ggroupid]',gzgroupid='$add[gzgroupid]',buygroupid='$add[buygroupid]',gsay='$add[gsay]',myorder='$add[myorder]' where id='$id'");
	if($sql)
	{
		printerror('修改充值类型成功','ListBuyGroup.php');
	}
	else
	{
		printerror('数据库出错','');
	}
}

//删除充值类型
function DelBuyGroup($id,$userid,$username){
	global $empire,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"buygroup");
	$id=(int)$id;
	if(!$id)
	{
		printerror('请选择要删除的充值类型','');
	}
	$sql=$empire->query("delete from {$dbtbpre}downbuygroup where id='$id'");
	if($sql)
	{
		printerror('删除充值类型成功','ListBuyGroup.php');
	}
	else
	{
		printerror('数据库出错','');
	}
}
?>