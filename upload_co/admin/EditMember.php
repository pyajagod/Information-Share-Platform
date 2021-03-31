<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"member");
$downdate=0;
$phome=$_GET['phome'];
if($phome=="EditMember")
{
	$userid=(int)$_GET['userid'];
	$r=ReturnUserInfo($userid);//取得用户资料
	//时间
	if($r[downdate])
	{
		$downdate=$r[downdate]-time();
		if($downdate<=0)
		{
			OutTimeZGroup($userid,$r['zgroupid']);
			if($r['zgroupid'])
			{
				$r['groupid']=$r['zgroupid'];
				$r['zgroupid']=0;
			}
			$downdate=0;
		}
		else
		{
			$downdate=round($downdate/(24*3600));
		}
	}
	$addr=$empire->fetch1("select * from {$dbtbpre}downmemberadd where userid='$userid'");
}
//会员组
$sql=$empire->query("select groupid,groupname from {$dbtbpre}downmembergroup order by level");
while($level_r=$empire->fetch($sql))
{
	if($r[groupid]==$level_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$group.="<option value=".$level_r[groupid].$select.">".$level_r[groupname]."</option>";
	if($r[zgroupid]==$level_r[groupid])
	{$zselect=" selected";}
	else
	{$zselect="";}
	$zgroup.="<option value=".$level_r[groupid].$zselect.">".$level_r[groupname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>会员</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置: <a href="ListMember.php">管理会员</a> &gt; 修改会员资料</td>
  </tr>
</table>
<form name="form1" method="post" action="memberphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">修改会员资料</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">基本信息</td>
    </tr>
    <tr> 
      <td width="28%" height="25" bgcolor="#FFFFFF">用户名:</td>
      <td width="72%" height="25" bgcolor="#FFFFFF"> <input name="username" type="text" id="username" value="<?=$r[username]?>" size="35" readonly> 
        <input name="oldusername" type="hidden" id="oldusername" value="<?=$r[username]?>"> 
        <input name="phome" type="hidden" id="phome" value="EditMember"> 
        <input name="userid" type="hidden" id="userid" value="<?=$userid?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">密码:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="password" type="password" id="password" size="35">
        (不想修改,请留空)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">邮箱:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="email" type="text" id="email" value="<?=$r[email]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">会员组:</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="groupid" id="groupid">
          <?=$group?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">点数:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="downfen" type="text" id="downfen" value="<?=$r[downfen]?>" size="35">
        点</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">有效期:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="downdate" type="text" id="downdate" value="<?=$downdate?>" size="6">
        天，到期后转向用户组: 
        <select name="zgroupid" id="zgroupid">
          <option value="0">不设置</option>
          <?=$zgroup?>
        </select></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">帐号审核:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="checked" value="1"<?=$r[checked]==1?' checked':''?>>
        已审核
        <input type="radio" name="checked" value="0"<?=$r[checked]==0?' checked':''?>>
        未审核</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">其他信息</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">真实姓名</td>
      <td height="25" bgcolor="#FFFFFF"><input name="truename" type="text" id="truename" value="<?=$addr[truename]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">QQ号码</td>
      <td height="25" bgcolor="#FFFFFF"><input name="oicq" type="text" id="oicq" value="<?=$addr[oicq]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">MSN</td>
      <td height="25" bgcolor="#FFFFFF"><input name="msn" type="text" id="msn" value="<?=$addr[msn]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">联系电话</td>
      <td height="25" bgcolor="#FFFFFF"><input name="mycall" type="text" id="mycall" value="<?=$addr[mycall]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">手机</td>
      <td height="25" bgcolor="#FFFFFF"><input name="phone" type="text" id="phone" value="<?=$addr[phone]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">网站地址</td>
      <td height="25" bgcolor="#FFFFFF"><input name="homepage" type="text" id="homepage" value="<?=$addr[homepage]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">联系地址</td>
      <td height="25" bgcolor="#FFFFFF"><input name="address" type="text" id="address" value="<?=$addr[address]?>" size="50">
        邮编: 
        <input name="zip" type="text" id="zip" value="<?=$addr[zip]?>" size="8"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">个人介绍</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="saytext" cols="65" rows="8" id="saytext"><?=$addr[saytext]?></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="修改"> 
        <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
