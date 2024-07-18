<?php
    require("db_config/DBCall_admin_login.php");
    require("essentials/func.php");
    session_start();
    if(isset($_SESSION['admin_type']) == "Reservations Manager"){
        if(isset($_SESSION['adminLogin']) && ($_SESSION['adminLogin'] == true)){
            redirection("rmdashboard.php");
        }
    }
    if(isset($_SESSION['admin_type']) == "Main Admin"){
        if(isset($_SESSION['adminLogin']) && ($_SESSION['adminLogin'] == true)){
            redirection("madashboard.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mariposa Farm Resort - Admin Login</title>
    <?php require("bootstraplinks/linking.php"); ?>
    <style>
        div.login-form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }

        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 30%;
            transform: translateY(-80%);
            cursor: pointer;
        }

        .customized{
            position: fixed;
            top: 25px;
            right: 25px;
        }

    </style>
</head>
<body class="bg-light">
    
    <div class="login-form rounded bg-white shadow overflow-hidden">
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
            <h4 class="bg-dark text-white px-3 py-3">Admin Login</h4>
            <div class="p-4">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control shadow-none" required>
                </div>

                <div class="mb-4 password-container">
                    <label>Password</label>
                    <input type="password" name="password" id="passwordfield" class="form-control shadow-none password-field" required>
                    <span style="cursor: pointer;" class="password-toggle" onclick="appearDisappear1halfPassword()">Show</span>
                </div>
                <button name="login" type="submit" class="btn text-white bg-dark shadow-none">Login</button>
            </div>
        </form>
    </div>

    <?php

        if(isset($_POST['login'])){
            $usernamer = $_POST['username'];
            $filtered = filteringSql($_POST); 
            $usernem = $filtered["username"];
            $pass = $filtered["password"];
            $passvalue = [$usernem, $pass];

            $resManagerSql = "SELECT * FROM admin_accounts WHERE admin_username = ? AND admin_pass = ? AND admin_type = 'Reservations Manager'";
            $rsltResManager = selectMatching($resManagerSql, $passvalue, "ss");

            $mainAdminSql = "SELECT * FROM admin_accounts WHERE admin_username = ? AND admin_pass = ? AND admin_type = 'Main Admin'";
            $rsltMainAdmin = selectMatching($mainAdminSql, $passvalue, "ss");
        
            if ($rsltResManager && $rsltResManager->num_rows == 1) {
                $rowing = mysqli_fetch_assoc($rsltResManager);
                $_SESSION['adminLogin'] = true;
                $_SESSION['admin_id'] = $rowing["admin_id"];
                $_SESSION['admin_type'] = $rowing["admin_type"];
                redirection("rmdashboard.php");
            } elseif ($rsltMainAdmin && $rsltMainAdmin->num_rows == 1) {
                $rowing = mysqli_fetch_assoc($rsltMainAdmin);
                $_SESSION['adminLogin'] = true;
                $_SESSION['admin_id'] = $rowing["admin_id"];
                $_SESSION['admin_type'] = $rowing["admin_type"];
                redirection("madashboard.php");
            }else{
                  alerting("failed", "Are you sure you are an administrator?");
            }
        }
            

    ?>

    <?php require("bootstraplinks/scripts.php"); ?>

    <script>
        // script for showing and hiding of password
        function appearDisappear1halfPassword() {
            var passwordFields = document.querySelectorAll(".password-field");
            var passwordToggle = document.querySelectorAll(".password-toggle");

            passwordFields.forEach(function(field, index) {
                if (field.type === "password") {
                    field.type = "text";
                    passwordToggle[index].textContent = "Hide";
                } else {
                    field.type = "password";
                    passwordToggle[index].textContent = "Show";
                }
            });
        }
    </script>
</body>
</html>