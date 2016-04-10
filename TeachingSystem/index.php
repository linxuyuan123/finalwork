<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>登陆页面</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<img class="background" src="images/40047.jpg">
<div class="">
    <div class="container">
        <div class="row">
            <div class="sigin-div">
                <p class="sigin-title"><strong>教学管理系统</strong></p>

                <div class="form-group input-height">
                    <input type="text" class="form-control" id="username" name="username" placeholder="账号">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="密码">
                </div>
                <div class="form-group checkbox-group">
                    <input name="radioGroup" type="radio" value="系统管理员">
                    系统管理员 &nbsp;&nbsp;
                    <input name="radioGroup" type="radio" value="教师">
                    教师 &nbsp;&nbsp;
                    <input name="radioGroup" type="radio" value="学生">
                    学生

                </div>
                <div class="form-group sub">
                    <button id="btn_login" type="submit" class="btn btn-primary btn-submit "
                            onclick="chk_ajax_login_with_php()">登录
                    </button>

                    <p class="pull-right" style="line-height:34px; color:#000000"><a
                            href="regeister.html">还没有账号，立即注册</a></p>
                </div>

            </div>
        </div>

    </div>
    <div class="copyright">
        Copyright © 2013-2016 林旭源 All Rights Reserved.
    </div>
</div>
<script>
    function chk_ajax_login_with_php() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var identify = document.getElementsByName("radioGroup");


        if (username == "") {
            $('<div id="msg" />').html("用户名不能为空！").appendTo('.sub').fadeOut(2000);
            $("#username").focus();
            return false;
        }
        if (password == "") {
            $('<div id="msg" />').html("密码不能为空！").appendTo('.sub').fadeOut(2000);
            $("#password").focus();
            return false;
        }
        var identifyChecked;
        for (var i = 0; i < 3; i++) {
            if (identify[i].checked == true) {
                identifyChecked = identify[i].value;
            }
        }
        if (identifyChecked == null) {
            $('<div id="msg" />').html("选择登陆类型！").appendTo('.sub').fadeOut(2000);
            $("#password").focus();
            return false;

        }

        $.ajax({
            type: "POST",
            url: "logincheck.php",
            dataType: "json",
            data: {"username": username, "password": password, "radioGroup": identifyChecked},
            beforeSend: function () {
                $('<div id="msg" />').addClass("loading").html("正在登录...").css("color", "#999")
                    .appendTo('.sub');
            },
            success: function (json) {
                if (json.success == 1) {
                    //  alert(json.loginType + "登陆成功");
                    window.location = "main.php";

                } else {
                    $("#msg").remove();
                    alert("账号或密码错误");
                }

                //   window.location = "main.php"


            },
            error: function (jqXHR, textStatus, errorThrown) {
                /*错误信息处理*/
                alert("错误信息".textStatus);
            }
        });
    }

</script>
</body>
</html>
