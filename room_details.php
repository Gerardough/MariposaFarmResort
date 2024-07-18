<?php
    require("../PHP_PROJECT_FINALE/Admin/essentials/func.php");
    userlogin();
?>
<html>
      <head>
            <title>MFR | Room Details</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" /> 
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
            
<style>
.card{
      transition: 1s;
}
.card:hover{
      transform: scale(1.02);
      z-index: 2;
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap');

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

html,
body {
  font-family: 'Poppins', sans-serif;
  scroll-behavior: smooth;
}

.container {
  max-width: 90%;
  margin: auto;
}

li {
  list-style: none;
}

a {
  text-decoration: none;
  transition: 0.5s;
}

.flex {
  display: flex;
}

.flex1 {
  display: flex;
  justify-content: space-between;
}

/*-------------head--------- */
.head {
  height: 10vh;
  line-height: 10vh;
}

.head i {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  line-height: 30px;
  background: #FAF3E7;
  text-align: center;
  color: #CC8C18;
}

.head img {
  margin-top: 10px;
}

/*-------------head--------- */
/*-------------header--------- */
header {
  background: #CC8C18;
  padding: 15px 0 15px 0;
  color: white;
}

.navbar {
  display: flex;
  align-items: center;
}

.hamburger {
  display: none;
}

.bar {
  display: block;
  width: 25px;
  height: 3px;
  margin: 5px auto;
  transition: all 0.5s ease-in-out;
  background: white;
}

.nav-menu {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

header ul {
  padding: 0 20px 0 0;
}

header li {
  margin-right: 30px;
}

header ul li a {
  font-size: 15px;
  color: white;
  text-transform: uppercase;
  font-weight: 500;
  transition: 0.5s;
}

header ul li a:hover {
  color: #000;
}

header .head_contact {
  position: relative;
}

header .head_contact i {
  position: absolute;
  top: -29px;
  left: -70%;
  width: 80px;
  height: 80px;
  line-height: 80px;
  text-align: center;
  background: white;
  color: #CC8C18;
  border-radius: 50%;
  transform: rotate(-45deg);
  border: 5px solid #ECE3D2;
  font-size: 30px;
}

header .sticky_logo {
  display: none;
}

header.sticky .sticky_logo {
  display: block;
  width: 50px;
  height: 50px;
  margin-top: -10px;
}

header.sticky {
  z-index: 9999;
  position: fixed;
  width: 100%;
  background: #313538;
  transition: 0.5s;
  height: 12vh;
  transition: 0.5s;
  top: 0;
  padding: 30px 0 0 0;
}

header.sticky ul li a {
  color: white;
}

@media only screen and (max-width:768px) {

  /*------------head------------*/
  .header .head_contact,
  .logo {
    display: none;
  }

  /*------------head------------*/
  header.sticky {
    height: 8vh;
  }

  header.sticky .nav-menu {
    background: #313538;
  }

  .navbar {
    height: 5vh;
    justify-content: space-between;
  }

  .nav-menu {
    position: fixed;
    left: -100%;
    top: 11rem;
    flex-direction: column;
    background: #CC8C18;
    width: 100%;
    border-radius: 10px;
    text-align: center;
    transition: 0.3s;
    z-index: 99;
    text-decoration: none;
  }

  header.sticky .nav-menu {
    top: 5rem;
  }

  header ul li a {
    color: white;
  }

  .nav-menu.active {
    left: 0;
  }

  header li {
    margin: 2.5rem 0;
  }

  .hamburger {
    display: block;
    cursor: pointer;
  }

  .hamburger.active .bar:nth-child(2) {
    opacity: 0;
  }

  .hamburger.active .bar:nth-child(1) {
    transform: translateY(8px) rotate(45deg);
  }

  .hamburger.active .bar:nth-child(3) {
    transform: translateY(-8px) rotate(-45deg);
  }
}

/*------------home------------*/
.grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  grid-gap: 30px;
}

.home {
  background-image: url("../image/home.png");
  height: 100vh;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  text-align: center;
}

.home h1 {
  font-family: 'Great Vibes', cursive;
  font-size: 150px;
  color: white;
  padding-top: 10%;
}

.home p {
  color: white;
}

.home .content {
  text-align: left;
  color: black;
  margin-top: 7%;
}

.home .box {
  background: white;
  padding: 35px;
}

.home input {
  margin-top: 10px;
}

input {
  border: none;
  outline: none;
}

button {
  background: #CC8C18;
  color: white;
  padding: 10px 20px;
  outline: none;
  border: none;
  border-radius: 30px;
}

button i {
  margin-left: 20px;
  font-size: 25px;
}

button span {
  margin-top: 5px;
}

/*------------home------------*/
/*------------about------------*/
.top {
  margin-top: 80px;
}

.mtop {
  margin-top: 40px;
}

.heading {
  text-align: center;
}

.heading h5 {
  font-weight: 400;
  letter-spacing: 5px;
  color: #CC8C18;
  padding-top: 20px;
}

.heading h2 {
  color: #24416B;
  font-size: 45px;
  font-family: serif;
  font-weight: bold;
  margin: 10px 0 20px 0;
}

.left, .right {
  width: 50%;
}

h3 {
  font-size: 35px;
  font-family: serif;
  color: #24416B;
  margin-bottom: 20px;
}

.about .left {
  padding: 20px;
}

p {
  line-height: 30px;
  color: #a4a4a4;
  margin-bottom: 20px;
  font-size: 15px;
}

.about {
  position: relative;
  padding-bottom: 70px;
}

.about .right {
  position: relative;
}

.about .right::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  background: #CC8C18;
  width: 92%;
  height: 61vh;
  z-index: -1;
  margin: 50px;
}

