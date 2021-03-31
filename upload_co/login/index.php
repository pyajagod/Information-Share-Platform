<?php
require('../class/connect.php');
include("../data/cache/public.php");
include('../class/user.php');
if($eloginurl)
{
	Header("Location:$eloginurl");
	exit();
}
$from=$_GET['from'];
$url="<a href='../webPage/intro.php'>首页</a>&nbsp;>&nbsp;<a href='../cp'>会员中心</a>&nbsp;>&nbsp;会员登陆";
@include("../data/template/cp_1.php");
?>
  
<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="login" method="post" action="../phome/index.php">
    <tr class="header"> 
      <td height="25" colspan="2">会员登陆 
	  <input name="phome" type="hidden" id="phome" value="login">
	  <input name="ecmsfrom" type="hidden"  value="<?=$from?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="32%" height="25">用户名:</td>
      <td width="68%" height="25"><input name="username" type="text" id="username" size="27"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">密码:</td>
      <td height="25"><input name="password" type="password" id="password" size="27"> </td>
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
      <td height="25"><input type="submit" name="Submit" value="登陆">&nbsp;&nbsp;&nbsp;<input type="button" name="Submit2" value="注册" onclick="parent.location.href='../register';"></td>
    </tr>
  </form>
</table>
<?
@include("../data/template/cp_2.php");
?>