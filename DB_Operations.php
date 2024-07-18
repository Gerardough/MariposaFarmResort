<?php
// Creation of Database

    $asserver = "localhost:3306";
    $asun = "root";
    $aspass = "";
    // Establishing connection
    $ascon = mysqli_connect($asserver, $asun, $aspass);

    if(!$ascon){
        die("database connection failed!" . mysqli_connect_error());
    }

     // Creation of Database for Account
     $chkdb = "SHOW DATABASES LIKE 'client_management'";
     $aschk = mysqli_query($ascon,$chkdb);
     if(mysqli_num_rows($aschk) == 0){
         $assql = "CREATE DATABASE client_management";
         if(mysqli_query($ascon, $assql)){
                 echo "creation of database is successful!<br>";
         }else{
             echo "error in creation of database...<br>" . mysqli_error($ascon);
         }
     }
     else{
         echo "database already created<br>";
     }

    mysqli_close($ascon);
?>


<?php
    // Database connection details
    $asserver = "localhost:3306";
    $asun = "root";
    $aspass = "";
    $asdbname = "client_management";
    
    // Establishing connection
    $ascon = mysqli_connect($asserver, $asun, $aspass, $asdbname);
    
    // Check connection
    if (!$ascon) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Function to create tables if they do not exist
    function createTableIfNotExists($ascon, $tableName, $createQuery, $successMessage) {
        $chkdb = "SHOW TABLES LIKE '$tableName'";
        $aschk = mysqli_query($ascon, $chkdb);
        
        if(mysqli_num_rows($aschk) == 0){
            if(mysqli_query($ascon, $createQuery)){
                echo "$successMessage<br>";
            } else {
                echo "Error creating table $tableName: " . mysqli_error($ascon) . "<br>";
            }
        } else {
            echo "$tableName table already exists!<br>";
        }
    }
    
    // Create accounts table
    createTableIfNotExists($ascon, 'accounts', "
        CREATE TABLE accounts (
            c_userid INT(2) PRIMARY KEY AUTO_INCREMENT, 
            c_first_name TEXT NOT NULL,
            c_last_name TEXT NOT NULL,
            c_middle_name TEXT,
            c_address TEXT NOT NULL,
            c_birthdate DATE NOT NULL,
            c_age INT(2) NOT NULL,
            c_contactnum TEXT NOT NULL,
            c_gender VARCHAR(20),
            c_email TEXT UNIQUE NOT NULL,
            c_pass TEXT NOT NULL,
            c_reset_token_hash VARCHAR(64) NULL UNIQUE,  
            c_reset_token_expires_at DATETIME NULL
        )", "Creation of Client Account Table is Successful!");
?>


<?php
// Room type table creation
    $chkdb = "SHOW TABLES LIKE 'roomtype'";
    $aschk = mysqli_query($ascon, $chkdb);
    if(mysqli_num_rows($aschk) == 0){
        $assql = "CREATE TABLE roomtype(
                  rt_id INT(3) PRIMARY KEY AUTO_INCREMENT,
                  room_type VARCHAR(100) NOT NULL,
                  room_desc TEXT,
                  price DOUBLE)";
        if(mysqli_query($ascon, $assql)){
            echo "creation of roomtype table is successful! <br>";
        }else{
            echo "unsuccessful creation of roomtype table!... try again. " . mysqli_error($ascon) . "<br>";
        }
    }else{
        echo "roomtype table has been created already! <br>";
    }
?>


<?php
// Rooms table creation
    $chkdb = "SHOW TABLES LIKE 'room'";
    $aschk = mysqli_query($ascon, $chkdb);
    if(mysqli_num_rows($aschk) == 0){
        $assql = "CREATE TABLE room(
                rm_id INT(3) PRIMARY KEY AUTO_INCREMENT,
                room_name VARCHAR(300) NOT NULL,
                room_type_id INT(3),
                status INT(1),
                adult_capacity INT(3),
                child_capacity INT(3),
                removed INT(1),
                FOREIGN KEY(room_type_id) REFERENCES
                roomtype(rt_id))";
        if(mysqli_query($ascon, $assql)){
            echo "creation of room table is successful! <br>";
        }else{
            echo "unsuccessful creation of room table!... try again. " . mysqli_error($ascon) . "<br>";
        }
    }else{
        echo "room table has been created already! <br>";
    }
?>


<?php
// Admin_accounts creation
    $chkdb = "SHOW TABLES LIKE 'admin_accounts'";
    $aschk = mysqli_query($ascon, $chkdb);
    if(mysqli_num_rows($aschk) == 0){
        $assql = "CREATE TABLE admin_accounts(
                admin_id INT(3) PRIMARY KEY AUTO_INCREMENT,
                admin_username VARCHAR(100) NOT NULL UNIQUE,
                admin_pass TEXT,
                admin_type VARCHAR(100))";
        if(mysqli_query($ascon, $assql)){
            echo "creation of admin_accounts table is successful! <br>";
        }else{
            echo "unsuccessful creation of admin_accounts table!... try again. " . mysqli_error($ascon) . "<br>";
        }
    }else{
        echo "admin_accounts table has been created already! <br>";
    }
?>


<?php
// Features creation
    $chkdb = "SHOW TABLES LIKE 'features'";
    $aschk = mysqli_query($ascon, $chkdb);
    if(mysqli_num_rows($aschk) == 0){
        $assql = "CREATE TABLE features(
                f_id INT(3) PRIMARY KEY AUTO_INCREMENT,
                feature VARCHAR(100) NOT NULL UNIQUE
                )";
        if(mysqli_query($ascon, $assql)){
            echo "creation of Features table is successful! <br>";
        }else{
            echo "unsuccessful creation of Features table!... try again. " . mysqli_error($ascon) . "<br>";
        }
    }else{
        echo "Features table has been created already! <br>";
    }
