<?php
require("../class/connect.php");
include("../data/cache/public.php");
include("../class/db_sql.php");
include("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//��֤�û�
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
    <title>�ϴ���Ƶ</title>

</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
        <td>λ�ã��ϴ���Ƶ</td>
    </tr>
</table>
<form name="form1" method="post" action="../phpPage/action/uploadPath.php">
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header">
            <td height="25" colspan="2">�ϴ���Ƶ
                <input name="phome" type="hidden" id="phome" value="uploadvideo">
            </td>
        </tr>
<!--        <tr bgcolor="#FFFFFF">-->
<!--            <td height="25">�꼶:-->
<!--            </td>-->
<!--            <td>-->
<!--                <select name="grade" id="grade">-->
<!--                    <option value="one">һ�꼶</option>-->
<!--                    <option value="two">���꼶</option>-->
<!--                    <option value="three">���꼶</option>-->
<!--                    <option value="four">���꼶</option>-->
<!--                    <option value="five">���꼶</option>-->
<!--                    <option value="six">���꼶</option>-->
<!--                    <option value="seven">���꼶</option>-->
<!--                    <option value="eight">���꼶</option>-->
<!--                    <option value="nine">���꼶</option>-->
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->
<!--        <tr bgcolor="#FFFFFF">-->
<!--            <td height="25">ѧ��:-->
<!--            </td>-->
<!--            <td>-->
<!--                <select name="ud" id="ud">-->
<!--                    <option value="first">��</option>-->
<!--                    <option value="second">��</option>-->
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->
<!--        <tr bgcolor="#FFFFFF">-->
<!--            <td height="25">��Ԫ:-->
<!--            </td>-->
<!--            <td>-->
<!--                <select name="unit" id="unit">-->
<!--                    <option value="unit_one">��һ��Ԫ</option>-->
<!--                    <option value="unit_two">�ڶ���Ԫ</option>-->
<!--                    <option value="unit_three">������Ԫ</option>-->
<!--                    <option value="unit_four">���ĵ�Ԫ</option>-->
<!--                    <option value="unit_five">���嵥Ԫ</option>-->
<!--                    <option value="unit_six">������Ԫ</option>-->
<!--                    <option value="unit_seven">���ߵ�Ԫ</option>-->
<!--                    <option value="unit_eight">�ڰ˵�Ԫ</option>-->
<!--                    <option value="unit_nine">�ھŵ�Ԫ</option>-->
<!--                    <option value="unit_ten">��ʮ��Ԫ</option>-->
<!--                    <option value="unit_eleven">��ʮһ��Ԫ</option>-->
<!--                    <option value="unit_twelve">��ʮ����Ԫ</option>-->
<!--                    <option value="special_training">ר��ѵ��</option>-->
<!--                    <option value="synthetic_test">�ۺϲ���</option>-->
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->
<!--        <tr bgcolor="#FFFFFF">-->
<!--            <td height="25">��Ŀ��</td>-->
<!--            <td>-->
<!--                <select name="subject" id="subject">-->
<!--                    <option value="chinese">����</option>-->
<!--                    <option value="math">��ѧ</option>-->
<!--                    <option value="english">Ӣ��</option>-->
<!--                    <option value="physics">����</option>-->
<!--                    <option value="chemistry">��ѧ</option>-->
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->
<!--        <tr bgcolor="#FFFFFF">-->
<!--            <td height="25">��ǩ��</td>-->
<!--            <td>-->
<!--                <select name="label" id="label">-->
<!--                    <option value="Сѧ����">Сѧ����</option>-->
<!--                    <option value="Сѧ��ѧ">Сѧ��ѧ</option>-->
<!--                    <option value="СѧӢ��">СѧӢ��</option>-->
<!--                    <option value="��ѧ����">��ѧ����</option>-->
<!--                    <option value="��ѧ��ѧ">��ѧ��ѧ</option>-->
<!--                    <option value="��ѧӢ��">��ѧӢ��</option>-->
<!--                    <option value="��ѧ����">��ѧ����</option>-->
<!--                    <option value="��ѧ��ѧ">��ѧ��ѧ</option>-->
<!--                </select>-->
<!--            </td>-->
<!--        </tr>-->

        <tr bgcolor="#FFFFFF">
            <td height="25">�γ̣�</td>
<!--            <td height="25"><input name="name" type="text" id="name"></td>-->
            <td height="25">ѧ�ڣ�<select id="area" name="grade"></select>
            ѧ�ƣ�<select id="cmbProvince" name="subject"></select>
            ��Ԫ��<select id="cmbCity" name="unit"></select>
            �γ̣�<select id="cmbArea" name="courseName"></select></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">������ʦ��</td>
            <td>
                <select name="teacher" id="grade">
                    <option value="������ʦ">������ʦ</option>
                    <option value="��ѧ��ʦ">��ѧ��ʦ</option>
                    <option value="Ӣ����ʦ">Ӣ����ʦ</option>
                    <option value="������ʦ">������ʦ</option>
                    <option value="��ѧ��ʦ">��ѧ��ʦ</option>
                </select>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">��飺</td>
<!--            <td height="25"><textarea rows="3" cols="20" name="intro"  id="intro"></textarea></td>-->
            <td height="25"><textarea id="intro" name="intro" cols="100" rows="8" style="width:800px;height:450px;visibility:hidden;margin:0px 100px 0px 100px;"></textarea><br /></td>
            <td height="25"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">�׶Σ�</td>
            <td>
            <select name="cate" id="cate">
                <option value="preview">Ԥϰ</option>
                <option value="review">��ϰ</option>
                <option value="study">��չ</option>
            </select>
            </td>
        </tr>
        <script type="text/javascript">
            addressInit('area','cmbProvince','cmbCity','cmbArea','һ�꼶��', '����', '��һ��Ԫ', '�����');
        </script>
        <tr bgcolor="#FFFFFF">
            <td height="25">���������</td>
            <td height="25"><input name="points" type="text" id="points"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">���̵�ַ��</td>
            <td height="25"><input name="address" type="text" id="address"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="25">������ȡ�룺</td>
            <td height="25"><input name="password" type="text" id="password"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
        <tr bgcolor="#FFFFFF">
            <td height="25">&nbsp;</td>
            <td height="25"><input type="submit" name="Submit" value="�ύ">
                <input type="reset" name="Submit2" value="����"></td>
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
                document.getElementById("check_intro").innerHTML = "<font color='#F00'>����ʽ����</font>";
                return false;
            }
            if (intro.length === 0 ){
                document.getElementById("check_intro").innerHTML = "<font color='#F00'>��鲻��Ϊ��</font>";
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

