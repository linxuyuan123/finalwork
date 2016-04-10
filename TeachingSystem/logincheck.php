<?php
    session_start();
    $user = $_POST["username"];
    $psw = $_POST["password"];
    $identity = $_POST["radioGroup"];
    //  echo "<script>alert(".$user.$psw."); </script>";
    // echo "PHP接收到的用户名".$user;


    include("conn.php");  //引入数据库连接代码

    switch ($identity) {
        case "系统管理员":
            $sql = "select *  from tb_admin where admin_name = '$_POST[username]' and admin_password = '$_POST[password]'";
           // echo $sql;
          //  echo "<br>";
            $result = $conn->query($sql);
            $info = $result->fetch_array();
            break;
        case "教师":
            $sql = "select * from tb_teacher where teacher_name = '$_POST[username]' and teacher_password = '$_POST[password]'";
          //  echo $sql;
          //  echo "<br>";
            $result = $conn->query($sql);
            $info = $result->fetch_array();
            break;
        case "学生":
            $sql = "select *  from tb_student where student_name = '$_POST[username]' and student_password = '$_POST[password]'";
          //  echo $sql;
          //  echo "<br>";
            $result = $conn->query($sql);
            $info = $result->fetch_array();
            break;
    }


    if ($result->num_rows > 0) {

         $_SESSION['user'] = $info[1];  
         $_SESSION['loginType']  = $info[5];
        $arr['success'] = 1;
        $arr['msg'] = '登录成功！';
        $arr['username'] =  $_SESSION['user'];
        $arr['loginType'] = $_SESSION['loginType'];
        echo json_encode($arr);

    } else {
        //header("Location:index.php");
       // echo " <script type = 'text/javascript' > alert('用户名或密码不正确！');history.back();</script>";
        $arr['success'] = 0;
        echo json_encode($arr);
    }

?>  