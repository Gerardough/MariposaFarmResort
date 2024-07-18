<html>
    <head>
    </head>
<body>
    <?php
        include 'DBCall.php'; 
        $asmsg = "";
    
        if(isset($_POST["signup"])){
            $firstnem = $_POST["c_first_name"];
            $lastnem = $_POST["c_last_name"];
            $middlenem = isset($_POST["c_middle_name"]) ? $_POST["c_middle_name"]: null;
            $address = $_POST["c_address"];
            $birthdate = $_POST["c_birth"];
            $birthdateTimestamp = strtotime($birthdate);
            $mysql_date_format = date('Y-m-d', $birthdateTimestamp);
            $age = $_POST["c_age"];
            $phone = $_POST["c_contact"];
            $gender = isset($_POST["c_gender"]) ? $_POST["c_gender"]: null;
            $email = $_POST["c_email"];
            $pass = isset($_POST["c_pass"]) ? password_hash($_POST["c_pass"], PASSWORD_DEFAULT): null;
    
                try{
                    $checkEmailQuery = "SELECT c_email FROM accounts WHERE c_email = '$email'";
                    $checkResult = mysqli_query($ascon, $checkEmailQuery);
                    if (mysqli_num_rows($checkResult) > 0) {
                        header('Location: failedregistration.html');
                    }
    
                    $assql = "INSERT INTO accounts" . "(c_userid, c_first_name, c_last_name, c_middle_name,
                    c_address, c_birthdate, c_age, c_contactnum, c_gender, c_email, c_pass)"
                    . "VALUES('','$firstnem','$lastnem', '$middlenem', '$address', '$mysql_date_format', '$age', '$phone', '$gender', '$email', '$pass')";
    
                    if(mysqli_query($ascon, $assql)){
                        header('Location: successregistration.html');
                    } else {
                        header('Location: failedregistration.html');
                    }
    
                    mysqli_close($ascon);
    
                }catch (mysqli_sql_exception $e) {
                    $asmsg = "Error in signing up: " . $e->getMessage();
                }
            }
        echo json_encode(['message' => $asmsg]);
    ?>
</body>
</html>