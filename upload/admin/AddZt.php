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
$phome=$_GET['phome'];
$r[maxnum]=0;
$r[lencord]=20;
$url="<a href=ListZt.php>����ר��</a>&nbsp;>����ר��";
if($phome=="EditZt")
{
	$ztid=(int)$_GET['ztid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downzt where ztid='$ztid'");
	$url="<a href=ListZt.php>����ר��</a>&nbsp;>�޸�ר�⣺".$r[ztname];
}
//�б�ģ��
$listtemp="";
$ltsql=$empire->query("select tempid,tempname from {$dbtbpre}downlisttemp order by tempid");
while($ltr=$empire->fetch($ltsql))
{
	if($ltr[tempid]==$r[listtempid])
	{$select=" selected";}
	else
	{$select="";}
	$listtemp.="<option value=".$ltr[tempid].$select.">".$ltr[tempname]."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>����ר��</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="classphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">����ר�� <input name="ztid" type="hidden" id="ztid" value="<?=$ztid?>"> 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25">ר�����ƣ�</td>
      <td width="77%" height="25"><input name="ztname" type="text" id="ztname" value="<?=$r[ztname]?>" size="38">
        (*)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ʾ�ܼ�¼����</td>
      <td height="25"><input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="38">
        ��<font color="#666666">(0Ϊ����)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�б�ÿҳ��¼����</td>
      <td height="25"><input name="lencord" type="text" id="lencord" value="<?=$r[lencord]?>" size="38">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����б�ģ�壺</td>
      <td height="25"><select name="listtempid" id="listtempid">
          <?=$listtemp?>
        </select>
        (*)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ҳ��ؼ��֣�</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ztkey" type="text" id="ztkey" value="<?=$r[ztkey]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ר���飺</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="ztintro" rows="5" style="WIDTH:100%" id="ztintro"><?=$r[ztintro]?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�ύ"> <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>
