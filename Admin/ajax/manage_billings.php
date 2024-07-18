<?php
    require("../db_config/DBCall_admin_login.php");
    require("../essentials/func.php");
    adminlogin("Reservations Manager");

    if (isset($_POST['retrieve_billings'])) {
        $sql = "SELECT r.room_name, r.room_type_id, bl.*, rt.room_type, a.c_email
                FROM room r 
                INNER JOIN billings bl ON r.rm_id = bl.rm_id
                INNER JOIN roomtype rt ON r.room_type_id = rt.rt_id
                INNER JOIN accounts a ON a.c_userid = bl.c_userid
                WHERE bl.billstatus = 'pending'
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
                    <td> {$asrow['bill_id']} </td>
                    <td> {$asrow['downpayment']} </td>
                    <td> {$asrow['totprice']} </td>
                    <td> {$asrow['paymentmethod']} </td>
                    <td> {$asrow['bookingdate']} </td>
                    <td> {$asrow['expirydate']} </td>
                    <td> {$asrow['room_name']} </td>
                    <td> {$asrow['room_type']} </td>
                    <td> {$asrow['c_email']} </td>
                    <td> {$asrow['datein']} </td>
                    <td> {$asrow['dateout']} </td>
                    <td> {$asrow['billstatus']} </td>
                    <td> <button class='btn btn-success' onclick ='book_now({$asrow['bill_id']})'> Confirm Booking </button> </td>
                    <td> <button class='btn btn-danger' onclick ='cancel_now({$asrow['bill_id']})'> Cancel Booking </button> </td>
                </tr>
            ";
        }
        echo $info;
    }
    
    if (isset($_POST['book_now'])) {
        $rec = 0;
        $frm_info = filteringSql($_POST);
        $bill_id = $frm_info['book_now'];
    
        // Retrieve billing details
        $sql = "SELECT * FROM billings WHERE bill_id = ?";
        $stmt = mysqli_prepare($ascon, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $bill_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $billing_details = mysqli_fetch_assoc($result);

        $sql = ("
        SELECT * FROM bookings 
        WHERE roomid = '$billing_details[rm_id]' AND datein <= '$billing_details[dateout]' AND dateout >= '$billing_details[datein]'");
        if((mysqli_num_rows(mysqli_query($ascon, $sql))>0)){
            echo 0;
            die('<script type="text/javascript">alert("Please repick a new date, Given dates have already been booked for this room.");</script>');
        }
    
        if ($billing_details) {
            $datein = date('Y-m-d', strtotime($billing_details['datein']));
            $dateout = date('Y-m-d', strtotime($billing_details['dateout']));
            // Insert into bookings
            $insert_query = "INSERT INTO bookings (datein, dateout, adultnum, childnum, price, roomid, c_userid)
                             VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($ascon, $insert_query);
            mysqli_stmt_bind_param($stmt, 'ssiiiii', 
                $billing_details['datein'], 
                $billing_details['dateout'], 
                $billing_details['adult_num'], 
                $billing_details['child_num'], 
                $billing_details['totprice'], 
                $billing_details['rm_id'], 
                $billing_details['c_userid']
            );
    
            if (mysqli_stmt_execute($stmt)) {
                // Update the billstatus in billings
                $assql = "UPDATE `billings` SET `billstatus` = 'booked' WHERE `bill_id` = ? AND `billstatus` = 'pending'";
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

    if (isset($_POST['cancel_now'])) {
        $frm_info = filteringSql($_POST);
        $bill_id = $frm_info['cancel_now'];
    
        // Retrieve billing details
        $sql = "SELECT * FROM billings WHERE bill_id = ?";
        $stmt = mysqli_prepare($ascon, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $bill_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $billing_details = mysqli_fetch_assoc($result);
    
        if ($billing_details) {
            $datein = date('Y-m-d', strtotime($billing_details['datein']));
            $dateout = date('Y-m-d', strtotime($billing_details['dateout']));
            // Insert into bookings
            $insert_query = "INSERT INTO cancelled_bookings (datein, dateout, adultnum, childnum, price, roomid, c_userid)
                             VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($ascon, $insert_query);
            mysqli_stmt_bind_param($stmt, 'ssiiiii', 
                $billing_details['datein'], 
                $billing_details['dateout'], 
                $billing_details['adult_num'], 
                $billing_details['child_num'], 
                $billing_details['totprice'], 
                $billing_details['rm_id'], 
                $billing_details['c_userid']
            );
    
            if (mysqli_stmt_execute($stmt)) {
                // Update the billstatus in billings
                $assql = "UPDATE `billings` SET `billstatus` = 'cancelled' WHERE `bill_id` = ? AND `billstatus` = 'pending'";
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
