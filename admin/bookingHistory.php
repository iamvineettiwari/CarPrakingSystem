<?php
session_start();
require "../bin/config.php";
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "admin" && $_SESSION['user_id'] != "") {
        $title = "Booking History";
        ?>
        <?php include "includes/header.php"; ?>
        <div class="col s12" style="padding:0px 20px;">
            <p class="madmin-head">Booking History</p>
            <div id="loadData">
                <div class="row" id="myLoader">
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
        <?php include "includes/footer.php"; ?>
        <script src="../js/bookingHistory.js"></script>
<?php
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
?>