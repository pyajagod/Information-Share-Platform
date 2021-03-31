<?php
//批量替换地址权限
function RepDownLevel($add,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"repip");
	if(!($add[downpath]||$add[onlinepath])||!($add[dogroup]||$add[dofen]||$add[doqz]||$add[dopath]||$add[doname]))
	{
		printerror("请选择要操作的字段跟替换项目","history.go(-1)");
	}
	$start=(int)$add['start'];
	//转换变量
	if(empty($add[oldgroupid]))
	{
		$add[oldgroupid]=0;
	}
	if(empty($add[newgroupid]))
	{
		$add[newgroupid]=0;
	}
	if(empty($add[oldfen]))
	{
		$add[oldfen]=0;
	}
	if(empty($add[newfen]))
	{
		$add[newfen]=0;
	}
	if(empty($add[oldqz]))
	{
		$add[oldqz]=0;
	}
	if(empty($add[newqz]))
	{
		$add[newqz]=0;
	}
	//字段
	$field="softid";
	if($add['downpath'])
	{
		$field.=",downpath";
		$dh=",";
	}
	if($add['onlinepath'])
	{
		$field.=",onlinepath";
	}
	$wheresql="";
	//分类
	$classid=(int)$add['classid'];
	if($classid)
	{
		if(empty($class_r[$classid][islast]))//中级分类
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
		}
		else//终极分类
		{
			$where="classid='$classid'";
		}
		$wheresql.=" and (".$where.")";
	}
	//附加sql语句
	$query=$add['query'];
	if($query)
	{
		//取除adds
		$query=ClearAddsData($query);
		$wheresql.=" and (".$query.")";
	}
	$update="";
	$b=0;
	$sql=$empire->query("select ".$field." from {$dbtbpre}down where softid>$start".$wheresql." order by softid limit ".$public_r[repnum]);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[softid];
		$update='';
		//下载地址
		$newdownpath="";
		if($add[downpath])
		{
			$newdownpath=RepDownLevelStrip($r[downpath],$add);
			$update="downpath='".addslashes($newdownpath)."'";
		}
		//在线地址
		$newonlinepath="";
		if($add[onlinepath])
		{
			$newonlinepath=RepDownLevelStrip($r[onlinepath],$add);
			$update.=$dh."onlinepath='".addslashes($newonlinepath)."'";
		}
		$usql=$empire->query("update {$dbtbpre}down set ".$update." where softid=$r[softid]");
	}
	//替换完毕
	if(empty($b))
	{
		printerror("批量替换地址权限成功","RepIp.php");
	}
	EchoRepDownLevelForm($add,$newstart);
}

//替换权限处理函数
function RepDownLevelStrip($downpath,$add){
	if(empty($downpath))
	{
		return "";
	}
	$add[oldpath]=ClearAddsData($add[oldpath]);
	$add[newpath]=ClearAddsData($add[newpath]);
	$add[oldname]=ClearAddsData($add[oldname]);
	$add[newname]=ClearAddsData($add[newname]);
	$f_exp="::::::";
	$r_exp="\r\n";
	$newdownpath="";
	$downpath=stripSlashes($downpath);
	$down_rr=explode($r_exp,$downpath);
	$count=count($down_rr);
	for($i=0;$i<$count;$i++)
	{
		$down_fr=explode($f_exp,$down_rr[$i]);
		//权限替换
		$d_groupid=(int)$down_fr[2];
		if($add[dogroup])
		{
			if($add[oldgroupid]=="no")//不设置
			{
				$d_groupid=$add[newgroupid];
			}
			else//设置
			{
				if($d_groupid==$add[oldgroupid])
				{
					$d_groupid=$add[newgroupid];
				}
			}
		}
		//点数转换
		$d_fen=(int)$down_fr[3];
		if($add[dofen])
		{
			if($add[oldfen]=="no")//不设置
			{
				$d_fen=$add[newfen];
			}
			else//设置
			{
				if($d_fen==$add[oldfen])
				{
					$d_fen=$add[newfen];
				}
			}
		}
		//前缀转换
		$d_qz=(int)$down_fr[4];
		if($add[doqz])
		{
			if($add[oldqz]=="no")//不设置
			{
				$d_qz=$add['newqz'];
			}
			else//设置
			{
				if($d_qz==$add[oldqz])
				{
					$d_qz=$add[newqz];
				}
			}
		}
		//地址替换
		$d_path=$down_fr[1];
		if($add[dopath]&&$add[oldpath])
		{
			$d_path=str_replace($add[oldpath],$add[newpath],$down_fr[1]);
		}
		//名称替换
		$d_name=$down_fr[0];
		if($add[doname]&&$add[oldname])
		{
			$d_name=str_replace($add[oldname],$add[newname],$down_fr[0]);
		}
		//组合
		$newdownpath.=$d_name.$f_exp.$d_path.$f_exp.$d_groupid.$f_exp.$d_fen.$f_exp.$d_qz.$r_exp;
	}
	//去掉最后的字符
	$newdownpath=substr($newdownpath,0,strlen($newdownpath)-2);
	return $newdownpath;
}

