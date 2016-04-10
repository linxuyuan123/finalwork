<!DOCTYPE html>
<html lang="zh-CN">
<head>

    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>修改密码</title>
    <!--<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"/>
    -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/jquery.cropit.js"></script>
    <script src="js/jquery.wallform.js"></script>
    <link rel="stylesheet" href="asset/font-awesome/css/font-awesome.min.css">
    <style>
        .cropit-preview {
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 7px;
            width: 250px;
            height: 250px;
            margin: 0 auto;
        }

        .cropit-preview-image-container {
            cursor: move;
        }

        .image-size-label {
            margin-top: 10px;

        }

        input{
            display: block;
            width: 200px !important;
            margin: 0 auto;
        }
        .export{
            float: right;
            margin: 10px 20px;
        }


        button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> 编辑个人资料 </h3>
    </div>
    <div class="panel-body">
        <div class="ProfileEditCard-item">
            <p class="ProfileEditCard-itemLabel">头像</p>
            <div class="ProfileEditCard-content">
                <img id="img-personal" src="images/me.png" width="80" height="80"  data-toggle="modal" data-target="#foldModal">
                <input type="file" id="file" class="cropit-image-input" style="height:0px;width:0px;">
            </div>
        </div>
        <div class="ProfileEditCard-item">
            <p class="ProfileEditCard-itemLabel">邮箱</p>
            <div class="ProfileEditCard-content">
                <div>
                    <button id="btn-alter-email" type="button" class="btn btn-xs">修改</button>
                </div>
                <div class="js-toggle-email">

                    <input type="text" class="form-control">
                    <br>
                    <button class="btn btn-primary" value="提交">提交</button>
                    <a id="cancel-email" href="#">取消</a>

                    <div>
                    </div>
                </div>


            </div>
        </div>
        <div class="ProfileEditCard-item">
            <p class="ProfileEditCard-itemLabel">电话</p>
            <div class="ProfileEditCard-content">
                <div>
                    <button id="btn-alter-tel" type="button" class="btn btn-xs">修改</button>
                </div>
                <div class="js-toggle-tel">

                    <input type="text" class="form-control">
                    <br>
                    <button class="btn btn-primary" value="提交">提交</button>
                    <a id="cancel-tel" href="#">取消</a>

                    <div>
                    </div>
                </div>


            </div>
        </div>

        <!-- 修改头像对话框 -->
        <div class="modal fade" id="foldModal" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"
                                data-dismiss="modal" aria-hidden="true"> &times; </button>
                        <h4 class="modal-title" id="ModalLabel"> 修改图片 </h4>
                    </div>
                    <div class="image-editor">

                        <input type="file" class="cropit-image-input">
                        <div class="cropit-preview"></div>
                      
                        <input type="range" class="cropit-image-zoom-input">
                        <button id="submit-img" type="submit" class="btn btn-primary export "    data-dismiss="modal" value="提交">提交</button>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <script type="text/javascript">
            var imgSrc;
            $("#btn-alter-email").click(function () {
                $(".js-toggle-email").show();
                $("#btn-alter-email").hide();

            });
            $("#cancel-email").click(function () {
                $(".js-toggle-email").hide();
                $("#btn-alter-email").show();
            })
            $("#btn-alter-tel").click(function () {
                $(".js-toggle-tel").show();
                $("#btn-alter-tel").hide();
            });
            $("#cancel-tel").click(function () {
                $(".js-toggle-tel").hide();
                $("#btn-alter-tel").show();
            })

            $("#img-personal").click(function () {
                $("#file").click();

            });


            $('.image-editor').cropit({
                imageState: {
                    src: '',
                }

            });
            $('.export').click(function() {
                var imageData = $('.image-editor').cropit('export');  //保存了base64的图片

              //  $("#img-personal").attr('src',imageData);
                $.ajax({
                    type: "POST",
                    url: "test.php",
                 //   dataType: "text/html",
                    data: {"imageData": imageData},
                    beforeSend: function () {

                    },
                    success: function (img) {

                        $(".img-personal").attr('src',img);

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
