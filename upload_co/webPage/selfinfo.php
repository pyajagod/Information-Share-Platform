<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/q_functions.php");
include("../class/user.php");
include("../data/cache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
//�Ƿ��½
$user=islogin();
$r=ReturnUserInfo($user[userid]);
$downdate=0;
//ʱ��
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
//ע��ʱ��
$registertime=$r[registertime];
if($user_register)
{
    $registertime=date("Y-m-d H:i:s",$r[registertime]);
}
$url= "<a href='intro.php'>��ҳ</a>&nbsp;>&nbsp;<a href='../data/template/cp_1.php'>��Ա����</a>";
@include("../data/template/cp_1.php");
?>
    <p></p>
    <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header">
            <td height="25" colspan="2">�ҵ���Ϣ</td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">�ʺ�ID:</td>
            <td height="25"><?=$user[userid]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">�û���:</td>
            <td height="25"><?=$user[username]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width="33%" height="25">ע��ʱ��:</td>
            <td width="67%" height="25">
                <?=$registertime?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">��Ա�ȼ�:</td>
            <td height="25">
                <?=$level_r[$r[groupid]][groupname]?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">ʣ�����:</td>
            <td height="25">
                <?=$r[downfen]?>
                ��</td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">��Ա����Ч��:</td>
            <td height="25">
                <?=$downdate?>
                �� </td>
        </tr>
    </table>
<?php
@include("../data/template/cp_2.php");
db_close();
$empire=null;
?>