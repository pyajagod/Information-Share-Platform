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
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=25;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
$query="select varid,myvar,varvalue,varname,isclose from {$dbtbpre}downtempvar";
$totalquery="select count(*) as total from {$dbtbpre}downtempvar";
$num=$empire->gettotal($totalquery);//ȡ��������
$query=$query." order by varid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>����ģ�����</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">λ��: 
      <a href="ListTempvar.php">����ģ�����</a></td>
    <td><div align="right"> 
        <input type="button" name="Submit5" value="����ģ�����" onclick="self.location.href='AddTempvar.php?phome=AddTempvar';">
      </div></td>
  </tr>
</table>
  
<br>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="6%" height="25"> <div align="center">ID</div></td>
    <td width="33%" height="25"> <div align="center">ģ�������</div></td>
    <td width="28%" height="25"> <div align="center">������ʶ</div></td>
    <td width="15%"><div align="center">����</div></td>
    <td width="18%" height="25"> <div align="center">����</div></td>
  </tr>
  <?
  while($r=$empire->fetch($sql))
  {
  //����
  if($r[isclose])
  {
  $isclose="<font color=red>�ر�</font>";
  }
  else
  {
  $isclose="����";
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="center"> 
        <?=$r[varid]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <input name=text1 type=text value="[!--temp.<?=$r[myvar]?>--]" size="32">
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[varname]?>
      </div></td>
    <td><div align="center"><?=$isclose?></div></td>
    <td height="25"> <div align="center">[<a href="AddTempvar.php?phome=EditTempvar&varid=<?=$r[varid]?>">�޸�</a>]&nbsp;[<a href="tempphome.php?phome=DelTempvar&varid=<?=$r[varid]?>" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��</a>]</div></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="5">&nbsp;&nbsp;&nbsp; 
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
