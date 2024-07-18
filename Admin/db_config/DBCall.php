<?php
    $asserver = "localhost:3306";
    $asun = "root";
    $aspass = "";
    $asdbname = "client_management";

    // Checking connection
    $ascon = mysqli_connect($asserver, $asun, $aspass, $asdbname);
    // Check connection
    if (!$ascon) {
        die("Failed connecting, " . mysqli_connect_error());
    }
?>