<?php
include("../class/connect.php");
include("../data/cache/public.php");
include("../class/user.php");
if($public_r[openregister])
{
	echo"<script>alert('��Աע�Ṧ���ѱ�����Ա�ر�,����ϵ����Ա.');history.go(-1)</script>";
	exit();
}
//ת��ע��
if(!empty($registerurl))
{
	Header("Location:$registerurl");
	exit();
}
$url="<a href='../'>��ҳ</a>&nbsp;>&nbsp;>&nbsp;<a href='../cp'>�������</a>&nbsp;>&nbsp;ע���Ա";
@include("../data/template/cp_1.php");
?>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="register" method="post" action="../phome/index.php">
    <tr class="header"> 
      <td height="25" colspan="2">ע���Ա <input name="phome" type="hidden" id="phome" value="register"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">������Ϣ</td>
    </tr>
    <tr> 
      <td width="28%" height="25" bgcolor="#FFFFFF">�û���</td>
      <td width="72%" height="25" bgcolor="#FFFFFF"> <input name="username" type="text" id="username" size="35">
        * </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="password" type="password" id="password" size="35">
        * </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ظ�����</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="repassword" type="password" id="repassword" size="35">
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="email" type="text" id="email" size="35">
        *</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">������Ϣ</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ʵ����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="truename" type="text" id="truename" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">QQ����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="oicq" type="text" id="oicq" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">MSN</td>
      <td height="25" bgcolor="#FFFFFF"><input name="msn" type="text" id="msn" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ϵ�绰</td>
      <td height="25" bgcolor="#FFFFFF"><input name="mycall" type="text" id="mycall" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ֻ�</td>
      <td height="25" bgcolor="#FFFFFF"><input name="phone" type="text" id="phone" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��վ��ַ</td>
      <td height="25" bgcolor="#FFFFFF"><input name="homepage" type="text" id="homepage" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ϵ��ַ</td>
      <td height="25" bgcolor="#FFFFFF"><input name="address" type="text" id="address" size="50">
        �ʱ�:
        <input name="zip" type="text" id="zip" size="8"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���˽���</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="saytext" cols="65" rows="8" id="saytext"></textarea></td>
    </tr>
    <?php
	if($public_r['registerkey'])
	{
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��֤�룺</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="key" type="text" id="key" size="6"> 
        <img src="../ShowKey?edown"></td>
    </tr>
    <?php
	}
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="����ע��"> 
        <input type="reset" name="Submit2" value="����"></td>
    </tr>
  </form>
</table>
<?php
@include("../data/template/cp_2.php");
?>
