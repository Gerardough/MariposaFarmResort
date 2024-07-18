<?php
    $asserver = "localhost:3306";
    $asun = "root";
    $aspass = "";
    $asdbname = "client_management";

    // Checking connection
    $ascon = mysqli_connect($asserver, $asun, $aspass, $asdbname);
    // Check connection
    if (!$ascon) {
        die("Failed connecting, " . mysqli_connect_error());
    }

    function filteringSql($passed){
        foreach($passed as $key => $val){
            $passed[$key] = trim($val);
            $passed[$key] = stripcslashes($val);
            $passed[$key] = htmlspecialchars($val);
            $passed[$key] = strip_tags($val);
        }return $passed;
    }

    function selectMatching($assql, $val, $dtype){
        $ascon = $GLOBALS['ascon'];
        if($asstmt = mysqli_prepare($ascon, $assql)){
            mysqli_stmt_bind_param($asstmt, $dtype, ...$val);
            if(mysqli_stmt_execute($asstmt)){
                $asrslt = mysqli_stmt_get_result($asstmt);
                mysqli_stmt_close($asstmt);
                return $asrslt;
            }else{
                mysqli_stmt_close($asstmt);
                die("Cannot find data!");
           }

        }else{
            die("Cannot find data");
        }
    }

    function insertion($assql, $val, $dtype){
        $ascon = $GLOBALS['ascon'];
        if($asstmt = mysqli_prepare($ascon, $assql)){
            mysqli_stmt_bind_param($asstmt, $dtype, ...$val);
            if(mysqli_stmt_execute($asstmt)){
                $asrslt = mysqli_stmt_affected_rows($asstmt);
                mysqli_stmt_close($asstmt);
                return $asrslt;
            }else{
                mysqli_stmt_close($asstmt);
                die("Failed inserting record ... try again");
            }
        }else{
            die("Failed inserting record ... try again");
        }
    }

    function selectingAll($astab){
        $ascon = $GLOBALS['ascon'];
        $asrslt = mysqli_query($ascon, "SELECT * FROM $astab");
        return $asrslt;
    }

    function updateMe($assql, $val, $dtype){
        $ascon = $GLOBALS['ascon'];
        if($asstmt = mysqli_prepare($ascon, $assql)){
            mysqli_stmt_bind_param($asstmt, $dtype, ...$val);
            if(mysqli_stmt_execute($asstmt)){
                $asrslt = mysqli_stmt_affected_rows($asstmt);
                mysqli_stmt_close($asstmt);
                return $asrslt;
            }else{
                mysqli_stmt_close($asstmt);
                die("Failed updating record ... try again");
            }
        }else{
            die("Failed updating record ... try again");
        }
    }

    function deleteMe($assql, $val, $dtype){
        $ascon = $GLOBALS['ascon'];
        if($asstmt = mysqli_prepare($ascon, $assql)){
            mysqli_stmt_bind_param($asstmt, $dtype, ...$val);
            if(mysqli_stmt_execute($asstmt)){
                $asrslt = mysqli_stmt_affected_rows($asstmt);
                mysqli_stmt_close($asstmt);
                return $asrslt;
            }else{
                mysqli_stmt_close($asstmt);
                die("Failed deleting record ... try again");
            }
        }else{
            die("Failed deleting record ... try again");
        }
    }

    function deleteImage($image, $folder){
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
            return true;
        }else{
            return false;
        }
    }

?>