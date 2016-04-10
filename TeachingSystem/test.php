<?php
    /**
     * Created by PhpStorm.
     * User: lin
     * Date: 2016/4/9
     * Time: 10:26
     */
    $imageData = $_POST["imageData"];

    $img=base64_decode($imageData);

    echo $img;

?>