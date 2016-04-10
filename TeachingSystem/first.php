<!DOCTYPE html>
<html lang="zh-CN">
<head>
  
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>bootstrap学习</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> 宿舍管理员管理 </h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>编号</th>
                <th>用户名</th>
                <th>密码</th>
                <th>联系电话</th>
                <th>邮箱</th>
                <th>类型</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            <?php
                include("conn.php");  //引入数据库连接代码,联合查询 ;
                $sql = "select * from tb_student UNION ALL select * from tb_teacher";
                $result = $conn->query($sql);
                $totalCount = $result->num_rows;  //总的纪录条数
                $perNumber = 8;                  //每页显示的记录数
                $totalPage = ceil($totalCount / $perNumber); //计算出总页数
                $page=empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情 //获得当前的页面值
                if (!isset($page)) {
                    $page = 1;
                } //如果没有值,则赋值1
                $startCount = ($page - 1) * $perNumber; //分页开始,根据此方法计算出开始的记录
                $sql = "select * from tb_student UNION ALL select * from tb_teacher limit $startCount,$perNumber ";
                $result = $conn->query($sql);
                $info = $result->fetch_array();
                if ($info == false) {
                    echo "暂无提问";
                } else {
                    do {
                        ?>

                        <tr>
                            <td><?php echo $info[0]; ?></td>
                            <td><?php echo $info[1]; ?></td>
                            <td><?php echo $info[2]; ?></td>
                            <td><?php echo $info[3]; ?></td>
                            <td><?php echo $info[4]; ?></td>
                            <td><?php echo $info[5]; ?></td>

                            <td>
                                <button type="button" class="btn btn-primary btn-xs">修改</button>
                                <button type="button" class="btn btn-danger btn-xs">删除</button>
                            </td>
                        </tr>


                        <?php
                    } while ($info = $result->fetch_array());
                }

            ?>


            </tbody>
        </table>
        <div class="text-center">
            <ul class="pagination">
                <?php
                    if ($page != 1) { //页数不等于1
                        ?>
                        <li><a href="first.php?page=<?php echo $page - 1; ?>">上一页</a></li><!--显示上一页-->
                        <?php
                    }
                    for ($i = 1; $i <= $totalPage; $i++) {  //循环显示出页面
                        ?>
                        <li><a href="first.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                    if ($page < $totalPage) { //如果page小于总页数,显示下一页链接
                        ?>
                        <li><a href="first.php?page=<?php echo $page + 1; ?>">下一页</a></li>
                        <?php
                    }
                ?>

            </ul>
        </div>
    </div>
</div>
</body>
</html>
