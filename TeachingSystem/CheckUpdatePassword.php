<?php
    /**
     * 修改密码的处理页面
     */
    include("conn.php");  //引入数据库连接代码);
    session_start();
    $login_user = $_SESSION['user'];
    $login_type = $_SESSION['loginType'];
    $newPassword = $_POST['new_password'];
    $old_password = $_POST['old_password'];


    switch (trim($login_type)) {
        case "系统管理员":
            $sql = "update tb_admin set admin_password = '$newPassword' where admin_name = '$login_user'";
            //echo $sql;
            //  echo "<br>";
            $conn->query($sql);
            break;
        case "教师":
            $sql = "update tb_teacher set teacher_password = '$newPassword' where teacher_name = '$login_user'";
            //   echo $sql;
            //   echo "<br>";
            $conn->query($sql);
            break;

        case "学生":
            $sql = "update tb_student set student_password = '$newPassword' where student_name = '$login_user'";
          // echo $sql;
            $conn->query($sql);
            break;
    }


    if ($conn->affected_rows > 0) {
        //  echo "<script type='text/javascript'>alert('注册成功')</script>";
        //   header("Location:main.php");
        $arr['success'] = 1;
        echo json_encode($arr);

    } else {
        //    header("Location:index.php");
        //  echo " <script type = 'text/javascript' > alert('注册失败！');history.back();</script>";
        //$arr['success'] = 0;
      //  echo json_encode($arr);

    }


?>