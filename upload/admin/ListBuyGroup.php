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
CheckLevel($myuserid,$myusername,$classid,"buygroup");

$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=25;
$page_line=25;
$offset=$start+$line*$page;
$totalquery="select count(*) as total from {$dbtbpre}downbuygroup";
$num=$empire->gettotal($totalquery);
$query="select id,gname,gmoney,gfen,gdate from {$dbtbpre}downbuygroup";
$query.=" order by myorder,id limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�����ֵ����</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">λ�ã�<a href="ListBuyGroup.php">�����ֵ����</a></td>
    <td><div align="right">
        <input type="button" name="Submit5" value="���ӳ�ֵ����" onclick="self.location.href='AddBuyGroup.php?phome=AddBuyGroup';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="6%" height="25"> <div align="center">ID</div></td>
    <td width="41%" height="25"> <div align="center">��������</div></td>
    <td width="15%" height="25"> <div align="center">���(Ԫ)</div></td>
    <td width="11%" height="25"> <div align="center">����</div></td>
    <td width="11%"><div align="center">��Ч��(��)</div></td>
    <td width="16%" height="25"> <div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <?=$r[id]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[gname]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[gmoney]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[gfen]?>
      </div></td>
    <td><div align="center"><?=$r[gdate]?></div></td>
    <td height="25"> <div align="center">[<a href="AddBuyGroup.php?phome=EditBuyGroup&id=<?=$r[id]?>">�޸�</a>]��[<a href="memberphome.php?phome=DelBuyGroup&id=<?=$r[id]?>" onclick="return confirm('ȷ��Ҫɾ��?');">ɾ��</a>]</div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6"> &nbsp;&nbsp; 
      <?=$returnpage?>
      <div align="left"></div></td>
  </tr>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>