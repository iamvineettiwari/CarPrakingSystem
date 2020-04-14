<?php
session_start();
require "../bin/config.php";
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
  if ($_SESSION['user_type'] == "admin" && $_SESSION['user_id'] != "") {
    $title = "Dashboard";
    ?>
    <?php include "includes/header.php"; ?>

    <section class="login-form reg row">
      <div class="col s12">
        <div class="col s12 m10 l10 xl10 offset-m1 offset-l1 offset-xl1">
          <h4 class="log-head center theme-head-text">Add Admin</h4>
          <form method="post" id="admin_add_form" enctype="multipart/form-data">
            <div class="row">
              <div class="input-field col s12 m4 l4 xl4">
                <i class="material-icons prefix">person</i>
                <input id="name" type="text" name="name" required class="validate">
                <label for="name">Name</label>
                <span class="helper-text" id="name-helper"></span>
              </div>
              <div class="input-field col s12 m4 l4 xl4">
                <i class="material-icons prefix">person</i>
                <input id="username" type="text" name="username" required class="validate">
                <label for="username">Userame</label>
                <span class="helper-text" id="username-helper"></span>
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
              <div class="file-field input-field">
                <div class="btn grey">
                  <span>Profile Image</span>
                  <input type="file" id="profile" required name="profile" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text">
                </div>
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
        </div>
      </div>
    </section>
    <?php include "includes/footer.php"; ?>
<?php
  } else {
    header("Location: ../");
  }
} else {
  header("Location: ../");
}
?>