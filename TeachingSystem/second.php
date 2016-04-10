<?php
    header("Content-Type:text/html;charset=utf-8");
    //设置系统默认时间
    date_default_timezone_set('Asia/Shanghai');
    function getFileSize($path)
    {
        $size = filesize($path);
        if ($size < 1024) {
            return $size . 'B';
        } else if ($size < 1024 * 1024) {
            return sprintf("%.2f", ($size / 1024)) . 'K';
        } else {
            return sprintf("%.2f", ($size / 1024 / 1024)) . 'M';
        }
    }

    //返回文件创建的时间
    function getFileTime($path)
    {
        return date("Y-m-d H:i", filectime($path));
    }

    //返回文件类型
    function getFileType($path)
    {
        $type = substr(strstr($path, "."), 1);
        return $type;
    }

    //返回文件类型的图片
    function getFileTypeImg($path, $display_type)
    {
        $type = substr(strstr($path, "."), 1);
        switch ($type) {
            case "zip":
                if ($display_type == "list") {
                    return "<img src='images/rar.gif'>";
                } else {
                    return "<img src='images/gird_zip.png'>";
                }

                break;
            case "jpg":
                if ($display_type == "list") {
                    return "<img src='images/jpg.png'>";
                } else {
                    return "<img src='images/gird_doc.png'>";
                }


                break;
            case "txt":
                if ($display_type == "list") {
                    return "<img src='images/txt.png'>";
                } else {
                    return "<img src='images/gird_txt.png'>";
                }

                break;
            case "pdf":
                if ($display_type == "list") {
                    return "<img src='images/pdf.png'>";
                } else {
                    return "<img src='images/gird_pdf.png'>";
                }

                break;
        }

    }


    //存放所有的文件名
    $dirs = array();

    $dir = "home/";//要获取的目录
    //先判断指定的路径是不是一个文件夹
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) != false) {
                //将所有的文件名放入dirs

                //文件名的全路径 包含文件名
                $filePath = $dir . $file;
                if ($file != '.' and $file != '..') {
                    $dirs[] = $file;
                    //    echo $filePath . "<br/>";
                    //filectime返回文件创建的时间
                    //    echo date("Y-m-d H:i", filectime($filePath)) . "<br/>";

                }

            }
            closedir($dh);
        }
    } else {
        echo "这不是目录";
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>bootstrap学习</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="asset/font-awesome/css/font-awesome.min.css">
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row">
    <div class="col-md-10">
        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#uploadModal"
                rel="/build/uploadModal">
            <i class="fa fa-upload"></i> 上传
        </button>

        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#foldModal"><i
                class="fa fa-folder-o"></i> 新建文件夹
        </button>
        <div class="btn-group pull-right">

            <a id="list-switch-on" class="btn btn-default" href="#"><i class="fa fa-bars"></i></a>
            <a id="gird-switch-on" class="btn btn-default" href="#"><i class="fa fa-th-large"></i></a>
        </div>
        <div id="fileListHead">
            <div class="filename col-sm-4" id="up">名称</div>

            <div class="filetype col-sm-2">类型</div>
            <div class="filesize col-sm-2">上传时间</div>
            <div class="filesize col-sm-2">大小</div>


            <div class="fileOperation col-sm-2">操作</div>

            <div style="clear:both"></div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <?php

            echo "<ul id='file-ul' class='file-list file-gird'>";
            foreach ($dirs as $file) {
                $path = $dir . $file;

                echo "<li class='file-item'><span class='col-sm-4 fileName'> " . getFileTypeImg($path, "list") . " ." . $file . "</span>";
                echo "<span class='col-sm-2 fileType'>" . getFileType($path) . "文件</span>";
                echo "<span class='col-sm-2 fileTime'>" . getFileTime($path) . "</span>";
                echo "<span class='col-sm-2 fileSize'>" . getFileSize($path) . "</span>";

                echo "<a href='deleteFile.php?path=" . $path . "'> <button class=\"btn btn-default\" data-path=\"\" type=\"button\" title=\"删除\">删除</button></a>
               <a href='downloadFile.php?path=" . $path . "'> <button class=\"btn btn-default\" data-path=\"\" type=\"button\" title=\"下载\"> 下载</button></a>";

                echo "</li>";


                echo "<div class='file-box'>
                         " . getFileTypeImg($path, "gird") . "<span class='box-title'>" . $file . "</span>
                    </div>";
            }


            echo "</ul>";
        ?>


    </div>

</div>


</div>


<!-- 上传文件的对话框 -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true"> &times; </button>
                <h4 class="modal-title" id="myModalLabel"> 上传新的文件 </h4>
            </div>
            <br>

            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-5">
                    <input id="input_upload" name="input_upload" type="file" class="form-control" placeholder="">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">关闭
                    </button>
                    <button type="submit" class="btn btn-primary"> 确认上传</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
</div>
<!-- 上传文件的对话框结束 -->

<!-- 新建文件夹对话框 -->
<div class="modal fade" id="foldModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true"> &times; </button>
                <h4 class="modal-title" id="ModalLabel"> 在目录下新建一个文件夹 </h4>
            </div>
            <div class="form-group input-height">
                <input type="text" class="form-control" id="foldName" placeholder="请输入文件名">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">关闭
                </button>
                <button type="button" class="btn btn-primary"> 提交更改</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<!--  鼠标右键菜单-->
<div id="item-right-menu" class="right-menu dropdown-menu">
    <li><a href="#">下载</a></li>
    <li><a href="#">删除</a></li>
    <li><a href="#">移动</a></li>
    <li><a href="#">重命名</a></li>
    <li><a href="#">分享</a></li>
</div>

<!-- 上传文件的对话框结束 -->
<script>
    $(document).ready(function () {

        $("#list-switch-on").click(function () {
            $("#fileListHead").css("display", "block");
            $("#file-ul").addClass("file-list");
            $("#file-ul li").css("display", "block");
            $(".file-box").css("display", "none");


        });
        $("#gird-switch-on").click(function () {
            $("#fileListHead").css("display", "none");
            $("#file-ul li").css("display", "none");
            $(".file-box").css("display", "block");
        });

        $("#file-ul").on("contextmenu", ".file-item ,.file-box", function (event) {
            event.stopPropagation();
            $('#item-right-menu').css({
                'display': 'block',
                'top': event.clientY + 'px',
                'left': event.clientX + 'px'
            });
            return false;

        })

        $(document.body).on('click', function () {
            // 页面点击后隐藏右键菜单
            $('#item-right-menu').hide();
        })

    });


</script>
</body>

</html>
