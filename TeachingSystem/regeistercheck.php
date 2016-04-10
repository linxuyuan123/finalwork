<?php

    $user = $_POST["username"];
    $psw = $_POST["password"];
    $identity = trim($_POST["radioGroup"]);
  //  echo $user . "<br>";
  //  echo $psw;
  //  echo $identity;
     include("conn.php");  //引入数据库连接代码

        switch (trim($identity)) {
            case "系统管理员":

                $sql = "insert into tb_admin(admin_name,admin_password,login_type) VALUES ('$_POST[username]','$_POST[password]',' $identity ')";
               // echo $sql;
              //  echo "<br>";
                $conn->query($sql);
                break;
            case "教师":
                $sql = "insert into tb_teacher(teacher_name,teacher_password,login_type) VALUES ('$_POST[username]','$_POST[password]','$identity')";
             //   echo $sql;
             //   echo "<br>";
                $conn->query($sql);
                break;
            case "学生":
                $sql = "insert into tb_student(student_name,student_password,login_type) VALUES ('$_POST[username]','$_POST[password]','$identity')";
                /* 调试mysql错误
                if (!mysqli_query($conn, $sql))
                {
                    echo("Error description: " . mysqli_error($conn));
                }
                */
                $sql = "insert into tb_student(student_name,student_password,login_type) VALUES ('$_POST[username]','$_POST[password]','$identity')";
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
              $arr['success'] = 0;
            echo json_encode($arr);
        }
    
?>  