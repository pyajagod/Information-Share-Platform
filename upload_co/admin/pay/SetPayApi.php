<?php
require("../../class/connect.php");
include("../../data/cache/public.php");
include("../../class/db_sql.php");
include("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"pay");
$phome=$_GET['phome'];
$payid=(int)$_GET['payid'];
$r=$empire->fetch1("select * from {$dbtbpre}downpayapi where payid='$payid'");
$url="����֧��&gt; <a href=PayApi.php>����֧���ӿ�</a>&nbsp;>&nbsp;����֧���ӿڣ�<b>".$r[paytype]."</b>";
$registerpay='';
if($r[paytype]=='tenpay')
{
	$registerpay="<input type=\"button\" value=\"����ע��Ƹ�ͨ�̻���\" onclick=\"javascript:window.open('http://union.tenpay.com/mch/mch_index1.shtml?sp_suggestuser=1203924401');\">";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>֧���ӿ�</title>
<link href="../../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">λ�ã� 
      <?=$url?>
    </td>
    <td><div align="right">
        <input type="button" name="Submit5" value="����֧����¼" onclick="self.location.href='ListPayRecord.php';">
      </div></td>
  </tr>
</table>
<form name="setpayform" method="post" action="PayApi.php" enctype="multipart/form-data">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">����֧���ӿ� 
        <input name="phome" type="hidden" id="phome" value="<?=$phome?>"> 
        <input name="payid" type="hidden" id="payid" value="<?=$payid?>"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="right">�ӿ����ͣ�</div></td>
      <td height="25"> 
        <?=$r[paytype]?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="right">�ӿ�״̬��</div></td>
      <td height="25"><input type="radio" name="isclose" value="0"<?=$r[isclose]==0?' checked':''?>>
        ���� 
        <input type="radio" name="isclose" value="1"<?=$r[isclose]==1?' checked':''?>>
        �ر�</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25"><div align="right">�ӿ����ƣ�</div></td>
      <td width="77%" height="25"><input name="payname" type="text" id="payname" value="<?=$r[payname]?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><div align="right">�ӿ�������</div></td>
      <td height="25"><textarea name="paysay" cols="65" rows="6" id="paysay"><?=htmlspecialchars($r[paysay])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="right">�̻��ţ�</div></td>
      <td height="25"><input name="payuser" type="text" id="payuser" value="<?=$r[payuser]?>" size="35"> 
        <?=$registerpay?> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="right">��Կ��</div></td>
      <td height="25"><input name="paykey" type="text" id="paykey" value="<?=$r[paykey]?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="right">�����ѣ�</div></td>
      <td height="25"><input name=payfee type=text id="payfee" value='<?=$r[payfee]?>' size="35">
        % </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value=" �� �� ">
        &nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </table>
</form>
</body>
</html>
