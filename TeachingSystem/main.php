<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
   
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>欢迎使用教学资源管理系统</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <style>
        .panel {
            min-height: 100px !important;
        }

        .second-panel {
            padding: 0 !important;
            border: 0 !important;
        }
    </style>
</head>
<body>

<div class="index-header">
    <p>教学资源管理系统</p>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        当前状态
                    </h3>
                </div>
                <div class="panel-body second-panel">

                    <ul class="nav left-nav" role="navigation">

                        <li><a>用户名：<?php echo $_SESSION['user']; ?></a></li>
                        <li><a>类型: <?php echo $_SESSION['loginType']; ?></a></li>

                    </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        相关功能
                    </h3>
                </div>
                <div class="panel-body second-panel">
                    <ul class="nav left-nav" role="navigation">
                        <li onclick="a('first.php');" class="active"><a>用户管理</a></li>
                        <li onclick="a('OnlineQuestion.php');"><a>在线问答</a></li>
                        <li onclick="a('second.php');"><a href="#">文件管理</a></li>
                        <li onclick="a('personal.php');"><a href="#">个人中心</a></li>
                        <li onclick="a('updatePassword.php');"><a href="#">修改密码</a></li>
                        <li onclick="a('logout.php');"><a href="#">退出登录</a></li>
                    </ul>
                </div>
            </div>


            <br>


        </div>
        <div class="col-md-10">
            <iframe src="first.php" name="frm" id="frm" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
</div>
<footer>
    <p>版权所有，盗版必究</p>

</footer>
</body>
<script>
    function a(surl) {
        var s = document.getElementById("frm");
        s.src = surl;
    }
</script>
</html>
