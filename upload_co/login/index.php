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
$url="<a href='../webPage/intro.php'>��ҳ</a>&nbsp;>&nbsp;<a href='../cp'>��Ա����</a>&nbsp;>&nbsp;��Ա��½";
@include("../data/template/cp_1.php");
?>
  
<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="login" method="post" action="../phome/index.php">
    <tr class="header"> 
      <td height="25" colspan="2">��Ա��½ 
	  <input name="phome" type="hidden" id="phome" value="login">
	  <input name="ecmsfrom" type="hidden"  value="<?=$from?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="32%" height="25">�û���:</td>
      <td width="68%" height="25"><input name="username" type="text" id="username" size="27"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����:</td>
      <td height="25"><input name="password" type="password" id="password" size="27"> </td>
    </tr>
    <?php
	if($public_r['loginkey'])
	{
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��֤�룺</td>
      <td height="25"><input name="key" type="text" id="key" size="6"> <img src="../ShowKey?edown"></td>
    </tr>
    <?php
	}	
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="��½">&nbsp;&nbsp;&nbsp;<input type="button" name="Submit2" value="ע��" onclick="parent.location.href='../register';"></td>
    </tr>
  </form>
</table>
<?
@include("../data/template/cp_2.php");
?>