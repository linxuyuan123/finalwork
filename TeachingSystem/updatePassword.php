<!DOCTYPE html>
<html lang="zh-CN">
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>修改密码</title>
  <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/style.css"/>
  <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"> 修改密码 </h3>
  </div>
  <div class="panel-body">
    <div class="change-ps-box text-center">
      <div class="form-group">
        <label class=" control-label "><span class="red-dot">*</span>原密码:&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="old_password" name="old_password">
      </div>
      <div class="form-group">
        <label  class="control-label "><span class="red-dot">*</span>新密码:&nbsp;&nbsp;&nbsp;</label>
        <input type="text"  id="new_password" name="new_password" >
      </div>
      <div class="form-group">
        <label  class="control-label"><span class="red-dot">*</span>确认密码:&nbsp;</label>
        <input type="text" id="rnew_password" name="rnew_password">
      </div>
      <div class="form-group text-center sub">
        <button id="btn_update_password" type="submit" class="btn btn-primary" >提交</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $("#btn_update_password").click(function () {

    var old_password = $("#old_password").val();
    var new_password = $("#new_password").val();
    var rnew_password = $("#rnew_password").val();

    if (old_password == "" || new_password == "" || rnew_password == "") {
      $('<div id="msg" />').html("密码不能为空！").appendTo('.sub').fadeOut(2000);
      return false;
    }
    if(new_password != rnew_password ){
      $('<div id="msg" />').html("两次输入的密码不一致！").appendTo('.sub').fadeOut(2000);
      return false;
    }

    $.ajax({
      type: "POST",
      url: "CheckUpdatePassword.php",
    dataType: "json",
      data: {"old_password": old_password, "new_password": new_password},
      beforeSend: function () {
        $('<div id="msg" />').addClass("loading").html("正在修改...").css("color", "#999")
            .appendTo('.sub');
      },
      success: function (json) {
        if (json.success == 1) {
          alert("修改成功");
          $("#msg").remove();
        } else {
          $("#msg").remove();
          alert("修改失败");
        }
    //alert(json);

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
