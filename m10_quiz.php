<?php

include "DBCall.php";
require("../PHP_PROJECT_FINALE/Admin/db_config/DBCall_admin_login.php");
require("../PHP_PROJECT_FINALE/Admin/essentials/func.php");
session_start();

if(!isset($_GET['id'])){
    redirection('filteredrooms.php');
}

$info = filteringSql($_GET);

if (isset($_POST["logoutbuttoned"])) {
    if (isset($_SESSION['refresher_ctr'])) {
        session_unset();
        session_destroy(); 
        header("Location: loginpage.php");
        exit(); 
    }
}

$userid = $_COOKIE['username'];
$sql = "SELECT * FROM accounts WHERE c_email = '$userid'";
$result = mysqli_query($ascon, $sql);
$userrow = mysqli_fetch_array($result); 
$fn = $userrow["c_first_name"];
$ln = $userrow["c_last_name"];
$email = $userrow["c_email"];
$contact = $userrow["c_contactnum"];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="stylebook.css">
        <title>Room Booking</title>

        <script>
            function setMinDates() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();

            // Format today's date as YYYY-MM-DD
            today = yyyy + '-' + mm + '-' + dd;

            // Set minimum date for Date In as today
            document.getElementById("datein").setAttribute("min", today);

            // Set minimum date for Date Out to be always one day after the current date
            var tomo = new Date(today);
            tomo.setDate(tomo.getDate() + 1);
            var dTomo = String(tomo.getDate()).padStart(2, '0');
            var mTomo = String(tomo.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yTomo = tomo.getFullYear();
            var formattedTomo = yTomo + '-' + mTomo + '-' + dTomo;
            document.getElementById("dateout").setAttribute("min", formattedTomo);
        }

        function init() {
            setMinDates();

            var dateInPicker = document.getElementById("datein");
            var dateOutPicker = document.getElementById("dateout");

            dateInPicker.addEventListener("change", function () {
                if (dateInPicker.value) {
                    dateOutPicker.value = "";
                    var checkInDate = new Date(dateInPicker.value);
                    var minCheckOutDate = new Date(checkInDate);
                    minCheckOutDate.setDate(checkInDate.getDate() + 1);

                    var dd = String(minCheckOutDate.getDate()).padStart(2, '0');
                    var mm = String(minCheckOutDate.getMonth() + 1).padStart(2, '0');
                    var yyyy = minCheckOutDate.getFullYear();
                    var formattedMinCheckOutDate = yyyy + '-' + mm + '-' + dd;

                    dateOutPicker.setAttribute("min", formattedMinCheckOutDate);
                } else {
                    setMinDates();
                }
            });

            dateOutPicker.addEventListener("change", function () {
                if (dateOutPicker.value && new Date(dateOutPicker.value) <= new Date(dateInPicker.value)) {
                    alert("Date Out must be at least one day after Date In");
                    dateOutPicker.value = "";
                }
            });
        }

        window.onload = init;
        </script>
    </head>
    <body style="background-image: url(home.png);">
                <?php
                    if(isset($_SESSION['refresher_ctr'])){
                        $_SESSION['refresher_ctr'] += 1;
                    }else{
                        $_SESSION['refresher_ctr'] = 0;
                    }
                ?>
        <h1 class="text-center m-5" style="color: rgba(231, 199, 72);">Book a Room!</h1>
            <div class="justify-content-center p-5 d-flex align-middle col-md-8 container" style="background-color: rgba(231, 199, 72, 0.7); border-radius: 2rem;">
                <form class="w-100" action="m10_quizcheck.php?id=<?php echo $_GET['id'] ?>" method="POST">
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
                                <label>Date In: <br><input type="date" id="datein" name="datein" onfocus="DateIn()" required></label>
                            </div>
                            <div class=" my-3 form-group">
                                <label>Date Out: <br><input type="date" id="dateout" name="dateout" onfocus="DateOut()" required></label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="my-3 form-group">
                                <label>Number of Adults: <br><input type="number" name="Adultnum" value="1" min="1" max="3"></input></label>
                            </div>
                            <div class="my-3 form-group">
                                <label>Number of Children: <br><input type="number" name="Childnum" value="0" min="0" max="3"></input></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 my-3 form-group">
                            <label>Rooms:</label>
                            <select name="Room" required>
                                <?php
                                $sql = "SELECT r.*, rt.* 
                                        FROM room r 
                                        INNER JOIN roomtype rt ON r.room_type_id = rt.rt_id 
                                        WHERE r.rm_id = $_GET[id] AND r.status = 1 AND r.removed = 0 
                                        ORDER BY r.room_name";
                                $result = mysqli_query($ascon,$sql);
                                while($room = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    echo "<option value = " . $room['rm_id'] . ">" . $room['room_name'] . " (" . $room['room_type'] . ") </option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-6 my-3 form-group">
                            <input class="btn btn-success" type="submit" value="Proceed"></input>
                        </div>
                    </div>
                </form>
                <div class="column">
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                        <button class="btn btn-warning" onclick="window.history.go(-1); return false;" >Back</button>
                    </form>
                </div>
            </div>
    </body>
</html>