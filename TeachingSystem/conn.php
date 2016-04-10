<?php
    /**
     * 数据库连接公共类
     */

    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $db = "dbteachingsystem";

    // 创建连接
    $conn = new mysqli($servername, $username, $password, $db);

    /* 设置编码，注意是utf8 而不是utf-8 */
    $conn->set_charset("utf8");

    // 检测连接
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>