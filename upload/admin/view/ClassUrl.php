<?php
include("../../class/connect.php");
include("../../data/cache/class.php");
include("../../data/cache/public.php");
$jspath=$public_r['sitedown']."data/js/";
$classid=$_GET['classid'];
if($phome=='zt')
{
	//�����ַ
	$classurl=EDReturnZtUrl($classid);
	$newjs=$jspath."newzt".$classid.".js";
	$goodjs=$jspath."zttype".$classid.".js";
	$topjs=$jspath."zt".$classid.".js";
	$topmonthjs=$jspath."ztmonth".$classid.".js";
	$topweekjs=$jspath."ztweek".$classid.".js";
	$topdayjs=$jspath."ztday".$classid.".js";
}
elseif($phome=='softtype')//�������
{
	//�����ַ
	$classurl=EDReturnTypeUrl($classid);
	$newjs=$jspath."newtype".$classid.".js";
	$goodjs=$jspath."goodtype".$classid.".js";
	$topjs=$jspath."type".$classid.".js";
	$topmonthjs=$jspath."typemonth".$classid.".js";
	$topweekjs=$jspath."typeweek".$classid.".js";
	$topdayjs=$jspath."typeday".$classid.".js";
}
elseif($phome=='all')//�ܵ�
{
	//�����ַ
	$classurl=$public_r['sitedown'];
	$newjs=$jspath."new.js";
	$goodjs=$jspath."good.js";
	$topjs=$jspath."top.js";
	$topmonthjs=$jspath."topmonth.js";
	$topweekjs=$jspath."topweek.js";
	$topdayjs=$jspath."topday.js";
}
else
{
	//�����ַ
	$classurl=EDReturnClassUrl($classid);
	$newjs=$jspath."new".$classid.".js";
	$goodjs=$jspath."good".$classid.".js";
	$topjs=$jspath.$classid.".js";
	$topmonthjs=$jspath."month".$classid.".js";
	$topweekjs=$jspath."week".$classid.".js";
	$topdayjs=$jspath."day".$classid.".js";
}
?>
<link href="../../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>���õ�ַ</title>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25">&nbsp;</td>
    <td height="25"><font color="#FFFFFF">���õ�ַ</font></td>
    <td height="25"> <div align="center"><font color="#FFFFFF">Ԥ��</font></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td width="22%" height="25">ҳ���ַ:</td>
    <td width="71%" height="25"> <input name="textfield" type="text" value="<?=$classurl?>" size="35"></td>
    <td width="7%" height="25"> <div align="center"><a href="<?=$classurl?>" target="_blank">Ԥ��</a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">����JS:</td>
    <td height="25"> <input name="textfield2" type="text" value="<?=$newjs?>" size="35"></td>
    <td height="25"> <div align="center"><a href="js.php?classid=<?=$classid?>&js=<? echo urlencode($newjs);?>" target="_blank">Ԥ��</a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�Ƽ�JS:</td>
    <td height="25"> <input name="textfield3" type="text" value="<?=$goodjs?>" size="35"></td>
    <td height="25"> <div align="center"><a href="js.php?classid=<?=$classid?>&js=<? echo urlencode($goodjs);?>" target="_blank">Ԥ��</a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">������JS:</td>
    <td height="25"><input name="textfield32" type="text" value="<?=$topjs?>" size="35"></td>
    <td height="25"><div align="center"><a href="js.php?classid=<?=$classid?>&js=<? echo urlencode($topjs);?>" target="_blank">Ԥ��</a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">������JS:</td>
    <td height="25"><input name="textfield33" type="text" value="<?=$topmonthjs?>" size="35"></td>
    <td height="25"><div align="center"><a href="js.php?classid=<?=$classid?>&js=<? echo urlencode($topmonthjs);?>" target="_blank">Ԥ��</a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">������JS:</td>
    <td height="25"><input name="textfield34" type="text" value="<?=$topweekjs?>" size="35"></td>
    <td height="25"><div align="center"><a href="js.php?classid=<?=$classid?>&js=<? echo urlencode($topweekjs);?>" target="_blank">Ԥ��</a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">������JS:</td>
    <td height="25"><input name="textfield35" type="text" value="<?=$topdayjs?>" size="35"></td>
    <td height="25"><div align="center"><a href="js.php?classid=<?=$classid?>&js=<? echo urlencode($topdayjs);?>" target="_blank">Ԥ��</a></div></td>
  </tr>
</table>
