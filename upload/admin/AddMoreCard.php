<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"card");
$phome=$_GET['phome'];
$url="<a href=ListCard.php>����㿨</a> &gt; <a href=AddMoreCard.php>�������ӵ㿨</a>";
//----------��Ա��
$sql=$empire->query("select groupid,groupname from {$dbtbpre}downmembergroup order by level");
while($level_r=$empire->fetch($sql))
{
	$group.="<option value=".$level_r[groupid].">".$level_r[groupname]."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�������ӵ㿨</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<script src=../editor/setday.js></script>
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ�ã�<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="memberphome.php">
  <table width="60%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">�������ӵ㿨 
          <input name="phome" type="hidden" id="phome" value="AddMoreCard">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="36%" height="25">�������ɵ㿨������</td>
      <td width="64%" height="25"><input name="donum" type="text" id="donum" value="10" size="6">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�㿨�ʺ�λ����</td>
      <td height="25"><input name="cardnum" type="text" id="cardnum" value="8" size="6">
        λ </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�㿨����λ����</td>
      <td height="25"><input name="passnum" type="text" id="passnum" value="6" size="6">
        λ </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�㿨��</td>
      <td height="25"><input name="money" type="text" id="money" value="10" size="6">
        Ԫ</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">������</td>
      <td height="25"><input name="cardfen" type="text" id="cardfen" value="0" size="6">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="3">��ֵ��Ч��:</td>
      <td height="25"><input name="carddate" type="text" id="carddate" value="0" size="6">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ֵ����ת���Ա��: 
        <select name="cdgroupid" id="select2">
          <option value=0>������</option>
          <?=$group?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ں�ת��Ļ�Ա��: 
        <select name="cdzgroupid" id="cdzgroupid">
          <option value=0>������</option>
          <?=$group?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����ʱ�䣺</td>
      <td height="25"><input name="endtime" type="text" id="endtime" value="0000-00-00" size="20" onclick="setday(this)">
        (0000-00-00Ϊ������)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <input type="submit" name="Submit" value="�ύ">
          &nbsp; 
          <input type="reset" name="Submit2" value="����">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
<?
db_close();
$empire=null;
?>