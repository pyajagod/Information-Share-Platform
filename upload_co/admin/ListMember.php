<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../class/user.php");
include("../data/cache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"member");
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
//����
$add='';
$sear=$_GET['sear'];
if($sear)
{
	$keyboard=RepPostVar2($_GET['keyboard']);
	//����ת��
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
$num=$empire->gettotal($totalquery);//ȡ��������
$query=$query." order by ".$user_userid." desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
//��Ա��
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
<title>��Ա</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td>λ��: �����Ա</td>
    <td><div align="right">
        <input type="button" name="Submit3" value="ע���Ա" onclick="window.open('../register/');">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name=form1 method=get action=ListMember.php>
    <input type=hidden name=sear value=1>
    <tr> 
      <td height="25" colspan="6" bgcolor="#FFFFFF">�������û���: 
        <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>"> 
        <select name="groupid">
          <option value="0" selected>���л�Ա</option>
          <?=$group?>
        </select> <input type="submit" name="Submit" value="����"></td>
    </tr>
  </form>
  <form name=form2 method=post action=memberphome.php onsubmit="return confirm('ȷ��Ҫɾ��?');">
    <input type=hidden name=phome value=DelMember_all>
    <tr> 
      <td width="5%" height="25"><div align="center">ID</div></td>
      <td width="24%" height="25"><div align="center">�û���</div></td>
      <td width="21%" height="25"><div align="center">ע��ʱ��</div></td>
      <td width="19%" height="25"><div align="center">����</div></td>
      <td width="13%"><div align="center">��¼</div></td>
      <td width="18%" height="25"><div align="center">����</div></td>
    </tr>
    <?
  while($r=$empire->fetch($sql))
  {
  		if(empty($r[$user_checked]))
		{
			$checked=" title='δ���' style='background:#99C4E3'";
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
	  //����ת��
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
      <td><div align="center">[<a href="ListBuyBak.php?userid=<?=$r[$user_userid]?>&username=<?=$m_username?>" target="_blank">����</a>] 
          [<a href="ListDownBak.php?userid=<?=$r[$user_userid]?>&username=<?=$m_username?>" target="_blank">����</a>]</div></td>
      <td height="25"><div align="center">[<a href="EditMember.php?userid=<?=$r[$user_userid]?>&phome=EditMember">�޸�</a>] [<a href="memberphome.php?userid=<?=$r[$user_userid]?>&phome=DelMember" onclick="return confirm('ȷ��Ҫɾ��?');">ɾ��</a>] 
          <input type=checkbox name=userid[] value="<?=$r[$user_userid]?>"<?=$checked?>>
        </div></td>
    </tr>
    <?
  }
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="6"> &nbsp;&nbsp; 
        <?=$returnpage?>
        &nbsp;&nbsp; <input type="submit" name="Submit2" value="����ɾ��"></td>
    </tr>
  </form>
</table>
</body>
</html>
