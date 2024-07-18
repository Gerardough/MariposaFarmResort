<?php 

$token = $_POST["token"];


$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/DBCall.php";

$sql = "SELECT * FROM accounts
        WHERE c_reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    header("Location: FAILED.html");
    exit();
}

if (strtotime($user["c_reset_token_expires_at"]) <= time()) {
    header("Location: FAILED.html");
    exit();
}

// Hash the new password before storing it
$c_pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE accounts     
        SET c_pass = ?,
            c_reset_token_hash = NULL,
            c_reset_token_expires_at = NULL
        WHERE c_userid = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $c_pass, $user["c_userid"]);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header("Location: UPDATED.html");
    exit();
} else {
    header("Location: FAILED.html");
    exit();
}

?>
