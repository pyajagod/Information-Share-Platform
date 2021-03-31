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
CheckLevel($myuserid,$myusername,$classid,"link");
$phome=$_GET['phome'];
$url="<a href=ListLink.php>管理友情链接</a>&nbsp;>&nbsp;增加友情链接";
$r[lurl]="http://";
$r[width]=88;
$r[height]=31;
$target0="";
$target1="";
$r[onclick]=0;
$r[myorder]=0;
$checked=" checked";
if($phome=="EditLink")
{
	$lid=(int)$_GET['lid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downlink where lid='$lid'");
	if($r[target]=="_parent")
	{$target1=" selected";}
	if(empty($r[checked]))
	{$checked="";}
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>友情链接</title>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListLink.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="26%" height="25"><strong><font color="#FFFFFF">增加友情链接</font></strong></td>
      <td width="74%" height="25"><input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
        <input name="lid" type="hidden" id="lid" value="<?=$lid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">站点名称:(*)</td>
      <td height="25"> <input name="lname" type="text" id="lname" value="<?=$r[lname]?>" size="42"> 
        <input name="checked" type="checkbox" id="checked" value="1"<?=$checked?>>
        显示</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">站点图标:</td>
      <td height="25"> <input name="lpic" type="text" id="lpic" value="<?=$r[lpic]?>" size="42"> 
        
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25">宽 
        <input name="width" type="text" id="width" value="<?=$r[width]?>" size="6">
        * 高 
        <input name="height" type="text" id="height" value="<?=$r[height]?>" size="6">
        (不选择图片为文字链接)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">站点地址:(*)</td>
      <td height="25"> <input name="lurl" type="text" id="lurl" value="<?=$r[lurl]?>" size="42"> 
        <select name=target>
          <option value="_blank"<?=$target0?>>在新窗口打开</option>
          <option value="_parent"<?=$target1?>>在原窗口打开</option>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">点击:</td>
      <td height="25"><input name="onclick" type="text" id="onclick" value="<?=$r[onclick]?>" size="6"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">显示顺序:</td>
      <td height="25"><input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>" size="6">
        (越小越前面)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">站长Email:</td>
      <td height="25"><input name="email" type="text" id="email" value="<?=$r[email]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">站点简介:</td>
      <td height="25"><textarea name="lsay" cols="60" rows="6" id="lsay"><?=htmlspecialchars($r[lsay])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
