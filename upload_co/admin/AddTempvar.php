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
CheckLevel($myuserid,$myusername,$classid,"template");
$phome=$_GET['phome'];
$r[myorder]=0;
$url="<a href=ListTempvar.php>管理模板变量</a>&nbsp;>&nbsp;增加模板变量";
//修改
if($phome=="EditTempvar")
{
	$varid=(int)$_GET['varid'];
	$r=$empire->fetch1("select myvar,varname,varvalue,isclose,myorder from {$dbtbpre}downtempvar where varid='$varid'");
	$r[varvalue]=htmlspecialchars(stripSlashes($r[varvalue]));
	$url="<a href=ListTempvar.php>管理模板变量</a>&nbsp;>&nbsp;修改模板变量：".$r[myvar];
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>增加模板变量</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">增加模板变量 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> <input name="varid" type="hidden" value="<?=$varid?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">变量名(*)</td>
      <td width="81%" height="25">[!--temp. 
        <input name="myvar" type="text" value="<?=$r[myvar]?>" size="16">
        --] <font color="#666666">(如：edown，变量就是[!--temp.edown--])</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">变量标识(*)</td>
      <td height="25"><input name="varname" type="text" value="<?=$r[varname]?>">
        <font color="#666666">(如：帝国下载)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">是否开启变量</td>
      <td height="25"><input type="radio" name="isclose" value="0"<?=$r[isclose]==0?' checked':''?>>
        是 
        <input type="radio" name="isclose" value="1"<?=$r[isclose]==1?' checked':''?>>
        否<font color="#666666">（开启才会在模板中生效）</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">变量排序</td>
      <td height="25"><input name="myorder" type="text" value="<?=$r[myorder]?>" size="6"> 
        <font color="#666666">(值越大等级越高，可以嵌入更低等级的变量)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>变量值</strong>(*)</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <textarea name="varvalue" cols="90" rows="27" wrap="OFF" style="WIDTH: 100%"><?=$r[varvalue]?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> &nbsp; <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
