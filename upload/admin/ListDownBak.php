<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"member");
$userid=(int)$_GET['userid'];
$username=RepPostVar($_GET['username']);
$search="&username=".$username."&userid=".$userid;
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
$query="select * from {$dbtbpre}downdownrecord where userid='$userid'";
$num=$empire->num($query);//取得总条数
$query=$query." order by down_id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>下载记录</title>
    <link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
        <td>查看<b><?=$username?></b>下载记录</td>
    </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header">
        <td width="43%" height="25"><div align="center">课程名</div></td>
        <td width="20%" height="25"><div align="center">扣除点数</div></td>
        <td width="37%" height="25"><div align="center">下载时间</div></td>
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
    db_close();
    $empire=null;
    ?>
    <tr bgcolor="#FFFFFF">
        <td height="25" colspan="3">&nbsp;&nbsp;
            <?=$returnpage?>
        </td>
    </tr>
</table>
</body>
</html>
