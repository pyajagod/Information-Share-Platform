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
//验证权限
CheckLevel($myuserid,$myusername,$classid,"file");
//基目录
$basepath="../".ToReturnFileSavePath();
$filepath=$_GET['filepath'];
if(strstr($filepath,".."))
{
	$filepath="";
}
$openpath=$basepath."/".$filepath;
$hand=@opendir($openpath);
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理附件</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="34%">位置：<a href="ListFilePath.php">管理附件(目录式)</a></td>
    <td width="66%"><div align="right">
        <input type="button" name="Submit5" value="数据库式管理附件" onclick="self.location.href='ListFile.php';">
      </div></td>
  </tr>
</table>
<form name="form1" method="post" action="filephome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr class="header"> 
      <td height="25"> 
        <div align="center">选择</div></td>
      <td height="25">文件名 
        <input name="phome" type="hidden" value="DelPathFile">
        (当前目录：<strong>/ 
        <?=$filepath?>
        </strong>) &nbsp;&nbsp;&nbsp;[<a href="#edown" onclick="javascript:history.go(-1);">返回</a>]</td>
    </tr>
	<?php
	while($file=@readdir($hand))
	{
		if(empty($filepath))
		{
			$truefile=$file;
		}
		else
		{
			$truefile=$filepath."/".$file;
		}
		if($file=="."||$file=="..")
		{
			continue;
		}
		//目录
		if(is_dir($openpath."/".$file))
		{
			$filelink="'ListFilePath.php?filepath=".$truefile."'";
			$filename=$file;
			$img="folder.gif";
			$checkbox="";
			$target="";
		}
		//文件
		else
		{
			$filelink="'".$basepath."/".$truefile."'";
			$filename=$file;
			$filetype=GetFiletype($file);
			$img=substr($filetype,1,strlen($filetype))."_icon.gif";
			if(!file_exists('../data/images/dir/'.$img))
			{
				$img='unknown_icon.gif';
			}
			$checkbox="<input name='filename[]' type='checkbox' value='".$truefile."'>";
			$target=" target='_blank'";
		}
	 ?>
	 <tr> 
      <td width="9%" height="25"> <div align="center"> 
          <?=$checkbox?>
        </div></td>
      <td width="91%" height="25"><img src="../data/images/dir/<?=$img?>" width="23" height="22" align="absmiddle"><a href=<?=$filelink?><?=$target?>><?=$filename?></a></td>
    </tr>
	<?
	}
	@closedir($hand);
	?>
    <tr> 
      <td height="25"><div align="center"><input type="checkbox" name="chkall" value="on" onclick="CheckAll(this.form)"></div></td>
      <td height="25"><input type="submit" name="Submit" value="删除文件"></td>
    </tr>
  </table>
</form>
</body>
</html>