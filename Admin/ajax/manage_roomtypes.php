<?php
    require("../db_config/DBCall_admin_login.php");
    require("../essentials/func.php");
    adminlogin("Main Admin");


    if(isset($_POST['retrieve_types'])){
        $asrslt = selectingAll("roomtype");
        $ctr = 1;
    
        $info = "";
        while($asrow = mysqli_fetch_assoc($asrslt)){
            $info .= "
                <tr class='align-middle'>
                    <td> $asrow[rt_id] </td>
                    <td> $asrow[room_type] </td>
                    <td> $asrow[price] </td>
                    <td>
                        <button type='button' class='btn btn-warning shadow-none btn-sm mx-1' onclick='edit_rdetail($asrow[rt_id])' data-bs-toggle='modal' data-bs-target='#editType'>
                            <i class='bi bi-pencil'></i> Edit
                        </button>
                        <button type='button' class='btn btn-danger shadow-none btn-sm' onclick='remove_type($asrow[rt_id])'>
                            <i class='bi bi-trash'></i> Delete
                        </button>
                    </td>
                </tr>
            ";
            $ctr++;
        }
        echo $info;
    }

    if(isset($_POST['retrieve_features'])){
        $asrslt = selectingAll("features");
        $ctr = 1;
    
        $info = "";
        while($asrow = mysqli_fetch_assoc($asrslt)){
            $info .= "
                <tr class='align-middle'>
                    <td> $asrow[f_id] </td>
                    <td> $asrow[feature] </td>
                </tr>
            ";
            $ctr++;
        }
        echo $info;
    }


    if(isset($_POST['add_type'])){

        $frm_info = filteringSql($_POST);
        $flag = 0;

        $assql = "SELECT * FROM roomtype WHERE room_type = ?";
        if($asstmt = mysqli_prepare($ascon, $assql)){
        mysqli_stmt_bind_param($asstmt, "s", $frm_info['type']);
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

        
        $assql = "INSERT INTO `roomtype`(`room_type`, `room_desc`, `price`) VALUES (?, ?, ?)";
        $val = [$frm_info['type'], $frm_info['desc'], $frm_info['price']];
        if(insertion($assql, $val, 'ssd')){
            $flag = 1;
        }

        if($flag){
            echo 1;
        }else{
            echo 0;
        }
    }


    if(isset($_POST['add_the_feat'])){

        $frm_info = filteringSql($_POST);
        $flag = 0;

        $assql = "SELECT * FROM features WHERE feature = ?";
        if($asstmt = mysqli_prepare($ascon, $assql)){
        mysqli_stmt_bind_param($asstmt, "s", $frm_info['feat']);
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

        
        $assql = "INSERT INTO `features`(`feature`) VALUES (?)";
        $val = [$frm_info['feat']];
        if(insertion($assql, $val, 's')){
            $flag = 1;
        }

        if($flag){
            echo 1;
        }else{
            echo 0;
        }
    }


    if(isset($_POST['get_room'])){
        $frm_info = filteringSql($_POST);

        $assql1 = "SELECT * FROM `roomtype` WHERE `rt_id` = ?";
        $asrslt1 = selectMatching($assql1, [$frm_info['get_room']], 'i');
        $rm_info = mysqli_fetch_assoc($asrslt1);

        $infos = ["rm_info" => $rm_info];

        $infos = json_encode($infos);
        echo $infos;
    }


    if(isset($_POST['edit_type'])){

        $frm_info = filteringSql($_POST);
        $flag = 0;
        
        $assql = "SELECT * FROM roomtype WHERE room_type = ? AND rt_id != ?";
        if($asstmt = mysqli_prepare($ascon, $assql)){
        mysqli_stmt_bind_param($asstmt, "si", $frm_info['rtype'], $frm_info['rt_id']);
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

        
        $assql = "UPDATE `roomtype` SET `room_type`= ?, `room_desc`= ?, `price`= ? WHERE `rt_id` = ?";
        $val = [$frm_info['rtype'], $frm_info['desc'], $frm_info['price'], $frm_info['rt_id']];
        if(updateMe($assql, $val, 'ssdi')){
            $flag = 1;
        }

        if($flag){
            echo 1;
        }else{
            echo 0;
        }
    }



    if(isset($_POST["remove_rt"])){
        $frm_info = filteringSql($_POST);
        
        $asrslt2 = deleteMe("DELETE FROM `roomtype` WHERE `rt_id` = ?", [$frm_info['rt_id']], 'i');
        if($asrslt2){
            echo 1;
        }else{
            echo 0;
        }
    }
?>