.about::after {
  content: '';
  position: absolute;
  top: -5%;
  left: 0;
  background-image: url("../image/line1.png");
  background-size: cover;
  background-repeat: no-repeat;
  height: 50px;
  width: 100%;
}

.about::before {
  content: '';
  position: absolute;
  bottom: -5%;
  left: 0;
  background-image: url("../image/line2.png");
  background-size: cover;
  background-repeat: no-repeat;
  height: 50px;
  width: 100%;
}

/*------------about------------*/
/*------------wrapper------------*/
.wrapper {
  background-image: url("../image/w.jpg");
  height: 80vh;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.wrapper .container {
  max-width: 50%;
  margin: auto;
}

.wrapper .item {
  background: white;
  padding: 50px;
  margin-top: 15%;
  border: 30px solid #F3F3F3;
  border-bottom: none;
}

.wrapper .heading {
  text-align: left;
}

.owl-nav .owl-next,
.owl-nav .owl-prev {
  height: 47px;
  position: absolute;
  top: 60%;
  width: 26px;
  cursor: pointer;
  background: none !important;
}

.owl-nav .owl-prev {
  left: 0;
}

.owl-nav .owl-next {
  right: 53px;
}

.owl-nav .owl-next i,
.owl-nav .owl-prev i {
  background: white;
  padding: 7px;
  border-radius: 50%;
  color: #CC8C18;
  box-shadow: 2px 2px 5px 3px rgba(0, 0, 0, 0.05);
  transition: 0.5s;
}

.owl-nav .owl-next i:hover,
.owl-nav .owl-prev i:hover {
  background: #CC8C18;
  color: white;
}

/*------------wrapper------------*/
/*------------wrapper2------------*/
.wrapper2 {
  position: relative;
  text-align: center;
}

.wrapper2 .grid {
  grid-template-columns: repeat(4, 1fr);
}

.wrapper2 .box {
  box-shadow: 0 0 20px 3px rgb(0 0 0 / 5%);
  padding: 20px;
  transition: 0.5s;
}

.wrapper2 i {
  margin: 10px 0 15px 0;
  color: #CC8C18;
  font-size: 30px;
}

.wrapper2 h3 {
  font-size: 20px;
}

.wrapper2 span {
  padding: 10px;
  background: #F5E8D1;
  color: #CC8C18;
  border-radius: 50%;
}

.wrapper2 .box:hover {
  background: #CC8C18;
  cursor: pointer;
}

.wrapper2 .box:hover span {
  background: #fff;
}

.wrapper2 .box:hover p,
.wrapper2 .box:hover h3,
.wrapper2 .box:hover i {
  color: white;
}

.wrapper2::after {
  content: '';
  position: absolute;
  top: -22%;
  left: 0;
  background-image: url("../image/line1.png");
  background-size: cover;
  background-repeat: no-repeat;
  height: 75px;
  width: 100%;
  z-index: 2;
}

/*------------wrapper2------------*/
/*------------room------------*/
.room {
  margin-bottom: 50px;
  position: relative;
}

.room.wrapper2::after {
  display: none;
  top: 105%;
  background-image: url("../image/line2.png");
}

.grid2 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 30px;
}

