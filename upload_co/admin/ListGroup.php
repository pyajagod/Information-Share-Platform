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
CheckLevel($myuserid,$myusername,$classid,"group");
$sql=$empire->query("select groupid,groupname from {$dbtbpre}downgroup order by groupid desc");
$url="λ�ã�<a href=ListGroup.php>�û������</a>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�û���</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>
      <?=$url?>
    </td>
    <td><div align="right">
        <input type="button" name="Submit" value="�����û���" onclick="self.location.href='AddGroup.php?phome=AddGroup';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="13%"><div align="center">ID</div></td>
    <td width="63%" height="25"><div align="center">�û�������</div></td>
    <td width="24%" height="25"><div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td><div align="center"> 
        <?=$r[groupid]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[groupname]?>
      </div></td>
    <td height="25"><div align="center"> [<a href="AddGroup.php?phome=EditGroup&groupid=<?=$r[groupid]?>">�޸�</a>] 
        [<a href="adminphome.php?phome=DelGroup&groupid=<?=$r[groupid]?>" onclick="return confirm('ȷ��Ҫɾ�����û��飿');">ɾ��</a>]</div></td>
  </tr>
  <?
  }
  db_close();
  $empire=null;
  ?>
</table>
</body>
</html>
