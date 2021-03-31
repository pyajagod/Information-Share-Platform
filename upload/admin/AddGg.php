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
CheckLevel($myuserid,$myusername,$classid,"gg");
$phome=$_GET['phome'];
$r[ggtime]=date("Y-m-d H:i:s");
$url="<a href=ListGg.php>管理公告</a>&nbsp;>&nbsp;增加公告";
//修改公告
if($phome=="EditGg")
{
	$url="<a href=ListGg.php>管理公告</a>&nbsp;>&nbsp;修改公告";
	$ggid=(int)$_GET['ggid'];
	$r=$empire->fetch1("select title,ggtext,ggtime from {$dbtbpre}downgg where ggid='$ggid'");
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>公告</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="comphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">增加公告 
        <input name="ggid" type="hidden" id="ggid" value="<?=$ggid?>"> 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25"><strong>标题:</strong></td>
      <td width="77%" height="25"><input name="title" type="text" id="title" value="<?=$r[title]?>" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>发布时间:</strong></td>
      <td height="25"><input name="ggtime" type="text" id="ggtime" value="<?=$r[ggtime]?>" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><strong>内容:</strong><br> <br>
        EBB代码说明：<br>
        链接：[url]链接地址[/url]<br>
        图片：[img]图片地址[/img]<br>
        FLASH：[flash]flash地址[/flash]<br>
        文字加粗：[b]文字[/b]</td>
      <td height="25"><textarea name="ggtext" cols="60" rows="15" id="ggtext" style="WIDTH:100%"><?=htmlspecialchars($r[ggtext])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
