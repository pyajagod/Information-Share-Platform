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
$r=ReturnUserInfo($user[userid]);
$downdate=0;
//时间
if($r[downdate])
{
    $downdate=$r[downdate]-time();
    if($downdate<=0)
    {
        $downdate=0;
    }
    else
    {
        $downdate=round($downdate/(24*3600));
    }
}
//注册时间
$registertime=$r[registertime];
if($user_register)
{
    $registertime=date("Y-m-d H:i:s",$r[registertime]);
}
$url= "<a href='intro.php'>首页</a>&nbsp;>&nbsp;<a href='../data/template/cp_1.php'>会员中心</a>";
@include("../data/template/cp_1.php");
?>
    <p></p>
    <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header">
            <td height="25" colspan="2">我的信息</td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">帐号ID:</td>
            <td height="25"><?=$user[userid]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">用户名:</td>
            <td height="25"><?=$user[username]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width="33%" height="25">注册时间:</td>
            <td width="67%" height="25">
                <?=$registertime?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">会员等级:</td>
            <td height="25">
                <?=$level_r[$r[groupid]][groupname]?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">剩余点数:</td>
            <td height="25">
                <?=$r[downfen]?>
                点</td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">会员组有效期:</td>
            <td height="25">
                <?=$downdate?>
                天 </td>
        </tr>
    </table>
<?php
@include("../data/template/cp_2.php");
db_close();
$empire=null;
?>