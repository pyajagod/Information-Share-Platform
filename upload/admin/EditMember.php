<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"member");
$downdate=0;
$phome=$_GET['phome'];
if($phome=="EditMember")
{
	$userid=(int)$_GET['userid'];
	$r=ReturnUserInfo($userid);//ȡ���û�����
	//ʱ��
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
//��Ա��
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
<title>��Ա</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ��: <a href="ListMember.php">�����Ա</a> &gt; �޸Ļ�Ա����</td>
  </tr>
</table>
<form name="form1" method="post" action="memberphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">�޸Ļ�Ա����</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">������Ϣ</td>
    </tr>
    <tr> 
      <td width="28%" height="25" bgcolor="#FFFFFF">�û���:</td>
      <td width="72%" height="25" bgcolor="#FFFFFF"> <input name="username" type="text" id="username" value="<?=$r[username]?>" size="35" readonly> 
        <input name="oldusername" type="hidden" id="oldusername" value="<?=$r[username]?>"> 
        <input name="phome" type="hidden" id="phome" value="EditMember"> 
        <input name="userid" type="hidden" id="userid" value="<?=$userid?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="password" type="password" id="password" size="35">
        (�����޸�,������)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="email" type="text" id="email" value="<?=$r[email]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��Ա��:</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="groupid" id="groupid">
          <?=$group?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="downfen" type="text" id="downfen" value="<?=$r[downfen]?>" size="35">
        ��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��Ч��:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="downdate" type="text" id="downdate" value="<?=$downdate?>" size="6">
        �죬���ں�ת���û���: 
        <select name="zgroupid" id="zgroupid">
          <option value="0">������</option>
          <?=$zgroup?>
        </select></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�ʺ����:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="checked" value="1"<?=$r[checked]==1?' checked':''?>>
        �����
        <input type="radio" name="checked" value="0"<?=$r[checked]==0?' checked':''?>>
        δ���</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">������Ϣ</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ʵ����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="truename" type="text" id="truename" value="<?=$addr[truename]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">QQ����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="oicq" type="text" id="oicq" value="<?=$addr[oicq]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">MSN</td>
      <td height="25" bgcolor="#FFFFFF"><input name="msn" type="text" id="msn" value="<?=$addr[msn]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ϵ�绰</td>
      <td height="25" bgcolor="#FFFFFF"><input name="mycall" type="text" id="mycall" value="<?=$addr[mycall]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ֻ�</td>
      <td height="25" bgcolor="#FFFFFF"><input name="phone" type="text" id="phone" value="<?=$addr[phone]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��վ��ַ</td>
      <td height="25" bgcolor="#FFFFFF"><input name="homepage" type="text" id="homepage" value="<?=$addr[homepage]?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ϵ��ַ</td>
      <td height="25" bgcolor="#FFFFFF"><input name="address" type="text" id="address" value="<?=$addr[address]?>" size="50">
        �ʱ�: 
        <input name="zip" type="text" id="zip" value="<?=$addr[zip]?>" size="8"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���˽���</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="saytext" cols="65" rows="8" id="saytext"><?=$addr[saytext]?></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="�޸�"> 
        <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
