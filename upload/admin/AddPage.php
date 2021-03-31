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
CheckLevel($myuserid,$myusername,$classid,"userpage");
$phome=$_GET['phome'];
$url="<a href=ListPage.php>管理自定义页面</a>&nbsp;>&nbsp;增加自定义页面";
//复制
if($phome=="AddUserpage"&&$_GET['docopy'])
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}downuserpage where id='$id'");
	$url="<a href=ListPage.php>管理自定义页面</a>&nbsp;>&nbsp;复制自定义页面：<b>".$r[title]."</b>";
}
//修改
if($phome=="EditUserpage")
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}downuserpage where id='$id'");
	$url="<a href=ListPage.php>管理自定义页面</a>&nbsp;>&nbsp;修改自定义页面：<b>".$r[title]."</b>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>增加自定义页面</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ReturnHtml(html)
{
document.form1.pagetext.value=html;
}
</script>
<SCRIPT lanuage="JScript">
<!--
function tempturnit(ss)
{
 if (ss.style.display=="") 
  ss.style.display="none";
 else
  ss.style.display=""; 
}
-->
</SCRIPT>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="ListPage.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">增加自定义页面 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> <input name="id" type="hidden" id="id" value="<?=$id?>"> 
        <input name="oldfilename" type="hidden" value="<?=$r[filename]?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">页面名称(*)</td>
      <td width="81%" height="25"> <input name="title" type="text" id="title" value="<?=$r[title]?>" size="35"> 
        <font color="#666666">(如：联系我们)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">文件名(*)</td>
      <td height="25">/page/ 
        <input name="filename" type="text" id="filename" value="<?=$r[filename]?>" size="28"> 
        <font color="#666666">(如：contact.html)</font> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">网页标题</td>
      <td height="25"><input name="pagetitle" type="text" id="pagetitle" value="<?=htmlspecialchars(stripSlashes($r[pagetitle]))?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">网页关键词</td>
      <td height="25"><input name="pagekeywords" type="text" id="pagekeywords" value="<?=htmlspecialchars(stripSlashes($r[pagekeywords]))?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">网页描述</td>
      <td height="25"><input name="pagedescription" type="text" id="pagedescription" value="<?=htmlspecialchars(stripSlashes($r[pagedescription]))?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><strong>页面内容</strong>(*)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"><div align="center"> 
          <textarea name="pagetext" cols="90" rows="27" id="pagetext" wrap="OFF" style="WIDTH: 100%"><?=htmlspecialchars(stripSlashes($r[pagetext]))?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF" id="showtempvar" style="display:none"> 
      <td height="25" colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td height="24"> 网页标题： 
              <input name="textfield" type="text" value="[!--pagetitle--]"> </td>
            <td> 网页关键词： 
              <input name="textfield2" type="text" value="[!--pagekey--]"> </td>
            <td> 网页描述： 
              <input name="textfield3" type="text" value="[!--pagedes--]"> </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="24">站点地址： 
              <input name="textfield32" type="text" value="[!--edown.url--]"> 
            </td>
            <td>页面导航： 
              <input name="textfield15" type="text" value="[!--empiredown.url--]"></td>
            <td>分类列表： 
              <input name="textfield262" type="text" value="[!--class.menu--]"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="24">热门下载： 
              <input name="textfield20" type="text" value="[!--empiredown.topjs--]"></td>
            <td>最新下载： 
              <input name="textfield21" type="text" value="[!--empiredown.newjs--]"></td>
            <td>分类导航： 
              <input name="textfield19" type="text" value="[!--empiredown.class--]"></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="24"><strong>支持公共模板变量</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
