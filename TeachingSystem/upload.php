<?php
    header("Content-Type:text/html;charset=utf-8");
    if ($_FILES["input_upload"]["error"] > 0)
    {
        echo "Error: " . $_FILES["input_upload"]["error"] . "<br/>";

    }
    else
    {
        echo "上传的文件名: " . $_FILES["input_upload"]["name"] . "<br />";
        echo "文件类型: " . $_FILES["input_upload"]["type"] . "<br />";
        echo "大小: " . ($_FILES["input_upload"]["size"] / 1024) . " Kb<br />";
        echo "暂时存放的位置: " . $_FILES["input_upload"]["tmp_name"]."<br/>";


        if (file_exists("/home/" . $_FILES["input_upload"]["name"]))
        {
            echo $_FILES["input_upload"]["name"] . " already exists. ";
        }
        else
        {
            move_uploaded_file($_FILES["input_upload"]["tmp_name"],
                "home/" . $_FILES["input_upload"]["name"]);
            echo "文件已经存放在: " . "home/" . $_FILES["input_upload"]["name"];
        }


    }


?>