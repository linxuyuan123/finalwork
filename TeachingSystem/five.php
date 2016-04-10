<!DOCTYPE html>
<html lang="zh-CN">
<head>
   
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>在线问答模块</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <style>

    </style>
</head>
<body>
<div class="col-sm-10">
    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#askQuestionModal">
        我要提问
    </button>


    <?php
        include("conn.php");
        $sql = "select * from tb_question";
        $conn->query($sql);
        $result = $conn->query($sql);
       // echo "查询到的问题数为" . $result->num_rows;
        $info = $result->fetch_array();
        if ($info == false) {
            echo "暂无提问";
        } else {

            do {
                ?>
                <div class="question_box">
                    <p class="question_time"><?php echo $info["question_time"]; ?><span
                            class="question_from">来自 <?php echo $info["askQuestionPeople"]; ?></span></p>
                    <div class="answerNumBox">
                        <p class="answer_num">
                            <?php
                                $sql_a = "SELECT * FROM tb_answer where question_id = " . $info["question_id"];
                                $result_answer = $conn->query($sql_a);
                                $answerNum = $result_answer->num_rows;
                                echo $answerNum;
                            ?>


                        </p>
                        <p class="answer">回答</p>
                    </div>
                    <h3 class="question_title"><a
                            href="question_detail.php?question_id=<?php echo $info["question_id"]; ?>"><?php echo $info["question_title"] ?></a>
                    </h3>
                    <p class="question_content"> <?php echo $info["question_content"] ?></p>
                </div>
                <?php

            } while ($info = $result->fetch_array());
        }

    ?>


</div>

<!-- 提问的对话框 -->
<div class="modal fade" id="askQuestionModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    请输入您的问题
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group sub">
                    <!--
                    <form action="askquestion.php" method="post">
                    -->
                        <input type="text" class="form-control" id="askQuestionInput" name="askQuestionInput"
                               placeholder="标题"/>
                        <br>
                        <textarea class="form-control" name="QuestionArea" id="QuestionArea" rows="3"
                                  placeholder="问题内容"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">关闭
                </button>
                <button type="submit" class="btn btn-primary" onclick="btn_askquestion()">
                    确认提问
                </button>
            </div>
            <!--
            </form>
            -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<script type="text/javascript">
    function btn_askquestion() {

        var questionTitle = document.getElementById("askQuestionInput").value;
        var questionContent = document.getElementById("QuestionArea").value;

        if (questionTitle == "") {
            $('<div id="msg" />').html("问题不能为空！").appendTo('.sub').fadeOut(2000);
            return false;
        }
        if (questionContent == "") {
            $('<div id="msg" />').html("问题内容不能为空！").appendTo('.sub').fadeOut(2000);
            return false;
        }


        $.ajax({
            type: "POST",
            url: "askquestion.php",
            dataType: "json",
            data: {"questionTitle": questionTitle, "questionContent": questionContent},
            beforeSend: function () {
                $('<div id="msg" />').addClass("loading").html("正在提交...").css("color", "#999")
                    .appendTo('.sub');
            },
            success: function (json) {
                if (json.success == 1) {
                  //    alert( "提交成功");
                    window.location.reload();
               //     window.location = "main.php";

                } else {
                  //  $("#msg").remove();
                    alert("提交失败");
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
