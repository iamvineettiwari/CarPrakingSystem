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
    <link rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
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

    <section class="row login-form" id="login-form">
      <div class="col s12">
        <div class="col s12 m4 offset-m4 offset-l4 offset-xl4 login-form-body">
          <h4 class="log-head center theme-head-text">Login</h4>
          <p class="log-cont center theme-head-text">Great to see you again ! </p>
          <form method="post" id="login_form">
            <div class="input-field col s12">
              <i class="material-icons prefix">person</i>
              <input id="username" type="text" name="username" required class="validate">
              <label for="username">Enter Username</label>
              <span class="helper-text" id="username-helper"></span>
            </div>
            <div class="input-field no-bot-mar col s12">
              <i class="material-icons prefix">lock_outline</i>
              <input id="password" type="password" name="password" required class="validate">
              <label for="password">Enter Password</label>
              <span class="helper-text" id="password-helper"></span>
            </div>
            <div class="input-field no-top-mar col s12" id="log-btn-div">
              <button class="btn waves-effect waves-light col s12 green" type="submit" name="login">LOGIN
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
                    </div>
                    <div class="gap-patch">
                      <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                      <div class="circle"></div>
                    </div>
                  </div>

                  <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                      <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                      <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                      <div class="circle"></div>
                    </div>
                  </div>

                  <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                      <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                      <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                      <div class="circle"></div>
                    </div>
                  </div>

                  <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                      <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                      <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                      <div class="circle"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="input-field col s12">
            <span class="left">Forgot Password ?<a href="#"> Reset</a></span>
            <span class="right">New User ? <a href="register.php">Register Now</a></span>
          </div>
        <div class="input-field col s12">
            <span class="right">Adminstrator Login <a href="adminLogin.php">Click Here</a></span>          
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
    <script src="js/logApp.js"></script>
    <script>
      $(document).ready(function() {
        $('.sidenav').sidenav();
      });
    </script>

  </body>

  </html>
<?php
}
?>