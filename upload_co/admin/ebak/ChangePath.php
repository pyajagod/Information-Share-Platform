<?php
require("../../class/connect.php");
include("../../data/cache/public.php");
include("../../class/db_sql.php");
include("../../class/functions.php");
include("class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"dbdata");
$bakpath=$public_r['bakdbpath'];
$hand=@opendir($bakpath);
$form='ebakredata';
if($_GET['toform'])
{
	$form=$_GET['toform'];
}
$onclickword='(���ת��ָ�����)';
$change=(int)$_GET['change'];
if($change==1)
{
	$onclickword='(���ѡ��)';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>������Ŀ¼</title>
<link href="../../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ChangePath(pathname)
{
opener.document.<?=$form?>.mypath.value=pathname;
window.close();
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã�<a href="ChangePath.php">������Ŀ¼</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="45%" height="25"> 
      <div align="center">����Ŀ¼��<?=$onclickword?></div></td>
    <td width="20%" height="25"> 
      <div align="center">�鿴˵���ļ�</div></td>
    <td width="35%"> 
      <div align="center">����</div></td>
  </tr>
  <?
  while($file=@readdir($hand))
  {
	if($file!="."&&$file!=".."&&is_dir($bakpath."/".$file))
	{
		if($change==1)
		{
			$showfile="<a href='#ebak' onclick=\"javascript:ChangePath('$file');\" title='$file'>$file</a>";
		}
		else
		{
			$showfile="<a href='phome.php?phome=PathGotoRedata&mypath=$file' title='$file'>$file</a>";
		}
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="left"><img src="images/dir.gif" width="19" height="15">&nbsp; 
        <?=$showfile?> </div></td>
    <td height="25"> <div align="center"> [<a href="<? echo $bakpath."/".$file."/readme.txt"?>" target=_blank>�鿴����˵��</a>]</div></td>
    <td><div align="center">[<a href="#ebak" onclick="window.open('phome.php?phome=DoZip&p=<?=$file?>&change=<?=$change?>','','width=350,height=160');">���������</a>]&nbsp;&nbsp;&nbsp;[<a href="phome.php?phome=DelBakpath&path=<?=$file?>&change=<?=$change?>" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��Ŀ¼</a>]</div></td>
  </tr>
  <?
     }
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="3">&nbsp;</td>
  </tr>
</table>
</body>
</html>