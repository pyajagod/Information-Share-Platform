<?php
//生成分类导航
function ReSoftClass($userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	GetSoftClass();
	if($_GET['OneReAll']==1)//一键生成
	{
		echo "分类导航页面生成完毕,继续下一个生成......<script>self.location.href='chtmlphome.php?phome=ChangeDtPage&OneReAll=1';</script>";
		exit();
	}
	printerror("生成分类导航页面成功","history.go(-1)");
}

//生成列表
function ReHtml($classid,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"class");
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("请选择要生成的分类","history.go(-1)");
	}
	ListHtml($classid,$listtemp_r,0);
	printerror("生成分类页面成功","history.go(-1)");
}

//生成专题
function ReZtHtml($ztid,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"zt");
	$ztid=(int)$ztid;
	if(!$ztid)
	{
		printerror("请选择要生成的专题","history.go(-1)");
	}
	ListHtml($ztid,$listtemp_r,1);
	printerror("生成专题页面成功","history.go(-1)");
}

//生成软件类型
function ReSoftTypeHtml($softtypeid,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"softtype");
	$softtypeid=(int)$softtypeid;
	if(!$softtypeid)
	{
		printerror("请选择要生成的软件类型","history.go(-1)");
	}
	ListHtml($softtypeid,$listtemp_r,2);
	printerror("生成软件类型页面成功","history.go(-1)");
}

//生成自定义列表
function ReUserlistHtml($id,$userid,$username){
	global $empire,$public_r,$class_r,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"userlist");
	$id=(int)$id;
	if(!$id)
	{
		printerror("请选择要生成的自定义列表","history.go(-1)");
	}
	ListHtml($id,$listtemp_r,4);
	printerror("生成自定义列表页面成功","history.go(-1)");
}

//生成首页
function ReIndex(){
	global $empire;
	$temptext=GetDownTemp("indextemp");
	DownBq($temptext);
	if($_GET['OneReAll']==1)//一键生成
	{
		echo "首页生成完毕,继续下一个生成......<script>self.location.href='chtmlphome.php?phome=ReSoftClass&OneReAll=1';</script>";
		exit();
	}
	printerror("生成首页成功","history.go(-1)");
}

//批量生成自定义列表
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
	//完毕
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//一键生成
		{
			echo "自定义列表生成完毕,继续下一个生成......<script>self.location.href='chtmlphome.php?phome=ReUserpageAll&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("批量生成自定义列表成功",$from);
	}
	echo "一组自定义列表生成完毕，正进入下一组......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReUserlistAll&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//生成专题列表
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
	//完毕
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//一键生成
		{
			echo "专题列表生成完毕,继续下一个生成......<script>self.location.href='chtmlphome.php?phome=ReSoftTypelistAll&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("批量生成专题列表成功",$from);
	}
	echo "一组专题列表生成完毕，正进入下一组......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReZtlistAll&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//生成软件类型列表
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
	//完毕
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//一键生成
		{
			echo "软件类型列表生成完毕,继续下一个生成......<script>self.location.href='chtmlphome.php?phome=ReZmlistAll&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("批量生成软件类型列表成功",$from);
	}
	echo "一组软件类型列表生成完毕，正进入下一组......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReSoftTypelistAll&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//字母列表
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
		if($_GET['OneReAll']==1)//一键生成
		{
			echo "字母索引列表生成完毕,继续下一个生成......<script>self.location.href='chtmlphome.php?phome=ReUserlistAll&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("生成字母索引列表成功",$from);
	}
	echo "一组字母索引列表生成完毕，正进入下一组......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReZmlistAll&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//生成分类列表
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
	//完毕
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//一键生成
		{
			echo "分类列表生成完毕,继续下一个生成......<script>self.location.href='chtmlphome.php?phome=ReSoftHtml&start=0&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("批量生成分类列表成功",$from);
	}
	echo "一组分类列表生成完毕，正进入下一组......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReHtml_all&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//生成分类导行
