<?php
error_reporting(E_ALL ^ E_NOTICE);
@include("../class/connect.php");
@include("../data/cache/public.php");
// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
// HTTP/1.0
header("Pragma: no-cache");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�۹�����ϵͳ��̨��½ - Powered by EmpireDown</title>
<link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
<base onmouseover="window.status='��Դ����ϵͳ��һƷ�� �� �۹�����ϵͳ';return true">
<script>
if(self!=top)
{
	parent.location.href='index.php';
}
function CheckLogin(obj){
	if(obj.username.value=='')
	{
		alert('�������û���');
		obj.username.focus();
		return false;
	}
	if(obj.password.value=='')
	{
		alert('�������¼����');
		obj.password.focus();
		return false;
	}
	if(obj.loginauth!=null)
	{
		if(obj.loginauth.value=='')
		{
			alert('��������֤��');
			obj.loginauth.focus();
			return false;
		}
	}
	if(obj.key!=null)
	{
		if(obj.key.value=='')
		{
			alert('��������֤��');
			obj.key.focus();
			return false;
		}
	}
	return true;
}
</script>
</head>

<body onload="document.login.username.focus();">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<form name="login" method="post" action="adminphome.php">
  <table width="420" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">����Ա��½</div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="32%" height="25">�û���:</td>
      <td width="78%" height="25"><input name="username" type="text" id="username" size="27"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����:</td>
      <td height="25"><input name="password" type="password" id="password" size="27"></td>
    </tr>
	<?php
	if($do_loginauth)
	{
	?>
    <tr bgcolor="#FFFFFF">
      <td height="25">��֤��:</td>
      <td height="25"><input name="loginauth" type="password" id="loginauth" size="27"></td>
    </tr>
	<?php
	}
	if($public_r['adminloginkey'])
	{
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��֤�룺</td>
      <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="52"> <input name="key" type="text" id="key" size="6"> </td>
            <td><img src="ShowKey.php" name="KeyImg" id="KeyImg" align="bottom" onclick="KeyImg.src='ShowKey.php?'+Math.random()" alt="�������,���ˢ��"></td>
          </tr>
        </table></td>
    </tr>
	<?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="���ϵ�½"> &nbsp;&nbsp;
        <input type="button" name="Submit2" value="��վ��ҳ" onclick="window.open('../');"> 
        <input name="phome" type="hidden" id="phome" value="login"></td>
    </tr>
  </table>
  <br>
  <table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td><div align="center">Powered by <a href="http://www.phome.net" target="_blank"><strong>EmpireDown</strong></a> 
          <font color="#FF9900"><strong>2.5</strong></font> &copy; 2002-2009 <a href="http://www.digod.com" target="_blank">EmpireSoft</a> 
          Inc.</div></td>
    </tr>
  </table>
</form>
</body>
</html>
