<?php
    include ("../class/connect.php");
    $conn->query("SET NAMES GBK");
    $grade = $_POST['grade'];
//    $team = $_POST['ud'];
    $unit = $_POST['unit'];
    $subject = $_POST['subject'];
//    $label = $_POST['label'];
    $courseName = $_POST['courseName'];
    $courseTeacher = $_POST['teacher'];
    $pathIntro = $_POST['intro'];
    $cate = $_POST['cate'];
    $points = $_POST['points'];
//    $uploadTime = $_POST['uptime'];
    $address = $_POST['address'];
    $password = $_POST['password'];

//    $grade_id = $team."_".$grade;
    $uploadTime = date('Y-m-d H:i:s', time());
//    echo $uploadTime;

    echo $courseName;
    $selectCourse = "SELECT * FROM `ccxm_course` WHERE `course_name` = '{$courseName}'";
    $isExit = $conn->query($selectCourse);
//    $count = $isExit->num_rows;
    if ($isExit == false){
        echo "此课程不存在";
        exit;
    }else {

//    $selectCourse2 = "SELECT * FROM `ccxm_course` WHERE `course_name` = '{$courseName}'";
        $getData = $conn->query($selectCourse);
        $data = mysqli_fetch_assoc($getData);
        $dataId = $data['course_id'];

        $choosePath = "SELECT * FROM `ccxm_path` WHERE `course_id` = '{$dataId}' AND `path_address` = '{$address}' AND `cate_log` = '{$cate}'";
        $isPathExit = $conn->query($choosePath);
        $num = $isPathExit->num_rows;
        if ($num == 0) {
            $addPath = "INSERT INTO `ccxm_path` (`path_address`, `path_password`, `path_intro`, `cate_log`, `path_need_point`, `course_id`) VALUES ('{$address}', '{$password}', '{$pathIntro}', '{$cate}', '{$points}', '{$dataId}')";
            $isSus = $conn->query($addPath);
            if ($isSus == false) {
                echo "SQL错误";
                exit;
            }

            $tishi = "视频上传成功";
            header("Location:dataExit.php?tishi=" . $tishi);
        } else {
            $tishi2 = "视频上传失败，2秒后请重新录入";
            header("Location:dataExit.php?tishi=" . $tishi);
        }
    }




