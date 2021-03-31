<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"zt");
$phome=$_GET['phome'];
$r[maxnum]=0;
$r[lencord]=20;
$url="<a href=ListZt.php>管理专题</a>&nbsp;>增加专题";
if($phome=="EditZt")
{
	$ztid=(int)$_GET['ztid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downzt where ztid='$ztid'");
	$url="<a href=ListZt.php>管理专题</a>&nbsp;>修改专题：".$r[ztname];
}
//列表模板
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
<title>增加专题</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="classphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">增加专题 <input name="ztid" type="hidden" id="ztid" value="<?=$ztid?>"> 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25">专题名称：</td>
      <td width="77%" height="25"><input name="ztname" type="text" id="ztname" value="<?=$r[ztname]?>" size="38">
        (*)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">显示总记录数：</td>
      <td height="25"><input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="38">
        条<font color="#666666">(0为不限)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">列表每页记录数：</td>
      <td height="25"><input name="lencord" type="text" id="lencord" value="<?=$r[lencord]?>" size="38">
        条</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">所属列表模板：</td>
      <td height="25"><select name="listtempid" id="listtempid">
          <?=$listtemp?>
        </select>
        (*)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">页面关键字：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ztkey" type="text" id="ztkey" value="<?=$r[ztkey]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">专题简介：</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="ztintro" rows="5" style="WIDTH:100%" id="ztintro"><?=$r[ztintro]?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>
