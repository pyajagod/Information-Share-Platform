<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
include("../class/user.php");
include("../data/cache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
//是否登陆
$user=islogin();
$query="select * from {$dbtbpre}downbuygroup order by myorder,id";
$sql=$empire->query($query);
//支付平台
$paysql=$empire->query("select payid,paytype,payfee,paysay,payname from {$dbtbpre}downpayapi where isclose=0 order by myorder,payid");
$pays='';
while($payr=$empire->fetch($paysql))
{
	$pays.="<option value='".$payr[payid]."'>".$payr[payname]."</option>";
}
$url="<a href='../webPage/intro.php'>首页</a>&nbsp;>&nbsp;<a href='../cp'>会员中心</a>&nbsp;>&nbsp;在线充值";
@include("../data/template/cp_1.php");
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="payform" method="post" action="<?=$public_r[sitedown]?>payapi/PayBuyGroup.php">
    <tr class="header"> 
      <td height="25">请选择要购买的充值类型：</td>
    </tr>
    <?
  while($r=$empire->fetch($sql))
  {
	  if($r[buygroupid]&&$level_r[$r[buygroupid]][level]>$level_r[$user[groupid]][level])
	  {
		  continue;
	  }
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="1%"> <input type="radio" name="id" value="<?=$r[id]?>"> 
            </td>
            <td width="97%"> 
              <?=$r[gmoney]?>
              元 （ 
              <?=$r[gname]?>
              ）</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td><font color="#666666">
              <?=nl2br($r[gsay])?>
              </font></td>
          </tr>
        </table></td>
    </tr>
    <?
  }
  ?>
    <tr bgcolor="#FFFFFF">
      <td height="25">支付平台：
        <SELECT name="payid" style="WIDTH: 120px">
          <?=$pays?>
        </SELECT></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><input type="submit" name="Submit" value="马上充值">
        &nbsp;&nbsp; <input type="button" name="Submit2" value="返回" onclick="self.location.href='../';"> 
      </td>
    </tr>
  </form>
</table>
<?php
@include("../data/template/cp_2.php");
db_close();
$empire=null;
?>
