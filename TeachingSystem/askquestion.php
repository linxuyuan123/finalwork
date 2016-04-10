<?php
    /**
     * 提问的处理页面
     */
    session_start();
    date_default_timezone_set('PRC');
    $questionTitle = $_POST["questionTitle"];
    $questionArea = $_POST["questionContent"];
    $askQuestionPeople= $_SESSION['user'];
   // echo $questionTitle . "<br>";
   // echo $questionArea . "<br>";


    include("conn.php"); //引入数据库连接文件

    $questionTime = date('y-m-d h:i', time());
   // echo $questionTime . "<br>";
    $sql = "insert into tb_question(question_title,question_content,question_time,askQuestionPeople) VALUES ('$_POST[questionTitle]','$_POST[questionContent]','$questionTime','$askQuestionPeople')";
    $conn->query($sql);
  //  echo $sql . "<br>";

    if ($conn->affected_rows > 0) {
        //  echo "<script type='text/javascript'>alert('提交成功')</script>";
        //   header("Location:main.php");
        $arr['success'] = 1;
        echo json_encode($arr);

    } else {
        //    header("Location:index.php");
        //  echo " <script type = 'text/javascript' > alert('提交失败！');</script>";
        $arr['success'] = 0;
        echo json_encode($arr);
    }

?>  