//输出批量替换下载权限表单
function EchoRepDownLevelForm($add,$newstart){
	global $fun_r;
	?>
	一组数据替换完毕,正进入下一组......(ID:<font color=red><b><?=$newstart?></b></font>)
	<form name="RepDownLevelForm" method="post" action="comphome.php">
		<input type=hidden name="phome" value="RepIp">
		<input type=hidden name="start" value="<?=$newstart?>">
		<input type=hidden name="classid" value="<?=$add['classid']?>">
		<input type=hidden name="downpath" value="<?=$add['downpath']?>">
		<input type=hidden name="onlinepath" value="<?=$add['onlinepath']?>">
		<input type=hidden name="dogroup" value="<?=$add['dogroup']?>">
		<input type=hidden name="oldgroupid" value="<?=$add['oldgroupid']?>">
		<input type=hidden name="newgroupid" value="<?=$add['newgroupid']?>">
		<input type=hidden name="dofen" value="<?=$add['dofen']?>">
		<input type=hidden name="oldfen" value="<?=$add['oldfen']?>">
		<input type=hidden name="newfen" value="<?=$add['newfen']?>">
		<input type=hidden name="doqz" value="<?=$add['doqz']?>">
		<input type=hidden name="oldqz" value="<?=$add['oldqz']?>">
		<input type=hidden name="newqz" value="<?=$add['newqz']?>">
		<input type=hidden name="dopath" value="<?=$add['dopath']?>">
		<input type=hidden name="oldpath" value="<?=htmlspecialchars(ClearAddsData($add['oldpath']))?>">
		<input type=hidden name="newpath" value="<?=htmlspecialchars(ClearAddsData($add['newpath']))?>">
		<input type=hidden name="doname" value="<?=$add['doname']?>">
		<input type=hidden name="oldname" value="<?=htmlspecialchars(ClearAddsData($add['oldname']))?>">
		<input type=hidden name="newname" value="<?=htmlspecialchars(ClearAddsData($add['newname']))?>">
		<input type=hidden name="query" value="<?=htmlspecialchars(ClearAddsData($add['query']))?>">
	</form>
	<script>
	document.RepDownLevelForm.submit();
	</script>
	<?
	exit();
}

//删除评论
function DelPl($plid,$userid,$username){
	global $empire,$dbtbpre;
	$plid=(int)$plid;
	if(!$plid)
	{
		printerror("请选择要删除的评论","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}downpl where plid='$plid'");
	if($sql)
	{
		printerror("删除评论成功",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//批量删除评论
function DelPl_all($plid,$userid,$username){
	global $empire,$dbtbpre;
	$count=count($plid);
	if(!$count)
	{
		printerror("请选择要删除的评论","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$add.="plid='".intval($plid[$i])."' or ";
	}
	$add=substr($add,0,strlen($add)-4);
	$sql=$empire->query("delete from {$dbtbpre}downpl where ".$add);
	if($sql)
	{
		printerror("删除评论成功",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//增加公告
function AddGg($title,$ggtext,$ggtime,$userid,$username){
	global $empire,$dbtbpre;
	if(!$title||!$ggtext)
	{
		printerror("请输入公告标题与内容","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"gg");
	$sql=$empire->query("insert into {$dbtbpre}downgg(title,ggtime,ggtext) values('$title','$ggtime','$ggtext');");
	GetGgJs();
	if($sql)
	{
		printerror("增加公告成功","AddGg.php?phome=AddGg");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改公告
function EditGg($ggid,$title,$ggtext,$ggtime,$userid,$username){
	global $empire,$dbtbpre;
	$ggid=(int)$ggid;
	if(!$ggid||!$title||!$ggtext)
	{
		printerror("请输入公告标题与内容","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"gg");
	$sql=$empire->query("update {$dbtbpre}downgg set title='$title',ggtext='$ggtext',ggtime='$ggtime' where ggid='$ggid'");
	GetGgJs();
	if($sql)
	{
		printerror("修改公告成功","ListGg.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除公告
function DelGg($ggid,$userid,$username){
	global $empire,$dbtbpre;
	$ggid=(int)$ggid;
	if(!$ggid)
	{
		printerror("请选择要删除的公告","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"gg");
	$sql=$empire->query("delete from {$dbtbpre}downgg where ggid='$ggid'");
	GetGgJs();
	if($sql)
	{
		printerror("删除公告成功","ListGg.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}
?>