
<?php
include "DBCall.php";
session_start();

$userid = $_COOKIE['username'];
$sql = "SELECT * FROM accounts WHERE c_email = '$userid'";
$result = mysqli_query($ascon, $sql);
$userrow = mysqli_fetch_array($result);
$fn = $userrow["c_first_name"];
$ln = $userrow["c_last_name"];
$email = $userrow["c_email"];

$billingid = $_SESSION['pendingid'];
$sql = "SELECT * FROM billings WHERE bill_id = '$billingid'";
$result = mysqli_query($ascon, $sql);
$bookingrow = mysqli_fetch_array($result);
$bill_id = $bookingrow['bill_id']; //
$datein = $bookingrow['datein']; //
$dateout = $bookingrow['dateout']; //
$room = $bookingrow['rm_id'];
$totprice = $bookingrow['totprice'];
$downp = $bookingrow['downpayment'];
$bookingdate = $bookingrow['bookingdate'];
$expirydate = $bookingrow['expirydate'];
$pmethod = $bookingrow['paymentmethod'];

$sql = "SELECT * FROM `room` WHERE rm_id = '$room'";
$result = mysqli_query($ascon,$sql);
$roomrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
$roomtitle = $roomrow['room_name'];//
$roomtype = $roomrow['room_type_id'];

$sql = "SELECT * FROM `roomtype` WHERE rt_id = '$roomtype'";
$result = mysqli_query($ascon,$sql);
$roomrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
$roomtyped = $roomrow['room_type'];//

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <meta name="viewport" content = "width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" href="css/styling.css">
        <title>Client Registration</title>
    </head>
    <body>

        <section class="container2">
                <h3 class="noted">Booking successful!</h3><br>
            <div class="row w-100 rounded ms-1" style="background-color: antiquewhite;padding: 2rem;">
                <h4 class="noted mb-5">Billing Details</h4>
                <div class="row">
                <div class="col-6">
                    <p><strong>Name: </strong><?php echo $fn . " " . $ln ?></p>
                    <p><strong>Receipt ID: </strong><?php echo $billingid . "-" . $billingid?></p>
                    <p><strong>Room: </strong><?php echo $roomtitle . "-" . $roomtyped ?></p>
                    <p><strong>Total Price: </strong>₱ <?php echo $totprice?></p>
                    <p><strong>Initial Deposit: </strong>₱ <?php echo $downp?></p>
                </div>

                <div class="col-6">
                    <p><strong>Booking Date: </strong><?php echo $bookingdate ?></p>
                    <p><strong>Due Date: </strong><?php echo $expirydate?></p>
                    <p><strong>Payment Method: </strong><?php echo $pmethod?></p>
                </div>

                <p align="center"><strong>Screenshot this invoice and present it to the staff at the Mariposa Farm Resort during check-in</strong></p>
                
                <hr>

                <div class="col" align="center">

                <?php
                    if($pmethod == "Gcash")
                    echo '<p>For Online GCash Payments, send the appropriate amount of payment to <strong>0999-999-9999</strong> and send the receipt through our email at: <br> <button class="buttoned" onclick=document.location="contacts.php">Email</button></p>'
                ?>

                </div>
                </div>
            </div>
            <div class="column">
                <button class="buttoned" onclick="bookAgain()">Book Another Room</button>
            </div>
            <div class="column">
                <button class="buttoned" onclick="goToNextPage()">Go Back to Dashboard</button>
            </div>
        </section>

        <script>
            function bookAgain(){
                window.location.href = "rooms.php";
            }
            function goToNextPage(){
                window.location.href = "index2.php";
            }
        </script>
    </body>
</html>
