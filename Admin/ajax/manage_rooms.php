<?php
    require("../db_config/DBCall_admin_login.php");
    require("../essentials/func.php");
    adminlogin("Main Admin");

    if(isset($_POST['add_room'])){

        $features = filteringSql(json_decode($_POST['features']));
        $frm_info = filteringSql($_POST);
        $flag = 0;

        $rtype = $frm_info['rmtype'];
        $assql = "SELECT rt_id FROM roomtype WHERE room_type = ?";
        if($asstmt = mysqli_prepare($ascon, $assql)){
            mysqli_stmt_bind_param($asstmt, "s", $rtype);
            mysqli_stmt_execute($asstmt);
            $asrslt = mysqli_stmt_get_result($asstmt);
            if($asrow = mysqli_fetch_assoc($asrslt)){
                $rt_id_now = $asrow["rt_id"];
            }else {
                die("Error: Room type not found.");
            }
            mysqli_stmt_close($asstmt);
        }else {
            die("Error preparing statement");
        }

        $removed = 0;

        $assql = "SELECT * FROM room WHERE room_name = ? AND room_type_id = ? AND removed = ?";
        if($asstmt = mysqli_prepare($ascon, $assql)){
        mysqli_stmt_bind_param($asstmt, "sii", $frm_info['rmname'], $rt_id_now, $removed);
        mysqli_stmt_execute($asstmt);
        $asrslt = mysqli_stmt_get_result($asstmt);
        if(mysqli_num_rows($asrslt) > 0){
            ob_clean();
            echo 2; 
            exit;
        }
        mysqli_stmt_close($asstmt);
        } else {
        die("Error preparing statement for checking room existence");
        }

        
        $assql = "INSERT INTO `room`(`room_name`, `room_type_id`, `status`, `adult_capacity`, `child_capacity`, `removed`) VALUES (?, ?, ?, ?, ?, ?)";
        $val = [$frm_info['rmname'], $rt_id_now, 1, $frm_info['adult'], $frm_info['child'], 0];
        if(insertion($assql, $val, 'siiiii')){
            $flag = 1;
        }
        $rm_id = mysqli_insert_id($ascon);

        $assql2 = "INSERT INTO `roomfeature`(`rm_id`, `f_id`) VALUES (?, ?)";
        if($asstmt2 = mysqli_prepare($ascon, $assql2)){
            foreach($features as $feature){
                mysqli_stmt_bind_param($asstmt2, 'ii', $rm_id, $feature);
                mysqli_stmt_execute($asstmt2);
            }mysqli_stmt_close($asstmt2);
        }else{
            $flag = 0;
            die("Error in creation of room!");
        }

        if($flag){
            echo 1;
        }else{
            echo 0;
        }
    }

    if(isset($_POST['retrieve_rooms'])){
        $asrslt = selectMatching("SELECT * FROM `room` WHERE `removed` != ? ORDER BY `room_name`", [1], "i");
        $newasrslt = selectingAll("roomtype");
        $ctr = 1;
    
        $room_typez = array();
    
        while($newasrow = mysqli_fetch_assoc($newasrslt)){
            $room_typez[$newasrow['rt_id']] = $newasrow['room_type'];
        }
    
        $info = "";
    
        while($asrow = mysqli_fetch_assoc($asrslt)){
            if($asrow['status'] == 1){
                $rm_status = "<button class='btn btn-success btn-sm shadow-none' onclick='changestatus($asrow[rm_id], 0)'>Active</button>";
            }else{
                $rm_status = "<button class='btn btn-danger btn-sm shadow-none' onclick='changestatus($asrow[rm_id], 1)'>Inactive</button>";
            }
            $room_type = isset($room_typez[$asrow['room_type_id']]) ? $room_typez[$asrow['room_type_id']] : 'Null';
    
            $info .= "
                <tr class='align-middle'>
                    <td> $asrow[rm_id] </td>
                    <td> $asrow[room_name] </td>
                    <td> $room_type </td>
                    <td>
                        <span class='badge rounded-pill bg-light text-dark'>
                        Adult: $asrow[adult_capacity]
                        </span><br>
                        <span class='badge rounded-pill bg-light text-dark'>
                        Children: $asrow[child_capacity]
                        </span>
                    </td>
                    <td>$rm_status</td>
                    <td>
                        <button type='button' class='btn btn-warning shadow-none btn-sm mx-1' onclick='edit_rdetail($asrow[rm_id])' data-bs-toggle='modal' data-bs-target='#editRoom'>
                            <i class='bi bi-pencil'></i> Edit
                        </button>
                        <button type='button' class='btn btn-danger shadow-none btn-sm' onclick='remove_room($asrow[rm_id])'>
                            <i class='bi bi-trash'></i> Delete
                        </button>
                        <button type='button' class='btn btn-primary shadow-none btn-sm' onclick=\"room_images($asrow[rm_id], '$asrow[room_name]')\" data-bs-toggle='modal' data-bs-target='#imageRoom'>
                            <i class='bi bi-card-image'></i>
                        </button>
                    </td>
                </tr>
            ";
            $ctr++;
        }
        echo $info;
    }


    if(isset($_POST['retrieve_accs'])){
        $newasrslt = selectingAll("accounts");
        $ctr = 1;
    
        $info = "";
    
        while($asrow = mysqli_fetch_assoc($newasrslt)){
            $info .= "
                <tr class='align-middle'>
                    <td> $asrow[c_userid] </td>
                    <td> $asrow[c_first_name] </td>
                    <td> $asrow[c_last_name] </td>
                    <td> $asrow[c_address] </td>
                    <td> $asrow[c_birthdate] </td>
                    <td> $asrow[c_age] </td>
                    <td> $asrow[c_contactnum] </td>
                    <td> $asrow[c_gender] </td>
                    <td> $asrow[c_email] </td>
                </tr>
            ";
            $ctr++;
        }
        echo $info;
    }

    
    if(isset($_POST['changestatus'])){
        $frm_info = filteringSql($_POST);
        
        $assql = "UPDATE `room` SET `status` = ? WHERE rm_id = ?";
        $enabler = [$frm_info['value'], $frm_info['changestatus']];
        if(updateMe($assql, $enabler, 'ii')){
            ob_clean();
            echo 1;
        }else{
            ob_clean();
            echo 0;
        }
    }
    

    if(isset($_POST['get_room'])){
        $frm_info = filteringSql($_POST);

        $assql1 = "SELECT * FROM `room` WHERE `rm_id` = ?";
        $asrslt1 = selectMatching($assql1, [$frm_info['get_room']], 'i');
        $rm_info = mysqli_fetch_assoc($asrslt1);

        $assql2 = "SELECT * FROM `roomfeature` WHERE `rm_id` = ?";
        $asrslt2 = selectMatching($assql2, [$frm_info['get_room']], 'i');

        $assql3 = "SELECT room_type from roomtype where rt_id = ?";
        $asrslt3 = selectMatching($assql3, [$rm_info['room_type_id']], 'i');
        $room_type_info = mysqli_fetch_assoc($asrslt3);
        $rm_info['room_type'] = $room_type_info['room_type'];

        $features = [];

        if(mysqli_num_rows($asrslt2) > 0){
            while($asrow = mysqli_fetch_assoc($asrslt2)){
                array_push($features, $asrow['f_id']);
            }
        }

        $infos = ["rm_info" => $rm_info, "features" => $features];

        $infos = json_encode($infos);
        echo $infos;
    }



    if(isset($_POST['edit_room'])){

        $features = filteringSql(json_decode($_POST['features']));
        $frm_info = filteringSql($_POST);
        $flag = 0;

        $rtype = $frm_info['rmtype'];
        $assql = "SELECT rt_id FROM roomtype WHERE room_type = ?";
        if($asstmt = mysqli_prepare($ascon, $assql)){
            mysqli_stmt_bind_param($asstmt, "s", $rtype);
            mysqli_stmt_execute($asstmt);
            $asrslt = mysqli_stmt_get_result($asstmt);
            if($asrow = mysqli_fetch_assoc($asrslt)){
                $rt_id_now = $asrow["rt_id"];
            }else {
                die("Error: Room type not found.");
            }
            mysqli_stmt_close($asstmt);
        }else {
            die("Error preparing statement");
        }

        error_log("rt_id_now: " . $rt_id_now);
        $removed = 0;
        $assql = "SELECT * FROM room WHERE room_name = ? AND rm_id != ? AND room_type_id = ? AND removed = ?";
        if($asstmt = mysqli_prepare($ascon, $assql)){
        mysqli_stmt_bind_param($asstmt, "siii", $frm_info['rmname'], $frm_info['rm_id'], $rt_id_now, $removed);
        mysqli_stmt_execute($asstmt);
        $asrslt = mysqli_stmt_get_result($asstmt);
        if(mysqli_num_rows($asrslt) > 0){
            echo 2; 
            exit;
        }
        mysqli_stmt_close($asstmt);
        } else {
        die("Error preparing statement for checking room existence");
        }

        
        $assql = "UPDATE `room` SET `room_name`= ?, `room_type_id`= ?, `status`= ?, `adult_capacity`= ?, `child_capacity`= ? WHERE `rm_id` = ?";
        $val = [$frm_info['rmname'], $rt_id_now, 1, $frm_info['adult'], $frm_info['child'], $frm_info['rm_id']];
        if(updateMe($assql, $val, 'siiiii')){
            $flag = 1;
        }

        $assql1 = "DELETE FROM `roomfeature` WHERE `rm_id` = ?";
        $val2 = [$frm_info['rm_id']];
        $del_feat = deleteMe($assql1, $val2, 'i');
        if(!$del_feat){
            $flag = 0;
        }

        $assql2 = "INSERT INTO `roomfeature`(`rm_id`, `f_id`) VALUES (?, ?)";
        if($asstmt2 = mysqli_prepare($ascon, $assql2)){
            foreach($features as $feature){
                mysqli_stmt_bind_param($asstmt2, 'ii', $frm_info['rm_id'], $feature);
                mysqli_stmt_execute($asstmt2);
            }$flag = 1;
            mysqli_stmt_close($asstmt2);
        }else{
            $flag = 0;
            die("Error in creation of room!");
        }

        if($flag){
            echo 1;
        }else{
            echo 0;
        }
    }


    if(isset($_POST['add_image'])){
        $frm_info = filteringSql($_POST);

        $img_r = uploadImg($_FILES['image'], ROOMS_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }else if($img_r == 'inv_size'){
            echo $img_r;
        }else if($img_r == 'upd_failed'){
            echo $img_r;
        }else{
            $q = "INSERT INTO `roomimage` (`rm_id`, `image`) VALUES (?,?)";
            $values = [$frm_info['rm_id'], $img_r];
            $res = insertion($q, $values, 'is');
            echo $res;
        }
    }


    if(isset($_POST['get_room_images'])){
        $frm_info = filteringSql($_POST);
        $res = selectMatching("SELECT *  FROM `roomimage` WHERE `rm_id` = ?", [$frm_info['get_room_images']], 'i');
        $path = ROOMS_IMG_PATH;

        while($asrow = mysqli_fetch_assoc($res)){
            echo <<<data
                <tr class= 'align-middle'>
                    <td><img src = '$path$asrow[image]' class= 'img-fluid'></td>
                    <td>
                        <button onclick='remove_image($asrow[ri_id], $asrow[rm_id])' class='btn btn-danger shadow-none btn-sm'>
                            <i class='bi bi-trash'></i> Delete
                        </button>
                    </td>
                </tr>
            data;
        }
    }


    if(isset($_POST['rem_image'])){
        $frm_info = filteringSql($_POST);
        $val = [$frm_info['image_id'], $frm_info['room_id']];

        $pre = "SELECT * FROM `roomimage` WHERE `ri_id` = ? AND `rm_id` = ?";
        $res = selectMatching($pre, $val, 'ii');
        $img = mysqli_fetch_assoc($res);
        
        if(deleteImage($img['image'], ROOMS_FOLDER)){
            $q = "DELETE FROM `roomimage` WHERE `ri_id` = ? AND `rm_id` = ?";
            $res = deleteMe($q, $val, 'ii'); 
            echo $res;
        }else{
            false;
        }
        

    }


    if(isset($_POST["remove_room"])){
        $frm_info = filteringSql($_POST);

        $asrslt = selectMatching("SELECT * FROM `roomimage` WHERE `rm_id` = ?", [$frm_info['room_id']], 'i');

        while($asrow = mysqli_fetch_assoc($asrslt)){
            deleteImage($asrow['image'], ROOMS_FOLDER);
        }

        
        $asrslt2 = deleteMe("DELETE FROM `roomfeature` WHERE `rm_id` = ?", [$frm_info['room_id']], 'i');
        $asrslt3 = updateMe("UPDATE `room` SET `removed` = ? WHERE `rm_id` = ?", [1, $frm_info['room_id']], 'ii');
        if($asrslt2 || $asrslt3){
            echo 1;
        }else{
            echo 0;
        }
    }
    
?>