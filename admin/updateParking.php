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
          <h4 class="log-head center theme-head-text">Update Parking Place</h4>
          <form name="getUpdate" action="">
            <div class="row">
              <div class="input-field col s12 m4 l4 xl4">
                <label for="title">Select Parking</label>
              </div>
              <div class="input-field col s12 m4">
                  <select name="pid" id="area">
                      <option value="" disabled selected>Select Parking Area</option>
                      <?php
                          $parking = mysqli_query($db, "SELECT slot_name, slot_id FROM parking_slot_detail");
                          $data = mysqli_num_rows($parking);
                          if ($data > 0) {
                              while ($row = mysqli_fetch_assoc($parking)) { ?>
                              <option value="<?= $row['slot_id'] ?>"><?= strtoupper($row['slot_name']) ?></option>
                          <?php         
                              }
                          }
                      ?>
                  </select>
              </div>
              <div class="input-field col s12 m4 l4 xl4">
                  <button class="waves-effect waves-light btn"><i class="material-icons left">send</i>Update</button>
              </div>
            </div>
          </form>
          <div id="loadUpdatingForm">
              <?php
                if (isset($_GET['pid'])) {
                    $pid = mysqli_real_escape_string($db, $_GET['pid']);
                    $sql = mysqli_query($db, "SELECT * FROM parking_slot_detail WHERE slot_id = '{$pid}'");
                    if ($sql) {
                        $row = mysqli_num_rows($sql);
                        if ($row > 0) {
                            $data = mysqli_fetch_assoc($sql); ?>
                            <form method="post" action="updatePlaceProcess.php">
                                <input type="hidden" name="pid" value="<?= $pid ?>">
                                <div class="row">
                                  <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">label_outline</i>
                                    <input id="title" type="text" name="title" value="<?= $data['slot_name'] ?>" required class="validate">
                                    <label for="title">Title</label>
                                    <span class="helper-text" id="title-helper"></span>
                                  </div>
                                  <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">reorder</i>
                                    <input id="nolot" type="number" name="nolot" value="<?= $data['slot_capacity'] ?>" required class="validate">
                                    <label for="nolot">Number of Lots</label>
                                    <span class="helper-text" id="nolot-helper"></span>
                                  </div>
                                  <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">account_balance</i>
                                    <input id="chargeLot" type="text" name="chargeLot" value="<?= $data['slot_charge'] ?>"  required class="validate">
                                    <label for="chargeLot">Charge Per Lot / Hour</label>
                                    <span class="helper-text" id="chargeLot-helper"></span>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">person</i>
                                    <input id="managerName" type="text" name="managerName" value="<?= $data['slot_manager_name'] ?>"  required class="validate">
                                    <label for="managerName">Manager Name</label>
                                    <span class="helper-text" id="manager-helper"></span>
                                  </div>
                                  <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="contact" type="number" name="contact" value="<?= $data['slot_manager_contact'] ?>"  required class="validate">
                                    <label for="contact">Contact Number</label>
                                    <span class="helper-text" id="contact-helper"></span>
                                  </div>
                                  <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">mail</i>
                                    <input id="email" type="email" name="email" value="<?= $data['slot_manager_email'] ?>"  required class="validate">
                                    <label for="email">Manager Email</label>
                                    <span class="helper-text" id="email-helper"></span>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">my_location</i>
                                    <label for="long">Location Longitude</label> <br><br>
                                    <span class="helper-text" id="long-helper"> <?= $data['slot_longitude'] ?> </span>
                                  </div>
                                  <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">my_location</i>
                                    <label for="lat">Location Latitude</label> <br><br>
                                    <span class="helper-text" id="lat-helper"> <?= $data['slot_latitude'] ?> </span>
                                  </div>
                                  <input type="hidden" name="faddress" id="faddress">
                                  <div class="input-field col s12 m4 l4 xl4">
                                    <i class="material-icons prefix">map</i>
                                    <span class="helper-text" id="lat-helper"> <?= $data['slot_address'] ?> </span>
                                  </div>
                                </div>
                    
                                <div class="input-field no-top-mar col s12" id="reg-btn-div">
                                  <button class="btn waves-effect waves-light col s12 green" type="submit" name="addPlaceBtn" id="addPlaceBtn">Update Place
                                    <i class="material-icons right">send</i>
                                  </button>
                                </div>
                              </form>
                <?php
                        }
                    }
                } 
              ?>
              
          </div>
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
        <script src="../js/upPlace.js"></script>
        <script>        
        $(document).ready(function(){
            $('.modal').modal();
            $('select').formSelect();
        });
        </script>
        
    <?php
                if (isset($_GET['msg']) && $_GET['msg'] == "true") { ?>
                    <script>
                        swal("Successfully Updated !", "Parking place has been successfully updated.", "success");
                    </script>
                <?php
                } else if (isset($_GET['msg']) && $_GET['msg'] == "false") {?>
                    <script>
                        swal("Error !", "Something went wrong.", "error");
                    </script>
                <?php
                }
    ?>



<?php
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
?>