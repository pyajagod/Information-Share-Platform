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
CheckLevel($myuserid,$myusername,$classid,"template");
$url="<a href=ListListtemp.php>�����б�ģ��</a>";
$sql=$empire->query("select tempid,tempname,isdefault from {$dbtbpre}downlisttemp");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�����б�ģ��</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã�
      <?=$url?>
    </td>
    <td><div align="right">
        <input type="button" name="Submit" value="�����б�ģ��" onclick="self.location.href='AddListtemp.php?phome=AddListtemp';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="13%" height="25"><div align="center">ID</div></td>
    <td width="52%" height="25"><div align="center">ģ����</div></td>
    <td width="35%" height="25"><div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
	  if($r[isdefault])
	  {$bgcolor="#DBEAF5";}
	  else
	  {$bgcolor="#ffffff";}
  ?>
  <tr bgcolor="<?=$bgcolor?>"> 
    <td height="25"><div align="center"> 
        <?=$r[tempid]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[tempname]?>
      </div></td>
    <td height="25"><div align="center">[<a href="AddListtemp.php?phome=EditListtemp&tempid=<?=$r[tempid]?>">�޸�</a>] 
        [<a href="tempphome.php?phome=DelListtemp&tempid=<?=$r[tempid]?>" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��</a>]</div></td>
  </tr>
  <?
  }
  ?>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>
