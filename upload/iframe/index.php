<?php
@include("../class/connect.php");
if(!defined('InEmpireDown'))
{
	exit();
}
$myuserid=(int)getcvar('memberuserid');
$mhavelogin=0;
if($myuserid)
{
	@include("../data/cache/public.php");
	@include("../class/db_sql.php");
	@include("../class/user.php");
	@include("../data/cache/MemberLevel.php");
	$link=db_connect();
	$empire=new mysqlquery();
	$mhavelogin=1;
	//数据
	$myusername=RepPostVar(getcvar('memberusername'));
	$myrnd=RepPostVar(getcvar('memberrnd'));
	$r=$empire->fetch1("select ".$user_userid.",".$user_username.",".$user_group.",".$user_downfen.",".$user_downdate.",".$user_checked.",".$user_zgroup." from ".$user_tablename." where ".$user_userid."='$myuserid' and ".$user_rnd."='$myrnd' limit 1");
	if(empty($r[$user_userid])||$r[$user_checked]==0)
	{
		EmptyEdownCookie();
		$mhavelogin=0;
	}
	//会员等级
	if(empty($r[$user_group]))
	{$groupid=$user_groupid;}
	else
	{$groupid=$r[$user_group];}
	$groupname=$level_r[$groupid]['groupname'];
	//点数
	$downfen=$r[$user_downfen];
	//天数
	$downdate=0;
	if($r[$user_downdate])
	{
		$downdate=$r[$user_downdate]-time();
		if($downdate<=0)
		{$downdate=0;}
		else
		{$downdate=round($downdate/(24*3600));}
	}
	//$myusername=$r[$user_username];
	db_close();
	$empire=null;
}
if($mhavelogin==1)
{
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>登陆</title>
<LINK href="../data/images/qcss.css" rel=stylesheet>
</head>
<body bgcolor="#ededed" topmargin="0">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
	<td height="23" align="center">
	<div align="left">
		&raquo;&nbsp;<font color=red><b><?=$myusername?></b></font>&nbsp;&nbsp;<a href="../cp" target="_parent"><?=$groupname?></a>&nbsp;&nbsp;<a href="../fava" target=_blank>收藏夹</a>&nbsp;&nbsp;<a href="../cp" target="_parent">会员中心</a>&nbsp;&nbsp;<a href="../phome?phome=exit&prtype=9" onclick="return confirm('确认要退出?');">退出</a> 
	</div>
	</td>
    </tr>
</table>
</body>
</html>
<?
}
else
{
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>登陆</title>
<LINK href="../data/images/qcss.css" rel=stylesheet>
</head>
<body bgcolor="#ededed" topmargin="0">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <form name=login method=post action="../phome/index.php">
    <input type=hidden name=phome value=login>
    <input type=hidden name=prtype value=1>
    <tr> 
      <td height="23" align="center">
      <div align="left">
      用户名：<input name="username" type="text" size="12">&nbsp;
      密码：<input name="password" type="password" size="12">&nbsp;
      <input type="submit" name="Submit" value="登陆">&nbsp;
      <input type="button" name="Submit2" value="注册" onclick="window.open('../register');">
      </div>
      </td>
    </tr>
  </form>
</table>
</body>
</html>

<?
}
?>