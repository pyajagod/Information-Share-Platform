<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
$link=db_connect();
$empire=new mysqlquery();
$softid=(int)$_GET['softid'];
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$search='&softid='.$softid;
$line=10;
$page_line=12;
$offset=$start+$page*$line;
$s_r=$empire->fetch1("select softname,filename,titleurl,softid from {$dbtbpre}down where softid='$softid'");
if(empty($s_r['softid']))
{
	printerror('�����ز�����','history.go(-1)',1);
}
$totalquery="select count(*) as total from {$dbtbpre}downpl where softid='$softid'";
$num=$empire->gettotal($totalquery);
$query="select content,pltime,plip,plfen from {$dbtbpre}downpl where softid='$softid' order by plid desc";
$query.=" limit $offset,$line";
$sql=$empire->query($query);
$i=0;
$allfen=0;
while($r=$empire->fetch($sql))
{
	$i++;
	$showpl.="<table width='98%' border=0 align=center cellpadding=3 cellspacing=1 class='tableborder'>
    <tr>
      <td height=25><b>��</b>����<b>".ToReturnXhIp($r[plip])."</b>��<b>".$r[pltime]."</b>�����������ۣ�</td>
    </tr>
    <tr>
      <td height=25 bgcolor='#FFFFFF'>".$r[content]."</td>
    </tr>
</table><br>";
}
//����
$av_fen=0;
$sumpf=$empire->gettotal("select sum(plfen) as total from {$dbtbpre}downpl where softid='$softid'");
if($sumpf)
{
	$av_fen=ceil($sumpf/$num);
}
db_close();
$empire=null;
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�� <?=$s_r[softname]?> ���������</title>
<link href="../data/images/qcss.css" rel="stylesheet" type="text/css">
</head>

<body>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="../phome/index.php">
    <tr class="header"> 
      <td><b>.</b>��<b><?=$s_r[softname]?></b>�����ۣ�(�ۺϻ��֣�<b><?=$av_fen?></b>)</td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF"> ������֣� 
        <input type="radio" name="plfen" value="1">
        1 <input type="radio" name="plfen" value="2">
        2 <input name="plfen" type="radio" value="3" checked>
        3 
        <input type="radio" name="plfen" value="4">
        4 <input type="radio" name="plfen" value="5">
        5 
        <input name="phome" type="hidden" id="phome" value="AddPl">
<input name="softid" type="hidden" id="softid" value="<?=$softid?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF"> ������ۣ� 
        <input name="content" type="text" id="content" size="45"></td>
    </tr>
	<?php
	if($public_r['plkey'])
	{
	?>
	<tr bgcolor="#FFFFFF"> 
      <td height="25">��֤�룺<input name="key" type="text" id="key" size="6">
        <img src="../ShowKey?edown" align="absmiddle"></td>
    </tr>
	<?php
	}
	?>
    <tr>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="����"></td>
    </tr>
	</form>
  </table>
  <br>
<?=$showpl?>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td>&nbsp;<?=$returnpage?></td>
    </tr>
	</table>
</body>
</html>