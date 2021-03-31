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
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gbk">
    <script type="text/javascript" src="../../staticPoj/jsAddress.js"></script>
    <link href="../data/images/adminstyle.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../staticPoj/kindeditor-4.1.7/themes/default/default.css" />
    <link rel="stylesheet" href="../../staticPoj/kindeditor-4.1.7/plugins/code/prettify.css" />
    <title>上传视频</title>

</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
        <td>位置：上传视频</td>
    </tr>
</table>
<form name="form1" method="post" action="../phpPage/action/uploadPath.php">
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header">
            <td height="25" colspan="2">上传视频
                <input name="phome" type="hidden" id="phome" value="uploadvideo">
            </td>
        </tr>
<!--        <tr bgcolor="#FFFFFF">-->
<!--            <td height="25">年级:-->
<!--            </td>-->
<!--            <td>-->
<!--                <select name="grade" id="grade">-->
<!--                    <option value="one">一年级</option>-->
<!--                    <option value="two">二年级</option>-->
<!--                    <option value="three">三年级</option>-->
<!--                    <option value="four">四年级</option>-->
<!--                    <option value="five">五年级</option>-->
<!--                    <option value="six">六年级</option>-->
<!--                    <option value="seven">七年级</option>-->
<!--                    <option value="eight">八年级</option>-->
<!--                    <option value="nine">九年级</option>-->
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->
<!--        <tr bgcolor="#FFFFFF">-->
<!--            <td height="25">学期:-->
<!--            </td>-->
<!--            <td>-->
<!--                <select name="ud" id="ud">-->
<!--                    <option value="first">上</option>-->
<!--                    <option value="second">下</option>-->
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->
<!--        <tr bgcolor="#FFFFFF">-->
<!--            <td height="25">单元:-->
<!--            </td>-->
<!--            <td>-->
<!--                <select name="unit" id="unit">-->
<!--                    <option value="unit_one">第一单元</option>-->
<!--                    <option value="unit_two">第二单元</option>-->
<!--                    <option value="unit_three">第三单元</option>-->
<!--                    <option value="unit_four">第四单元</option>-->
<!--                    <option value="unit_five">第五单元</option>-->
<!--                    <option value="unit_six">第六单元</option>-->
<!--                    <option value="unit_seven">第七单元</option>-->
<!--                    <option value="unit_eight">第八单元</option>-->
<!--                    <option value="unit_nine">第九单元</option>-->
<!--                    <option value="unit_ten">第十单元</option>-->
<!--                    <option value="unit_eleven">第十一单元</option>-->
<!--                    <option value="unit_twelve">第十二单元</option>-->
<!--                    <option value="special_training">专题训练</option>-->
<!--                    <option value="synthetic_test">综合测试</option>-->
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->
<!--        <tr bgcolor="#FFFFFF">-->
<!--            <td height="25">科目：</td>-->
<!--            <td>-->
<!--                <select name="subject" id="subject">-->
<!--                    <option value="chinese">语文</option>-->
<!--                    <option value="math">数学</option>-->
<!--                    <option value="english">英语</option>-->
<!--                    <option value="physics">物理</option>-->
<!--                    <option value="chemistry">化学</option>-->
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->
<!--        <tr bgcolor="#FFFFFF">-->
<!--            <td height="25">标签：</td>-->
<!--            <td>-->
<!--                <select name="label" id="label">-->
<!--                    <option value="小学语文">小学语文</option>-->
<!--                    <option value="小学数学">小学数学</option>-->
<!--                    <option value="小学英语">小学英语</option>-->
<!--                    <option value="中学语文">中学语文</option>-->
<!--                    <option value="中学数学">中学数学</option>-->
<!--                    <option value="中学英语">中学英语</option>-->
<!--                    <option value="中学物理">中学物理</option>-->
<!--                    <option value="中学化学">中学化学</option>-->
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->

        <tr bgcolor="#FFFFFF">
            <td height="25">课程：</td>
<!--            <td height="25"><input name="name" type="text" id="name"></td>-->
            <td height="25">学期：<select id="area" name="grade"></select>
            学科：<select id="cmbProvince" name="subject"></select>
            单元：<select id="cmbCity" name="unit"></select>
            课程：<select id="cmbArea" name="courseName"></select></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">讲课老师：</td>
            <td>
                <select name="teacher" id="grade">
                    <option value="语文老师">语文老师</option>
                    <option value="数学老师">数学老师</option>
                    <option value="英语老师">英语老师</option>
                    <option value="物理老师">物理老师</option>
                    <option value="化学老师">化学老师</option>
                </select>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">简介：</td>
<!--            <td height="25"><textarea rows="3" cols="20" name="intro"  id="intro"></textarea></td>-->
            <td height="25"><textarea id="intro" name="intro" cols="100" rows="8" style="width:800px;height:450px;visibility:hidden;margin:0px 100px 0px 100px;"></textarea><br /></td>
            <td height="25"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">阶段：</td>
            <td>
            <select name="cate" id="cate">
                <option value="preview">预习</option>
                <option value="review">复习</option>
                <option value="study">扩展</option>
            </select>
            </td>
        </tr>
        <script type="text/javascript">
            addressInit('area','cmbProvince','cmbCity','cmbArea','一年级上', '语文', '第一单元', '天地人');
        </script>
        <tr bgcolor="#FFFFFF">
            <td height="25">所需点数：</td>
            <td height="25"><input name="points" type="text" id="points"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">网盘地址：</td>
            <td height="25"><input name="address" type="text" id="address"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">网盘提取码：</td>
            <td height="25"><input name="password" type="text" id="password"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
        <tr bgcolor="#FFFFFF">
            <td height="25">&nbsp;</td>
            <td height="25"><input type="submit" name="Submit" value="提交">
                <input type="reset" name="Submit2" value="重置"></td>
        </tr>
    </table>

    <script charset="utf-8" src="../../staticPoj/kindeditor-4.1.7/kindeditor-all.js"></script>
    <script charset="utf-8" src="../../staticPoj/kindeditor-4.1.7/lang/zh-CN.js"></script>
    <script charset="utf-8" src="../../staticPoj/kindeditor-4.1.7/plugins/code/prettify.js"></script>
    <script>
        KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="intro"]', {
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

        function checkIntro() {
            var intro = $("#introduction").val();
            if (intro.length > 100 ){
                document.getElementById("check_intro").innerHTML = "<font color='#F00'>简介格式错误</font>";
                return false;
            }
            if (intro.length === 0 ){
                document.getElementById("check_intro").innerHTML = "<font color='#F00'>简介不能为空</font>";
                return false;
            }
        }

        // function chuanzhi() {
        //     var title = $("#title").val();
        //     var label = $("#label").val();
        //     var uploader = $("#uploader").val();
        //     editor1.sync();
        //     var content1 = $("#content").val();
        //     $.ajax({
        //         url:"addArticleAction.action",
        //         type:"POST",
        //         data:{
        //             "blogTitle":title,
        //             "blogLabel":label,
        //             "blogContent":content1,
        //             "blogUploader":uploader
        //         },
        //         dataType:"json",
        //         contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //         success:function (data) {
        //             console.log(data)
        //             window.location.href='backstage.jsp?userId='+uploader;
        //         }
        //     });

        // }
    </script>
</form>
</body>
</html>