.room img {
  width: 100%;
  height: 100%;
  margin-left: 20px;
}

.room h3 {
  margin: 0;
  padding: 0;
}

/*------------room------------*/
/*------------timer------------*/
.timer {
  position: relative;
  text-align: center;
  padding-top: 12%;
}

.background::after {
  position: absolute;
  content: '';
  top: 0;
  left: 0;
  content: '';
  background: rgba(0, 0, 0, 0.5);
  height: 100%;
  width: 100%;
}

.timer.wrapper {
  background-image: url("../image/w2.jpg");
}

.timer.about::after {
  z-index: 1;
  top: 0%;
  background-image: url("../image/line2.png");
}

.timer.about::before {
  z-index: 1;
  bottom: 0%;
  background-image: url("../image/line1.png");
}

.timer h2,
.timer h5 {
  color: white;
  text-align: center;
}

.timer .container {
  position: relative;
}

.timer h2 span {
  font-family: 'Great Vibes', cursive;
}

.clock span {
  color: white;
  font-size: 50px;
  line-height: 50px;
}

.clock p {
  color: white;
  font-size: 18px;
  letter-spacing: 3px;
}

/*------------timer------------*/
/*------------offer------------*/
.offer img {
  width: 100%;
  height: 100%;
}

.offer .right {
  padding: 20px;
  margin: 20px;
  box-shadow: 0 0 20px 3px rgb(0 0 0 / 5%);
}

.offer .content h4 {
  font-size: 20px;
  color: #627795;
  font-family: serif;
}

.offer .rate i {
  font-size: 13px;
  color: #CC8C18;
  margin: 10px 10px 20px 0;
}

.offer .content h5 {
  color: #627795;
  margin-bottom: 10px;
}

.offer .box {
  transition: 0.5s;
}

.offer .box:hover {
  transform: translateY(-10px);
}

/*------------offer------------*/
/*------------area------------*/
.area img {
  margin: 0px 0 20px 80px;
}

.area ul li {
  display: inline-block;
  font-weight: 500;
  color: #5c646e;
  margin-right: 20px;
  margin-bottom: 20px;
}

.area .left {
  position: relative;
}

.area .left::after {
  position: absolute;
  top: 0;
  left: 0;
  content: '';
  width: 85%;
  height: 92%;
  margin: 30px;
  background: #CC8C18;
  z-index: -1;
}

/*------------area------------*/
/*------------offer2------------*/
.offer2 .heading {
  padding-top: 10%;
  text-align: center;
}

.offer2 .heading h3 {
  color: white;
}

.offer2.wrapper {
  background-image: url("../image/w3.jpg");
  height: 90vh;
  background-attachment: scroll;
}

.offer2.timer {
  padding-top: 0%;
}

.offer2.wrapper .container {
  max-width: 85%;
  margin: auto;
}

.offer2 .box {
  background: white;
  padding: 30px;
  text-align: left;
  transition: 0.5s;
}

.offer2 .box:hover {
  transform: translateY(-10px);
  cursor: pointer;
}

.offer2 .box h5 {
  color: #CC8C18;
  text-align: left;
  font-weight: 400;
  list-style: 5px;
  word-spacing: 10px;
}

.offer2 .box h3 {
  font-size: 20px;
  margin: 10px 0 10px 0;
}

.offer2 label {
  color: #CC8C18;
}

.offer2 .grid {
  grid-template-columns: repeat(3, 1fr);
}

.offer2 .flex i {
  margin: 0 20px 20px 0;
  font-weight: 400;
  color: #5c646e;
}

/*------------offer2------------*/
/*------------customer------------*/
.customer .mtop {
  padding: 30px;
  max-width: 60%;
  margin: auto;
  text-align: center;
  box-shadow: 0 0 20px 3px rgb(0 0 0 / 5%);
}

.customer i {
  color: #CC8C18;
  font-size: 13px;
}

.customer .item h3 {
  font-size: 20px;
}

.customer img {
  width: 70px;
  height: 70px;
  border-radius: 50%;
}

.customer .admin {
  justify-content: center;
}

