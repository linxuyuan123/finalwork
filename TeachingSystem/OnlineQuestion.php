<!DOCTYPE html>
<html lang="zh-CN">
<head>
   
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>在线问答模块</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        $result= $conn->query($sql);
        $totalCount = $result->num_rows;  //总的纪录条数
        $perNumber = 4;                  //每页显示的记录数
        $totalPage = ceil($totalCount / $perNumber); //计算出总页数

        $page=empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情 //获得当前的页面值
        if (!isset($page)) {
            $page = 1;
        } //如果没有值,则赋值1
        $startCount = ($page - 1) * $perNumber; //分页开始,根据此方法计算出开始的记录
        $sql = "select * from tb_question limit $startCount,$perNumber ";
        $result = $conn->query($sql);

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

    <div class="text-center">
        <ul class="pagination">
            <?php
                if ($page != 1) { //页数不等于1
                    ?>
                    <li><a href="OnlineQuestion.php.php?page=<?php echo $page - 1; ?>">上一页</a></li><!--显示上一页-->
                    <?php
                }
                for ($i = 1; $i <= $totalPage; $i++) {  //循环显示出页面
                    ?>
                    <li><a href="OnlineQuestion.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                }
                if ($page < $totalPage) { //如果page小于总页数,显示下一页链接
                    ?>
                    <li><a href="OnlineQuestion.php?page=<?php echo $page + 1; ?>">下一页</a></li>
                    <?php
                }
            ?>

        </ul>
    </div>

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
