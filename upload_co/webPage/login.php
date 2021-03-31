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
      <title>��¼ҳ��</title>
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
              ��ӭ��¼
          </div>
          <div id="layout_body">

              <form class="layui-form" name="login" action="../phome/index.php" method="post">
                  <input name="ecmsfrom" type="hidden"  value="<?=$from?>">
                  <input name="phome" type="hidden" id="phome" value="login">
                  <div class="layui-form-item">
                      <label class="layui-form-label"><span style="color: #00F7DE">�û���</span></label>
                      <div class="layui-input-inline">
                          <input type="text" id="userId" name="username" required  lay-verify="required" placeholder="�������û���" autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux" id="check_id">�������û���</div>
                  </div>
                  <div class="layui-form-item">
                      <label class="layui-form-label"><span style="color: #00F7DE">����</span></label>
                      <div class="layui-input-inline">
                          <input type="password" id="userPwd" name="password" required lay-verify="required" placeholder="����������" autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux" id="check_pwd">���볤��Ϊ6~20</div>
                  </div>
                  <?php
                  if($public_r['loginkey'])
                  {
                  ?>
                  <div class="layui-form-item">
                      <label class="layui-form-label">��֤��</label>
                      <div class="layui-input-inline">
                          <input type="text" name="key" id="key" placeholder="��������֤��" autocomplete="off" class="layui-input">
                      </div>
                      <img src="../ShowKey?edown">
                      <!--                    <div class="layui-form-mid layui-word-aux" id="check_email">��֤��</div>-->
                  </div>
                      <?php
                  }
                  ?>

                  <input type="submit"  value="��¼" class="layui-btn" style="margin-left: 130px;" />
                  <a href="register.php" class="layui-btn" style="margin-left: 10px;">ע��</a>
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
