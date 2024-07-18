<?php 
  require("essentials/func.php");
  adminlogin("Reservations Manager");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mariposa Farm Resort - Admin - Reservations Manager - Dashboard</title>
    <?php require("bootstraplinks/linking.php"); ?>
</head>
<body>
    <style>
        .customized{
            position: fixed;
            top: 120px;
            right: 25px;
        }

        #dashboard-menu{
            position: fixed;
            height: 100%;
        }

        @media screen and (max-width: 992px){
            #dashboard-menu{
                position: fixed;
                height: auto;
                width: 100%;
            }

            .customized{
                top: 180px;
                left: 25px;
            }

            #main-section{
                margin-top: 80px;
            }
        }
    </style>
    <?php
        alerting("success", "Access Granted! Welcome Reservations Manager!");
    ?>

    <?php require("essentials/rmheader.php"); ?>

    <div class="container-fluid" id="main-section">
        <div class="row">
            <div class="col-lg-10 ms-auto">
            </div>
        </div>
    </div>

    <?php require("bootstraplinks/scripts.php"); ?>
</body>
</html>
