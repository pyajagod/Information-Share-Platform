<?php
require('../class/connect.php');
include("../data/cache/public.php");
include('../class/user.php');
if($eloginurl)
{
    Header("Location:$eloginurl");
    exit();
}
$from=$_GET['from'];
?>
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <title>登录页面</title>
      <link rel="stylesheet" href="../../staticPoj/layui/css/layui.css" />
      <style type="text/css">
          body{
              /*background: url('statics/images/backk.jpg');*/
              background-size: 1580px 800px;

          }
          #layout_all{
              border: 6px lightgray solid;
              margin-top: 180px;
              margin-left: 10%;
              margin-right: 150px;
              background-color: rgba(220, 38, 0, 0.1);
          }
          #layout_title{
              /*border: 1px black solid;*/
              font-size: 30px;
              color: white;
              padding-left: 43%;
              margin-top: 20px;
          }
          #layout_body{
              /*border: 1px red solid ;*/
              height: 230px;
              margin-top: 20px;
              padding-top: 10px;
              padding-left: 30%;
          }
      </style>
  </head>
  <body>
    <div class="layui-anim layui-anim-up layui-anim-rotate">
      <div id="layout_all">
          <div id="layout_title">
              欢迎登录
          </div>
          <div id="layout_body">

              <form class="layui-form" name="login" action="../phome/index.php" method="post">
                  <input name="ecmsfrom" type="hidden"  value="<?=$from?>">
                  <input name="phome" type="hidden" id="phome" value="login">
                  <div class="layui-form-item">
                      <label class="layui-form-label"><span style="color: #00F7DE">用户名</span></label>
                      <div class="layui-input-inline">
                          <input type="text" id="userId" name="username" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux" id="check_id">请输入用户名</div>
                  </div>
                  <div class="layui-form-item">
                      <label class="layui-form-label"><span style="color: #00F7DE">密码</span></label>
                      <div class="layui-input-inline">
                          <input type="password" id="userPwd" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux" id="check_pwd">密码长度为6~20</div>
                  </div>
                  <?php
                  if($public_r['loginkey'])
                  {
                  ?>
                  <div class="layui-form-item">
                      <label class="layui-form-label">验证码</label>
                      <div class="layui-input-inline">
                          <input type="text" name="key" id="key" placeholder="请输入验证码" autocomplete="off" class="layui-input">
                      </div>
                      <img src="../ShowKey?edown">
                      <!--                    <div class="layui-form-mid layui-word-aux" id="check_email">验证码</div>-->
                  </div>
                      <?php
                  }
                  ?>

                  <input type="submit"  value="登录" class="layui-btn" style="margin-left: 130px;" />
                  <a href="register.php" class="layui-btn" style="margin-left: 10px;">注册</a>
              </form>
          </div>
      </div>
  </div>

    <script src="../../staticPoj/layui/layui.js" charset="utf-8"></script>
    <script src="../../staticPoj/jquery.min.js"></script>
    <script>
        $("#Verify").click(function () {
            $(this).attr("src", "SecurityCodeImageAction.action?timestamp=" + new Date().getTime());
        });
        function reloadImage(t) {
            t.src="findImage?flag="+Math.random();
        }
    </script>
  </body>
</html>
