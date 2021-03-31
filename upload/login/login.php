<?php
require('../class/connect.php');
include("../data/cache/public.php");
include('../class/user.php');
if($eloginurl)
{
	echo"<script>window.close();</script>";
	//Header("Location:$eloginurl");
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../data/images/qcss.css" rel="stylesheet" type="text/css">
<title>登录</title>
</head>
<body>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="login" method="post" action="../phome/index.php">
    <input type=hidden name=ecmsfrom value="<?=$_GET['from']?>">
    <input type=hidden name=prtype value="<?=$_GET['prt']?>">
    <input name="phome" type="hidden" id="phome" value="login">
    <tr class="header"> 
      <td height="25" colspan="2">会员登陆</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="32%" height="25">用户名:</td>
      <td width="68%" height="25"><input name="username" type="text" id="username"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">密码:</td>
      <td height="25"><input name="password" type="password" id="password"> </td>
    </tr>
    <?php
	if($public_r['loginkey'])
	{
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">验证码：</td>
      <td height="25"><input name="key" type="text" id="key" size="6"> <img src="../ShowKey?edown"></td>
    </tr>
    <?php
	}	
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="登陆"> &nbsp;&nbsp;<input type="button" name="Submit2" value="注册" onclick="window.open('../register');"></td>
    </tr>
  </form>
</table>
  </body>
  </html>