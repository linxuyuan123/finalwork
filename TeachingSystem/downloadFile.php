<?php
    /*
    * 文件下载函数
    */
    header("Content-Type:text/html;charset=utf-8");
    $path = $_GET['path'];
    echo $path;
        echo "准备开始下载文件啦";
        //  $file_name = "xxx.rar";     //下载文件名
        $file_dir = "./up/";        //下载文件存放目录
//检查文件是否存在
        if (!file_exists($path)) {
            echo "文件找不到";
            exit ();
        } else {
            //打开文件
            $file = fopen($path, "r");
            //输入文件标签
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length: " . filesize($path));
            Header("Content-Disposition: attachment; filename=" . $path);
            //输出文件内容
            //读取文件内容并直接输出到浏览器
            echo fread($file, filesize($path));
            fclose($file);
            exit ();
        }


?>