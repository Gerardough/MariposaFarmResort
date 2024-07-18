<?php
    require("essentials/func.php");

    session_start();
    session_destroy();
    redirection("adminlogin.php");
?>