.customer .admin h3 {
  margin: 0;
}

.customer .text {
  margin: 10px;
}

.customer span {
  opacity: 0.7;
}

/*------------customer------------*/
/*------------gallary------------*/
.gallary .item {
  position: relative;
  cursor: pointer;
}

.gallary .overlay i {
  position: absolute;
  top: 40%;
  left: 40%;
  z-index: 1;
  opacity: 0;
  font-size: 50px;
  color: white;
}

.gallary .overlay {
  position: absolute;
  content: '';
  background: rgba(204, 140, 24, 0.73);
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  opacity: 0;
}

.gallary .item:hover .overlay,
.gallary .item:hover i {
  opacity: 1;
  transition: 0.5s;
  cursor: pointer;
}

/*------------gallary------------*/
/*------------blog------------*/
.blog .grid {
  grid-template-columns: repeat(3, 1fr);
}

.blog .box {
  box-shadow: 0 0 20px 3px rgb(0 0 0 / 5%);
  transition: 0.5s;
}

.blog .box:hover {
  transform: translateY(-10px);
  cursor: pointer;
}

.blog .text {
  padding: 20px;
}

.blog img {
  width: 100%;
  height: 100%;
  position: relative;
}

.blog .img {
  position: relative;
  overflow: hidden;
}

.blog span {
  position: absolute;
  top: -3%;
  left: -12%;
  z-index: 1;
  color: white;
  background: #CC8C18;
  padding: 20px 50px;
  transform: rotate(-45deg);
  font-size: 14px;
}

.blog .box h3 {
  font-size: 20px;
}

.blog .box i {
  margin-right: 10px;
  color: #CC8C18;
}

.blog .box i label {
  color: black;
}

.blog .box h3 {
  margin: 15px 0;
}

.blog a {
  color: #CC8C18;
  font-size: 15px;
}

/*------------blog------------*/
/*------------map------------*/
.map iframe {
  width: 100%;
}

/*------------map------------*/
/*------------footer------------*/
footer {
  background: black;
  color: white;
  padding: 30px;
}

.subscribe {
  text-align: center;
  max-width: 50%;
  margin: auto;
}

.subscribe input {
  width: 100%;
  border-radius: 50px;
  margin-right: 30px;
  padding: 10px;
}

footer .grid {
  grid-template-columns: repeat(4, 1fr);
}

footer .content h2 {
  margin-bottom: 20px;
  font-size: 23px;
}

footer li {
  margin-bottom: 15px;
  opacity: 0.5;
}

footer li i {
  font-size: 13px;
  margin-right: 10px;
}

footer .content h3 {
  font-size: 20px;
  color: white;
  margin: 0;
}

footer .content .icon i {
  font-size: 25px;
  margin-right: 20px;
}

footer .social i {
  padding: 10px;
  background: grey;
  margin-right: 10px;
  border-radius: 50%;
}

footer .content {
  padding-top: 60px;
  padding-bottom: 50px;
  border-top: 2px solid rgba(255, 255, 255, 0.2);
}

/*------------footer------------*/
@media only screen and (max-width:768px) {

  /*------------home------------*/
  footer .grid,
  .blog .grid,
  .offer2 .grid,
  .wrapper2 .content,
  .grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .home h1 {
    font-size: 100px;
  }

  .home {
    height: 80vh;
  }

  .home .grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, auto);
    grid-gap: 15px;
  }

  .home .box:nth-last-child(1) {
    grid-column-start: 1;
    grid-column-end: 3;
    grid-row-start: 3;
    grid-row-end: 3;
  }

  /*------------home------------*/
  /*------------about------------*/
  .left, .right {
    width: 100%;
  }

  .area .content,
  .room .content,
  .about .content {
    flex-direction: column;
  }

  .wrapper2::after,
  .area .left::after,
  .timer.about::before,
  .timer.about::after,
  .about .right::after,
  .about::before,
  .about::after {
    display: none;
  }

  /*------------about------------*/
  /*------------wrapper------------*/
  .wrapper .container {
    max-width: 80%;
    margin: auto;
  }

  /*------------wrapper2------------*/
  /*------------room------------*/
  .room img {
    margin: 0;
    margin-top: 50px;
  }

  /*------------room------------*/
  /*------------timer------------*/
  .timer.wrapper {
    height: 50vh;
  }

  /*------------timer------------*/
  /*------------offer------------*/
  .offer .box {
    flex-direction: column;
  }

  .offer .right {
    margin: 0px;
  }

  /*------------offer------------*/
  /*------------area------------*/
  .area img {
    margin: 0px;
    width: 100%;
  }

  /*------------area------------*/
  /*------------offer2------------*/
  .offer2.wrapper {
    height: 100vh;
  }

  /*------------offer2------------*/
  /*------------customer------------*/
  .customer .mtop {
    max-width: 100%;
  }

  /*------------customer------------*/
  /*------------footer------------*/
  .subscribe {
    max-width: 100%;
  }

  /*------------footer------------*/
}

