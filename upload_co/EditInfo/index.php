<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
include("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//�Ƿ��½
$user=islogin();
$r=ReturnUserInfo($user[userid]);
$addr=$empire->fetch1("select * from {$dbtbpre}downmemberadd where userid='$user[userid]'");
$url="<a href='../webPage/intro.php'>��ҳ</a>&nbsp;>&nbsp;<a href='../cp'>��Ա����</a>&nbsp;>&nbsp;�޸�����";
@include("../data/template/cp_1.php");
?>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="register" method="post" action="../phome/index.php">
    <tr class="header"> 
      <td height="25" colspan="2">�޸����� <input name="phome" type="hidden" id="phome" value="EditInfo"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">������Ϣ</td>
    </tr>
    <tr> 
      <td width="27%" height="25" bgcolor="#FFFFFF">�û���:</td>
      <td width="73%" height="25" bgcolor="#FFFFFF"> 
        <?=$r[username]?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">������:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="oldpassword" type="password" id="oldpassword" size="35"> 
        <font color="#666666">(�����޸�������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">������:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="password" type="password" id="password" size="35"> 
        <font color="#666666">(�����޸�������) </font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ظ�������:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="repassword" type="password" id="repassword" size="35"> 
        <font color="#666666">(�����޸�������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����:</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="email" type="text" id="email" value="<?=$r[email]?>" size="35"></td>
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
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="�޸�����"> 
        <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </form>
</table>
<?php
@include("../data/template/cp_2.php");
db_close();
$empire=null;
?>