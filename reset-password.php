<?php 

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/DBCall.php";

$sql = "SELECT *FROM accounts
        WHERE c_reset_token_hash = ?";

$stmt = $mysqli ->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt-> execute();

$result = $stmt ->get_result();

$user = $result-> fetch_assoc();

if ($user === null){

    die("token not found");
}

if (strtotime($user["c_reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Reset Password </title>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styling20.css">
    </head>
    <body>
<section class="container">
        <header> Reset Password </header>
    <form method="POST" action="process-reset-password.php" class="form">
            <div class="column">
                <div class="input-box password-container">
                    <label>Create a New Password<span class="requiring">*</span></label>
                    
                    <input type ="hidden" name ="token" value="<?= htmlspecialchars($token)?>">

                    <input id="password" name="password" class="password-field" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}"
                    title="Must contain at least one  number and one uppercase and lowercase letter, at least one special character, and at least 8 or more characters">
                    <span class="password-toggle" onclick="appearDisappearPassword()">Show</span>
                </div>
                    <div class="input-box password-container">
                        <label>Confirm New Password<span class="requiring">*</span></label>
                        <input id="password_confirmation" class="password-field" type="password" name="password_confirmation" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}"
                        title="Must contain at least one  number and one uppercase and lowercase letter, at least one special character, and at least 8 or more characters">
                        <span class="password-toggle" onclick="appearDisappearPassword()">Show</span>
                    </div>
            </div>        

            <div class="columnlog">
            <label class="distance passnote" id="passnote">Kindly match your password to proceed.</label>
            </div>

            <div class="column">
            <h4 class="sub">In setting up a password:</h4>
            </div>

            <div class="column">
            <label class="fsize" id="8char"><span>It must be at least 8 characters long</span></label>
            </div>
            <div class="column">
            <label class="fsize" id="lowandupcase"><span>It must contain lowercase characters [a-z] and uppercase characters [A-Z]</span></label>
            </div>
            <div class="column">
            <label class="fsize" id="containnumber"><span>It must contain a combination of numerical values [0-9]</span></label>
            </div>
            <div class="column">
            <label class="fsize" id="containspecialchars"><span>It must contain a special character [! @ # $ % ^ & * ( ) _ + - = { } [ ] | : ; " ' < > , . ? /]</span></label>
        </div>

                <button id="submitBtn" type="submit">
                Confirm
                </button>

</form>

</section>

<script>
            
            

        // script for showing and hiding of password
        function appearDisappearPassword() {
            var passwordFields = document.querySelectorAll(".password-field");
            var passwordToggle = document.querySelectorAll(".password-toggle");

            passwordFields.forEach(function(field, index) {
                if (field.type === "password") {
                    field.type = "text";
                    passwordToggle[index].textContent = "Hide";
                } else {
                    field.type = "password";
                    passwordToggle[index].textContent = "Show";
                }
            });
        }

        // script for dynamically checking of rules for password setting
        function checkPasswordCriteria() {
            var password = document.getElementById("password").value;

            var eightCharLabel = document.getElementById("8char");
            var lowAndUpCaseLabel = document.getElementById("lowandupcase");
            var containNumberLabel = document.getElementById("containnumber");
            var containSpecialCharsLabel = document.getElementById("containspecialchars");

            // reset all rules
            eightCharLabel.classList.remove("crossed-out");
            lowAndUpCaseLabel.classList.remove("crossed-out");
            containNumberLabel.classList.remove("crossed-out");
            containSpecialCharsLabel.classList.remove("crossed-out");

            // dynamically cross out the rules
            if (password.length >= 8) {
                eightCharLabel.classList.add("crossed-out");
            }
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) {
                lowAndUpCaseLabel.classList.add("crossed-out");
            }
            if (/\d/.test(password)) {
                containNumberLabel.classList.add("crossed-out");
            }
            if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
                containSpecialCharsLabel.classList.add("crossed-out");
            }
        }

        // event listener for input checking
        document.getElementById("password").addEventListener("input", checkPasswordCriteria);

        function validateForm() {
        const submitButton = document.getElementById('submitBtn');
        const passNote = document.getElementById('passnote');
        const ageMessageLabel = document.getElementById('ageMessage');

        // check password match
        var password1 = document.getElementById("password").value;
        var password2 = document.getElementById("password_confirmation").value;
        const passwordsMatch = (password1 === password2);

        if (!passwordsMatch) {
            passNote.style.display = 'block';
        } else {
            passNote.style.display = 'none';
        }
        submitBtn.disabled = !(passwordsMatch);
    }
        
    // event listeners for password, confirm password, and birthdate fields
    document.getElementById("password").addEventListener("input", validateForm);
    document.getElementById("password_confirmation").addEventListener("input", validateForm);
    
    
        </script>
</body>
</html>
