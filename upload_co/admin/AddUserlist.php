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
CheckLevel($myuserid,$myusername,$classid,"userlist");
$phome=$_GET['phome'];
$url="<a href=ListUserlist.php>管理自定义列表</a> &gt; 增加自定义列表";
$r[totalsql]="select count(*) as total from [!db.pre!]down where checked=1";
$r[listsql]="select * from [!db.pre!]down where checked=1 order by softtime desc";
$r[maxnum]=0;
$r[lencord]=25;
//复制
if($phome=="AddUserlist"&&$_GET['docopy'])
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}downuserlist where id='$id'");
	$url="<a href=ListUserlist.php>管理自定义列表</a> &gt; 复制自定义列表：<b>".$r[listname]."</b>";
}
//修改
if($phome=="EditUserlist")
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}downuserlist where id='$id'");
	$url="<a href=ListUserlist.php>管理自定义列表</a> -&gt; 修改自定义列表：<b>".$r[listname]."</b>";
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
db_close();
$empire=null;
//风格
$loginadminstyleid=(int)getcvar('loginadminstyleid');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<title>自定义列表</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListUserlist.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">增加自定义信息列表 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
        <input name="id" type="hidden" id="id" value="<?=$id?>">
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="18%" height="25">列表名称：(*)</td>
      <td width="82%" height="25"> <input name="listname" type="text" id="listname" value="<?=$r[listname]?>" size="38"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="4">查询SQL语句：(*)</td>
      <td height="25">统计记录: 
        <input name="totalsql" type="text" id="totalsql" value="<?=htmlspecialchars(stripSlashes($r[totalsql]))?>" size="72"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><font color="#666666">(如：select count(*) as total from e_down 
        where classid=1 and checked=1)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">查询记录: 
        <input name="listsql" type="text" id="listsql" value="<?=htmlspecialchars(stripSlashes($r[listsql]))?>" size="72"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><font color="#666666">(如：select * from e_down where classid=1 
        and checked=1 order by downid)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="26">查询总条数：</td>
      <td height="26"><input name="maxnum" type="text" id="lencord" value="<?=$r[maxnum]?>" size="6">
        条信息(0为不限制)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="26">每页显示：</td>
      <td height="26"> <input name="lencord" type="text" id="jsname3" value="<?=$r[lencord]?>" size="6">
        条信息</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">使用列表模板：(*)</td>
      <td height="25"><select name="listtempid" id="listtempid">
          <?=$listtemp?>
        </select> </td>
    </tr>
	<tr bgcolor="#FFFFFF"> 
      <td height="25">网页标题:</td>
      <td height="25"><input name="pagetitle" type="text" id="pagetitle" value="<?=$r[pagetitle]?>" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">页面关键字：</td>
      <td height="25"><input name="pagekey" type="text" id="pagekey" value="<?=$r[pagekey]?>" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">页面简介：</td>
      <td height="25"><textarea name="pagedes" rows="5" style="WIDTH:100%" id="pageintro"><?=$r[pagedes]?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25">表前缀可用“<strong>[!db.pre!]</strong>”表示</td>
    </tr>
  </table>
</form>
</body>
</html>
