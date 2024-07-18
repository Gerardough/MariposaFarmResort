<?php
      require("../PHP_PROJECT_FINALE/Admin/essentials/func.php");
      session_start();
      if(isset($_SESSION['userLogin']) && ($_SESSION['userLogin'] == true)){
      redirection("index2.php");
      }
?>
<html>
      <head>
            <title>Mariposa Farm Resort Portal</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="css/portal.css">
            <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
          
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
      </head>
      <body>  
              
                <script>
                  const hamburger = document.querySelector(".hamburger");
                  const navMenu = document.querySelector(".nav-menu");
              
                  hamburger.addEventListener("click", mobliemmenu);
              
                  function mobliemmenu() {
                    hamburger.classList.toggle("active");
                    navMenu.classList.toggle("active");
                  }
              
                  window.addEventListener("scroll", function() {
                    var header = document.querySelector("header");
                    header.classList.toggle("sticky", window.scrollY > 0)
                  })
                </script>
      <section class="portal" id="portal">
            <div class="card-container">
                  <a href="loginpage.php" style="text-decoration: none;">
                  <div class="card">
                        <img src="imahes/client.png">
                  </div>
                  </a>
                  <a href="admin/adminlogin.php" style="text-decoration: none;">
                  <div class="card">
                        <img src="imahes/admin.png">
                  </div>
                  </a>
            </div>
      </section>    
       
      </body>
</html>