<?php
    $host = '114.115.175.207';
    $username = 'root';
    $password = 'ccxm';
    $dbname = 'empiredown';

    $conn = new mysqli($host, $username, $password, $dbname);
    //        var_dump($conn);

    if ($conn->connect_error <> 0){
        echo "����ʧ��";
        echo $conn->connect_error;
        exit;
    }
    //�趨���ݿ⴫��ı���
    $conn->query("SET NAMES UTF8");
