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
CheckLevel($myuserid,$myusername,$classid,"zt");
$sql=$empire->query("select ztid,ztname from {$dbtbpre}downzt order by ztid desc");
$url="<a href=ListZt.php>����ר��</a>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>����ר��</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã� 
      <?=$url?>
    </td>
    <td><div align="right">
        <input type="button" name="Submit" value="����ר��" onclick="self.location.href='AddZt.php?phome=AddZt';">
      </div></td>
  </tr>
</table>
<form name="form1" method="post" action="classphome.php">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="10%" height="25"><div align="center">ID</div></td>
      <td width="59%" height="25"><div align="center">ר����</div></td>
      <td width="31%" height="25"><div align="center">����</div></td>
    </tr>
    <?
	while($r=$empire->fetch($sql))
	{
		$zturl=EDReturnZtUrl($r[ztid]);
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center"> 
          <?=$r[ztid]?>
        </div></td>
      <td height="25"><div align="center"> 
          <a href="<?=$zturl?>" target="_blank"><?=$r[ztname]?></a>
        </div></td>
      <td height="25"><div align="center">[<a href="chtmlphome.php?phome=ReZtHtml&ztid=<?=$r[ztid]?>">����ҳ��</a>]&nbsp;&nbsp;[<a href="AddZt.php?phome=EditZt&ztid=<?=$r[ztid]?>">�޸�</a>]&nbsp;&nbsp;[<a href="classphome.php?phome=DelZt&ztid=<?=$r[ztid]?>" onclick="return confirm('���Ƿ�Ҫɾ����');">ɾ��</a>]</div></td>
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
