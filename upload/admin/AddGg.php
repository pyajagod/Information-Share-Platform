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
CheckLevel($myuserid,$myusername,$classid,"gg");
$phome=$_GET['phome'];
$r[ggtime]=date("Y-m-d H:i:s");
$url="<a href=ListGg.php>������</a>&nbsp;>&nbsp;���ӹ���";
//�޸Ĺ���
if($phome=="EditGg")
{
	$url="<a href=ListGg.php>������</a>&nbsp;>&nbsp;�޸Ĺ���";
	$ggid=(int)$_GET['ggid'];
	$r=$empire->fetch1("select title,ggtext,ggtime from {$dbtbpre}downgg where ggid='$ggid'");
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>����</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="comphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">���ӹ��� 
        <input name="ggid" type="hidden" id="ggid" value="<?=$ggid?>"> 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25"><strong>����:</strong></td>
      <td width="77%" height="25"><input name="title" type="text" id="title" value="<?=$r[title]?>" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>����ʱ��:</strong></td>
      <td height="25"><input name="ggtime" type="text" id="ggtime" value="<?=$r[ggtime]?>" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><strong>����:</strong><br> <br>
        EBB����˵����<br>
        ���ӣ�[url]���ӵ�ַ[/url]<br>
        ͼƬ��[img]ͼƬ��ַ[/img]<br>
        FLASH��[flash]flash��ַ[/flash]<br>
        ���ּӴ֣�[b]����[/b]</td>
      <td height="25"><textarea name="ggtext" cols="60" rows="15" id="ggtext" style="WIDTH:100%"><?=htmlspecialchars($r[ggtext])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�ύ"> <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
