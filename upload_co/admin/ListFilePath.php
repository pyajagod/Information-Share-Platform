<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"file");
//��Ŀ¼
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
<title>������</title>
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
    <td width="34%">λ�ã�<a href="ListFilePath.php">������(Ŀ¼ʽ)</a></td>
    <td width="66%"><div align="right">
        <input type="button" name="Submit5" value="���ݿ�ʽ������" onclick="self.location.href='ListFile.php';">
      </div></td>
  </tr>
</table>
<form name="form1" method="post" action="filephome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr class="header"> 
      <td height="25"> 
        <div align="center">ѡ��</div></td>
      <td height="25">�ļ��� 
        <input name="phome" type="hidden" value="DelPathFile">
        (��ǰĿ¼��<strong>/ 
        <?=$filepath?>
        </strong>) &nbsp;&nbsp;&nbsp;[<a href="#edown" onclick="javascript:history.go(-1);">����</a>]</td>
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
		//Ŀ¼
		if(is_dir($openpath."/".$file))
		{
			$filelink="'ListFilePath.php?filepath=".$truefile."'";
			$filename=$file;
			$img="folder.gif";
			$checkbox="";
			$target="";
		}
		//�ļ�
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
      <td height="25"><input type="submit" name="Submit" value="ɾ���ļ�"></td>
    </tr>
  </table>
</form>
</body>
</html>