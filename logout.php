<?php
    require("../PHP_PROJECT_FINALE/Admin/essentials/func.php");

    session_start();
    session_destroy();
    redirection("index.php");
?>