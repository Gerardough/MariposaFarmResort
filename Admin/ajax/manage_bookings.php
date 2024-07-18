<?php
    require("../db_config/DBCall_admin_login.php");
    require("../essentials/func.php");
    adminlogin("Reservations Manager");

    if (isset($_POST['retrieve_bookings'])) {
        $sql = "SELECT r.room_name, r.room_type_id, bk.*, rt.room_type, a.c_email
                FROM room r 
                INNER JOIN bookings bk ON r.rm_id = bk.roomid 
                INNER JOIN roomtype rt ON r.room_type_id = rt.rt_id
                INNER JOIN accounts a ON a.c_userid = bk.c_userid
                WHERE bk.checkedout = 0
                ORDER BY r.room_name";
    
        $ascon = $GLOBALS['ascon'];
        $asrslt = mysqli_query($ascon, $sql);
    
        if (!$asrslt) {
            die("Error executing query: " . mysqli_error($ascon));
        }
    
        $info = "";
        while ($asrow = mysqli_fetch_assoc($asrslt)) {
            $info .= "
                <tr class='align-middle'>
                    <td> {$asrow['booking_id']} </td>
                    <td> {$asrow['datein']} </td>
                    <td> {$asrow['dateout']} </td>
                    <td> {$asrow['adultnum']} </td>
                    <td> {$asrow['childnum']} </td>
                    <td> {$asrow['price']} </td>
                    <td> {$asrow['room_name']} </td>
                    <td> {$asrow['room_type']} </td>
                    <td> {$asrow['c_email']} </td>
                    <td> <button class='btn btn-warning' onclick='checkout({$asrow['booking_id']})'> Check out </button> </td>
                </tr>
            ";
        }
        echo $info;
    }

    if (isset($_POST['checkout'])) {
        $frm_info = filteringSql($_POST);
        $bill_id = $frm_info['checkout'];
    
        // Retrieve billing details
        $sql = "SELECT * FROM bookings WHERE booking_id = ?";
        $stmt = mysqli_prepare($ascon, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $bill_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $billing_details = mysqli_fetch_assoc($result);
    
        if ($billing_details) {
            $datein = date('Y-m-d', strtotime($billing_details['datein']));
            $dateout = date('Y-m-d', strtotime($billing_details['dateout']));
            // Insert into bookings
            $insert_query = "INSERT INTO checkedouts (datein, dateout, adultnum, childnum, price, roomid, c_userid)
                             VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($ascon, $insert_query);
            mysqli_stmt_bind_param($stmt, 'ssiiiii', 
                $datein, 
                $dateout, 
                $billing_details['adultnum'], 
                $billing_details['childnum'], 
                $billing_details['price'], 
                $billing_details['roomid'], 
                $billing_details['c_userid']
            );
    
            if (mysqli_stmt_execute($stmt)) {
                // Update the billstatus in billings
                $assql = "UPDATE `bookings` SET `checkedout` = 1 WHERE `booking_id` = ? AND `checkedout` = 0";
                $stmt = mysqli_prepare($ascon, $assql);
                mysqli_stmt_bind_param($stmt, 'i', $bill_id);
    
                if (mysqli_stmt_execute($stmt)) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            echo "Error: No billing details found.";
        }
    }
    
?>
