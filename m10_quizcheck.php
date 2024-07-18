<?php

include "DBCall.php";

session_start();

$userid = $_COOKIE['username'];
$sql = "SELECT * FROM accounts WHERE c_email = '$userid'";
$result = mysqli_query($ascon, $sql);
$userrow = mysqli_fetch_array($result); 
$usernum = $userrow['c_userid'];
$fn = $_POST["FirstName"];
$ln = $_POST["LastName"];
$email = $_POST["Email"];
$contact = $userrow["c_contactnum"];
$datein = $_POST['datein'];
$dateout = $_POST['dateout'];
$room = $_POST['Room'];
$adultnum = $_POST['Adultnum'];
$childnum = $_POST['Childnum'];

echo $_GET['id'];

$sql = "SELECT r.*, rt.* 
        FROM room r 
        INNER JOIN roomtype rt ON r.room_type_id = rt.rt_id 
        WHERE r.rm_id = $_GET[id] AND r.status = 1 AND r.removed = 0 
        ORDER BY r.room_name";

$result = mysqli_query($ascon,$sql);
$roomrow = mysqli_fetch_array($result, MYSQLI_ASSOC); 
$roomtitle = $roomrow['room_name'];
$roomtype = $roomrow['room_type'];
$price = $roomrow['price'];



$date1=date_create($datein);
$date2=date_create($dateout);
$datediff=date_diff($date1,$date2)->format("%a");
$totprice=$price * $datediff;

$bookingdate = date("Y-m-d");
$bdate = strtotime($bookingdate);
$expirydate = date("Y-m-d", strtotime("+1 day", $bdate));

?>

