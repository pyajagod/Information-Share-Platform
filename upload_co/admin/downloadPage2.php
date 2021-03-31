
<?php
    include("../class/connect.php");
    include('../phpPage/class/connect.php');
    $myuserid=(int)getcvar('memberuserid');
    $conn->query("SET NAMES GBK");
//    echo $myuserid;
    $courseId = $_GET['courseId'];
    $sql = "SELECT * FROM ccxm_course WHERE course_id = {$courseId}";
    $readTimes = "UPDATE ccxm_course SET `course_read_times` = `course_read_times` + 1 WHERE course_id = {$courseId}";
    $update_times = $conn->query($readTimes);
    if ($update_times == false){
        echo "SQL错误";
        exit;
    }
    $mysqli_result = $conn->query($sql);
    if ($mysqli_result === false){
        echo "SQL错误";
        exit;
    }
//    $rows = [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="GBK">
    <title>课程下载页面</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../staticPoj/assets/materialize/css/materialize.min.css" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="../../staticPoj/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="../../staticPoj/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="../../staticPoj/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="../../staticPoj/assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="../../staticPoj/assets/js/Lightweight-Chart/cssCharts.css">
    <link rel="stylesheet" href="../../staticPoj/layui/css/layui.css">
    <style type="text/css">
        .lay_all{
            /*border: 1px solid black;*/
            height: 100%;
            width: 100%;
        }
        .lay_title{
            /*border: 1px solid red;*/
            height: 150px;
            margin-left: 3%;
        }
        .lay_intro{
            /*border: 1px solid blue;*/
            /*padding-top: 50px;*/
            margin-left: 3%;
            font-size: 20px;
        }
        .lay_down{
            /*border: 1px solid pink;*/
        }
        .lay_ex{
            font-size: 20px;
            color: red;
        }
    </style>
</head>
<body style="background-color: white">
</h1>
<ol class="breadcrumb" style="font-size: 14px">
    <li><a onclick="goback()">返回上一页</a></li>
    <li class="active">下载</li>
</ol>
<div class="lay_all">
        <div class="lay_title card col-md-10">
            <div style="float: left">
                <img src="../imgs/erha1.png" style="height: 100px; width: 120px"/>
            </div>
            <?php
            while($row = $mysqli_result->fetch_array(MYSQLI_ASSOC)){
            //        $rows[] = $row;

            ?>
                <div style="margin-left: 20px">
                    <span style="font-size: 30px"><?php echo $row['course_name']?></span>
                    <br/>
                    <span style="font-size: 18px">分类栏目：<?php echo $row['course_label']?></span>
                    <br/>
                    <span style="font-size: 18px">下载说明：请选择合适的视频开始下载</span>
                </div>
                </div>
                <div class="lay_intro card col-md-10">
                    <?php echo $row['course_intro']?>
                </div>

            <?php
            }
            ?>
        <div class="lay_down">
            <div id="page-inner">
                <div class="col-md-11 col-sm-6">
                    <div class="card">
                        <div class="card-action">

                        </div>
                        <div class="card-content">
                            <div class="col">
                                <ul class="tabs">
                                    <li class="tab col s3"><a href="#test1">基础</a></li>
                                    <li class="tab col s3"><a href="#test2">提高</a></li>
                                    <li class="tab col s3"><a href="#test3">超越</a></li>
<!--                                    <li class="tab col s3"><a href="#test4">所有视频</a></li>-->
                                </ul>
                            </div>
                            <div class="clearBoth"><br/></div>
                            <div id="test1" class="col s12">
                                <?php
                                    $sql = "SELECT * FROM ccxm_path WHERE course_id = {$courseId} AND cate_log = 'preview' ";
                                    $mysqli_result = $conn->query($sql);
                                    if ($mysqli_result === false){
                                        echo "SQL错误";
                                        exit;
                                    }

                                    while ($row = $mysqli_result->fetch_array(MYSQLI_ASSOC)) {
                                        $query = array(
                                            'path_id' => $row['path_id']
                                        );
                                        $url = '../DownVideo/index.php?' . http_build_query($query);

                                        ?>
                                        <button type="button" class="layui-btn layui-btn-warm"><a href="<?php echo $url;?>">预习视频</a></button>
                                        <span class="lay_ex">
                                            下载需要点数：<?php echo $row['path_need_point'] ?>点
                                        </span><br/><br/>
                                        <?php
                                    }
                                    ?>
                            </div>
                            <div id="test2" class="col s12">
                                <?php
                                $sql1 = "SELECT * FROM ccxm_path WHERE course_id = {$courseId} AND cate_log = 'review' ";
                                $mysqli_result1 = $conn->query($sql1);
                                if ($mysqli_result1 === false){
                                    echo "SQL错误";
                                    exit;
                                }

                                while ($row1 = $mysqli_result1->fetch_array(MYSQLI_ASSOC)) {

                                    $query1 = array(
                                        'path_id' => $row1['path_id']
                                    );
                                    $url1 = '../DownVideo/index.php?' . http_build_query($query1);
                                    ?>
                                    <button type="button" class="layui-btn layui-btn-warm"><a href="<?php echo $url1;?>">复习视频</a></button>
                                    <span class="lay_ex">
                                            下载需要点数：<?php echo $row1['path_need_point'] ?>点
<!--                                            路径：--><?php //echo $row1['path_id'] ?>
                                        </span><br/><br/>
                                    <?php
                                }
                                ?>
                            </div>
                            <div id="test3" class="col s12">
                                <?php
                                $sql2 = "SELECT * FROM ccxm_path WHERE course_id = {$courseId} AND cate_log = 'study' ";
                                $mysqli_result2 = $conn->query($sql2);
                                if ($mysqli_result2 === false){
                                    echo "SQL错误";
                                    exit;
                                }

                                while ($row2 = $mysqli_result2->fetch_array(MYSQLI_ASSOC)) {

                                    $query2 = array(
                                        'path_id' => $row2['path_id']
                                    );
                                    $url2 = '../DownVideo/index.php?' . http_build_query($query2);
                                    ?>
<!--                                    <button type="button" class="layui-btn layui-btn-warm">扩展视频</button>-->
                                    <button type="button" class="layui-btn layui-btn-warm"><a  href="<?php echo $url2;?>">扩展视频</a></button>
                                    <span class="lay_ex">
                                            下载需要点数：<?php echo $row2['path_need_point'] ?>点
<!--                                            路径：--><?php //echo $row2['path_id'] ?>
                                        </span><br/><br/>
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

<script>
    function goback() {
        window.history.go(-1);
    }
    //function down() {
    //    var is = confirm("您是否下载此视频？");
    //    if (is){
    //        window.location.href = "<?php //echo $url2;?>//"
    //    }
    //}
</script>
</body>
</html>