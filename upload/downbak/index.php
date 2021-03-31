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
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=10;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
$query="select * from {$dbtbpre}downdownrecord where userid='$user[userid]'";
$totalquery="select count(*) as total from {$dbtbpre}downdownrecord where userid='$user[userid]'";
$num=$empire->gettotal($totalquery);//取得总条数
$query=$query." order by down_id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
$url="<a href='../webPage/intro.php'>首页</a>&nbsp;>&nbsp;<a href='../cp'>会员中心</a>&nbsp;>&nbsp;下载记录";
@include("../data/template/cp_1.php");
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header">
        <td width="54%" height="25"><div align="center">课程名</div></td>
        <td width="13%" height="25"><div align="center">扣除点数</div></td>
        <td width="33%" height="25"><div align="center">下载时间</div></td>
    </tr>
    <?
    while($r=$empire->fetch($sql))
    {
        $sr=$empire->fetch1("select course_id from ccxm_path where path_id='$r[path_id]'");
        $cr=$empire->fetch1("select course_name from ccxm_course where course_id='$sr[course_id]'");
        //$softurl=EDReturnSoftPageUrl($sr[filename],$sr[titleurl]);
        ?>
        <tr bgcolor="#FFFFFF">
            <td height="25"><div align="center">
                    <?=$cr[course_name]?>
                </div></td>
            <td height="25"><div align="center">
                    <?=$r[downfen]?>
                </div></td>
            <td height="25"><div align="center">
                    <?=$r[downtime]?>
                </div></td>
        </tr>
        <?
    }
    ?>
    <tr bgcolor="#FFFFFF">
        <td height="25" colspan="3">
            <?=$returnpage?>
        </td>
    </tr>
</table>
<?php
@include("../data/template/cp_2.php");
db_close();
$empire=null;
?>
