<?php
session_start();
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
  if ($_SESSION['user_type'] == "user" && $_SESSION['user_id'] != "") {
    header("Location: dashboard/");
  } else if ($_SESSION['user_type'] == "admin") {
    header("Location: admin/");
  }
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.min.css"  media="screen,projection" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Car Parking System</title>
</head>
<body>
<section class="main-home col s12">
<nav>
    <div class="nav-wrapper">
    <a href="#" data-target="slide-out" class="sidenav-trigger left text-white"><i class="material-icons">menu</i></a>
    <a href="index.php" class="right brand-logo text-white"><img class="responsive-img" src="images/logo3.png"></a>      
    </div>
</nav>

<div class="intro center"> 
    <h2>Car Parking System</h2>
    <p>Are you afraid of your car ? Don't be. <br> <span>Now search the available parking space near you, park the car in safe hands and be happy ! </span> </p>
    <a href="login.php" class="btn waves-effect red getStartedBtn">Get Started</a>
</div>
</section>

<section class="sub-main">
    <h3 class="center">HOW IT WORKS</h3>
    <div class="sub-main-row row">
    <div class="col s12 m4 sub-main-content">
        <div class="col s12 m12 sub-main-div center">
            <p class="sub-main-icon"><i class="material-icons main-icon">search</i></p>
            <p class="main-head">Search</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, nesciunt a! Ab ut ea sint illum, magni id iusto mollitia, eligendi sunt reiciendis et at veniam ratione eos placeat hic.</p>
        </div>        
    </div>
    <div class="col s12 m4 sub-main-content">
        <div class="col s12 m12 sub-main-div center">
            <p class="sub-main-icon"><i class="material-icons main-icon">payment</i></p>
            <p class="main-head">Book And Pay</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, nesciunt a! Ab ut ea sint illum, magni id iusto mollitia, eligendi sunt reiciendis et at veniam ratione eos placeat hic.</p>
        </div>  
    </div>
    <div class="col s12 m4 sub-main-content">
        <div class="col s12 m12 sub-main-div center">
            <p class="sub-main-icon"><i class="material-icons main-icon">time_to_leave</i></p>
            <p class="main-head">Park</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, nesciunt a! Ab ut ea sint illum, magni id iusto mollitia, eligendi sunt reiciendis et at veniam ratione eos placeat hic.</p>
        </div>  
    </div>
    </div>
</section>

<footer>
    <h3 class="center">TEAM</h3>
    <div class="courtesy col s12 m12">
    <div class="carousel carousel-slider center">
    <div class="carousel-item" href="#one!">
      <h2 class="grey-text text-darken-2">Faculty</h2>
      <p><b>Dr. Manas Kumar Pal</b> <br>Department Of Mechanical Engineering</p>
    </div>
    <div class="carousel-item" href="#two!">
      <h2 class="grey-text text-darken-2">Team Leader</h2>
      <p><b>Vineet Tiwari</b> <br>Registration Number - 19MIS7058</p>
    </div>
    <div class="carousel-item" href="#three!">
      <h2 class="grey-text text-darken-2">Team Member</h2>
      <p><b>Akula Shashidhar</b> <br>Registration Number - 19MIS7066</p>
    </div>
    <div class="carousel-item" href="#four!">
      <h2 class="grey-text text-darken-2">Team Member</h2>
      <p><b>KONGARA HEMANTH</b> <br>Registration Number - 19BCE7549</p>
    </div>
    <div class="carousel-item" href="#five!">
      <h2 class="grey-text text-darken-2">Team Member</h2>
      <p><b>GANDRA NARASIMHA LOHITH</b> <br>Registration Number - 19BCD7070</p>
    </div>
    <div class="carousel-item" href="#six!">
      <h2 class="grey-text text-darken-2">Team Member</h2>
      <p><b>P KANTA RAJ</b> <br>Registration Number - 19BEC7155</p>
    </div>
    <div class="carousel-item" href="#seven!">
      <h2 class="grey-text text-darken-2">Team Member</h2>
      <p><b>VUYYURU AKHIL</b> <br>Registration Number - 19BCN7054</p>
    </div>
  </div>            
    </div>

    <div class="col m12 center last-footer">
        <p class="white-text">ENGINEERING CLINICS &copy; VIT UNIVERSITY, AP</p>
    </div>
</footer>

<ul id="slide-out" class="sidenav">
  <li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
  <li><a href="login.php"><i class="material-icons">vpn_key</i>Login</a></li>
  <li><a href="register.php"><i class="material-icons">person</i>Register</a></li>
</ul>


    <script src="js/jquery.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });

        $('.carousel.carousel-slider').carousel({
            fullWidth: true,
            indicators: true
        });

        function autoplay() {
            $('.carousel').carousel('next');
        }

        setInterval(autoplay, 5000);
    </script>
    
</body>
</html>
<?php
}
?>