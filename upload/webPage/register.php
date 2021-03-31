<?php
    include("../class/connect.php");
    include("../data/cache/public.php");
    include("../class/user.php");

//    @include("../data/template/cp_1.php");
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ע��ҳ��</title>
    <link rel="stylesheet" href="../../staticPoj/layui/css/layui.css" media="all"/>
    <style>
        body{
            /*background: url('');*/
            background-size: 1580px 800px;

        }
        .rg_layout{
            width: 800px;
            height: 500px;
            border: 8px solid #EEEEEE;
            background-color: white;

            margin: auto;
            margin-top: 90px;
            background-color: rgba(220, 38, 0, 0.1);
        }

        .rg_title{
            /*border: 1px solid red;*/
            padding-left: 249px;

        }

        .rg_title > p:first-child{
            color: white;
            font-size: 40px;
        }


        .rg_center{
            /*border: 1px solid red;*/
            float: left;
            width: 500px;
            padding-left: 200px;
            padding-top: 40px;

        }

        .rg_right{
            /*border: 1px solid red;*/
            float: right;
            padding-right: 20px;
        }

        .rg_right > p:first-child{
            /*color: #A6A6A6;*/
            font-size: 15px;
        }

        .rg_right p a {
            color: lightyellow;
        }
    </style>
</head>
<body>
    <div class="layui-anim layui-anim-up layui-anim-rotate">
    <div class="rg_layout">
        <div class="rg_title">
            <p >��ӭ���û�ע��</p>
        </div>
        <div class="rg_center">
            <form class="layui-form layui-form-pane" action="../phome/index.php" method="post" onsubmit="return checkAll();">
                <input name="phome" type="hidden" id="phome" value="register">
                <div class="layui-form-item">
                    <label class="layui-form-label">�û���</label>
                    <div class="layui-input-inline">
                        <input type="text" name="username" lay-verify="required" placeholder="�������û���" autocomplete="off" class="layui-input">
                    </div>

                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">����</label>
                    <div class="layui-input-inline">
                        <input type="password" name="password" id="pwd" placeholder="����������" autocomplete="off" class="layui-input" onblur="checkPwd();">
                    </div>
                    <div class="layui-form-mid layui-word-aux" id="check_pwd_one">�������6��20λ</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">�˶�����</label>
                    <div class="layui-input-inline">
                        <input type="password" name="repassword" id="pwd_again" placeholder="��˶�����" autocomplete="off" class="layui-input" onblur="checkPwdAgain()">
                    </div>
                    <div class="layui-form-mid layui-word-aux" id="check_pwd">���������������һ��</div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">����</label>
                    <div class="layui-input-inline">
                        <input type="text" name="email" id="email" placeholder="����������" autocomplete="off" class="layui-input" onblur="checkEmail();">
                    </div>
                    <div class="layui-form-mid layui-word-aux" id="check_email">����</div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">��֤��</label>
                    <div class="layui-input-inline">
                        <input type="text" name="key" id="key" placeholder="��������֤��" autocomplete="off" class="layui-input" onblur="checkEmail();">
                    </div>
                    <img src="../ShowKey?edown">
<!--                    <div class="layui-form-mid layui-word-aux" id="check_email">��֤��</div>-->
                </div>

                <div class="layui-form-item" pane="">
                    <label class="layui-form-label">�Ա�</label>
                    <div class="layui-input-block">
                        <input type="radio" name="userSex" value="��" title="��" checked="" />
                        <input type="radio" name="userSex" value="Ů" title="Ů" />
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="demo1">����ע��</button>
                        <button type="reset" class="layui-btn layui-btn-primary">����</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="rg_right">
            <p>�����˺ţ�<a href="login.php">������¼</a></p>
        </div>
    </div>
</div>
    <script src="../../staticPoj/layui/layui.js"></script>
    <script src="../../staticPoj/jquery.min.js"></script>
    <script>
        layui.use(['form', 'layedit', 'laydate'], function(){
            var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
                ,laydate = layui.laydate;

            //����
            laydate.render({
                elem: '#date'
            });
            laydate.render({
                elem: '#date1'
            });

            //����һ���༭��
            var editIndex = layedit.build('LAY_demo_editor');

            //�Զ�����֤����
            form.verify({
                title: function(value){
                    if(value.length < 5){
                        return '�������ٵ�5���ַ���';
                    }
                }
                ,pass: [
                    /^[\S]{6,12}$/
                    ,'�������6��12λ���Ҳ��ܳ��ֿո�'
                ]
                ,content: function(value){
                    layedit.sync(editIndex);
                }
            });

        });
    </script>
<!--    <script type="text/javascript">-->
<!--        function checkPwd() {-->
<!--            var checkPwd = /^.{6,20}$/;-->
<!--            var pwd = document.getElementById("pwd").value;-->
<!--            var res = checkPwd.test(pwd);-->
<!--            if (res === true && pwd !== null){-->
<!--                document.getElementById("check_pwd_one").innerHTML = "<font color='#0F0'>�̡̡̡̡�</font>";-->
<!--                return true;-->
<!--            }else {-->
<!--                document.getElementById("check_pwd_one").innerHTML = "<font color='#F00'>�������벻�淶��</font>";-->
<!--                return false;-->
<!--            }-->
<!--            // return res;-->
<!--        }-->
<!---->
<!--        function checkEmail() {-->
<!--            var checkEmail = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;-->
<!--            var email = document.getElementById("email").value;-->
<!--            var res =  checkEmail.test(email);-->
<!--            if (res === true){-->
<!--                document.getElementById("check_email").innerHTML = "<font color='#0F0'>�̡̡̡̡�</font>";-->
<!--                return true;-->
<!--            }else {-->
<!--                document.getElementById("check_email").innerHTML = "<font color='#F00'>�����ʽ���淶��</font>";-->
<!--                return false;-->
<!--            }-->
<!--            // return res;-->
<!--        }-->
<!---->
<!--        function checkPwdAgain() {-->
<!--            var pwd = document.getElementById("pwd").value;-->
<!--            var pwdAgain = document.getElementById("pwd_again").value;-->
<!--            if (pwd === pwdAgain && pwd !== null){-->
<!--                document.getElementById("check_pwd").innerHTML = "<font color='#0F0'>�̡̡̡̡�</font>";-->
<!--                return true;-->
<!--            } else {-->
<!--                document.getElementById("check_pwd").innerHTML = "<font color='#F00'>�������벻һ��!</font>";-->
<!--                return false;-->
<!--            }-->
<!--        }-->
<!---->
<!--        function checkAll() {-->
<!--            if (checkPwd() && checkPwdAgain() && checkEmail() ){-->
<!--                alert("��ӭע��");-->
<!--                return true;-->
<!--            }else {-->
<!--                return false;-->
<!--            }-->
<!--        }-->
<!--    </script>-->

</body>
</html>
