<?php
//ɾ���ļ�
function DelFile($fileid,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$fileid=(int)$fileid;
	if(!$fileid)
	{
		printerror("������Ҫɾ�����ļ�","history.go(-1)");
	}
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"file");
	$r=$empire->fetch1("select filename,path from {$dbtbpre}downfile where fileid='$fileid'");
	DelPathFile($r);
	$sql=$empire->query("delete from {$dbtbpre}downfile where fileid='$fileid'");
	if($sql)
	{
		printerror("ɾ���ļ��ɹ�","ListFile.php");
	}
	else
	{
		printerror("���ݿ����","history.go(-1)");
	}
}

//����ɾ���ļ�
function DelFile_all($fileid,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	//��֤Ȩ��
	CheckLevel($userid,$username,$classid,"file");
	$count=count($fileid);
	if(!$count)
	{
		printerror("��ѡ��Ҫɾ�����ļ�","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$fileid[$i]=intval($fileid[$i]);
		$r=$empire->fetch1("select filename,path from {$dbtbpre}downfile where fileid='$fileid[$i]' limit 1");
		$empire->query("delete from {$dbtbpre}downfile where fileid='$fileid[$i]'");
		DelPathFile($r);
	}
	printerror("ɾ���ļ��ɹ�","ListFile.php");
}

//ɾ��Ŀ¼�ļ�
function DelPFile($filename,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	//����Ȩ��
	CheckLevel($userid,$username,$classid,"file");
	$count=count($filename);
	if(empty($count))
	{
		printerror("��ѡ��Ҫɾ�����ļ�","history.go(-1)");
	}
	//��Ŀ¼
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
	printerror("ɾ���ļ��ɹ�",$_SERVER['HTTP_REFERER']);
}

//ɾ�����฽��
function DelFreeFile($userid,$username){
	global $empire,$dbtbpre;
	//����Ȩ��
	CheckLevel($userid,$username,$classid,"file");
	$sql=$empire->query("select filename,path from {$dbtbpre}downfile where cjid<>0 and (softid=0 or cjid=softid)");
	while($r=$empire->fetch($sql))
	{
       DelPathFile($r);
    }
	$empire->query("delete from {$dbtbpre}downfile where cjid<>0 and (softid=0 or cjid=softid)");
	printerror("ɾ�����฽�����",$_SERVER['HTTP_REFERER']);
}

//�ϴ��ļ�
function AddTran($add,$file,$file_name,$file_size,$file_type,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$fileno=$add['fileno'];
	$classid=(int)$add['classid'];
	$filepass=(int)$add['filepass'];
	if(!$file_name)
	{
		printerror("��ѡ��Ҫ�ϴ����ļ�","history.go(-1)",9);
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
		alert('�ϴ��ɹ�');
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
		alert('ϵͳ����,�ϴ����ɹ�');
		window.close();
		</script>
		<?
		exit();
	}
}
?>