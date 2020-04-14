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
          <h4 class="log-head center theme-head-text">Add New Parking Place</h4>
          <form method="post" id="add_place" enctype="multipart/form-data">
            <div class="row">
              <div class="input-field col s12 m4 l4 xl4">
                <i class="material-icons prefix">label_outline</i>
                <input id="title" type="text" name="title" required class="validate">
                <label for="title">Title</label>
                <span class="helper-text" id="title-helper"></span>
              </div>
              <div class="input-field col s12 m4 l4 xl4">
                <i class="material-icons prefix">reorder</i>
                <input id="nolot" type="number" name="nolot" required class="validate">
                <label for="nolot">Number of Lots</label>
                <span class="helper-text" id="nolot-helper"></span>
              </div>
              <div class="input-field col s12 m4 l4 xl4">
                <i class="material-icons prefix">account_balance</i>
                <input id="chargeLot" type="text" name="chargeLot" required class="validate">
                <label for="chargeLot">Charge Per Lot / Hour</label>
                <span class="helper-text" id="chargeLot-helper"></span>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m4 l4 xl4">
                <i class="material-icons prefix">person</i>
                <input id="managerName" type="text" name="managerName" required class="validate">
                <label for="managerName">Manager Name</label>
                <span class="helper-text" id="manager-helper"></span>
              </div>
              <div class="input-field col s12 m4 l4 xl4">
                <i class="material-icons prefix">phone</i>
                <input id="contact" type="number" name="contact" required class="validate">
                <label for="contact">Contact Number</label>
                <span class="helper-text" id="contact-helper"></span>
              </div>
              <div class="input-field col s12 m4 l4 xl4">
                <i class="material-icons prefix">mail</i>
                <input id="email" type="email" name="email" required class="validate">
                <label for="email">Manager Email</label>
                <span class="helper-text" id="email-helper"></span>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m4 l4 xl4">
                <i class="material-icons prefix">my_location</i>
                <input id="long" type="text" readonly name="long" required>
                <label for="long">Location Longitude</label>
                <span class="helper-text" id="long-helper"></span>
              </div>
              <div class="input-field col s12 m4 l4 xl4">
                <i class="material-icons prefix">my_location</i>
                <input id="lat" type="text" readonly name="lat" required>
                <label for="lat">Location Latitude</label>
                <span class="helper-text" id="lat-helper"></span>
              </div>
              <input type="hidden" name="faddress" id="faddress">
              <div class="input-field col s12 m4 l4 xl4">
                  <a class="waves-effect waves-light btn green modal-trigger" href="#LocationPicker"><i class="material-icons">add_location</i>Pick Location</a>
              </div>
            </div>

            <div class="input-field no-top-mar col s12" id="reg-btn-div">
              <button class="btn waves-effect waves-light col s12 green" type="submit" name="addPlaceBtn" id="addPlaceBtn">Add Place
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
    <!-- Modal Structure -->
    <div id="LocationPicker" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4>Choose Place</h4>
        <div id='map' class='map col s12' style="height: 100%;">
            <div class='tt-overlay-panel -center js-message-box' hidden>
                <button class='tt-overlay-panel__close js-message-box-close'></button>
                <span class='tt-overlay-panel__content'></span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-close red btn waves-effect">Close</a>
      </div>
    </div>
    <div class="modal-overlay" id="model-overlay"></div>
        <?php include "includes/footer.php"; ?>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.34.4/maps/maps-web.min.js"></script>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.34.4/services/services-web.min.js"></script>
        <script src="../js/aplace.js"></script>
        <script>        
        $(document).ready(function(){
            $('.modal').modal();
        });
        </script>



<?php
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
?>