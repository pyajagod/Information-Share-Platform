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
CheckLevel($myuserid,$myusername,$classid,"user");
$sql=$empire->query("select * from {$dbtbpre}downuser order by userid desc");
$url="<a href=ListUser.php>�����û�</a>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>�����û�</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã� 
      <?=$url?>
    </td>
    <td><div align="right">
        <input type="button" name="Submit" value="�����û�" onclick="self.location.href='AddUser.php?phome=AddUser';">
      </div></td>
  </tr>
</table>
<form name="form1" method="post" action="adminphome.php">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="7%" height="25"><div align="center">ID</div></td>
      <td width="27%" height="25"><div align="center">�û���</div></td>
      <td width="23%" height="25"><div align="center">�û���</div></td>
      <td width="9%"><div align="center">��½����</div></td>
      <td width="20%"><div align="center">����½</div></td>
      <td width="14%" height="25"><div align="center">����</div></td>
    </tr>
    <?
	while($r=$empire->fetch($sql))
	{
		$gr=$empire->fetch1("select groupname from {$dbtbpre}downgroup where groupid='$r[groupid]'");
		$lasttime='---';
  		if($r[lasttime])
  		{
  			$lasttime=date("Y-m-d H:i:s",$r[lasttime]);
  		}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center"> 
          <?=$r[userid]?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[username]?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$gr[groupname]?>
        </div></td>
      <td><div align="center"><?=$r[loginnum]?></div></td>
      <td><div align="center"><a title="����½IP��<?=$r[lastip]?>"><?=$lasttime?></a></div></td>
      <td height="25"><div align="center">[<a href="AddUser.php?phome=EditUser&userid=<?=$r[userid]?>">�޸�</a>] 
          [<a href="adminphome.php?phome=DelUser&userid=<?=$r[userid]?>" onclick="return confirm('���Ƿ�Ҫɾ����');">ɾ��</a>]</div></td>
    </tr>
    <?
  }
  ?>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>
