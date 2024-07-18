<?php
    require("../db_config/DBCall_admin_login.php");
    require("../essentials/func.php");
    adminlogin("Reservations Manager");

    if(isset($_POST['retrieve_cancelled'])){
        $newasrslt = selectingAll("cancelled_bookings");
        $ctr = 1;
    
        $info = "";
    
        while($asrow = mysqli_fetch_assoc($newasrslt)){
            $info .= "
                <tr class='align-middle'>
                    <td> $asrow[cancelled_id] </td>
                    <td> $asrow[datein] </td>
                    <td> $asrow[dateout] </td>
                    <td> $asrow[adultnum] </td>
                    <td> $asrow[childnum] </td>
                    <td> $asrow[price] </td>
                    <td> $asrow[roomid] </td>
                    <td> $asrow[c_userid] </td>
                </tr>
            ";
            $ctr++;
        }
        echo $info;
    }

?>