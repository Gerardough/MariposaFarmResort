<!DOCTYPE html>
<html>
    <head>
        <title> Forgot Password </title>
        
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/stylerism.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
   
        <style>
            body {
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 0 20px;
                    background: rgb(219,168,88);
                    background: linear-gradient(0deg, rgba(219,168,88,1) 0%, rgba(28,28,71,1) 45%);
                    background-attachment: fixed;
                }
        </style>
    </head>

    <body>
    <div class="container">
        <div class="contained">
        <?php
                session_start();
                if (isset($_SESSION['error'])) {
                    echo '<p class="alert alert-danger alert-custom">' . $_SESSION['error'] . '</p>';
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo '<p class="alert alert-success alert-custom">' . $_SESSION['success'] . '</p>';
                    unset($_SESSION['success']);
                }
                ?>
        <form method="post" action="send-password-reset.php">
                <h1>Forgot Password </h1>
                <p>Enter your email and we'll send you a link to reset your password. </p>
            
                
           
                <label for ="email"> Email </label>  
                <div class="input-wrapper">
                    <i class="text-dark bi bi-envelope-fill"></i>
                    <input type ="email" name="email" id="email" >
                </div>
                <a class="coloring" href="loginpage.php">Back to login</a>
                <button> Send </button>

     
        </form>
           

        </div>
    </div>
</body>
</html>