<?php
    session_start();
    session_destroy();
    echo " <script type = 'text/javascript' > window.parent.location='index.php';</script>";
?>