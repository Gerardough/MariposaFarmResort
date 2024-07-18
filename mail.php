<?php 

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        use PHPMailer\PHPMailer\SMTP;

        require './PHPMailer/src/Exception.php';
        require './PHPMailer/src/PHPMailer.php';
        require './PHPMailer/src/SMTP.php';


        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth = true;

                                         
        $mail->Host       = 'smtp.gmail.com';                     
       
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    
        $mail->Port =587;
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Username   = 'farmresort.mariposa@gmail.com';                    //CHANGE THIUS
        $mail->Password   = 'uifx ytgq nwtc icmx';                          //CHANGE THIS
        
        $mail->isHtml(true);

        return $mail;

   
        
?>