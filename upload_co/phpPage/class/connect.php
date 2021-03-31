<?php
    $host = '114.115.175.207';
    $username = 'root';
    $password = 'ccxm';
    $dbname = 'empiredown';

    $conn = new mysqli($host, $username, $password, $dbname);
    //        var_dump($conn);

    if ($conn->connect_error <> 0){
        echo "连接失败";
        echo $conn->connect_error;
        exit;
    }
    //设定数据库传输的编码
    $conn->query("SET NAMES UTF8");
