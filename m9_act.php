<?php

include "DBCall.php";

session_start();



if (isset($_POST["submit"])) {
    $senderino = $_COOKIE['username'];
    $torino = "genjuro.jurogen44@gmail.com";
    $subjectrino = $_POST["subject"];
    $messagerino = $_POST["inquiry"];
    $headerino = "From: $senderino";
    if (mail($torino, $subjectrino, $messagerino, $headerino)) {
        $email_status = "sending_success"; 
    } else {
        $email_status = "sending_failed";
    }
    header("Location: ".$_SERVER['PHP_SELF']."?status=".$email_status); 
    exit(); 
}

if (isset($_POST["feed"])) {
    $usernemer = $_COOKIE['username'];
    
    $sql = "SELECT c_userid FROM accounts WHERE c_email = ?";
    $asstmt = $ascon->prepare($sql);
    
    if ($asstmt) {
        $asstmt->bind_param("s", $usernemer);
        $asstmt->execute();
        $asstmt->bind_result($c_userid);
        
        if ($asstmt->fetch()) {
            $asstmt->free_result();
            $stario = isset($_POST["star"]) ? $_POST["star"] : null;
            $feedbackio = isset($_POST["feedbackin"]) ? $_POST["feedbackin"] : null;
            $currentDate = date("Y-m-d");
            
            $insert_sql = "INSERT INTO reviewsite (c_userid, r_siterating, r_sitefeedback, r_sitedate) VALUES (?, ?, ?, ?)";
            $insert_stmt = $ascon->prepare($insert_sql);
            
            if ($insert_stmt) {
                $insert_stmt->bind_param("iiss", $c_userid, $stario, $feedbackio, $currentDate);
                if ($insert_stmt->execute()) {
                    $email_status = "feedback_success"; 
                } else {
                    $email_status = "feedback_failed";
                }
                $insert_stmt->close();
                header("Location: ".$_SERVER['PHP_SELF']."?status2=".$email_status); 
                exit(); 
            } else {
                echo "Error preparing insert statement: " . $ascon->error;
            }
        } else {
            echo "No user found with that email";
        }
        
        $asstmt->close();
    } else {
        echo "Error preparing select statement: " . $ascon->error;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylecontact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/42f1525630.js" crossorigin="anonymous"></script>
    <title>PHP Sending Email</title>
</head>
<body>
    <div class="contactus">
        

    <div class="contactus2">
        <div class="box2">
            <div class="contacted2 form2">
                <h3>Share your thoughts about our website!</h3>
                <form style="margin-top: 24px;" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <div class="forming">
                        <div class="rowing">
                            <div class="inter">
                                <h4 style="margin: 24px 0px 12px 0px;">How was your experience in navigating our website and from our services?</h4>
                                <div class="starry">
                                    <span><i  value="1" class="fa-solid fa-star"></i></span>
                                    <span><i  value="2" class="fa-solid fa-star"></i></span>
                                    <span><i  value="3" class="fa-solid fa-star"></i></span>
                                    <span><i  value="4" class="fa-solid fa-star"></i></span>
                                    <span><i  value="5" class="fa-solid fa-star"></i></span>
                                </div>
                                <input type="text" name="star" hidden>
                            </div>
                        </div>

                        <div class="rowing">
                            <div class="inter">
                                <h4 style="margin: 24px 0px 12px 0px;">Post a feedback or a suggestion for our services and website!</h4>
                                <textarea name="feedbackin" class="" required></textarea>
                            </div>
                        </div>

                        <?php
                            if (isset($_GET['status2'])) {
                                if ($_GET['status2'] == 'feedback_success') {
                                    echo "<p>Your feedback was submitted successfully.</p>";
                                } else {
                                    echo "<p>Sending of feedback is unsuccessful... try again</p>";
                                }
                            }
                        ?>

                        <div class="">
                            <div class="login-button">
                                <button class="buttoner" type="submit" name="feed">Send Feedback</button>
                                <button class="buttoner second" type="reset" id="resetting">Clear Fields</button><br><br>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="contacted3 form3">
                <h3 style="margin-bottom: 48px;">Ratings and Feedback by our clients</h3>
                <?php
                    $assql = "SELECT c_userid, r_siterating, r_sitefeedback, r_sitedate FROM reviewsite";
                    $asrslt = $ascon->query($assql);

                    if ($asrslt && $asrslt->num_rows > 0) {
                        while ($row = $asrslt->fetch_assoc()) {
                            $c_id = $row['c_userid'];
                            $c_rating = $row['r_siterating'];
                            $c_feed = $row['r_sitefeedback'];
                            $r_date = $row['r_sitedate'];

                            $anothersql = "SELECT c_first_name FROM accounts WHERE c_userid = ?";
                            $asstmt = $ascon->prepare($anothersql);
                            
                            if ($asstmt) {
                                $asstmt->bind_param("i", $c_id);
                                $asstmt->execute();
                                $asstmt->bind_result($c_first);
                                $asstmt->fetch();

                                $asstmt->close();
                            } else {
                                echo "Error preparing statement for email query: " . $ascon->error;
                            }

                            echo "<div class='showing_feed'>";
                                echo "<div class='overflowing'>";
                                    echo "<p>Name: $c_first</p>";
                                    echo "<p>Rating: $c_rating<i  class='fa-solid fa-star starion'></i></p>";
                                    echo "<p>Feedback: $c_feed</p>";
                                    echo "<p>Date: $r_date</p><br>";
                                echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "No feedbacks found.";
                    }
                ?>

            </div>
        </div>
    </div>

    <div class="column">
            <a href="index2.php"><button class="centered buttoned">Back to Home</button></a>
    </div>

    <script>
        const starry = document.querySelectorAll(".starry i");
        starry.forEach((stary, index1) =>{
            stary.addEventListener("click", ()=>{
                starry.forEach((stary, index2)=>{
                    index1 >= index2 ? stary.classList.add("active") : stary.classList.remove("active");
                });
                document.querySelector("input[name='star']").value = stary.getAttribute("value");
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const resetButton = document.getElementById("resetting");
            const starIcons = document.querySelectorAll(".starry i");

            resetButton.addEventListener("click", function() {
                starIcons.forEach(icon => {
                    icon.classList.remove("active");
                });
            });
        });
    </script>

</body>
</html>