@media only screen and (max-width:512px) {
  .header.sticky {
    height: 10vh;
  }

  .header.sticky .sticky_logo {
    width: auto;
    height: auto;
  }

  .header.sticky .nav-menu {
    top: 4rem;
  }

  .nav-menu {
    top: 12rem;
  }

  .head {
    height: 20vh;
    line-height: auto;
    text-align: center;
  }

  .head .container {
    flex-direction: column;
  }

  .home h1 {
    font-size: 70px;
  }

  .grid2,
  footer .grid,
  .blog .grid,
  .offer2 .grid,
  .wrapper2 .content,
  .grid {
    grid-template-columns: repeat(1, 1fr);
  }

  .home {
    height: 140vh;
  }

  .home .grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    grid-template-rows: repeat(1, auto);
    grid-gap: 15px;
  }

  .home .box:nth-last-child(1) {
    grid-column-start: 1;
    grid-column-end: 1;
    grid-row-start: 5;
    grid-row-end: 5;
  }

  img {
    width: 100%;
    height: 100%;
  }

  /*------------wrapper------------*/
  .wrapper .container {
    max-width: 90%;
  }

  .wrapper {
    height: 100vh;
  }

  .wrapper .item {
    padding: 20px;
    border: 0 solid #F3F3F3;
  }

  .offer2.wrapper {
    height: 170vh;
  }
}

