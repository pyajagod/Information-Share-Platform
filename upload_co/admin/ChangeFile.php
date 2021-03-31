<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
$classid=(int)$_GET['classid'];
$filepass=(int)$_GET['filepass'];
$softname=$_GET['softname'];
$field=$_GET['field'];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"soft");
//基目录
$startpath=ToReturnFileSavePath();
$basepath="../".$startpath;
$filepath=$_GET['filepath'];
if(strstr($filepath,".."))
{
	$filepath="";
}
$openpath=$basepath."/".$filepath;
$hand=@opendir($openpath);
db_close();
$empire=null;
$temp="<tr><td width='25%' bgcolor='ffffff'><!--list.var1--></td><td width='25%' bgcolor='ffffff'><!--list.var2--></td><td width='25%' bgcolor='ffffff'><!--list.var3--></td><td width='25%' bgcolor='ffffff'><!--list.var4--></td></tr>";
$header='<table width="100%" border="0" cellpadding="3" cellspacing="1" align="center">';
$footer="</table>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>选择附件</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function DoCF(filename,fileurl,filesize,filetype){
	opener.doSpChangeFile(filename,fileurl,filesize,filetype,'<?=$field?>');
	window.close();
}
</script>
</head>

<body>
    <?php
	$ti=0;
	$tlistvar=$temp;
	while($file=@readdir($hand))
	{
		if($file=="."||$file=="..")
		{
			continue;
		}
		if(empty($filepath))
		{
			$truefile=$file;
		}
		else
		{
			$truefile=$filepath."/".$file;
		}
		//目录
		if(is_dir($openpath."/".$file))
		{
			$filelink="'ChangeFile.php?classid=$classid&filepass=$filepass&field=$field&filepath=".$truefile."&softname=$softname'";
			$filename=$file;
			$img="folder.gif";
			$checkbox="";
			$target="";
		}
		//文件
		else
		{
			$filename=$file;
			$filetype=GetFiletype($file);
			$img=substr($filetype,1,strlen($filetype))."_icon.gif";
			if(!file_exists('../data/images/dir/'.$img))
			{
				$img='unknown_icon.gif';
			}
			$fileurl=$public_r['sitedown'].$startpath.'/'.$truefile;
			$filesize=@filesize($openpath.'/'.$filename);
			$fmfilesize=ChTheFilesize($filesize);
			$filelink="'#edown' title='文件大小: ".$fmfilesize."' onclick=\"DoCF('$filename','$fileurl','$fmfilesize','$filetype');\"";
			$checkbox="<input name='filename[]' type='checkbox' value='".$truefile."'>";
			$target="";
		}
		$ti++;
		$var="<img src='../data/images/dir/$img' width='23' height='22' align='absmiddle'><a href=$filelink".$target.">$filename</a>";
		$tlistvar=str_replace("<!--list.var".$ti."-->",$var,$tlistvar);
		if($ti>=4)
		{
			$templist.=$tlistvar;
			$tlistvar=$temp;
			$ti=0;
		}
	 ?>
    <?
	}
	@closedir($hand);
	//模板
	if($ti!=0&&$ti<4)
	{
		$templist.=$tlistvar;
	}
	$templist=str_replace('[!--tbid--]','1',$header).$templist.$footer;
	?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25">文件名 
        <input name="phome" type="hidden" value="DelPathFile">
      (当前目录：<strong>/ 
      <?=$filepath?>
      </strong>) &nbsp;&nbsp;&nbsp;[<a href="#edown" onclick="javascript:history.go(-1);">上一级目录</a>]　 
      [<a href="ChangeFile.php?classid=<?=$classid?>&filepass=<?=$filepass?>">根目录</a>] 
    </td>
    </tr>
	<tr>
    <td bgcolor="#FFFFFF"> 
      <?=$templist?>
    </td>
  </tr>
</table>
</body>
</html>