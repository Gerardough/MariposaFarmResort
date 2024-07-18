<?php
session_start();
if (isset($_POST["submitting"])) {
    $torino = "farmresort.mariposa@gmail.com";
    $subjectrino = $_POST["subjecting"];
    $namerino = $_POST["naming"];
    $emailrino = $_POST["emailing"];
    $inquirino = $_POST["inquiring"];

    $tmp_name = $_FILES['attaching']['tmp_name'];
    $name = $_FILES['attaching']['name'];
    $size = $_FILES['attaching']['size'];
    $type = $_FILES['attaching']['type'];
    $error_ctr = $_FILES['attaching']['error'];

    if($error_ctr > 0){
        die('Uploading of attachment is unsuccessful!, are you sure with your file upload?');
    }

    $handle = fopen($tmp_name, "r");
    $content = fread($handle, $size);
    fclose($handle);

    $encoded = chunk_split(base64_encode($content));
    $bound = md5("random");

    $headerino = "MIME-Version: 1.0\r\n";
    $headerino .= "From: " .$emailrino . "\r\n";
    $headerino .= "Reply-To: " . $torino . "\r\n";
    $headerino .= "Content-Type: multipart/mixed;";
    $headerino .= "boundary = $bound\r\n";

    $messagerino = "--$bound\r\n";
    $messagerino .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $messagerino .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $messagerino .= "Sender's Name: " . $namerino . "\r\n";
    $messagerino .= "From: " . $emailrino . "\r\n";
    $messagerino .= "Message: " . $inquirino . "\r\n";

    $messagerino .= "--$bound\r\n";
    $messagerino .= "Content-Type: $type; name=" . $name . "\r\n";
    $messagerino .= "Content-Disposition: attachment; filename=" . $name . "\r\n";
    $messagerino .= "Content-Transfer-Encoding: base64\r\n";
    $messagerino .= "Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
    $messagerino .= $encoded;


    if (mail($torino, $subjectrino, $messagerino, $headerino)) {
        $email_status = "sending_success"; 
    } else {
        $email_status = "sending_failed";
    }
    header("Location: ".$_SERVER['PHP_SELF']."?status=".$email_status); 
    exit(); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Mariposa Farm Resort</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
      <link rel="stylesheet" href="css/styling2.css">
</head>
<body>

<div class="ctbnr">
      <div class="contcontt">
            <section class="contact">
                        <div class="content">
                              <h2>Contact Us</h2>
                              <p>Mariposa Farm Resort</p>
                        </div>
                        <div class="ccont">
                              <div class="contactInfo">
                                    <div class="box">
                                          <div class="icon"><img src="imahes/map-regular-24.png"></div>
                                          <div class="ctext">
                                                <h3>Address</h3>
                                                <p>San Carlos City, Ilocos Region,<br> Philippines</p>
                                          </div>
                                    </div>
                                    <div class="box">
                                          <div class="icon"><img src="imahes/phone-regular-24.png"></div>
                                          <div class="ctext">
                                                <h3>Contact No.</h3>
                                                <p>09681234567</p>
                                          </div>
                                    </div>
                              </div>
                              <div class="contactForm">
                                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
                                          <h2>Send Message</h2>
                                          <div class="inputBox">
                                                <input type="text" value="<?php echo $_SESSION['c_first_name'] . " " . $_SESSION['c_last_name'] ?>" name="naming" required="required">
                                                <span>Full name</span>
                                          </div>
                                          <div class="inputBox">
                                                <input type="email" value="<?php echo $_SESSION['username'] ?>" name="emailing" required="required">
                                                <span>Email</span>
                                          </div>
                                          <div class="inputBox">
                                                <input type="text" name="subjecting" required="required">
                                                <span>Subject</span>
                                          </div>
                                          <div class="inputBox">
                                                <textarea required="required" name="inquiring" id=""></textarea>
                                                <span>Enter Message...</span>
                                          </div>
                                          <div class="inputBox">
                                                <input type="file" name="attaching" required placeholder="Upload a File" id="">
                                          </div>

                                          <?php
                                                if (isset($_GET['status'])) {
                                                    if ($_GET['status'] == 'sending_success') {
                                                        echo "<p style='color:green'>Your concern was submitted successfully.</p>";
                                                    } else {
                                                        echo "<p style='color:red'>Sending of concern is unsuccessful... try again</p>";
                                                    }
                                                }
                                            ?>

                                          <div class="inputBox">
                                                <input type="submit" name="submitting" value="Send">
                                          </div>

                                          <div class="inputBox">
                                          <a href="m9_act.php">Rate Here!</a>
                                          </div>
                                    </form>
                              </div>
                        </div>

            </section>
      </div>
</div>    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function scrollToTarget() {
            var targetElement = document.getElementById('descrip');
            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>
</html>