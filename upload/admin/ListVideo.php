<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../class/user.php");
include("../data/cache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//��֤Ȩ��
CheckLevel($myuserid,$myusername,$classid,"member");
$page=(int)$_GET['page'];
$start=(int)$_GET['start'];
$line=20;//ÿҳ��ʾ����
$page_line=12;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
//����
$add='';
$sear=$_GET['sear'];
if($sear)
{
    $keyboard=$_GET['keyboard'];
//    var_dump($keyboard);
    //����ת��
    $utfkeyboard=doUtfAndGbk($keyboard,0);
    if($keyboard)
    {
        $add=" where course_id IN(select course_id from ccxm_course where course_name like '%$utfkeyboard%')";
    }

    $search="&sear=1&keyboard=".$keyboard;
}
$query="select * from ccxm_path".$add;
$totalquery="select count(*) as total from ccxm_path".$add;
$num=$empire->gettotal($totalquery);//ȡ��������
$query=$query." order by path_id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
//��Ա��

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>��Ƶ</title>
    <link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
        <td>λ��: ������Ƶ</td>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <form name=form1 method=get action=ListVideo.php>
        <input type=hidden name=sear value=1>
        <tr>
            <td height="25" colspan="8" bgcolor="#FFFFFF">������γ���:
                <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">

                 <input type="submit" name="submit" value="����"></td>
        </tr>
    </form>
    <form name=form2 method=post action=memberphome.php onsubmit="return confirm('ȷ��Ҫɾ��?');">
        <input type=hidden name=phome value=DelVideo_all>
        <tr>
            <td width="5%" height="25"><div align="center">ID</div></td>
            <td width="10%" height="25"><div align="center">�γ���</div></td>
            <td width="21%" height="25"><div align="center">���̵�ַ</div></td>
            <td width="10%" height="25"><div align="center">��ȡ��</div></td>
            <td width="20%"><div align="center">���</div></td>
            <td width="10%"><div align="center">�׶�</div></td>
            <td width="5%"><div align="center">�������</div></td>
            <td width="13%" height="25"><div align="center">����</div></td>
        </tr>
        <?
        while($r=$empire->fetch($sql)) {
            $cquery="select course_name from ccxm_course where course_id =".$r[course_id];
            $c=$empire->fetch1($cquery);

        //����ת��
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
                <td height="25"><div align="center">[<a href="EditVideo.php?path_id=<?=$r[path_id]?>&phome=EditVideo">�޸�</a>] [<a href="memberphome.php?path_id=<?=$r[path_id]?>&phome=DelVideo" onclick="return confirm('ȷ��Ҫɾ��?');">ɾ��</a>]
                        <input type=checkbox name=pathid[] value="<?=$r[path_id]?>"<?=$checked?>>
                    </div></td>
            </tr>
            <?
        }
        ?>
        <tr bgcolor="#FFFFFF">
            <td height="25" colspan="8"> &nbsp;&nbsp;
                <?=$returnpage?>
                &nbsp;&nbsp; <input type="submit" name="Submit2" value="����ɾ��"></td>
        </tr>
    </form>
</table>
</body>
</html>
