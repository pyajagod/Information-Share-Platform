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
CheckLevel($myuserid,$myusername,$classid,"player");
//����
$returnform=$_GET['returnform'];
//��Ŀ¼
$openpath="../play";
$hand=@opendir($openpath);
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>ѡ���ļ�</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="56%">λ�ã�<a href="ChangePlayerFile.php">ѡ���ļ�</a></td>
    <td width="44%"><div align="right"> </div></td>
  </tr>
</table>
<form name="chfile" method="post" action="phome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr class="header"> 
      <td height="25">�ļ��� (��ǰĿ¼��<strong>/play/</strong>)</td>
    </tr>
    <?php
	while($file=@readdir($hand))
	{
		$truefile=$file;
		if($file=="."||$file=="..")
		{
			continue;
		}
		//Ŀ¼
		if(is_dir($openpath."/".$file))
		{
			continue;
		}
		//�ļ�
		else
		{
			$img="txt_icon.gif";
			$target="";
		}
	 ?>
    <tr> 
      <td width="88%" height="25"><a href="#down" onclick="<?=$returnform?>='<?=$truefile?>';window.close();" title="ѡ��"> 
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