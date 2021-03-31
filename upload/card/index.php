<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
include("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//是否登陆
$user=islogin();
$url="<a href='../webPage/mainPage.php'>首页</a>&nbsp;>&nbsp;<a href='../cp'>会员中心</a>&nbsp;>&nbsp;点卡充值";
@include("../data/template/cp_1.php");
?>
<script>
function CheckGetCard()
{
	var ok;
	ok=confirm("确认要冲值?");
	if(ok)
	{
		document.GetCard.Submit.disabled=true
		return true;
	}
	else
	{return false;}
}
</script>
<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name=GetCard method=post action='../phome/index.php' onsubmit="return CheckGetCard();">
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">点卡充值<input type=hidden name=phome value=CardGetDown></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td width="34%" height="25"> <div align="right">充值的用户名：</div></td>
      <td width="66%" height="25"> <input name="username" type="text" id="username" value="<?=$user[username]?>">
        *</td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td height="25"> <div align="right">重复用户名：</div></td>
      <td height="25"> <input name="reusername" type="text" id="reusername" value="<?=$user[username]?>">
        *</td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td height="25"> <div align="right">充值卡号：</div></td>
      <td height="25"> <input name="card_no" type="text" id="card_no">
        *</td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td height="25"> <div align="right">充值卡密码：</div></td>
      <td height="25"> <input name="password" type="password" id="password">
        *</td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td height="25">&nbsp; </td>
      <td height="25"> <input type="submit" name="Submit" value="开始充值"> &nbsp; 
        <input type="reset" name="Submit2" value="重置"> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"> 
      <td height="25">&nbsp; </td>
      <td height="25">说明：带*的为必填项。</td>
    </tr>
  </form>
</table>
<?php
@include("../data/template/cp_2.php");
db_close();
$empire=null;
?>