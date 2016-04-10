<?php
    /**
     * 删除文件
     */
    header("Content-Type:text/html;charset=utf-8");
    $path = $_GET['path'];
    if (!unlink($path))
    {
        echo ("删除文件失败 $path");
    }
    else
    {
        echo ("成功删除文件 $path");
    }
?>