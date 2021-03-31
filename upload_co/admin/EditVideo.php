<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
include("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//验证用户
$lur=is_login();
$myuserid=$lur[userid];
$myusername=$lur[username];
//验证权限
CheckLevel($myuserid,$myusername,$classid,"member");
$downdate=0;
$phome=$_GET['phome'];
if($phome=="EditVideo")
{
    $path_id=(int)$_GET['path_id'];
    $r=ReturnVideoInfo($path_id);//取得视频资料

}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>视频</title>
    <link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../staticPoj/kindeditor-4.1.7/themes/default/default.css" />
    <link rel="stylesheet" href="../../staticPoj/kindeditor-4.1.7/plugins/code/prettify.css" />
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
        <td>位置: <a href="ListVideo.php">管理视频</a> &gt; 修改视频资料</td>
    </tr>
</table>
<form name="form1" method="post" action="memberphome.php">
    <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header">
            <td height="25" colspan="2">修改视频资料</td>
        </tr>
        <tr>
            <td height="25" colspan="2">基本信息</td>
        </tr>
        <tr>
            <td width="28%" height="25" bgcolor="#FFFFFF">课程名:</td>
            <td width="72%" height="25" bgcolor="#FFFFFF"> <input name="course_name" type="text" id="course_name" value="<?=$r[course_name]?>" size="35" readonly>
                <input name="oldcoursename" type="hidden" id="oldcoursename" value="<?=$r[course_name]?>">
                <input name="phome" type="hidden" id="phome" value="EditVideo">
                <input name="path_id" type="hidden" id="path_id" value="<?=$path_id?>"></td>
        </tr>
        <tr>
            <td height="25" bgcolor="#FFFFFF">网盘地址:</td>
            <td height="25" bgcolor="#FFFFFF"> <input name="path_address" type="text" id="path_address" value="<?=$r[path_address]?>" size="35">
          </td>
        </tr>
        <tr>
            <td height="25" bgcolor="#FFFFFF">提取码:</td>
            <td height="25" bgcolor="#FFFFFF"> <input name="path_password" type="text" id="path_password" value="<?=$r[path_password]?>" size="35"></td>
        </tr>

        <tr>
            <td height="25" bgcolor="#FFFFFF">点数:</td>
            <td height="25" bgcolor="#FFFFFF"> <input name="path_need_point" type="text" id="path_need_point" value="<?=$r[path_need_point]?>" size="35">
                点</td>
        </tr>
        <tr>
            <td height="25" bgcolor="#FFFFFF">阶段:</td>
            <td height="25" bgcolor="#FFFFFF"> <input name="cate_log" type="text" id="cate_log" value="<?=$r[cate_log]?>" size="35">
                </td>
        </tr>
        <tr>
            <td height="25" bgcolor="#FFFFFF">介绍</td>
<!--            <td height="25" bgcolor="#FFFFFF"><textarea name="path_intro" cols="65" rows="8" id="saytext">--><?//=$r[path_intro]?><!--</textarea></td>-->
            <td height="25"><textarea name="path_intro" cols="100" rows="8" style="width:800px;height:450px;visibility:hidden;margin:0px 100px 0px 100px;"><?=$r[path_intro]?></textarea><br /></td>
        </tr>
        <tr>
            <td height="25" bgcolor="#FFFFFF">课程id:</td>
            <td height="25" bgcolor="#FFFFFF"> <input name="course_id" type="text" id="course_id" value="<?=$r[course_id]?>" size="35">
                </td>
        </tr>


        <tr>
            <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="修改">
                <input type="reset" name="Submit2" value="重置"></td>
        </tr>
    </table>
</form>

<script charset="utf-8" src="../../staticPoj/kindeditor-4.1.7/kindeditor-all.js"></script>
<script charset="utf-8" src="../../staticPoj/kindeditor-4.1.7/lang/zh-CN.js"></script>
<script charset="utf-8" src="../../staticPoj/kindeditor-4.1.7/plugins/code/prettify.js"></script>
<script>
    KindEditor.ready(function(K) {
        var editor1 = K.create('textarea[name="path_intro"]', {
            cssPath : 'statics/kindeditor-4.1.7/plugins/code/prettify.css',
            uploadJson : 'insertPictureAction.action',
            fileManagerJson : 'statics/kindeditor-4.1.7/jsp/file_manager_json.jsp',
            allowFileManager : true,
            afterCreate : function() {
                var self = this;
                K.ctrl(document, 13, function() {
                    self.sync();
                    document.forms['example'].submit();
                });
                K.ctrl(self.edit.doc, 13, function() {
                    self.sync();
                    document.forms['example'].submit();
                });
            }
        });
        prettyPrint();
    })
    </script>
</body>
</html>

