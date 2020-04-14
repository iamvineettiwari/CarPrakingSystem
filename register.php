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
    <link rel="stylesheet" href="css/style2.css" />
    <title>Car Parking System</title>
</head>
<body>
<nav>
    <div class="nav-wrapper">
    <a href="#" data-target="slide-out" class="sidenav-trigger left text-white"><i class="material-icons">menu</i></a>
    <a href="index.php" class="right brand-logo text-white"><img class="responsive-img" src="images/logo3.png"></a>      
    </div>
</nav>

<section class="login-form reg row" id="register-form-area">
    <div class="col s12">
    <div class="col s12 m10 l10 xl10 offset-m1 offset-l1 offset-xl1">
        <h4 class="log-head center theme-head-text">Registration</h4>
        <p class="log-cont center theme-head-text">Great Decision ! Register now to avail easy and safe car parking system. </p>
        <form method="post" id="registration_form">
        <div class="row">
        <div class="input-field col s12 m4 l4 xl4">
            <i class="material-icons prefix">person</i>
            <input id="first-name" type="text" name="firstname" required class="validate">
            <label for="first-name">First Name</label>            
            <span class="helper-text" id="firstname-helper"></span>
        </div>
        <div class="input-field col s12 m4 l4 xl4">
            <i class="material-icons prefix">person</i>
            <input id="last-name" type="text" name="lastname" required class="validate">
            <label for="last-name">Last Name</label>            
            <span class="helper-text" id="lastname-helper"></span>
        </div>
        <div class="input-field col s12 m4 l4 xl4">
            <i class="material-icons prefix">mail_outline</i>
            <input id="email" type="email" name="email" required class="validate">
            <label for="email">Email Address</label>            
            <span class="helper-text" id="email-helper"></span>
        </div>
        </div>
        <div class="row">
        <div class="input-field col s12 m4 l4 xl4">
            <i class="material-icons prefix">vpn_key</i>
            <input id="password" type="password" name="password" required class="validate">
            <label for="password">Password</label>            
            <span class="helper-text" id="password-helper"></span>
        </div>
        <div class="input-field col s12 m4 l4 xl4">
            <i class="material-icons prefix">phone</i>
            <input id="contact" type="number" name="contact" required class="validate">
            <label for="contact">Contact Number</label>            
            <span class="helper-text" id="contact-helper"></span>
        </div>
        <div class="input-field col s12 m4 l4 xl4">
            <i class="material-icons prefix">business_center</i>
            <input id="occupation" type="text" name="occupation" required class="validate">
            <label for="occupation">Occupation</label>            
            <span class="helper-text" id="occupation-helper"></span>
        </div>
        </div>        
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">map</i>
                <textarea id="address" required name="address" class="materialize-textarea"></textarea>
                <label for="address">Address</label>
                <span class="helper-text" id="address-helper"></span>
            </div>
        </div>
        <div class="input-field no-top-mar col s12" id="reg-btn-div">
            <button class="btn waves-effect waves-light col s12 green" type="submit" name="register">Register
                <i class="material-icons right">send</i>
            </button>
        </div>
        </form>
        <div class="row hide" id="myLoader">
<div class="col s12 center">
<div class="col s12 m4 offset-m4">
<div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
</div>
</div>
</div>
</div>
        <div class="input-field col s12">
            <span class="right">Already Registerd ? <a href="login.php">Login Now</a></span>
        </div>
    </div>
    </div>
</section>


<footer>
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
    <script src="js/regApp.js"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script>
    
</body>
</html>
<?php
}
?>