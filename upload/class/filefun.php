<?php
//删除文件
function DelFile($fileid,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$fileid=(int)$fileid;
	if(!$fileid)
	{
		printerror("请输入要删除的文件","history.go(-1)");
	}
	//验证权限
	CheckLevel($userid,$username,$classid,"file");
	$r=$empire->fetch1("select filename,path from {$dbtbpre}downfile where fileid='$fileid'");
	DelPathFile($r);
	$sql=$empire->query("delete from {$dbtbpre}downfile where fileid='$fileid'");
	if($sql)
	{
		printerror("删除文件成功","ListFile.php");
	}
	else
	{
		printerror("数据库出错","history.go(-1)");
	}
}

//批量删除文件
function DelFile_all($fileid,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	//验证权限
	CheckLevel($userid,$username,$classid,"file");
	$count=count($fileid);
	if(!$count)
	{
		printerror("请选择要删除的文件","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$fileid[$i]=intval($fileid[$i]);
		$r=$empire->fetch1("select filename,path from {$dbtbpre}downfile where fileid='$fileid[$i]' limit 1");
		$empire->query("delete from {$dbtbpre}downfile where fileid='$fileid[$i]'");
		DelPathFile($r);
	}
	printerror("删除文件成功","ListFile.php");
}

//删除目录文件
function DelPFile($filename,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	//操作权限
	CheckLevel($userid,$username,$classid,"file");
	$count=count($filename);
	if(empty($count))
	{
		printerror("请选择要删除的文件","history.go(-1)");
	}
	//基目录
	$basepath="../data/".$public_r['downpath'];
	for($i=0;$i<$count;$i++)
	{
		if(strstr($filename[$i],".."))
		{
			continue;
	    }
		DelFiletext($basepath."/".$filename[$i]);
		$dfile=ReturnPathFile($filename[$i]);
		$empire->query("delete from {$dbtbpre}downfile where filename='$dfile'");
    }
	printerror("删除文件成功",$_SERVER['HTTP_REFERER']);
}

//删除多余附件
function DelFreeFile($userid,$username){
	global $empire,$dbtbpre;
	//操作权限
	CheckLevel($userid,$username,$classid,"file");
	$sql=$empire->query("select filename,path from {$dbtbpre}downfile where cjid<>0 and (softid=0 or cjid=softid)");
	while($r=$empire->fetch($sql))
	{
       DelPathFile($r);
    }
	$empire->query("delete from {$dbtbpre}downfile where cjid<>0 and (softid=0 or cjid=softid)");
	printerror("删除多余附件完毕",$_SERVER['HTTP_REFERER']);
}

//上传文件
function AddTran($add,$file,$file_name,$file_size,$file_type,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$fileno=$add['fileno'];
	$classid=(int)$add['classid'];
	$filepass=(int)$add['filepass'];
	if(!$file_name)
	{
		printerror("请选择要上传的文件","history.go(-1)",9);
	}
	if(empty($fileno))
	{
		$fileno=$file_name;
	}
	$filer=GoTranFile($file,$file_name,$file_size,$file_type,0,0,0);
	$filetime=date("Y-m-d H:i:s");
	$sql=$empire->query("insert into {$dbtbpre}downfile(filename,filesize,adduser,filetime,fileno,classid,path,softid,cjid) values('$filer[filename]','$filer[filesize]','$username','$filetime','$fileno','$classid','$filer[filepath]','$filepass','$filepass');");
	if($sql)
	{
		?>
		<script>
		alert('上传成功');
		opener.doSpChangeFile('<?=$filer[filename]?>','<?=$filer[fileurl]?>','<?=ChTheFilesize($filer[filesize])?>','<?=$filer[filetype]?>','<?=$add[field]?>');
		window.close();
		</script>
		<?
		exit();
	}
	else
	{
		?>
		<script>
		alert('系统出错,上传不成功');
		window.close();
		</script>
		<?
		exit();
	}
}
?>