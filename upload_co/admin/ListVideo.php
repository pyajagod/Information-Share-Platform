<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../class/user.php");
include("../data/cache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"member");
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//每页显示条数
$page_line=12;//每页显示链接数
$offset=$start+$page*$line;//总偏移量
//搜索
$add='';
$sear=$_GET['sear'];
if($sear)
{
    $keyboard=$_GET['keyboard'];
//    var_dump($keyboard);
    //编码转换
    $utfkeyboard=doUtfAndGbk($keyboard,0);
    if($keyboard)
    {
        $add=" where course_id IN(select course_id from ccxm_course where course_name like '%$utfkeyboard%')";
    }

    $search="&sear=1&keyboard=".$keyboard;
}
$query="select * from ccxm_path".$add;
$totalquery="select count(*) as total from ccxm_path".$add;
$num=$empire->gettotal($totalquery);//取得总条数
$query=$query." order by path_id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
//会员组

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>视频</title>
    <link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
        <td>位置: 管理视频</td>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <form name=form1 method=get action=ListVideo.php>
        <input type=hidden name=sear value=1>
        <tr>
            <td height="25" colspan="8" bgcolor="#FFFFFF">请输入课程名:
                <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">

                 <input type="submit" name="submit" value="搜索"></td>
        </tr>
    </form>
    <form name=form2 method=post action=memberphome.php onsubmit="return confirm('确认要删除?');">
        <input type=hidden name=phome value=DelVideo_all>
        <tr>
            <td width="5%" height="25"><div align="center">ID</div></td>
            <td width="10%" height="25"><div align="center">课程名</div></td>
            <td width="21%" height="25"><div align="center">网盘地址</div></td>
            <td width="10%" height="25"><div align="center">提取码</div></td>
            <td width="20%"><div align="center">简介</div></td>
            <td width="10%"><div align="center">阶段</div></td>
            <td width="5%"><div align="center">所需分数</div></td>
            <td width="13%" height="25"><div align="center">操作</div></td>
        </tr>
        <?
        while($r=$empire->fetch($sql)) {
            $cquery="select course_name from ccxm_course where course_id =".$r[course_id];
            $c=$empire->fetch1($cquery);

        //编码转换
        $m_coursename=doUtfAndGbk($c[course_name],1);
        $m_intro=doUtfAndGbk($r[path_intro],1);
            ?>
            <tr bgcolor="#FFFFFF">
                <td height="25"><div align="center">
                        <?=$r[path_id]?>
                    </div></td>
                <td height="25"><div align="center">
                        <?=$m_coursename?>
                    </div></td>
                <td height="25"><div align="center">
                        <?=$r[path_address]?>
                    </div></td>
                <td height="25"><div align="center">
                        <?=$r[path_password]?>
                    </div></td>
                <td height="25"><div align="center">
                        <?=$m_intro?>
                    </div></td>
                <td height="25"><div align="center">
                        <?=$r[cate_log]?>
                    </div></td>
                <td><div align="center">
                      <?=$r[path_need_point]?>
                    </div></td>
                <td height="25"><div align="center">[<a href="EditVideo.php?path_id=<?=$r[path_id]?>&phome=EditVideo">修改</a>] [<a href="memberphome.php?path_id=<?=$r[path_id]?>&phome=DelVideo" onclick="return confirm('确认要删除?');">删除</a>]
                        <input type=checkbox name=pathid[] value="<?=$r[path_id]?>"<?=$checked?>>
                    </div></td>
            </tr>
            <?
        }
        ?>
        <tr bgcolor="#FFFFFF">
            <td height="25" colspan="8"> &nbsp;&nbsp;
                <?=$returnpage?>
                &nbsp;&nbsp; <input type="submit" name="Submit2" value="批量删除"></td>
        </tr>
    </form>
</table>
</body>
</html>
