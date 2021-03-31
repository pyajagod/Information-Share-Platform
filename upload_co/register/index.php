<?php
include("../class/connect.php");
include("../data/cache/public.php");
include("../class/user.php");
if($public_r[openregister])
{
	echo"<script>alert('会员注册功能已被管理员关闭,请联系管理员.');history.go(-1)</script>";
	exit();
}
//转向注册
if(!empty($registerurl))
{
	Header("Location:$registerurl");
	exit();
}
$url="<a href='../'>首页</a>&nbsp;>&nbsp;>&nbsp;<a href='../cp'>控制面板</a>&nbsp;>&nbsp;注册会员";
@include("../data/template/cp_1.php");
?>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="register" method="post" action="../phome/index.php">
    <tr class="header"> 
      <td height="25" colspan="2">注册会员 <input name="phome" type="hidden" id="phome" value="register"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">基本信息</td>
    </tr>
    <tr> 
      <td width="28%" height="25" bgcolor="#FFFFFF">用户名</td>
      <td width="72%" height="25" bgcolor="#FFFFFF"> <input name="username" type="text" id="username" size="35">
        * </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">密码</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="password" type="password" id="password" size="35">
        * </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">重复密码</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="repassword" type="password" id="repassword" size="35">
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">邮箱</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="email" type="text" id="email" size="35">
        *</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">其他信息</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">真实姓名</td>
      <td height="25" bgcolor="#FFFFFF"><input name="truename" type="text" id="truename" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">QQ号码</td>
      <td height="25" bgcolor="#FFFFFF"><input name="oicq" type="text" id="oicq" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">MSN</td>
      <td height="25" bgcolor="#FFFFFF"><input name="msn" type="text" id="msn" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">联系电话</td>
      <td height="25" bgcolor="#FFFFFF"><input name="mycall" type="text" id="mycall" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">手机</td>
      <td height="25" bgcolor="#FFFFFF"><input name="phone" type="text" id="phone" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">网站地址</td>
      <td height="25" bgcolor="#FFFFFF"><input name="homepage" type="text" id="homepage" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">联系地址</td>
      <td height="25" bgcolor="#FFFFFF"><input name="address" type="text" id="address" size="50">
        邮编:
        <input name="zip" type="text" id="zip" size="8"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">个人介绍</td>
      <td height="25" bgcolor="#FFFFFF"><textarea name="saytext" cols="65" rows="8" id="saytext"></textarea></td>
    </tr>
    <?php
	if($public_r['registerkey'])
	{
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">验证码：</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="key" type="text" id="key" size="6"> 
        <img src="../ShowKey?edown"></td>
    </tr>
    <?php
	}
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="马上注册"> 
        <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </form>
</table>
<?php
@include("../data/template/cp_2.php");
?>
