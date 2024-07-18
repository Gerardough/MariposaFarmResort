
<?php

    define('SITE_URL', 'http://127.0.0.1/php_project_finale/');
    define('ABOUT_IMG_PATH', SITE_URL. 'image/about/');
    define('ROOMS_IMG_PATH', SITE_URL. 'image/rooms/');

    define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/php_project_finale/image/');
    define('UPLOADS_FOLDER', 'uploads/');
    define('ROOMS_FOLDER', 'rooms/');


    function adminlogin($required_type){
        session_start();
        if (!isset($_SESSION['adminLogin']) || $_SESSION['adminLogin'] !== true) {
            echo "<script>
                window.location.href='adminlogin.php';
            </script>";
            exit();
        } else {
            if ($_SESSION['admin_type'] !== $required_type) {
                if ($_SESSION['admin_type'] === 'Main Admin') {
                    echo "<script>
                        window.location.href='madashboard.php';
                    </script>";
                    exit();
                } elseif ($_SESSION['admin_type'] === 'Reservations Manager') {
                    echo "<script>
                        window.location.href='rmdashboard.php';
                    </script>";
                    exit();
                }
            }
        }session_regenerate_id(true);
    }


    function userlogin(){
        session_start();
        if (!(isset($_SESSION['userLogin']) && $_SESSION['userLogin'] == true)) {
            echo "<script>
                window.location.href='loginpage.php';
            </script>";
            exit();
        }session_regenerate_id(true);
    }


    function redirection($loc){
        echo "<script>
            window.location.href='$loc';
        </script>";
    }


    function alerting($status, $mess){
        $statusholder = ($status == "success") ? "alert-success" : "alert-danger";


        echo <<<alert
            <div class="alert $statusholder alert-dismissible fade show customized" role="alert">
                <strong me-3>$mess</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        alert;
    }


    function uploadImg($img, $folder){
        $valid = ['image/jpeg', 'image/png', 'image/webp'];
        $img_mime = $img['type'];

        if(!in_array($img_mime, $valid)){
            return 'inv_img';
        }
        elseif(($img['size']/(1024*1024)) > 2){
            return 'inv_size';
        }else{
            $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
            $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($img['tmp_name'], $img_path)){
                return $rname;
            }else{
                return 'upd_failed';
            }
        }
    }
?>