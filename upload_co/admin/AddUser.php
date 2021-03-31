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
CheckLevel($myuserid,$myusername,$classid,"user");
$phome=$_GET['phome'];
$url="<a href=ListUser.php>用户管理</a>&nbsp;>增加用户";
if($phome=="EditUser")
{
	$userid=(int)$_GET['userid'];
	$r=$empire->fetch1("select username,adminclass,groupid from {$dbtbpre}downuser where userid='$userid'");
	$url="<a href=ListUser.php>用户管理</a>&nbsp;>修改用户：".$r[username];
}
//-----------用户组
$sql=$empire->query("select groupid,groupname from {$dbtbpre}downgroup order by groupid desc");
while($gr=$empire->fetch($sql))
{
	if($r[groupid]==$gr[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$group.="<option value=".$gr[groupid].$select.">".$gr[groupname]."</option>";
}
//--------------------操作的栏目
$class=ShowClass_AddClass($r[adminclass],"n",0,"|-",3);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>增加用户</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="adminphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">增加用户 
        <input name="userid" type="hidden" id="userid" value="<?=$userid?>">
        <input name="oldusername" type="hidden" id="oldusername" value="<?=$r[username]?>">
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>">
        </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="28%" height="25">用户名：</td>
      <td width="72%" height="25"><input name="username" type="text" id="username" value="<?=$r[username]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">密码：</td>
      <td height="25"><input name="password" type="password" id="password">
        (不想修改请留空)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">重复密码：</td>
      <td height="25"><input name="repassword" type="password" id="repassword">
        (不想修改请留空)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">用户组：</td>
      <td height="25"><select name="groupid" id="groupid">
          <?=$group?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2" valign="top"> <p>管理分类：<br>
          <br>
          (多个，请用ctrl。) </p></td>
      <td height="25" valign="top"> <select name="adminclass[]" size="12" multiple id="adminclass[]" style="width:210;">
          <?=$class?>
        </select> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">注意事项：<font color="#FF0000">选择父分类会应用于子分类，并且如果选择父分类，请勿选择其子分类</font>)</td>
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