<?php require("../PHP_PROJECT_FINALE/Admin/bootstraplinks/linking.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="stylebook.css">
        <title>Room Booking</title>
    </head>
    <body style="background-image: url(home.png);">
        <h1 class="text-center m-5" style="color: rgba(231, 199, 72);">Check Details</h1>
            <div class="justify-content-center p-5 d-flex align-middle col-md-8 container" style="background-color: rgba(231, 199, 72, 0.7); border-radius: 2rem;">
                <form class="w-100" action="" method="POST" id="bookingdeets">
                    <div class="row col-12">
                        <div class="col-6 my-3 form-group">
                            <label>First Name: <br><input readonly type="text" name="FirstName" value="<?php echo $fn; ?>"></input></label>
                        </div>
                        <div class="col-6 my-3 form-group">
                            <label>Last Name: <br><input readonly type="text" name="LastName" value="<?php echo $ln; ?>"></input></label>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-6 my-3 form-group">
                            <label>Email Address: <br><input readonly type="text" name="Email" value="<?php echo $email; ?>"></input></label>
                        </div>
                        <div class="col-6 my-3 form-group">
                            <label>Contact Number: <br><input readonly type="text" name="Contact" value="<?php echo $contact; ?>"></input></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row col-12">
                        <div class="col-6">
                            <div class="my-3 form-group">
                                <label>Date In: <br><input readonly type="date" id="datein" name="datein" value="<?php echo $datein; ?>"></label>
                            </div>
                            <div class=" my-3 form-group">
                                <label>Date Out: <br><input readonly type="date" id="dateout" name="dateout" value="<?php echo $dateout; ?>" ></label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="my-3 form-group">
                                <label>Number of Adults: <br><input readonly type="number" name="Adultnum" value="<?php echo $adultnum; ?>"></input></label>
                            </div>
                            <div class="my-3 form-group">
                                <label>Number of Children: <br><input readonly type="number" name="Childnum" value="<?php echo $childnum; ?>"></input></label>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-6 my-3 form-group">
                            <label>Rooms:</label><br>
                            <select name="Room" readonly>
                                <option readonly value="<?php echo $room; ?>"><?php echo $roomtitle . " (" . $roomtype . ")"; ?></option>
                            </select>
                        </div>
                        <div class="col-6 my-3 form-group">
                            <label>Price per night: <br><input readonly type="number" name="Price" value="<?php echo $price; ?>"></input></label>
                        </div>

                        <div class="col-6 my-3 form-group">
                            <label>Number of Days: <br><input readonly type="number" name="NumberofDays" value="<?php echo $datediff; ?>"></input></label>
                        </div>

                        <div class="col-6 my-3 form-group">
                            <label>Total Price: <br><input readonly type="number" name="Totalprice" value="<?php echo $totprice; ?>"></input></label>
                        </div>

                    </div>
                    <div class="row col-12">
                        <div class="col-6 my-3 form-group">
                            <label>Payment Method:</label><br>
                            <select name="Payment" required>
                                <option value=Cash>Cash</option>
                                <option value=Gcash>Online Payment (GCash)</option>
                            </select>
                        </div>
                        <div class="col-6 my-3 form-group">
                            <label>Down Payment: <br><input readonly type="number" name="Down" value="<?php echo $totprice * 0.20; ?>"></input></label>
                        </div>
                    </div>
                    <div class="row col-12">
                    <div class="col-6 my-3 form-group">
                            <input type="checkbox" required> I have read and accepted the 
                            <button type="button" class="btn" style="font-size: 17px; text-decoration: underline;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Terms and Conditions
                            </button>

                            <!-- Modal -->
                            <div class="modal fade w-100" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Mariposa Farm Resort Terms and Conditions</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>1. Check-In and Check-Out
                                        Check-In Time: After 3:00 PM
                                        Check-Out Time: Before 11:00 AM
                                    </p>
                                    <p>
                                    2. Down Payment
                                    Required Down Payment: <br> A down payment of 20% of the total availed room price is required to secure your reservation.
                                    </p>
                                    <p> 2. Pets Policy
                                        No Pets Allowed: <br> For the comfort and safety of all our guests, pets are not permitted on the resort premises.</p>
                                        <p>
                                            3. Guest Responsibilities
                                            Before checking out, all guests are required to:<br><br>
                                            a. Dispose of Waste: Properly dispose of all waste products in the designated bins.<br>
                                            b. Turn Off Appliances: Ensure that all electrical appliances are turned off.<br>
                                            c. Return Keys: Return all keys to the reception.<br>
                                            d. Personal Belongings: Take responsibility for personal belongings. The resort is not liable for any lost or stolen items.<br>
                                        </p>
                                        
                                        <p>
                                            4. General Conduct
                                            Respect for Property: <br> Guests are expected to respect the property and facilities of the resort. Any damage caused by a guest will be charged to their account.
                                            <br>Noise Levels: Maintain a reasonable noise level to ensure the comfort of all guests. Quiet hours are observed from 10:00 PM to 8:00 AM.
                                        </p>
                                        <p>
                                            5. Liability
                                            Personal Injuries: <br> The resort is not liable for any personal injuries sustained on the premises. Guests are advised to take necessary precautions.
                                            Lost or Stolen Items:  <br> <br>The resort is not responsible for any lost or stolen items. Guests should secure their belongings.
                                        </p>
                                        <p>
                                            6. Compliance
                                            Adherence to Policies: <br> Guests must adhere to all resort policies and regulations. Failure to comply may result in additional charges or termination of the stay without refund.
                                            By confirming your reservation, you agree to abide by these terms and conditions. We appreciate your cooperation and wish you a pleasant stay at Mariposa Farm Resort.</p>
                                        </p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Understood</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-6 my-3 form-group">
                            <button class="btn btn-warning" type="submit" name="back">Cancel</button>
                        </div>
                        <div class="col-6 my-3 form-group">
                            <button class="btn btn-success" type="submit" name="submit">Book Reservation</button>
                        </div>
                    </div>
                </form>
            </div>

            <?php require("../PHP_PROJECT_FINALE/Admin/bootstraplinks/scripts.php"); ?>
    </body>
</html>

<script type="text/javascript">
    var confirm = document.getElementById('bookingdeets');

        confirm.addEventListener('submit', function(){
            return confirm('Are you sure you want to book this room? Please double check any details before proceeding to billing.');
        }, false);
</script>

<?php

if (isset($_POST['submit'])){
    $downp = $totprice * 0.20;
    $paymentmethod = $_POST['Payment'];
    if($datein > $dateout){
        die('<script type="text/javascript">alert("Please repick a new date, Check-in date should not be any later than the Check-out date.");</script>');
    }
    $sql = ("
    SELECT * FROM bookings 
    WHERE roomid = '$room' AND datein <= '$dateout' AND dateout >= '$datein'");
    if((mysqli_num_rows(mysqli_query($ascon, $sql))>0)){
        die('<script type="text/javascript">alert("Please repick a new date, Given dates have already been booked for this room.");</script>');
    }

    $sql2 = ("
    SELECT * FROM billings 
    WHERE bookingdate = '$bookingdate' AND expirydate = '$expirydate' AND c_userid = '$usernum' AND rm_id = '$room' AND billstatus ='pending'");
    if((mysqli_num_rows(mysqli_query($ascon, $sql2))>0)){
        die('<script type="text/javascript">alert("Please pick a new room to book, you have already booked this room!");</script>');
    }

    $sql3 = ("
    SELECT * FROM bookings 
    WHERE datein = '$datein' AND dateout = '$dateout' AND c_userid = '$usernum' AND rm_id = '$room'");
    if((mysqli_num_rows(mysqli_query($ascon, $sql2))>0)){
        die('<script type="text/javascript">alert("Please pick a new room to book, you have already booked this room!");</script>');
    }

    $assql = "INSERT INTO billings" . "(totprice, paymentmethod, downpayment, bookingdate, expirydate, c_userid, rm_id, datein, dateout, adult_num, child_num, billstatus)"
                                . "VALUES('$totprice', '$paymentmethod', '$downp', '$bookingdate', '$expirydate', '$usernum', '$room', '$datein', '$dateout', '$adultnum', '$childnum', 'pending')";
    
                if(mysqli_query($ascon, $assql)){
                    $sql = "SELECT * FROM `billings` WHERE rm_id = '$room' AND c_userid = '$usernum' AND datein = '$datein' AND dateout = '$dateout' AND bookingdate = '$bookingdate' AND expirydate = '$expirydate'";
                    $result = mysqli_query($ascon,$sql);
                    $pendingrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $pendingid = $pendingrow['bill_id'];
                    echo '<script type="text/javascript">alert("Kindly pay the downpayment set for your stay, currently, your booking is ready to be confirmed by a reservations manager.");</script>';
                    $_SESSION['pendingid'] = $pendingid;
                    echo "<script>window.location.href='successfulbooking.php';</script>";
                } else {
                    die('<script type="text/javascript">alert("Booking Failed.");</script>');
                }

    

                mysqli_close($ascon);
    }
if (isset($_POST['back'])){
    echo "<script>window.location.href='rooms.php';</script>";
}

?>