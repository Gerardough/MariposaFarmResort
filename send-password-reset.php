<?php 
session_start();
require("Admin/bootstraplinks/linking.php");
$email = $_POST["email"];
$mysqli = require __DIR__ . "/DBCall.php";




if ($mysqli instanceof mysqli) {
    // Check if the email exists in the database
    $check_email_sql = "SELECT * FROM accounts WHERE c_email = ?";
    $check_stmt = $mysqli->prepare($check_email_sql);

    if ($check_stmt) {
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        $check_stmt->close();

        if ($result->num_rows === 0) {
            $_SESSION['error'] = 'Did you input the correct email?';
            header("Location: forgot-password.php");
            exit();
        }
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }




$token = bin2hex(random_bytes(16)); //

$token_hash = hash("sha256", $token);

$expiry= date("Y-m-d H:i:s",time() + 60 * 30);






if ($mysqli instanceof mysqli) {
    $sql = "UPDATE accounts
            SET c_reset_token_hash = ?,
                c_reset_token_expires_at = ?
            WHERE c_email = ?";

    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $token_hash, $expiry, $email);
        $stmt->execute();
        $stmt->close();

        if ($mysqli->affected_rows){
            $mail = require __DIR__ . "/mail.php";
            $mail->setFrom("noreply@example.com");
            $mail->addAddress($email);
            $mail->Subject = "Password Reset";  
            $mail->Body = <<<END

            
            This is Mariposa Farm Resort Forgot your password? <br> please Click <a href="http://localhost/PHP_PROJECT_FINALE/reset-password.php?token=$token">here</a> to reset your password.
            

            END;
            //http://localhost is required change the rest to where reset-password is
           

            try {

                $mail->send();
            }catch (Exception $e){
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
            }
        }
        
                header("Location: successEMAIL.html"); // Redirect to your success page
                exit();
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }
} else {
    echo "Error: DBCall.php did not return a valid MySQLi connection.";
}

}
function alerting($status, $mess){
    $statusholder = ($status == "success") ? "alert-success" : "alert-danger";

    echo <<<alert
        <div class="alert $statusholder alert-dismissible fade show customized" role="alert">
            <strong class="me-3">$mess</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    alert;
}


?>

