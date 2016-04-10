<?php
    /**
     * 提交回复
     */
    include("conn.php");  //引入数据库连接代码);
    session_start();
    $question_id = $_POST["question_id"];
    $reply_content = $_POST["reply"];
    date_default_timezone_set('PRC');
    $questionTime = date('y-m-d h:i', time());
    $answer_user = $_SESSION['user'];
    $sql  = "insert into tb_answer(question_id,answer_content,answer_time,answer_user) VALUES ('$question_id','$reply_content','$questionTime','$answer_user') ";

    $conn->query($sql);

    if ($conn->affected_rows > 0) {
        //  echo "<script type='text/javascript'>alert('注册成功')</script>";
        //   header("Location:main.php");
        $arr['success'] = 1;
        echo json_encode($arr);

    } else {
        //    header("Location:index.php");
        //  echo " <script type = 'text/javascript' > alert('注册失败！');history.back();</script>";
        $arr['success'] = 0;
        echo json_encode($arr);
    }





?>