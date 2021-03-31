<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../staticPoj/assets/materialize/css/materialize.min.css" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="../../staticPoj/assets/cssm/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="../../staticPoj/assets/cssm/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="../../staticPoj/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="../../staticPoj/assets/cssm/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="../../staticPoj/assets/js/Lightweight-Chart/cssCharts.css">
    <link rel="stylesheet" href="../../staticPoj/layui/css/layui.css">

    <style type="text/css">
        .lay_all{
            /*border: 2px pink solid;*/
            margin-top: 50px;
            margin-left: 110px;
            margin-right: 80px;
            width: 100%;
        }
        .lay_con{
            /*border: 1px red solid;*/
            float: left;
        }
        .lay_writer{
            /*border: 1px #00FF00 solid;*/
            height: 169px;
        }
        .lay_title{
            /*border: 1px black solid;*/
            font-size: 30px;
            color: black;
            /*font-family: "Leelawadee UI Semilight";*/
            /*padding-right: 40px;*/
        }

        .lay_log{
            /*border: 1px gray solid;*/
        }

        .lay_context{
            /*border: 1px blue solid;*/
            height: 110px;
            width: 740px;
        }
    </style>
</head>
<body>
    <nav class="navbar-default navbar-side" role="navigation">
      <div id="hidemenu" onclick="hideMenu()" style="font-size:30px;width:220px;color:#000;height:100px;padding:10px 0px 10px 40px;line-height:100px;font-weight:600;">
      收起侧边栏<</div>
      <div id="showmenu" onclick="showMenu()" style="display:none;font-size:30px;width:220px;color:#000;height:100px;padding:10px 0px 10px 40px;line-height:100px;font-weight:600;">
      展开侧边栏></div>
      <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>一年级</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">一年级（上）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_eight.php?grade_log=first_one&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_eleven.php?grade_log=first_one&sub_log=math" target="manList">数学</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">一年级（下）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_eight.php?grade_log=second_one&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_seven.php?grade_log=second_one&sub_log=math" target="manList">数学</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i> 二年级</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">二年级（上）<</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_eight.php?grade_log=first_two&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=first_two&sub_log=math" target="manList">数学</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">二年级（下）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_eight.php?grade_log=second_two&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_nine.php?grade_log=second_two&sub_log=math" target="manList">数学</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i> 三年级</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">三年级（上）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_eight.php?grade_log=first_three&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=first_three&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=first_three&sub_log=english" target="manList">英语</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">三年级（下）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_eight.php?grade_log=second_three&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_ten.php?grade_log=second_three&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=second_three&sub_log=english" target="manList">英语</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i> 四年级</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">四年级（上）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_eight.php?grade_log=first_four&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_ten.php?grade_log=first_four&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=first_four&sub_log=english" target="manList">英语</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">四年级（下）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList.php?grade_log=second_four&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_nine.php?grade_log=second_four&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=second_four&sub_log=english" target="manList">英语</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i> 五年级</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">五年级（上）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_eight.php?grade_log=first_five&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_ten.php?grade_log=first_five&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=first_five&sub_log=english" target="manList">英语</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">五年级（下）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList.php?grade_log=second_five&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=second_five&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=second_five&sub_log=english" target="manList">英语</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i> 六年级</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">六年级（上）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_eight.php?grade_log=first_six&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_seven.php?grade_log=first_six&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=first_six&sub_log=english" target="manList">英语</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">六年级（下）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList.php?grade_log=second_six&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_nine.php?grade_log=second_six&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=second_six&sub_log=english" target="manList">英语</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i> 七年级</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">七年级（上）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_six.php?grade_log=first_seven&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_six.php?grade_log=first_seven&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=first_seven&sub_log=english" target="manList">英语</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">七年级（下）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_six.php?grade_log=second_seven&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_twelve.php?grade_log=second_seven&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=second_seven&sub_log=english" target="manList">英语</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i> 八年级</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">八年级（上）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_six.php?grade_log=first_eight&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_six.php?grade_log=first_eight&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=first_eight&sub_log=english" target="manList">英语</a>
                            </li>
                            <li>
                                <a href="courseList_five.php?grade_log=first_eight&sub_log=physics" target="manList">物理</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">八年级（下）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_six.php?grade_log=second_eight&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_six.php?grade_log=second_eight&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=second_eight&sub_log=english" target="manList">英语</a>
                            </li>
                            <li>
                                <a href="courseList_five.php?grade_log=second_eight&sub_log=physics" target="manList">物理</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i> 九年级</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">九年级（上）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_six.php?grade_log=first_nine&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_four.php?grade_log=first_nine&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_eight.php?grade_log=first_nine&sub_log=english" target="manList">英语</a>
                            </li>
                            <li>
                                <a href="courseList_four.php?grade_log=first_nine&sub_log=physics" target="manList">物理</a>
                            </li>
                            <li>
                                <a href="courseList_seven.php?grade_log=first_nine&sub_log=chemistry" target="manList">化学</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">九年级（下）</a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="courseList_six.php?grade_log=second_nine&sub_log=chinese" target="manList">语文</a>
                            </li>
                            <li>
                                <a href="courseList_four.php?grade_log=second_nine&sub_log=math" target="manList">数学</a>
                            </li>
                            <li>
                                <a href="courseList_four.php?grade_log=second_nine&sub_log=english" target="manList">英语</a>
                            </li>
                            <li>
                                <a href="courseList_four.php?grade_log=second_nine&sub_log=physics" target="manList">物理</a>
                            </li>
                            <li>
                                <a href="courseList_five.php?grade_log=second_nine&sub_log=chemistry" target="manList">化学</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <script>
      function hideMenu(){
         $("#main-menu").hide();
         $("#hidemenu").hide();
         $("#showmenu").show();
      }
      function showMenu(){
         $("#main-menu").show();
         $("#hidemenu").show();
         $("#showmenu").hide();
      }
    </script>  
    </nav>
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="col-md-12 col-sm-6" style="overflow-y: auto; overflow-x: auto; width: 100%; height: 100%;">
                <div class="card">
                    <div class="card-content">
                        <div class="col">
                            <ul class="tabs">
                                <li class="tab col s3"><a style="font-size:28px;" href="#test1">第一单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test2">第二单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test3">第三单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test4">第四单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test5">第五单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test6">第六单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test7">第七单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test8">第八单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test9">第九单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test10">第十单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test11">第十一单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test12">第十二单元</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test13">专题训练</a></li>
                                <li class="tab col s3"><a style="font-size:28px;" href="#test14">复习测试</a></li>
                            </ul>
                        </div>
                        <div class="clearBoth"><br/></div>
                        <div id="test1" class="col s12">
                            <?php
                            include('../phpPage/class/connect.php');
                            $gradeLog = $_GET["grade_log"];
                            $subLog = $_GET["sub_log"];
                            $sql1 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_one' ORDER BY course_upload_time";

                            $mysqli_result1 = $conn->query($sql1);
                            if ($mysqli_result1 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row1 = $mysqli_result1->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title" style="font-size:28px;" >
                                            <?php
                                            $query1 =array(
                                                'courseId' => $row1['course_id']
                                            );
                                            $url1 = 'downloadPage.php?'.http_build_query($query1);
                                            ?>
                                            <a href="<?php echo $url1; ?>"><?php echo $row1['course_name'];?></a>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 26px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row1['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row1['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row1['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 26px; color: grey">
                                                <?php echo $row1['course_intro'];?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row1['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test2" class="col s12">
                            <?php
                            $sql2 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_two' ORDER BY course_upload_time";

                            $mysqli_result2 = $conn->query($sql2);
                            if ($mysqli_result2 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row2 = $mysqli_result2->fetch_array(MYSQLI_ASSOC)){

                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <?php
                                            $query2 =array(
                                                'courseId' => $row2['course_id']
                                            );
                                            $url2 = 'downloadPage.php?'.http_build_query($query2);
                                            ?>
                                            <a href="<?php echo $url2; ?>"><?php echo $row2['course_name'];?></a>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row2['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row2['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row2['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row2['course_intro'];?>
                                            </div>



                                            <!--                                            <div style="padding-left: 600px; margin-top: 5px">-->
                                            <!--                                                <button type="button" class="layui-btn layui-btn-normal"><a-->
                                            <!--                                                            style="color: #00FFFF" href="--><?php //echo $url2; ?><!--">查看详情</a>-->
                                            <!--                                                </button>-->
                                            <!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row2['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test3" class="col s12">
                            <?php
                            $sql3 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_three' ORDER BY course_upload_time";

                            $mysqli_result3 = $conn->query($sql3);
                            if ($mysqli_result3 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row3 = $mysqli_result3->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <div class="lay_title">
                                                <?php
                                                $query3 =array(
                                                    'courseId' => $row3['course_id']
                                                );
                                                $url3 = 'downloadPage.php?'.http_build_query($query3);
                                                ?>
                                                <a href="<?php echo $url3; ?>"><?php echo $row3['course_name'];?></a>
                                            </div>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row3['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row3['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row3['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row3['course_intro'];?>
                                            </div>

                                            <!--                                            --><?php
                                            //                                            $query3 =array(
                                            //                                                'courseId' => $row3['course_id']
                                            //                                            );
                                            //                                            $url3 = 'downloadPage.php?'.http_build_query($query3);
                                            //                                            ?>
                                            <!---->
                                            <!--                                            <div style="padding-left: 600px; margin-top: 5px">-->
                                            <!--                                                <button type="button" class="layui-btn layui-btn-normal"><a-->
                                            <!--                                                            style="color: #00FFFF" href="--><?php //echo $url3; ?><!--">查看详情</a>-->
                                            <!--                                                </button>-->
                                            <!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row3['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test4" class="col s12">
                            <?php
                            $sql4 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_four' ORDER BY course_upload_time";

                            $mysqli_result4 = $conn->query($sql4);
                            if ($mysqli_result4 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row4 = $mysqli_result4->fetch_array(MYSQLI_ASSOC)){

                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <div class="lay_title">
                                                <?php
                                                $query4 =array(
                                                    'courseId' => $row4['course_id']
                                                );
                                                $url4 = 'downloadPage.php?'.http_build_query($query4);
                                                ?>
                                                <a href="<?php echo $url4; ?>"><?php echo $row4['course_name'];?></a>
                                            </div>
                                            <!--                                            --><?php //echo $row4['course_name'];?>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row4['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row4['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row4['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row4['course_intro'];?>
                                            </div>

                                            <!--                                            --><?php
                                            //                                            $query4 =array(
                                            //                                                'courseId' => $row4['course_id']
                                            //                                            );
                                            //                                            $url4 = 'downloadPage.php?'.http_build_query($query4);
                                            //                                            ?>
                                            <!---->
                                            <!--                                            <div style="padding-left: 600px; margin-top: 5px">-->
                                            <!--                                                <button type="button" class="layui-btn layui-btn-normal"><a-->
                                            <!--                                                            style="color: #00FFFF" href="--><?php //echo $url4; ?><!--">查看详情</a>-->
                                            <!--                                                </button>-->
                                            <!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row4['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test5" class="col s12">
                            <?php
                            $sql5 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_five' ORDER BY course_upload_time";

                            $mysqli_result5 = $conn->query($sql5);
                            if ($mysqli_result5 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row5 = $mysqli_result5->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <div class="lay_title">
                                                <?php
                                                $query5 =array(
                                                    'courseId' => $row5['course_id']
                                                );
                                                $url5 = 'downloadPage.php?'.http_build_query($query5);
                                                ?>
                                                <a href="<?php echo $url5; ?>"><?php echo $row5['course_name'];?></a>
                                            </div>
                                            <!--                                            --><?php //echo $row5['course_name'];?>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row5['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row5['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row5['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row5['course_intro'];?>
                                            </div>

                                            <!--                                            --><?php
                                            //                                            $query5 =array(
                                            //                                                'courseId' => $row5['course_id']
                                            //                                            );
                                            //                                            $url5 = 'downloadPage.php?'.http_build_query($query5);
                                            //                                            ?>
                                            <!---->
                                            <!--                                            <div style="padding-left: 600px; margin-top: 5px">-->
                                            <!--                                                <button type="button" class="layui-btn layui-btn-normal"><a-->
                                            <!--                                                            style="color: #00FFFF" href="--><?php //echo $url5; ?><!--">查看详情</a>-->
                                            <!--                                                </button>-->
                                            <!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row5['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test6" class="col s12">
                            <?php
                            $sql6 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_six' ORDER BY course_upload_time";

                            $mysqli_result6 = $conn->query($sql6);
                            if ($mysqli_result6 === false){
                                echo "SQL错误";
                                exit;
                            }
                            //                            $rows = [];
                            while($row6 = $mysqli_result6->fetch_array(MYSQLI_ASSOC)){
//                                $rows[] = $row;
//                            }
//                            foreach ($rows as $row1) {
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <div class="lay_title">
                                                <?php
                                                $query6 =array(
                                                    'courseId' => $row6['course_id']
                                                );
                                                $url6 = 'downloadPage.php?'.http_build_query($query6);
                                                ?>
                                                <a href="<?php echo $url6; ?>"><?php echo $row6['course_name'];?></a>
                                            </div>
                                            <!--                                            --><?php //echo $row6['course_name'];?>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row6['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row6['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row6['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row6['course_intro'];?>
                                            </div>

                                            <!--                                            --><?php
                                            //                                            $query6 =array(
                                            //                                                'courseId' => $row6['course_id']
                                            //                                            );
                                            //                                            $url6 = 'downloadPage.php?'.http_build_query($query6);
                                            //                                            ?>
                                            <!---->
                                            <!--                                            <div style="padding-left: 600px; margin-top: 5px">-->
                                            <!--                                                <button type="button" class="layui-btn layui-btn-normal"><a-->
                                            <!--                                                            style="color: #00FFFF" href="--><?php //echo $url6; ?><!--">查看详情</a>-->
                                            <!--                                                </button>-->
                                            <!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row6['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test7" class="col s12">
                            <?php
                            $sql7 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_seven' ORDER BY course_upload_time";

                            $mysqli_result7 = $conn->query($sql7);
                            if ($mysqli_result7 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row7 = $mysqli_result7->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <div class="lay_title">
                                                <?php
                                                $query7 =array(
                                                    'courseId' => $row7['course_id']
                                                );
                                                $url7 = 'downloadPage.php?'.http_build_query($query7);
                                                ?>
                                                <a href="<?php echo $url7; ?>"><?php echo $row7['course_name'];?></a>
                                            </div>
                                            <!--                                            --><?php //echo $row7['course_name'];?>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row7['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row7['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row7['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row7['course_intro'];?>
                                            </div>

                                            <!--                                            --><?php
                                            //                                            $query7 =array(
                                            //                                                'courseId' => $row7['course_id']
                                            //                                            );
                                            //                                            $url7 = 'downloadPage.php?'.http_build_query($query7);
                                            //                                            ?>
                                            <!---->
                                            <!--                                            <div style="padding-left: 600px; margin-top: 5px">-->
                                            <!--                                                <button type="button" class="layui-btn layui-btn-normal"><a-->
                                            <!--                                                            style="color: #00FFFF" href="--><?php //echo $url7; ?><!--">查看详情</a>-->
                                            <!--                                                </button>-->
                                            <!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row7['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test8" class="col s12">
                            <?php
                            $sql8 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_eight' ORDER BY course_upload_time";

                            $mysqli_result8 = $conn->query($sql8);
                            if ($mysqli_result8 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row8 = $mysqli_result8->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <div class="lay_title">
                                                <?php
                                                $query8 =array(
                                                    'courseId' => $row8['course_id']
                                                );
                                                $url8 = 'downloadPage.php?'.http_build_query($query8);
                                                ?>
                                                <a href="<?php echo $url8; ?>"><?php echo $row8['course_name'];?></a>
                                            </div>
                                            <!--                                            --><?php //echo $row8['course_name'];?>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row8['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row8['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row8['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row8['course_intro'];?>
                                            </div>

                                            <!--                                            --><?php
                                            //                                            $query8 =array(
                                            //                                                'courseId' => $row8['course_id']
                                            //                                            );
                                            //                                            $url8 = 'downloadPage.php?'.http_build_query($query8);
                                            //                                            ?>
                                            <!---->
                                            <!--                                            <div style="padding-left: 600px; margin-top: 5px">-->
                                            <!--                                                <button type="button" class="layui-btn layui-btn-normal"><a-->
                                            <!--                                                            style="color: #00FFFF" href="--><?php //echo $url8; ?><!--">查看详情</a>-->
                                            <!--                                                </button>-->
                                            <!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row8['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test9" class="col s12">
                            <?php
                            $sql9 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_nine' ORDER BY course_upload_time DESC";

                            $mysqli_result9 = $conn->query($sql9);
                            if ($mysqli_result9 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row9 = $mysqli_result9->fetch_array(MYSQLI_ASSOC)){

                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <?php
                                            $query9 =array(
                                                'courseId' => $row9['course_id']
                                            );
                                            $url9 = 'downloadPage.php?'.http_build_query($query9);
                                            ?>
                                            <a href="<?php echo $url9; ?>"><?php echo $row9['course_name'];?></a>
<!--                                            --><?php //echo $row9['course_name'];?>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row9['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row9['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row9['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row9['course_intro'];?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row9['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test10" class="col s12">
                            <?php
                            $sql10 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_ten' ORDER BY course_upload_time DESC";

                            $mysqli_result10 = $conn->query($sql10);
                            if ($mysqli_result10 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row10 = $mysqli_result10->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <?php
                                            $query10 =array(
                                                'courseId' => $row10['course_id']
                                            );
                                            $url10 = 'downloadPage.php?'.http_build_query($query10);
                                            ?>
                                            <a href="<?php echo $url10; ?>"><?php echo $row10['course_name'];?></a>
<!--                                            --><?php //echo $row10['course_name'];?>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row10['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row10['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row10['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row10['course_intro'];?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row10['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test11" class="col s12">
                            <?php
                            $sql11 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_eleven' ORDER BY course_upload_time DESC";

                            $mysqli_result11 = $conn->query($sql11);
                            if ($mysqli_result === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row11 = $mysqli_result11->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <?php
                                            $query11 =array(
                                                'courseId' => $row11['course_id']
                                            );
                                            $url11 = 'downloadPage.php?'.http_build_query($query11);
                                            ?>
                                            <a href="<?php echo $url11; ?>"><?php echo $row11['course_name'];?></a>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row11['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row11['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row11['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row11['course_intro'];?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row11['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test12" class="col s12">
                            <?php
                            $sql12 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'unit_twelve' ORDER BY course_upload_time DESC";

                            $mysqli_result12 = $conn->query($sql12);
                            if ($mysqli_result12 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row12 = $mysqli_result12->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <?php
                                            $query12 =array(
                                                'courseId' => $row12['course_id']
                                            );
                                            $url12 = 'downloadPage.php?'.http_build_query($query12);
                                            ?>
                                            <a href="<?php echo $url12; ?>"><?php echo $row12['course_name'];?></a>
<!--                                            --><?php //echo $row12['course_name'];?>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row12['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row12['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row12['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: #00F7DE">
                                                <?php echo $row12['course_intro'];?>
                                            </div>

<!--                                            --><?php
//                                            $query12 =array(
//                                                'courseId' => $row12['course_id']
//                                            );
//                                            $url12 = 'downloadPage.php?'.http_build_query($query);
//                                            ?>
<!---->
<!--                                            <div style="padding-left: 600px; margin-top: 5px">-->
<!--                                                <button type="button" class="layui-btn layui-btn-normal"><a-->
<!--                                                            style="color: #00FFFF" href="--><?php //echo $url12; ?><!--">查看详情</a>-->
<!--                                                </button>-->
<!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row12['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test13" class="col s12">
                            <?php
                            $sql13 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'special_training' ORDER BY course_upload_time";

                            $mysqli_result13 = $conn->query($sql13);
                            if ($mysqli_result13 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row13 = $mysqli_result13->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <?php
                                            $query13 =array(
                                                'courseId' => $row13['course_id']
                                            );
                                            $url13 = 'downloadPage2.php?'.http_build_query($query13);
                                            ?>
                                            <a href="<?php echo $url13; ?>"><?php echo $row13['course_name'];?></a>
<!--                                            --><?php //echo $row13['course_name'];?>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row13['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row13['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row13['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row13['course_intro'];?>
                                            </div>

<!--                                            --><?php
//                                            $query13 =array(
//                                                'courseId' => $row13['course_id']
//                                            );
//                                            $url13 = 'downloadPage.php?'.http_build_query($query13);
//                                            ?>
<!---->
<!--                                            <div style="padding-left: 600px; margin-top: 5px">-->
<!--                                                <button type="button" class="layui-btn layui-btn-normal"><a-->
<!--                                                            style="color: #00FFFF" href="--><?php //echo $url13; ?><!--">查看详情</a>-->
<!--                                                </button>-->
<!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row13['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="test14" class="col s12">
                            <?php
                            $sql14 = "SELECT * FROM ccxm_course WHERE grade_log='{$gradeLog}' AND sub_log = '{$subLog}' AND unit_log = 'synthetic_test' ORDER BY course_upload_time";

                            $mysqli_result14 = $conn->query($sql14);
                            if ($mysqli_result14 === false){
                                echo "SQL错误";
                                exit;
                            }
                            while($row14 = $mysqli_result14->fetch_array(MYSQLI_ASSOC)){
                                ?>
                                <div class="col-md-12 col-sm-6 card lay_all" style="margin-left: 0">
                                    <div class="lay_con">
                                        <div class="lay_title">
                                            <?php
                                            $query14 =array(
                                                'courseId' => $row14['course_id']
                                            );
                                            $url14 = 'downloadPage2.php?'.http_build_query($query14);
                                            ?>
                                            <a href="<?php echo $url14; ?>"><?php echo $row14['course_name'];?></a>
<!--                                            --><?php //echo $row14['course_name'];?>
                                        </div>
                                        <div class="lay_log" style="color: grey; font-size: 20px;">
                                            <table>
                                                <tr>
                                                    上传时间:
                                                </tr>
                                                <?php echo $row14['course_upload_time'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    浏览次数:
                                                </tr>
                                                <?php echo $row14['course_read_times'];?>
                                                <span style="color: lightseagreen">|</span>&nbsp;
                                                <tr>
                                                    标签:
                                                </tr>
                                                <?php echo $row14['course_label'];?>
                                            </table>
                                        </div>

                                        <div class="lay_context">

                                            <div style="font-size: 16px; color: grey">
                                                <?php echo $row14['course_intro'];?>
                                            </div>

<!--                                            --><?php
//                                            $query14 =array(
//                                                'courseId' => $row14['course_id']
//                                            );
//                                            $url14 = 'downloadPage.php?'.http_build_query($query14);
//                                            ?>
<!---->
<!--                                            <div style="padding-left: 600px; margin-top: 5px">-->
<!--                                                <button type="button" class="layui-btn layui-btn-normal"><a-->
<!--                                                            style="color: #00FFFF" href="--><?php //echo $url14; ?><!--">查看详情</a>-->
<!--                                                </button>-->
<!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="lay_writer">
                                        <img src="../imgs/erha11.png" class="layui-nav-img"><br/>

                                        <div style="margin-left:680px; font-size: 16px; color: lightseagreen">
                                            <?php echo $row14['course_teacher'];?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="clearBoth"><br/></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script src="../../staticPoj/layui/layui.js"></script>
<script src="../../staticPoj/assets/js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="../../staticPoj/assets/js/bootstrap.min.js"></script>
<script src="../../staticPoj/assets/materialize/js/materialize.min.js"></script>
<!-- Metis Menu Js -->
<script src="../../staticPoj/assets/js/jquery.metisMenu.js"></script>
<!-- Morris Chart Js -->
<script src="../../staticPoj/assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="../../staticPoj/assets/js/morris/morris.js"></script>
<script src="../../staticPoj/assets/js/easypiechart.js"></script>
<script src="../../staticPoj/assets/js/easypiechart-data.js"></script>
<script src="../../staticPoj/assets/js/Lightweight-Chart/jquery.chart.js"></script>
<!-- Custom Js -->
<script src="../../staticPoj/assets/js/custom-scripts.js"></script>
</body>
</html>
