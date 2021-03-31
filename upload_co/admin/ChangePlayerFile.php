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
CheckLevel($myuserid,$myusername,$classid,"player");
//参数
$returnform=$_GET['returnform'];
//基目录
$openpath="../play";
$hand=@opendir($openpath);
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>选择文件</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="56%">位置：<a href="ChangePlayerFile.php">选择文件</a></td>
    <td width="44%"><div align="right"> </div></td>
  </tr>
</table>
<form name="chfile" method="post" action="phome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr class="header"> 
      <td height="25">文件名 (当前目录：<strong>/play/</strong>)</td>
    </tr>
    <?php
	while($file=@readdir($hand))
	{
		$truefile=$file;
		if($file=="."||$file=="..")
		{
			continue;
		}
		//目录
		if(is_dir($openpath."/".$file))
		{
			continue;
		}
		//文件
		else
		{
			$img="txt_icon.gif";
			$target="";
		}
	 ?>
    <tr> 
      <td width="88%" height="25"><a href="#down" onclick="<?=$returnform?>='<?=$truefile?>';window.close();" title="选择"> 
        <?=$truefile?>
        </a></td>
    </tr>
    <?
	}
	@closedir($hand);
	?>
  </table>
</form>
</body>
</html>