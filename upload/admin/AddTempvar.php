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
CheckLevel($myuserid,$myusername,$classid,"template");
$phome=$_GET['phome'];
$r[myorder]=0;
$url="<a href=ListTempvar.php>����ģ�����</a>&nbsp;>&nbsp;����ģ�����";
//�޸�
if($phome=="EditTempvar")
{
	$varid=(int)$_GET['varid'];
	$r=$empire->fetch1("select myvar,varname,varvalue,isclose,myorder from {$dbtbpre}downtempvar where varid='$varid'");
	$r[varvalue]=htmlspecialchars(stripSlashes($r[varvalue]));
	$url="<a href=ListTempvar.php>����ģ�����</a>&nbsp;>&nbsp;�޸�ģ�������".$r[myvar];
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>����ģ�����</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">λ�ã�<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="tempphome.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">����ģ����� 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> <input name="varid" type="hidden" value="<?=$varid?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">������(*)</td>
      <td width="81%" height="25">[!--temp. 
        <input name="myvar" type="text" value="<?=$r[myvar]?>" size="16">
        --] <font color="#666666">(�磺edown����������[!--temp.edown--])</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">������ʶ(*)</td>
      <td height="25"><input name="varname" type="text" value="<?=$r[varname]?>">
        <font color="#666666">(�磺�۹�����)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�Ƿ�������</td>
      <td height="25"><input type="radio" name="isclose" value="0"<?=$r[isclose]==0?' checked':''?>>
        �� 
        <input type="radio" name="isclose" value="1"<?=$r[isclose]==1?' checked':''?>>
        ��<font color="#666666">�������Ż���ģ������Ч��</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��������</td>
      <td height="25"><input name="myorder" type="text" value="<?=$r[myorder]?>" size="6"> 
        <font color="#666666">(ֵԽ��ȼ�Խ�ߣ�����Ƕ����͵ȼ��ı���)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>����ֵ</strong>(*)</td>
      <td height="25">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <textarea name="varvalue" cols="90" rows="27" wrap="OFF" style="WIDTH: 100%"><?=$r[varvalue]?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�ύ"> &nbsp; <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
