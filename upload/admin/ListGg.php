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
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=10;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
$query="select ggid,title,ggtime from {$dbtbpre}downgg";
$num=$empire->num($query);//ȡ��������
$query=$query." order by ggid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>������</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã�������</td>
    <td> <div align="right">
        <input type="button" name="Submit" value="���ӹ���" onclick="self.location.href='AddGg.php?phome=AddGg';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"> <div align="center">ID</div></td>
    <td width="45%" height="25"> <div align="center">����</div></td>
    <td width="30%" height="25"> <div align="center">ʱ��</div></td>
    <td width="20%" height="25"> <div align="center">����</div></td>
  </tr>
  <?
  $ggurl=EDReturnGgUrl();
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <?=$r[ggid]?>
      </div></td>
    <td height="25"><a href="<?=$ggurl?>#gg<?=$r[ggid]?>" target="_blank"> 
        <?=$r[title]?>
        </a></td>
    <td height="25"> <div align="center"> 
        <?=$r[ggtime]?>
      </div></td>
    <td height="25"> <div align="center">[<a href="AddGg.php?phome=EditGg&ggid=<?=$r[ggid]?>">�޸�</a>] 
        [<a href="comphome.php?phome=DelGg&ggid=<?=$r[ggid]?>" onclick="return confirm('ȷ��Ҫɾ��?');">ɾ��</a>]</div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="4"> 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
<?
db_close();
$empire=null;
?>
