<?php 

    session_start();
    include 'DBCall.php'; 
    require("../PHP_PROJECT_FINALE/Admin/essentials/func.php");
        if(isset($_SESSION['userLogin']) && ($_SESSION['userLogin'] == true)){
            redirection("index2.php");
        }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usernamer = $_POST['username'];
        $password = $_POST['password'];
        $asmsg = "";

        $sql = "SELECT * FROM accounts WHERE c_email = '$usernamer'";
        $result = mysqli_query($ascon, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // retrieve every stored pass in the accounts table
            $stored_password = $row['c_pass'];

            // verify password
            if (password_verify($password, $stored_password)) {
                // password is correct
                $_SESSION['username'] = $usernamer;
                $_SESSION['c_userid'] = $row['c_userid'];
                $_SESSION['c_first_name'] = $row['c_first_name'];
                $_SESSION['c_last_name'] = $row['c_last_name'];
                $_SESSION['userLogin'] = true;
                setCookie("username", $usernamer, time() + (86400 * 1), "/", "", 0);
                $asmsg = "Access Granted!" . " Welcome " . $usernamer;
                echo "<script>alert('$asmsg'); window.location.href='index2.php';</script>";
                exit;
            } else {
                // password is incorrect
                $asmsg = "Incorrect password." . " Are you sure with the password entered, " . $usernamer . "?";
                echo "<script>alert('$asmsg');</script>";
            }
        } else {
            // username does not exist
            $asmsg = "Email address does not exist." . " Are you sure you are registered, " . $usernamer . "?";
            echo "<script>alert('$asmsg');</script>";
        }

        mysqli_close($ascon);
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styler.css">
    
    <title>Mariposa Farm Resort</title>

    <style>
            body {
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 0 20px;
                    background: rgb(219,168,88);
                    background: linear-gradient(0deg, rgba(219,168,88,1) 0%, rgba(28,28,71,1) 45%);
                    background-attachment: fixed;
                }

                h1{
                    text-align: center;
                    margin-bottom: 10px;
                    color: #000000;
                    font-weight: 600;
                    font-size: 35px;
                }
        </style>
</head>
<body>
    <div class="container">
        <div class="contained">
            
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                
            <h1> Mariposa Farm Resort</h1>
            <!-- <p id= usogleft> Login to your account</p> -->

                <div class="fields">
                    <label for="Email Address">Email Address</label><br>
                    <input type="text" id="usernamefield" name="username" required>
                </div>

                <div class="fields password-container">
                    <label for="passwordfield">Password</label><br>
                    <input type="password" id="passwordfield" class="password-field" name="password" required>
                    <span class="password-toggle" onclick="appearDisappear1halfPassword()">Show</span>
                </div>

                <a class="coloring" href="forgot-password.php">Forgot Password</a>

                <div class="login-button">
                    <button class="login buttoned" type="submit" name="login">Login</button><br><br>
                </div>
                <p>Don't have an account?<a class="coloring" href="improvedregistration.html"> Sign Up</a></p>
            </form>

           
        </div>
    </div>

    <script>
        const asmsg = "<?php echo $asmsg; ?>";

        function showAlert() {
            if (asmsg !== "") {
                alert(asmsg);
                if (asmsg !== "Access Granted!") {
                    return false; 
                }
            }
            return true; 
        }

    </script>
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