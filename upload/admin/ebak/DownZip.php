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
$bakzippath=$public_r['bakdbzip'];
$p=$_GET['p'];
$f=$_GET['f'];
$file=$bakzippath."/".$f;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>����ѹ����</title>
<link href="../../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
  <tr> 
    <td height="30"> <div align="center"><strong><font color="#FFFFFF">����ѹ����(Ŀ¼�� 
        <?=$p?>
        )</font></strong></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF"> 
      <div align="center">[<a href="<?=$file?>">����ѹ����</a>]</div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF"> 
      <div align="center">[<a href="phome.php?f=<?=$f?>&phome=DelZip" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��ѹ����</a>]</div></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">
<div align="center">��<font color="#FF0000">˵������ȫ������������������ɾ��ѹ������</font>��</div></td>
  </tr>
</table>
</body>
</html>
