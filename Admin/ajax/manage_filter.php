<?php
require("../db_config/DBCall_admin_login.php");
require("../essentials/func.php");

session_start();

    if(isset($_GET['filterings'])){

        $rm_ctr = 0;
        $output = "";
        // Verify the SQL query
        $query = "SELECT r.*, rt.* 
        FROM room r 
        INNER JOIN roomtype rt ON r.room_type_id = rt.rt_id 
        WHERE r.status = ? AND r.removed = ? 
        ORDER BY r.room_name";

        $rm_res = selectMatching($query, [1, 0], "ii");

        if (!$rm_res) {
        die("Error: Room type not found.");
        }

        while ($rm_info = mysqli_fetch_assoc($rm_res)) {
        $rm_res2 = mysqli_query($ascon, "SELECT f.feature FROM `features` f 
                                            INNER JOIN `roomfeature` rfea ON f.f_id = rfea.f_id 
                                            WHERE rfea.rm_id = '$rm_info[rm_id]'");

        if (!$rm_res2) {
                die("Error fetching features: " . mysqli_error($ascon));
        }

        $feat_info = "";
        while ($feat_info_row = mysqli_fetch_assoc($rm_res2)) {
                $feat_info .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>" .
                            $feat_info_row['feature'] . "</span>";
        }

        $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
        $thumb_q = mysqli_query($ascon, "SELECT * FROM `roomimage` 
                                            WHERE `rm_id` = $rm_info[rm_id] LIMIT 1");

        if (mysqli_num_rows($thumb_q) > 0) {
                $thumb_rslt = mysqli_fetch_assoc($thumb_q);
                $room_thumb = ROOMS_IMG_PATH . $thumb_rslt['image'];
        }

        $output .="
        <div class='card mb-4 border-0 shadow'>
                <div class='row g-0 p-3 align-items-center'>
                    <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
                    <img src='$room_thumb' class='img-fluid w-100 rounded-start'>
                    </div>
                    <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                    <h5 class='mb-3'>$rm_info[room_name]</h5>
                    <h6 class='mb-3'>$rm_info[room_type]</h6>
                    <div class='features mb-3'>
                            <h6 class='mb-1'>Features</h6>
                            $feat_info
                    </div>
                    <div class='guests'>
                            <span class='badge rounded-pill bg-light text-dark text-wrap'>
                            Adult Capacity: $rm_info[adult_capacity] </span>
                            <span class='badge rounded-pill bg-light text-dark text-wrap'>
                            Child Capacity: $rm_info[child_capacity] </span>
                    </div>
                    </div>
                    <div class='col-md-2 mt-lg-0 mt-md-0 mt-4 text-center'>
                    <h6 class='mb-4'>₱ $rm_info[price] per night</h6>
                    <a href='#' class='btn btn-sm w-100 text-bg-success shadow-none mb-2'>Book Room</a>
                    <a href='room_details.php?id=$rm_info[rm_id]' target='_blank' class='btn btn-sm w-100 btn-outline-dark shadow-none'>View Details</a>
                    </div>
                </div>
        </div>
        ";

        $rm_ctr++;
        }
        if($rm_ctr > 0){
            echo $output;
        }else{
            echo "<h3 class='text-center text-danger'>No rooms to show!</h3>";
        }
    }

?>