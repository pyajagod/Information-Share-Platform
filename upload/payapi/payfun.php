<?php
//类型支付
function PayApiBuyGroupPay($bgid,$money,$orderid,$userid,$username,$groupid,$ecms_paytype){
	global $empire,$dbtbpre,$level_r,$user_tablename,$user_downfen,$user_downdate,$user_userid,$user_username,$user_zgroup,$user_group;
	//验证是否重复提交
	$orderid=RepPostVar($orderid);
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}downpayrecord where orderid='$orderid' limit 1");
	if($num)
	{
		printerror('您已成功充值','../../cp/',1);
	}
	$buyr=$empire->fetch1("select * from {$dbtbpre}downbuygroup where id='$bgid'");
	if($buyr['id']&&$money==$buyr['gmoney']&&$level_r[$buyr[buygroupid]][level]<=$level_r[$groupid][level])
	{
		//充值
		$user=$empire->fetch1("select $user_downdate,$user_userid,$user_username from {$user_tablename} where ".$user_userid."='$userid'");
		eAddFenToUser($buyr['gfen'],$buyr['gdate'],$buyr['ggroupid'],$buyr['gzgroupid'],$user);
		$posttime=date("Y-m-d H:i:s");
		$payip=egetip();
		$paybz="充值类型:".addslashes($buyr['gname']);
		$empire->query("insert into {$dbtbpre}downpayrecord(id,userid,username,orderid,money,posttime,paybz,type,payip) values(NULL,'$userid','$username','$orderid','$money','$posttime','$paybz','$ecms_paytype','$payip');");
		//备份充值记录
		BakBuy($userid,$username,$buyr['gname'],$buyr['gfen'],$money,$buyr['gdate'],1);
	}
	printerror('您已成功充值','../../cp/',1);
}
?>