</style>

      </head>
      <body class="whut bg-light">
    <?php
        require("../PHP_PROJECT_FINALE/Admin/db_config/DBCall_admin_login.php");
    ?>

      <?php
            if(!isset($_GET['id'])){
                redirection('filteredrooms.php');
            }

            $info = filteringSql($_GET);

            $query = "SELECT r.*, rt.* 
                              FROM room r 
                              INNER JOIN roomtype rt ON r.room_type_id = rt.rt_id 
                              WHERE r.rm_id = ? AND r.status = ? AND r.removed = ? 
                              ORDER BY r.room_name";

                        $rm_res = selectMatching($query, [$info['id'], 1, 0], "iii");

                        if(mysqli_num_rows($rm_res ) == 0){
                            redirection('filteredrooms.php');
                        }

                        $room_data = mysqli_fetch_assoc($rm_res);
        ?>
            <!------------ Navbar ------------>
      <section class="head">
            <div class="container flex1">
            <div class="scoial">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-youtube"></i>
            </div>
            <div class="logo">
            <img src="image/logo.png" alt="">
            </div>
            <div class="address">
            <i class="fas fa-map-marker-alt"></i>
            <span>San Carlos City, Ilocos Region, Philippines</span>
            </div>
            </div>
      </section>
      
      
      <header class="header">
            <div class="container">
            <nav class="navbar flex1">
            <div class="sticky_logo logo">
                  <img src="image/logo.png" alt="">
            </div>
      
            <ul class="nav-menu">
                  <li> <a href="index2.php">Home</a> </li>
                  <li> <a href="rooms.php">room</a> </li>
                  <li> <a href="contacts.php">contact</a> </li>
            </ul>
            <div class="hamburger">
                  <span class="bar"></span>
                  <span class="bar"></span>
                  <span class="bar"></span>
            </div>
            </nav>
            </div>
      </header>
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
      <!------------ /Navbar ------------>

      <div class="container mt-5 mb-5">
            <div class="row">

            <section>
                    <div class="col-12 my-5 mb-4 px-4">
                        <h2 class="fw-bold"><?php echo $room_data['room_name'] ?></h2>
                        <div style="font-size: 14px;">
                            <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                            <span class="text-secondary"> > </span>
                            <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
                        </div>
                    </div>
            </section>
                  
                <div class="col-lg-7 col-md-12 px-4">
                    <div id="roomCarousel" class="carousel slide carousel-fade">
                        <div class="carousel-inner">
                            <?php 
                                $img_q = mysqli_query($ascon, "SELECT * FROM `roomimage` 
                                                                    WHERE `rm_id` = '$room_data[rm_id]'");
        
                                if (mysqli_num_rows($img_q) > 0) {
                                    $active = 'active';
                                        while($img_rslt = mysqli_fetch_assoc($img_q)){
                                            echo "
                                                <div class='carousel-item $active'>
                                                    <img src = '". ROOMS_IMG_PATH . $img_rslt['image'] . "' class = 'd-block w-100'>
                                                </div>
                                            ";
                                            $active = '';
                                      }
                                }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                  
                <div class="col-lg-5 col-md-12 px-4">
                    <div class="card mb-4 border-0 shadow-sm rounded-3">
                        <div class="card-body">
                            <?php
                                echo <<<price
                                <h2>$room_data[room_type]</h2>
                                    <h4>₱ $room_data[price] per night</h4>
                                price;



                                $rm_res2 = mysqli_query($ascon, "SELECT f.feature FROM `features` f 
                                    INNER JOIN `roomfeature` rfea ON f.f_id = rfea.f_id 
                                    WHERE rfea.rm_id = '$room_data[rm_id]'");

                                if (!$rm_res2) {
                                    die("Error fetching features: " . mysqli_error($ascon));
                                }

                                $feat_info = "";
                                while ($feat_info_row = mysqli_fetch_assoc($rm_res2)) {
                                    $feat_info .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>" .
                                                $feat_info_row['feature'] . "</span>";
                                }

                                echo <<<feat
                                    <div class="features mb-3">
                                          <h6 class="mt-3 mb-3">Features</h6>
                                          $feat_info
                                    </div>
                                feat;

                                echo <<<desc
                                    <div class=" mb-3">
                                          <h4 class="mt-3 mb-1">Description</h4>
                                          <p>$room_data[room_desc]</p>
                                    </div>
                                desc;
                            ?>
                        </div>
                    </div>
                </div>

                  <div class="col-lg-9 col-md-12 px-4">


                  <?php 

                        // Verify the SQL query
                        // $query = "SELECT r.*, rt.* 
                        //       FROM room r 
                        //       INNER JOIN roomtype rt ON r.room_type_id = rt.rt_id 
                        //       WHERE r.status = ? AND r.removed = ? 
                        //       ORDER BY r.room_name";

                        // $rm_res = selectMatching($query, [1, 0], "ii");

                        // if (!$rm_res) {
                        // die("Error: Room type not found.");
                        // }

                        // while ($rm_info = mysqli_fetch_assoc($rm_res)) {
                        // $rm_res2 = mysqli_query($ascon, "SELECT f.feature FROM `features` f 
                        //                                     INNER JOIN `roomfeature` rfea ON f.f_id = rfea.f_id 
                        //                                     WHERE rfea.rm_id = '$rm_info[rm_id]'");

                        // if (!$rm_res2) {
                        //       die("Error fetching features: " . mysqli_error($ascon));
                        // }

                        // $feat_info = "";
                        // while ($feat_info_row = mysqli_fetch_assoc($rm_res2)) {
                        //       $feat_info .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>" .
                        //                   $feat_info_row['feature'] . "</span>";
                        // }

                        // $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                        // $thumb_q = mysqli_query($ascon, "SELECT * FROM `roomimage` 
                        //                                     WHERE `rm_id` = $rm_info[rm_id] LIMIT 1");

                        // if (mysqli_num_rows($thumb_q) > 0) {
                        //       $thumb_rslt = mysqli_fetch_assoc($thumb_q);
                        //       $room_thumb = ROOMS_IMG_PATH . $thumb_rslt['image'];
                        // }

                        // echo <<<DATA
                        // <div class="card mb-4 border-0 shadow">
                        //       <div class="row g-0 p-3 align-items-center">
                        //             <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        //             <img src="$room_thumb" class="img-fluid w-100 rounded-start">
                        //             </div>
                        //             <div class="col-md-5 px-lg-3 px-md-3 px-0">
                        //             <h5 class="mb-3">$rm_info[room_name]</h5>
                        //             <h6 class="mb-3">$rm_info[room_type]</h6>
                        //             <div class="features mb-3">
                        //                   <h6 class="mb-1">Features</h6>
                        //                   $feat_info
                        //             </div>
                        //             <div class="guests">
                        //                   <span class='badge rounded-pill bg-light text-dark text-wrap'>
                        //                   Adult Capacity: $rm_info[adult_capacity] </span>
                        //                   <span class='badge rounded-pill bg-light text-dark text-wrap'>
                        //                   Child Capacity: $rm_info[child_capacity] </span>
                        //             </div>
                        //             </div>
                        //             <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                        //             <h6 class="mb-4">₱ $rm_info[price] per night</h6>
                        //             <a href="#" class="btn btn-sm w-100 text-bg-success shadow-none mb-2">Book Now</a>
                        //             <a href="room_details.php?id=$rm_info[rm_id]" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                        //             </div>
                        //       </div>
                        // </div>
                        // DATA;
                        // }
                        ?>

                  </div>
   
            </div>
      </div>

      

      <footer>
            <div class="container top">
            <div class="subscribe" id="contact">
            <h2>Subscribe newsletter</h2>
            <div class="input flex">
                  <input type="email" placeholder="Your Email address">
                  <button class="flex1">
                  <span>Subscribe</span>
                  <i class="fas fa-arrow-circle-right"></i>
                  </button>
            </div>
            </div>
      
            <div class="content grid  top">
            <div class="box">
                  <div class="logo">
                  <img src="image/logo.png" alt="">
                  </div>
                  <p>Mariposa Farm Resort is the latest property under the management of Villamor Properties. Based in Southern California,Villamor Properties has long term and short term rental properties in Southern California, USA, Metro Manila and it’s premierresort property, Mariposa Farm Resort located in San Carlos, Pangasinan, Philippines.</p>
                  <div class="social flex">
                  <i class="fab fa-facebook-f"></i>
                  <i class="fab fa-twitter"></i>
                  <i class="fab fa-instagram"></i>
                  <i class="fab fa-youtube"></i>
                  </div>
            </div>
      
            <div class="box">
                  <h2>Quick Links</h2>
                  <ul>
                  <li><i class="fas fa-angle-double-right"></i>Big Data</li>
                  <li><i class="fas fa-angle-double-right"></i>Wellness</li>
                  <li><i class="fas fa-angle-double-right"></i>Spa Gallery</li>
                  <li><i class="fas fa-angle-double-right"></i>Reservation</li>
                  <li><i class="fas fa-angle-double-right"></i>FAQ</li>
                  <li><i class="fas fa-angle-double-right"></i>Contact</li>
                  </ul>
            </div>
      
            <div class="box">
                  <h2>Services</h2>
                  <ul>
                  <li><i class="fas fa-angle-double-right"></i>Restaurant</li>
                  <li><i class="fas fa-angle-double-right"></i>Swimming Pool</li>
                  <li><i class="fas fa-angle-double-right"></i>Wellness & Spa</li>
                  <li><i class="fas fa-angle-double-right"></i>Conference Room</li>
                  <li><i class="fas fa-angle-double-right"></i>Events</li>
                  <li><i class="fas fa-angle-double-right"></i>Adult Room</li>
                  </ul>
            </div>
      
            <div class="box">
                  <h2>Services</h2>
                  <div class="icon flex">
                  <div class="i">
                  <i class="fas fa-map-marker-alt"></i>
                  </div>
                  <div class="text">
                  <h3>Address</h3>
                  <p>San Carlos City, Ilocos Region, Philippines</p>
                  </div>
                  </div>
                  <div class="icon flex">
                  <div class="i">
                  <i class="fas fa-phone"></i>
                  </div>
                  <div class="text">
                  <h3>Phone</h3>
                  <p>+63 968 1234 567</p>
                  </div>
                  </div>
                  <div class="icon flex">
                  <div class="i">
                  <i class="far fa-envelope"></i>
                  </div>
                  <div class="text">
                  <h3>Email</h3>
                  <p>muningqv@gmail.com</p>
                  </div>
                  </div>
            </div>
            </div>
            </div>
      </footer>

      <?php require("../PHP_PROJECT_FINALE/Admin/bootstraplinks/scripts.php") ?>
      </body>
</html>