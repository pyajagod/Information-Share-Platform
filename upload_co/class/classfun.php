<?php
//增加专题
function AddZt($add,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"zt");//验证权限
	if(!$add[ztname])
	{
		printerror("请输入专题名","history.go(-1)");
	}
	$add[lencord]=(int)$add[lencord];
	$add[maxnum]=(int)$add[maxnum];
	$add[listtempid]=(int)$add[listtempid];
	$sql=$empire->query("insert into {$dbtbpre}downzt(ztname,lencord,maxnum,listtempid,ztkey,ztintro) values('$add[ztname]','$add[lencord]','$add[maxnum]','$add[listtempid]','$add[ztkey]','$add[ztintro]');");
	GetClassZt();
	if($sql)
	{
		printerror("增加专题成功","AddZt.php?phome=AddZt");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改专题
function EditZt($add,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"zt");//验证权限
	$ztid=(int)$add[ztid];
	if(!$add[ztname]||!$ztid)
	{
		printerror("请输入专题名","history.go(-1)");
	}
	$add[lencord]=(int)$add[lencord];
	$add[maxnum]=(int)$add[maxnum];
	$add[listtempid]=(int)$add[listtempid];
	$sql=$empire->query("update {$dbtbpre}downzt set ztname='$add[ztname]',lencord='$add[lencord]',maxnum='$add[maxnum]',listtempid='$add[listtempid]',ztkey='$add[ztkey]',ztintro='$add[ztintro]' where ztid='$ztid'");
	GetClassZt();
	if($sql)
	{
		printerror("修改专题成功","ListZt.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除专题
function DelZt($ztid,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"zt");//验证权限
	$ztid=(int)$ztid;
	if(!$ztid)
	{
		printerror("请选择要删除的专题","history.go(-1)");
	}
	$zr=$empire->fetch1("select lencord from {$dbtbpre}downzt where ztid='$ztid'");
	$sql=$empire->query("delete from {$dbtbpre}downzt where ztid='$ztid'");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where ztid='$ztid'");
	GetClassZt();
	DelListFile('zt'.$ztid,$zr[lencord],$num);
	if($sql)
	{
		printerror("删除专题成功","ListZt.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//处理分类变量
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

//增加分类
function AddClass($add,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"action");//验证权限
	$add=DoClassVar($add);
	if(!$add[classname])
	{
		printerror("请输入分类名","history.go(-1)");
	}
	$bclassid=$add['bclassid'];
	$islast=$add['islast'];
	//增加终极分类
	if($islast)
	{
		if(empty($bclassid))//根分类
		{
			$featherclass="";
			$sonclass="";
	    }
		else
		{
			//取得父分类信息
			$fr=$empire->fetch1("select sonclass,featherclass,islast from {$dbtbpre}downclass where classid='$bclassid'");
			//大类别为终极分类
			if($fr[islast])
			{
				printerror("父类别不能是终极分类","history.go(-1)");
			}
			//组合父分类
			if(empty($fr[featherclass]))
			{
				$fr[featherclass]="|";
			}
			$featherclass=$fr[featherclass].$bclassid."|";
			$sonclass="";
		}
		$sql=$empire->query("insert into {$dbtbpre}downclass(classname,bclassid,myorder,link_num,lencord,sonclass,featherclass,islast,openadd,groupid,listtempid,softtempid,downnum,onlinenum,bname,formtype,maxnum,qaddgroupid,qaddfen,classimg,classkey,classintro) values('$add[classname]','$bclassid','$add[myorder]','$add[link_num]','$add[lencord]','$sonclass','$featherclass','$islast','$add[openadd]','$add[groupid]','$add[listtempid]','$add[softtempid]','$add[downnum]','$add[onlinenum]','$add[bname]','$add[formtype]','$add[maxnum]','$add[qaddgroupid]','$add[qaddfen]','$add[classimg]','$add[classkey]','$add[classintro]');");
		$classid=$empire->lastid();
		//修改父分类
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
			printerror("增加终极分类成功","AddClass.php?phome=AddClass");
		}
		else
		{
			printerror("数据库出错","history.go(-1)");
		}
	}
	else//增加大分类
	{
		if(empty($bclassid))//根分类
		{
			$featherclass="";
			$sonclass="";
		}
		else
		{
			//取得父分类信息
			$fr=$empire->fetch1("select featherclass,sonclass,islast from {$dbtbpre}downclass where classid='$bclassid'");
			//大类别不能为终极分类
			if($fr[islast])
			{
				printerror("父分类不能是终极分类","history.go(-1)");
			}
			//组合父分类
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
		printerror("增加分类成功","AddClass.php?phome=AddClass");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//修改分类
function EditClass($add,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	CheckLevel($userid,$username,$classid,"action");//验证权限
	$add=DoClassVar($add);
	$classid=(int)$add['classid'];
	if(!$classid||!$add['classname'])
	{
		printerror("请输入分类名","history.go(-1)");
	}
	$islast=$add['islast'];
	$bclassid=$add['bclassid'];
	$oldbclassid=$add['oldbclassid'];
	//大分类
	if(!$islast)
	{
		//改变父分类的话
		if($bclassid<>$oldbclassid)
		{
			//转到根分类
			if(empty($bclassid))
			{
				$sonclass="";
				$featherclass="";
				//取得本分类的子分类
				$r=$empire->fetch1("select featherclass,sonclass from {$dbtbpre}downclass where classid='$classid'");
				//修改父分类的子分类
				$where=ReturnClass($r[featherclass]);
				$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
				while($or=$empire->fetch($osql))
				{
					$newsonclass=str_replace($r[sonclass],"|",$or[sonclass]);
					$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
			    }
				//修改子分类的父栏目
				$osql=$empire->query("select featherclass,classid from {$dbtbpre}downclass where featherclass like '%|".$classid."|%'");
				while($or=$empire->fetch($osql))
				{
					$newfeatherclass=str_replace($r[featherclass],"|",$or[featherclass]);
					$usql=$empire->query("update {$dbtbpre}downclass set featherclass='$newfeatherclass' where classid='$or[classid]'");
				}
		    }
			else//转到中级分类
			{
				if($classid==$bclassid)
				{
					printerror("父分类跟当前分类不能是同一个","history.go(-1)");
				}
				//取得父分类信息
				$b=$empire->fetch1("select sonclass,featherclass,islast from {$dbtbpre}downclass where classid='$bclassid'");
				if($b[islast])
				{
					printerror("父分类不能为终级分类","history.go(-1)");
				}
				//是否非法父类
			    if($b[featherclass])
			    {
					if(strstr($b[featherclass],'|'.$classid.'|'))
					{
						printerror("您选择的父类别不能是分类本身的子类","history.go(-1)");
					}
			    }
			    if(empty($b[featherclass]))
			    {
					$b[featherclass]="|";
				}
				$featherclass=$b[featherclass].$bclassid."|";
				//取得当前分类的的信息
				$r=$empire->fetch1("select sonclass,featherclass from {$dbtbpre}downclass where classid='$classid'");
				//修改子类的父分类
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
				//修改旧父分类的子类
				$where=ReturnClass($r[featherclass]);
				$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
				while($or=$empire->fetch($osql))
				{
					$newsonclass=str_replace($r[sonclass],"|",$or[sonclass]);
					$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
				}
				//修改新父类别的子类
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
	else//终极分类
	{
		//改变父分类
		if($bclassid<>$oldbclassid)
		{
			if(empty($bclassid))//转到根分类
			{
				$sonclass="";
				$featherclass="";
				//更新旧父分类的子分类
				$b=$empire->fetch1("select featherclass from {$dbtbpre}downclass where classid='$classid'");
				$where=ReturnClass($b[featherclass]);
				$osql=$empire->query("select classid,sonclass from {$dbtbpre}downclass where ".$where);
				while($or=$empire->fetch($osql))
				{
					$newsonclass=str_replace("|".$classid."|","|",$or[sonclass]);
					$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
			    }
		    }
			else//转到中极分类
			{
				//取得新父分类的信息
				$b=$empire->fetch1("select featherclass,islast from {$dbtbpre}downclass where classid='$bclassid'");
				//是否终极分类
				if($b[islast])
				{
					printerror("大类别不能为终级类别","history.go(-1)");
				}
				if(empty($b[featherclass]))
				{
					$b[featherclass]="|";
				}
				$featherclass=$b[featherclass].$bclassid."|";
				//改变新父分类的子类
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
				//改变旧父分类的子类
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
		printerror("修改分类成功","ListClass.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//删除分类
function DelClass($classid,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	CheckLevel($userid,$username,$classid,"action");//验证权限
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("请选择要删除的分类","history.go(-1)");
	}
	DelClass1($classid);
	GetSearch();
	GetSoftClass();
	GetClass();
	GetPublic();
	DelListEdown();
	printerror("删除分类成功","ListClass.php");
}

//删除分类函数
function DelClass1($classid){
	global $empire,$dbtbpre,$public_r;
	$c_r=$empire->fetch1("select * from {$dbtbpre}downclass where classid='$classid'");
	//删除终极分类
	if($c_r[islast])
	{
		$del=$empire->query("delete from {$dbtbpre}downclass where classid='$classid'");
		//删除软件
		$sql=$empire->query("select softid,tranimg,checked,filename,titleurl from {$dbtbpre}down where classid='$classid'");
		$i=0;
		while($r=$empire->fetch($sql))
		{
			if($r[tranimg])//删除预览图
			{
				DelFiletext("../data/soft_img/".$r[tranimg]);
			}
			if($r['checked']&&!$r['titleurl'])//删除文件
			{
				DelFiletext("../data/".$public_r['resoftpath']."/".$r['filename'].$public_r['refiletype']);
			}
			$i++;
		}
		ToDelSoftFile($classid,0);//删除附件
		DelListFile($classid,$c_r[lencord],$i);
		$sql1=$empire->query("delete from {$dbtbpre}down where classid='$classid'");
		//修改父分类的子类
		$where=ReturnClass($c_r[featherclass]);
		$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
		while($or=$empire->fetch($osql))
		{
			$newsonclass=str_replace("|".$classid."|","|",$or[sonclass]);
			$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
	    }
    }
	else//删除大分类
	{
		$del=$empire->query("delete from {$dbtbpre}downclass where classid='$classid'");
		//删除软件
		$where=ReturnClass($c_r[sonclass]);
		$wheres=$where;
		$osql=$empire->query("select softid,tranimg,checked,filename,titleurl from {$dbtbpre}down where ".$where);
		while($r=$empire->fetch($osql))
		{
			if($r[tranimg])//删除预览图
			{
				DelFiletext("../data/soft_img/".$r[tranimg]);
			}
			if($r['checked']&&!$r['titleurl'])//删除文件
			{
				DelFiletext("../data/".$public_r['resoftpath']."/".$r['filename'].$public_r['refiletype']);
			}
	    }
		//删除分类文件
		$osql=$empire->query("select classid,islast,sonclass,lencord from {$dbtbpre}downclass where featherclass like '%|".$classid."|%'");
		while($or=$empire->fetch($osql))
		{
			//终极分类
			if($or[islast])
			{
				$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where classid='$or[classid]'");
				ToDelSoftFile($or[classid],0);//删除附件
			}
			else
			{
				$where=ReturnClass($or[sonclass]);
				$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where ".$where);
			}
			DelListFile($or[classid],$or[lencord],$num);
		}
		$delb=$empire->query("delete from {$dbtbpre}downclass where featherclass like '%|".$classid."|%'");
		//删除软件记录
		$dels=$empire->query("delete from {$dbtbpre}down where ".$wheres);
		//改变父分类的子类
		$where=ReturnClass($c_r[featherclass]);
		$osql=$empire->query("select sonclass,classid from {$dbtbpre}downclass where ".$where);
		while($or=$empire->fetch($osql))
		{
			$newsonclass=str_replace($c_r[sonclass],"|",$or[sonclass]);
			$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$newsonclass' where classid='$or[classid]'");
		}
    }
}

//修改类别顺序
function EditClassOrder($classid,$myorder,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"action");//验证权限
	for($i=0;$i<count($classid);$i++)
	{
		$sql=$empire->query("update {$dbtbpre}downclass set myorder='".intval($myorder[$i])."' where classid='".intval($classid[$i])."'");
	}
	GetPublic();
	GetSoftClass();
	DelListEdown();
	if($sql)
	{
		printerror("修改分类顺序成功","ListClass.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//终极分类与非终极分类之间的转换
function ChangeClassIslast($classid,$userid,$username){
	global $empire,$dbtbpre;
	//操作权限
	CheckLevel($userid,$username,$classid,"action");
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("请选择要转换的分类","history.go(-1)");
	}
	//取得本分类信息
	$r=$empire->fetch1("select * from {$dbtbpre}downclass where classid='$classid'");
	if(empty($r[classid]))
	{
		printerror("请选择要转换的分类","history.go(-1)");
	}
	//非终极分类
	if(!$r[islast])
	{
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}downclass where bclassid='$classid'");
		if($num)
		{
			printerror("转换的分类下面不能有子分类","history.go(-1)");
		}
		//修改父分类的子分类
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
		$mess="转换为终极分类成功";
	}
	//终极分类
	else
	{
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}down where classid='$classid'");
		if($num)
		{
			printerror("此分类下有数据，不能转换","history.go(-1)");
		}
		//修改父分类的子分类
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
		$mess="转换为非终极分类成功";
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
		printerror("数据库出错","history.go(-1)");
	}
}

//更新分类关系
function ChangeSonclass($start,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"changedata");
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select classid from {$dbtbpre}downclass where islast=0 and classid>".$start." order by classid limit ".$public_r[relist_num]);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[classid];
		//子分类
		$sonclass="|";
		$ssql=$empire->query("select classid from {$dbtbpre}downclass where islast=1 and featherclass like '%|".$r[classid]."|%' order by classid");
		while($sr=$empire->fetch($ssql))
		{
			$sonclass.=$sr[classid]."|";
	    }
		$usql=$empire->query("update {$dbtbpre}downclass set sonclass='$sonclass' where classid='$r[classid]'");
    }
	//完毕
	if(empty($b))
	{
		GetClass();
		printerror("更新分类关系完毕","ChangeData.php");
	}
	echo "一组分类更新完毕,正进入下一组......(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='classphome.php?phome=ChangeSonclass&start=$newstart';</script>";
	exit();
}
?>