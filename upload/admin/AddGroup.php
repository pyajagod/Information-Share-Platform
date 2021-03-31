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
CheckLevel($myuserid,$myusername,$classid,"group");
$url="位置：<a href=ListGroup.php>用户组管理</a>&nbsp;>&nbsp;增加用户组";
//默认值
$checked="";
$doall=$checked;
$dopublic=$checked;
$doclass=$checked;
$dotemplate=$checked;
$dofile=$checked;
$douser=$checked;
$dolog=$checked;
$domember=$checked;
$dogroup=$checked;
$dolanguage=$checked;
$dosofttype=$checked;
$dosq=$checked;
$dofj=$checked;
$doerror=$checked;
$dorepip=$checked;
$doad=$checked;
$dogg=$checked;
$dovote=$checked;
$dodbdata=$checked;
$dodownurl=$checked;
$dopl=$checked;
$dochangedata=$checked;
$dolink=$checked;

$phome=$_GET['phome'];
//修改用户组
if($phome=="EditGroup")
{
	$groupid=(int)$_GET['groupid'];
	$r=$empire->fetch1("select * from {$dbtbpre}downgroup where groupid='$groupid'");
	$url="位置：<a href=ListGroup.php>用户组管理</a>&nbsp;>&nbsp;修改用户组：".$r[groupname];
	if($r[doall])
	{
		$doall=" checked";
	}
	if($r[dopublic])
	{
		$dopublic=" checked";
	}
	if($r[doclass])
	{
		$doclass=" checked";
	}
	if($r[dotemplate])
	{
		$dotemplate=" checked";
	}
	if($r[dofile])
	{
		$dofile=" checked";
	}
	if($r[douser])
	{
		$douser=" checked";
	}
	if($r[dolog])
	{
		$dolog=" checked";
	}
	if($r[domember])
	{
		$domember=" checked";
	}
	if($r[dogroup])
	{
		$dogroup=" checked";
	}
	if($r[dolanguage])
	{
		$dolanguage=" checked";
	}
	if($r[dosofttype])
	{
		$dosofttype=" checked";
	}
	if($r[dosq])
	{
		$dosq=" checked";
	}
	if($r[dofj])
	{
		$dofj=" checked";
	}
	if($r[doerror])
	{
		$doerror=" checked";
	}
	if($r[dorepip])
	{
		$dorepip=" checked";
	}
	if($r[doad])
	{
		$doad=" checked";
	}
	if($r[dogg])
	{
		$dogg=" checked";
	}
	if($r[docard])
	{
		$docard=" checked";
	}
	if($r[dovote])
	{
		$dovote=" checked";
	}
	if($r[dodbdata])
	{
		$dodbdata=" checked";
	}
	if($r[dodownurl])
	{
		$dodownurl=" checked";
	}
	if($r[dopl])
	{
		$dopl=" checked";
	}
	if($r[dochangedata])
	{
		$dochangedata=" checked";
	}
	if($r[dolink])
	{
		$dolink=" checked";
	}
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>用户组</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="adminphome.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">增加用户组 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> <input name="gr[groupid]" type="hidden" id="gr[groupid]" value="<?=$groupid?>"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2"><strong>名称</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%" height="25">用户组名称：</td>
      <td width="71%" height="25"><input name="gr[groupname]" type="text" id="gr[groupname]" value="<?=$r[groupname]?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2"><strong>权限</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>管理所有下载信息权限:</strong></td>
      <td height="25"><input name="gr[doall]" type="checkbox" id="gr[doall]" value="1"<?=$doall?>>
        有(推荐仅对于管理员有效)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">总体设置：</td>
      <td height="25"><input name="gr[dopublic]" type="checkbox" id="gr[dopublic]" value="1"<?=$dopublic?>>
        有 </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">分类管理：</td>
      <td height="25"><input name="gr[doclass]" type="checkbox" id="gr[doclass]" value="1"<?=$doclass?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">模板管理：</td>
      <td height="25"><input name="gr[dotemplate]" type="checkbox" id="gr[public]3" value="1"<?=$dotemplate?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">附件管理：</td>
      <td height="25"><input name="gr[dofile]" type="checkbox" id="gr[public]5" value="1"<?=$dofile?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理用户：</td>
      <td height="25"><input name="gr[douser]" type="checkbox" id="gr[public]6" value="1"<?=$douser?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理日志：</td>
      <td height="25"><input name="gr[dolog]" type="checkbox" id="gr[public]7" value="1"<?=$dolog?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理会员：</td>
      <td height="25"><input name="gr[domember]" type="checkbox" id="gr[public]8" value="1"<?=$domember?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">用户组管理：</td>
      <td height="25"><input name="gr[dogroup]" type="checkbox" id="gr[dovote]" value="1"<?=$dogroup?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理软件语言：</td>
      <td height="25"><input name="gr[dolanguage]" type="checkbox" id="gr[dogroup]" value="1"<?=$dolanguage?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理软件类型：</td>
      <td height="25"><input name="gr[dosofttype]" type="checkbox" id="gr[dogroup]2" value="1"<?=$dosofttype?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理软件授权：</td>
      <td height="25"><input name="gr[dosq]" type="checkbox" id="gr[dogroup]3" value="1"<?=$dosq?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理软件环境：</td>
      <td height="25"><input name="gr[dofj]" type="checkbox" id="gr[dogroup]4" value="1"<?=$dofj?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理错误报告：</td>
      <td height="25"><input name="gr[doerror]" type="checkbox" id="gr[dogroup]5" value="1"<?=$doerror?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">批量替换地址：</td>
      <td height="25"><input name="gr[dorepip]" type="checkbox" id="gr[dogroup]6" value="1"<?=$dorepip?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理广告：</td>
      <td height="25"><input name="gr[doad]" type="checkbox" id="gr[dogroup]7" value="1"<?=$doad?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理公告：</td>
      <td height="25"><input name="gr[dogg]" type="checkbox" id="gr[dogroup]8" value="1"<?=$dogg?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">点卡管理：</td>
      <td height="25"><input name="gr[docard]" type="checkbox" id="gr[dogg]" value="1"<?=$docard?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">投票管理：</td>
      <td height="25"><input name="gr[dovote]" type="checkbox" id="gr[dogg]" value="1"<?=$dovote?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">数据备份管理：</td>
      <td height="25"><input name="gr[dodbdata]" type="checkbox" id="gr[dogg]" value="1"<?=$dodbdata?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">地址前缀管理：</td>
      <td height="25"><input name="gr[dodownurl]" type="checkbox" id="gr[dogg]" value="1"<?=$dodownurl?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理所有评论：</td>
      <td height="25"><input name="gr[dopl]" type="checkbox" id="gr[dogg]" value="1"<?=$dopl?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">生成与更新数据：</td>
      <td height="25"><input name="gr[dochangedata]" type="checkbox" id="gr[dogg]" value="1"<?=$dochangedata?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">友情链接管理：</td>
      <td height="25"><input name="gr[dolink]" type="checkbox" id="gr[dogg]" value="1"<?=$dolink?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理专题：</td>
      <td height="25"><input name="gr[dozt]" type="checkbox" id="gr[dozt]" value="1"<?=$r[dozt]==1?' checked':''?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理自定义列表：</td>
      <td height="25"><input name="gr[douserlist]" type="checkbox" id="gr[douserlist]" value="1"<?=$r[douserlist]==1?' checked':''?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">管理播放器：</td>
      <td height="25"><input name="gr[doplayer]" type="checkbox" id="gr[doplayer]" value="1"<?=$r[doplayer]==1?' checked':''?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">管理自定义页面：</td>
      <td height="25"><input name="gr[douserpage]" type="checkbox" id="gr[douserpage]" value="1"<?=$r[douserpage]==1?' checked':''?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">管理充值类型：</td>
      <td height="25"><input name="gr[dobuygroup]" type="checkbox" id="gr[dobuygroup]" value="1"<?=$r[dobuygroup]==1?' checked':''?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">管理在线支付：</td>
      <td height="25"><input name="gr[dopay]" type="checkbox" id="gr[dopay]" value="1"<?=$r[dopay]==1?' checked':''?>>
        有</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
