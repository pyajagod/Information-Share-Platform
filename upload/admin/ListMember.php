<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../class/user.php");
include("../data/cache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"member");
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
//搜索
$add='';
$sear=$_GET['sear'];
if($sear)
{
	$keyboard=RepPostVar2($_GET['keyboard']);
	//编码转换
	$utfkeyboard=doUtfAndGbk($keyboard,0);
	if($keyboard)
	{
		$add=" where ".$user_username." like '%$utfkeyboard%'";
	}
	$groupid=(int)$_GET['groupid'];
	if($groupid)
	{
		if(empty($keyboard))
		{$add.=" where ".$user_group."='$groupid'";}
		else
		{$add.=" and ".$user_group."='$groupid'";}
	}
	$search="&sear=1&groupid=".$groupid."&keyboard=".$keyboard;
}
$query="select * from ".$user_tablename.$add;
$totalquery="select count(*) as total from ".$user_tablename.$add;
$num=$empire->gettotal($totalquery);//取得总条数
$query=$query." order by ".$user_userid." desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
//会员组
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}downmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	if($groupid==$l_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$group.="<option value=".$l_r[groupid].$select.">".$l_r[groupname]."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>会员</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td>位置: 管理会员</td>
    <td><div align="right">
        <input type="button" name="Submit3" value="注册会员" onclick="window.open('../register/');">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name=form1 method=get action=ListMember.php>
    <input type=hidden name=sear value=1>
    <tr> 
      <td height="25" colspan="6" bgcolor="#FFFFFF">请输入用户名: 
        <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>"> 
        <select name="groupid">
          <option value="0" selected>所有会员</option>
          <?=$group?>
        </select> <input type="submit" name="Submit" value="搜索"></td>
    </tr>
  </form>
  <form name=form2 method=post action=memberphome.php onsubmit="return confirm('确认要删除?');">
    <input type=hidden name=phome value=DelMember_all>
    <tr> 
      <td width="5%" height="25"><div align="center">ID</div></td>
      <td width="24%" height="25"><div align="center">用户名</div></td>
      <td width="21%" height="25"><div align="center">注册时间</div></td>
      <td width="19%" height="25"><div align="center">级别</div></td>
      <td width="13%"><div align="center">记录</div></td>
      <td width="18%" height="25"><div align="center">操作</div></td>
    </tr>
    <?
  while($r=$empire->fetch($sql))
  {
  		if(empty($r[$user_checked]))
		{
			$checked=" title='未审核' style='background:#99C4E3'";
		}
		else
		{
			$checked="";
		}
  	  if($user_register)
	  {
		  $registertime=date("Y-m-d H:i:s",$r[$user_registertime]);
	  }
	  else
	  {
		  $registertime=$r[$user_registertime];
	  }
	  //编码转换
	  $m_username=doUtfAndGbk($r[$user_username],1);
	  //$email=doUtfAndGbk($r[$user_email],1);
	  $email=$r[$user_email];
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center"> 
          <?=$r[$user_userid]?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$m_username?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$registertime?>
        </div></td>
      <td height="25"><div align="center"> <a href=AddMemberGroup.php?phome=EditMemberGroup&groupid=<?=$r[$user_group]?>> 
          <?=$level_r[$r[$user_group]][groupname]?>
          </a> </div></td>
      <td><div align="center">[<a href="ListBuyBak.php?userid=<?=$r[$user_userid]?>&username=<?=$m_username?>" target="_blank">购买</a>] 
          [<a href="ListDownBak.php?userid=<?=$r[$user_userid]?>&username=<?=$m_username?>" target="_blank">下载</a>]</div></td>
      <td height="25"><div align="center">[<a href="EditMember.php?userid=<?=$r[$user_userid]?>&phome=EditMember">修改</a>] [<a href="memberphome.php?userid=<?=$r[$user_userid]?>&phome=DelMember" onclick="return confirm('确认要删除?');">删除</a>] 
          <input type=checkbox name=userid[] value="<?=$r[$user_userid]?>"<?=$checked?>>
        </div></td>
    </tr>
    <?
  }
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="6"> &nbsp;&nbsp; 
        <?=$returnpage?>
        &nbsp;&nbsp; <input type="submit" name="Submit2" value="批量删除"></td>
    </tr>
  </form>
</table>
</body>
</html>