function GetClassJS_all($start=0,$do,$from){
	global $empire,$public_r,$dbtbpre;
	$start=(int)$start;
	$line=$public_r[relist_num];
	$b=0;
	if($do=="all")
	{
		ClassJS(0,0,'',1);
		if($_GET['OneReAll']==1)//一键生成
		{
			echo "所有分类导航生成完毕,继续下一个生成......<script>self.location.href='chtmlphome.php?phome=ReHtml_all&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("生成所有分类导航成功",$from); 
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
		//生成完毕
		if(empty($b))
		{
			echo "生成分类JS成功,正在进入一级导航生成......<script>self.location.href='chtmlphome.php?phome=ReClassJS_all&do=all&start=0&from=$from&OneReAll=$_GET[OneReAll]';</script>";
			exit();
		}
		echo "一组分类JS生成成功,正在进入下一组......<script>self.location.href='chtmlphome.php?phome=ReClassJS_all&do=class&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
		exit();
    }
}

//生成所有软件页面
function ReSoftHtml($start,$classid,$from,$retype,$startday,$endday,$startid,$endid){
	global $empire,$public_r,$class_r,$dbtbpre;
	$start=(int)$start;
	$classid=(int)$classid;
	//按ID生成
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
	//按类别生成
	if($classid)
	{
		if(empty($class_r[$classid][islast]))//中级类别
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
		}
		else//终极类别
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
		if($_GET['OneReAll']==1)//一键生成
		{
			printerror('全站生成完毕!','ChangeData.php',0,1);
		}
		printerror("生成所有软件页面成功",$from);
	}
	echo"一组软件页面生成完毕,正进入下一组......<script>self.location.href='chtmlphome.php?phome=ReSoftHtml&classid=$classid&start=$newstart&from=$from&retype=$retype&startday=$startday&endday=$endday&startid=$startid&endid=$endid&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}

//生成所有js
function ReJS_all($start=0,$do,$from,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$start=(int)$start;
	$b=0;
	$line=$public_r[relist_num];
	//取得模板
	$tempr=$empire->fetch1("select classjsshowdate,classjstemp from {$dbtbpre}downpubtemp limit 1");
	if($do=="all")//生成总的js
	{
		ReEdownJs(0,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],0,$tempr);
		ReEdownJs(0,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],1,$tempr);
		ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],2,$tempr);
		ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],3,$tempr);
		ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],4,$tempr);
		ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],5,$tempr);
		if($_GET['OneReAll']==1)//一键生成
		{
			echo "所有JS调用生成完毕,继续下一个生成......<script>self.location.href=action;</script>";
			exit();
		}
		printerror("生成所有JS调用成功",$from);
    }
	elseif($do=="zt")//生成专题js
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
		//生成完毕
		if(empty($b))
		{
			echo "生成专题JS成功,正在进入软件类型JS生成......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=softtype&start=0&from=$from&OneReAll=$_GET[OneReAll]';</script>";
			exit();
		}
		echo "一组专题JS生成成功,正在进入下一组......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=zt&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
		exit();
	}
	elseif($do=="softtype")//生成软件分类js
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
		//生成完毕
		if(empty($b))
		{
			echo "生成软件类型JS成功,正在进入最后的生成......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=all&start=0&from=$from&OneReAll=$_GET[OneReAll]';</script>";
			exit();
		}
		echo "一组软件类型JS生成成功,正在进入下一组......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=softtype&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
			exit();
	}
	else//分类js
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
		//生成完毕
		if(empty($b))
		{
			echo "生成分类JS成功,正在进入专题JS生成......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=zt&start=0&from=$from&OneReAll=$_GET[OneReAll]';</script>";
			exit();
		}
		echo "一组分类JS生成成功,正在进入下一组......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=class&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
		exit();
	}
}

//生成单js
function ReJs_single($classid,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	if(!$classid)
	{
		printerror("请选择要生成的分类","history.go(-1)");
	}
	//取得模板
	$tempr=$empire->fetch1("select classjsshowdate,classjstemp from {$dbtbpre}downpubtemp limit 1");
	ReEdownJs($classid,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],6,$tempr);
	ReEdownJs($classid,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],7,$tempr);
	ReEdownJs($classid,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],8,$tempr);
	ReEdownJs($classid,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],9,$tempr);
	ReEdownJs($classid,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],10,$tempr);
	ReEdownJs($classid,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],11,$tempr);
	printerror("生成分类JS成功","history.go(-1)");
}

//生成总JS
function ReSjs_single($classid,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	//取得模板
	$tempr=$empire->fetch1("select classjsshowdate,classjstemp from {$dbtbpre}downpubtemp limit 1");
	ReEdownJs(0,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],0,$tempr);
	ReEdownJs(0,$public_r['newnum'],$public_r['sub_new'],$tempr['classjsshowdate'],1,$tempr);
	ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],2,$tempr);
	ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],3,$tempr);
	ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],4,$tempr);
	ReEdownJs(0,$public_r['topnum'],$public_r['sub_top'],$tempr['classjsshowdate'],5,$tempr);
	printerror("生成总调用JS成功","history.go(-1)");
}

//生成公告
function ReGg(){
	GetGgJs();
	printerror("生成公告成功","history.go(-1)");
}

//更新动态页面
function ChangeDtPage($mess=0,$userid,$username){
	//验证权限
	CheckLevel($userid,$username,$classid,"changedata");
	GetSearch();//搜索表单
	ReSearchFile('');//搜索列表
	GetGgJs();//公告
	ChangeMemberCpPage();//控制面板
	ReLoginIframe();//登陆表单
	ReDownPageFile();//下载页面
	if(empty($mess))
	{
		if($_GET['OneReAll']==1)//一键生成
		{
			echo "动态页面生成完毕,继续下一个生成......<script>self.location.href='chtmlphome.php?phome=ReZtlistAll&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror('更新动态页面完毕','history.go(-1)');
	}
}

//批量刷新自定义页面
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
	//完毕
	if(empty($b))
	{
		if($_GET['OneReAll']==1)//一键生成
		{
			echo "自定义页面生成完毕,继续下一个生成......<script>self.location.href='chtmlphome.php?phome=ReListJs&do=class&from=ChangeData.php&OneReAll=1';</script>";
			exit();
		}
		printerror("批量生成自定义页面完毕",$from);
	}
	echo "一组页面生成完毕，正进入下一组......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='chtmlphome.php?phome=ReUserpageAll&start=$newstart&from=$from&OneReAll=$_GET[OneReAll]';</script>";
	exit();
}
?>