<!DOCTYPE html>
<html lang="zh-CN">
<head>
   
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>bootstrap学习</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row">
    <div class="col-sm-10">
        <?php
            $question_id = $_REQUEST['question_id'];
            include("conn.php");  //引入数据库连接代码
            $sql = "SELECT * FROM tb_answer where question_id =" . $question_id;
            //  echo $sql;
            $result = $conn->query($sql);
            $info = $result->fetch_array();
            $answerNum = $result->num_rows;
            //查询显示问题
            $sql_question = "select * from tb_question where question_id = " . $question_id;
            $result_question = $conn->query($sql_question);
            $info_question = $result_question->fetch_array();
        ?>

        <div class="question_box">
            <p class="question_time"><?php echo $info_question["question_time"] ?> <span
                    class="question_from">来自:<?php echo $info_question["askQuestionPeople"] ?></span></p>
            <div class="answerNumBox">
                <p class="answer_num"><?php echo $answerNum; ?></p>
                <p class="answer">回答</p>
            </div>
            <h3 class="question_title"><a href="#"><?php echo $info_question["question_title"] ?></a></h3>
            <p class="question_content">
                <?php echo $info_question["question_content"] ?></p>
            <p class="answerNum"> <?php echo $answerNum; ?>个回答</p>


            <?php

                if ($info == false) {
                    echo "暂无回答";
                } else {
                    do {
                        echo "<p class=\"answerPeople\">" . $info["answer_user"] . "<span class=\"answerTime\">&nbsp;&nbsp;" . $info["answer_time"] . "</span></p>";
                        echo "   <p class=\"answerContent\">" . $info["answer_content"] . " </p>";
                        ?>


                        <?php
                    } while ($info = $result->fetch_array());
                }
            ?>
            <div class="row">
                <div class="col-sm-10">

                    <textarea id="textarea_reply" class="form-control" rows="4"></textarea>
                    <br>
                    <button id="btn_reply" type="submit" class="btn btn-primary pull-right">我要回答</button>

                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $("#btn_reply").click(function () {

        var reply = $("#textarea_reply").val();
        if (reply == "") {
            alert("回复不能为空");
        }
        $.ajax({
            type: "POST",
            url: "CheckReply.php",
            dataType: "json",
            data: {"reply":reply,"question_id": <?php echo  $question_id; ?>},
            beforeSend: function () {
                $('<div id="msg" />').addClass("loading").html("正在提交...").css("color", "#999")
                    .appendTo('.sub');
            },
            success: function (json) {
                if (json.success == 1) {
                     // alert( "回复成功");
                    window.location.reload();
                    //     window.location = "main.php";

                } else {
                    //  $("#msg").remove();
                    alert("回复失败");
                }

                //   window.location = "main.php"


            },
            error: function (jqXHR, textStatus, errorThrown) {
                /*错误信息处理*/
                alert("错误信息".textStatus);
            }
        });


    });

</script>
</body>
</html>