?>

<?php
// Rooms Feature creation
    $chkdb = "SHOW TABLES LIKE 'roomfeature'";
    $aschk = mysqli_query($ascon, $chkdb);
    if(mysqli_num_rows($aschk) == 0){
        $assql = "CREATE TABLE roomfeature(
                rf_id INT(3) PRIMARY KEY AUTO_INCREMENT,
                rm_id INT(3) NOT NULL,
                f_id INT(3) NOT NULL,
                FOREIGN KEY(rm_id) REFERENCES
                room(rm_id),
                FOREIGN KEY(f_id) REFERENCES
                features(f_id))";
        if(mysqli_query($ascon, $assql)){
            echo "creation of Room Features table is successful! <br>";
        }else{
            echo "unsuccessful creation of Room Features table!... try again. " . mysqli_error($ascon) . "<br>";
        }
    }else{
        echo "Room Features table has been created already! <br>";
    }
?>

<?php
// Account table creation
$chkdb = "SHOW TABLES LIKE 'reviewsite'";
$aschk = mysqli_query($ascon,$chkdb);
if(mysqli_num_rows($aschk) == 0){
    $assql = "CREATE TABLE reviewsite (
        r_siteid INT(6)  PRIMARY KEY AUTO_INCREMENT, 
        c_userid INT(2),
        r_siterating INT(1),
        r_sitefeedback TEXT, 
        r_sitedate DATE NOT NULL,
        FOREIGN KEY(c_userid) REFERENCES accounts(c_userid)
        )";

    if (mysqli_query($ascon, $assql)) {
    echo "Creation of Review Site Table is Successful!";
    } else {
        echo "Error in creating the table: " . mysqli_error($ascon);
    }
}
else{
    echo "Table already created";
}
?>

<?php
// Room Images creation
    $chkdb = "SHOW TABLES LIKE 'roomimage'";
    $aschk = mysqli_query($ascon, $chkdb);
    if(mysqli_num_rows($aschk) == 0){
        $assql = "CREATE TABLE roomimage(
                ri_id INT(3) PRIMARY KEY AUTO_INCREMENT,
                rm_id INT(3) NOT NULL,
                image VARCHAR(150),
                FOREIGN KEY(rm_id) REFERENCES
                room(rm_id))";
        if(mysqli_query($ascon, $assql)){
            echo "creation of Room Images table is successful! <br>";
        }else{
            echo "unsuccessful creation of Room Images table!... try again. " . mysqli_error($ascon) . "<br>";
        }
    }else{
        echo "Room Images table has been created already! <br>";
    }
?>

<?php
// Booking table creation
$chkdb = "SHOW TABLES LIKE 'bookings'";
$aschk = mysqli_query($ascon,$chkdb);
if(mysqli_num_rows($aschk) == 0){
    $assql = "CREATE TABLE bookings (
        booking_id INT(10)  PRIMARY KEY AUTO_INCREMENT, 
        datein DATE NOT NULL,
        dateout DATE NOT NULL,
        adultnum int(2) NOT NULL,
        childnum int(2) NOT NULL,
        price int(10) NOT NULL,
        roomid INT(2) NOT NULL,
        c_userid INT(2) NOT NULL,
        CONSTRAINT fk_accounts FOREIGN KEY (c_userid)
        REFERENCES accounts(c_userid)
        )";

    if (mysqli_query($ascon, $assql)) {
    echo "Creation of Booking Table is Successful!";
    } else {
        echo "Error in creating the rooms table: " . mysqli_error($ascon);
    }
}
else{
    echo "Table already created";
}

// Billing table creation
$chkdb = "SHOW TABLES LIKE 'billings'";
$aschk = mysqli_query($ascon,$chkdb);
if(mysqli_num_rows($aschk) == 0){
    $assql = "CREATE TABLE billings (
        bill_id INT(10)  PRIMARY KEY AUTO_INCREMENT,
        totprice int(10) NOT NULL,
        paymentmethod varchar(10) NOT NULL,
        downpayment INT(10) NOT NULL,
        bookingdate DATE NOT NULL,
        expirydate DATE NOT NULL,
        c_userid INT(3) NOT NULL,
        rm_id INT(3) NOT NULL,
        datein DATE NOT NULL,
        dateout DATE NOT NULL,
        adult_num INT(2),
        child_num INT(2),
        billstatus varchar(10) NOT NULL
        )";

    if (mysqli_query($ascon, $assql)) {
    echo "<br>Creation of Billing Table is Successful!";
    } else {
        echo "<br>Error in creating the billing table: " . mysqli_error($ascon);
    }
}
else{
    echo "<br> Billing table already created";
}

// Cancelled bookings table creation
$chkdb = "SHOW TABLES LIKE 'cancelled_bookings'";
$aschk = mysqli_query($ascon,$chkdb);
if(mysqli_num_rows($aschk) == 0){
    $assql = "CREATE TABLE cancelled_bookings (
        cancelled_id INT(3)  PRIMARY KEY AUTO_INCREMENT, 
        datein DATE NOT NULL,
        dateout DATE NOT NULL,
        adultnum int(2) NOT NULL,
        childnum int(2) NOT NULL,
        price int(10) NOT NULL,
        roomid INT(3) NOT NULL,
        c_userid INT(3) NOT NULL,
        )";

    if (mysqli_query($ascon, $assql)) {
    echo "Creation of Cancelled bookings Table is Successful!";
    } else {
        echo "Error in creating the Cancelled bookings table: " . mysqli_error($ascon);
    }
}
else{
    echo "Table already created";
}

mysqli_close($ascon);
?>
