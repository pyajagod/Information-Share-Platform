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
CheckLevel($myuserid,$myusername,$classid,"member");
$phome=$_GET['phome'];
$r[favanum]=50;
$url="<a href=ListMemberGroup.php>管理会员组</a>&nbsp;>&nbsp;增加会员组";
if($phome=="EditMemberGroup")
{
	$groupid=(int)$_GET['groupid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downmembergroup where groupid='$groupid'");
	$url="<a href=ListMemberGroup.php>管理会员组</a>&nbsp;>&nbsp;修改会员组：".$r[groupname];
	if($r[checked])
	{$checked=" checked";}
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>增加会员组</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="memberphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">增加会员组 <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
        <input name="add[groupid]" type="hidden" id="add[groupid]" value="<?=$groupid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="30%" height="25">会员组名称：</td>
      <td width="70%" height="25"> <input name="add[groupname]" type="text" id="add[groupname]" value="<?=$r[groupname]?>">
        (比如：VIP会员,普通会员)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">会员组级别值：</td>
      <td height="25"> <input name="add[level]" type="text" id="add[level]" value="<?=$r[level]?>" size="6">
        (如：1,2...等，级别值越高，下载的权限越大)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">收藏夹最大数：</td>
      <td height="25"><input name="add[favanum]" type="text" id="add[favanum]" value="<?=$r[favanum]?>" size="6">
        条</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">每天最大下载数：</td>
      <td height="25"><input name="add[daydown]" type="text" id="add[daydown]" value="<?=$r[daydown]?>" size="6">
        次(0为不限制)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
