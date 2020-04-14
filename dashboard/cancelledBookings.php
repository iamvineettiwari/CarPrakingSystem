<?php
session_start();
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
  if ($_SESSION['user_type'] == "user" && $_SESSION['user_id'] != "") {
    require "../bin/config.php";

    $get_user = mysqli_query($db, "SELECT * FROM user_details WHERE user_id = " . mysqli_real_escape_string($db, $_SESSION['user_id']));
    $user = mysqli_fetch_assoc($get_user);
    $del = mysqli_query($db, "DELETE FROM booking_record WHERE user_id = '".mysqli_real_escape_string($db, $_SESSION['user_id'])."' AND status = '0'");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
      <link rel="stylesheet" href="../css/user-main.css" />
      <link href='https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.css' rel='stylesheet' />
      <title>Car Parking System - Dashboard</title>
    </head>

    <body>

      <nav>
        <div class="nav-wrapper">
          <a href="#" data-target="slide-out" class="sidenav-trigger left text-white"><i class="material-icons">menu</i></a>
          <a href="index.php" class="right brand-logo text-white"><img class="responsive-img" src="../images/logo3.png"></a>
        </div>
      </nav>
      <div class="col s12 welcome-content">
        <div class="row">
          <div class="col m12">
            <p class="welcome-text">Cancellation History</p>
            <p class="red-text center" style="margin:10px 0px;">Note : Initiated cancellation refunds may take 48 hours from bank side to refund the amount.</p>
          </div>
        </div>
      </div>
        <div class="col s12" style="padding:0px 20px;">
            <?php

            $per_page = 10;
            $get_data = mysqli_query($db, "SELECT * FROM cancel_refund WHERE user_id = '{$_SESSION['user_id']}'");
            $total_data = mysqli_num_rows($get_data);
            
            $total_page_required = ceil($total_data / $per_page);
            $current_page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page-1) * $per_page;

            ?>
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Refund ID</th>
                        <th>Payment ID</th>
                        <th>Refund Status</th>
                        <th>Paid Amount</th>
                        <th>Refunded Amount</th>
                        <th>Parking Place</th>
                        <th>Booked Date</th>
                        <th>Cancelled Date</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if ($total_data > 0) {
                        $sql = "SELECT * FROM cancel_refund WHERE user_id = '{$_SESSION['user_id']}' ORDER BY cancel_date DESC LIMIT $offset, $per_page";
                        $res_data = mysqli_query($db , $sql);
                        while($row = mysqli_fetch_array($res_data)){
                    ?>                    
                    <tr>
                        <td><?= $row['refund_token'] ?></td>
                        <td><?= $row['payment_id'] ?></td>
                        <td><?php 
                        if ($row['refund_status'] == "Refunded") { ?>
                            <p class="green-text"><?= $row['refund_status'] ?></p>
                        <?php
                        } else { ?>
                            <p class="red-text"><?= $row['refund_status'] ?></p>
                        <?php 
                        }
                        ?></td>
                        <td>&#8377; <?= $row['paid_amount'] ?></td>
                        <td>&#8377; <?= $row['refunded_amount'] ?></td>
                        <td><?= $row['parking_name'] ?></td>
                        <td><?= date('d-m-Y h:i:s A', strtotime($row['book_date_time'])) ?></td>
                        <td><?= date('d-m-Y h:i:s A', strtotime($row['cancel_date'])) ?></td>
                    </tr>
                    <?php     
                        }
                    } else { ?>
                    <tr>
                        <td colspan="9" class="center">
                            <p class="red-text"><b>No data found !</b></p>
                        </td>
                    </tr>
                <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col s12">
            <ul class="pagination <?php if ($total_page_required == 1) echo 'hide'; ?>">
                <li class="<?php if($current_page <= 1) echo 'disabled'; ?>">
                    <a href="<?php 
                        if ( $current_page <= 1 ) { 
                            echo '#'; 
                        } else { 
                            echo "cancelledBookings.php?page=". ($current_page - 1); 
                            } 
                        ?>">Prev</a>
                </li>
                <?php
                    if ($total_page_required > 1) {
                        for ($i = 1; $i <= $total_page_required; $i++) { ?>
                        <li class="<?php if ($current_page == $i) echo 'active'; ?>">
                            <a href="cancelledBookings.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                <?php
                        }
                    }
                ?>
                <li class="<?php if($current_page >= $total_page_required) echo 'disabled'; ?>">
                    <a href="<?php 
                        if ( $current_page >= $total_page_required ) {
                            echo '#'; 
                        } else { 
                            echo "cancelledBookings.php?page=". ($current_page + 1); 
                        } 
                    ?>">Next</a>
                </li>
            </ul>
        </div>
      <footer>
        <div class="col m12 center last-footer">
          <p class="white-text">ENGINEERING CLINICS &copy; VIT UNIVERSITY, AP</p>
        </div>
      </footer>

      <ul id="slide-out" class="sidenav">
        <li>
          <div class="user-view">
            <div class="background">
              <img src="../images/backNav2.jpg">
            </div>
            <a href="#user"><img class="circle" src="../images/user.jpg"></a>
            <a href="#name"><span class="white-text name"><b><?php echo $user['user_first_name'] . " " . $user['user_last_name']; ?></b></span></a>
            <a href="#email"><span class="white-text email"><b><?php echo $user['user_email']; ?></b></span></a>
          </div>
        </li>
        <li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
        <li><a href="booking-history.php"><i class="material-icons">history</i>Booking History</a></li>
        <li><a class="waves-effect" href="cancelledBookings.php"><i class="material-icons">cancel</i>Cancellation History</a></li>
        <li>
          <div class="divider"></div>
        </li>
        <li><a class="subheader">Setting</a></li>
        <li><a class="waves-effect" href="profile.php"><i class="material-icons">person</i>Profile</a></li>
        <li><a class="waves-effect" href="logout.php"><i class="material-icons">exit_to_app</i>Logout</a></li>
      </ul>

      <script src="../js/jquery.min.js"></script>
      <script src="../js/materialize.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
        $(document).ready(function() {
          $('.sidenav').sidenav();
          $("#modal1").modal();
        });
      </script>
      
      <?php
      if (isset($_GET['can']) && $_GET['can'] == "true") {
          ?>
          <script>
              swal("Success", "Successfully cancelled your booking !", "success");
          </script>
          <?php
      }
      ?>
      <script>
        var lastLat = 0;
        var lastLong = 0;
        function getUser() {
            if (navigator.geolocation) {        
                navigator.geolocation.getCurrentPosition(getUserLocation);
            } else {
                swal("Error", "It seems your browser does not supports geolocation !", "error");
            }
        }
        
        function getUserLocation(position) {
            if (position.coords.latitude - lastLat > 5 || position.coords.longitude - lastLong > 5) {
                lastLat = position.coords.latitude;
                lastLong = position.coords.longitude;
            }
        }
        
        getUser();
        
        function sendToMap(dest) {
            getUser();
            let currPost = lastLat + "," + lastLong;
            window.open('https://www.google.com/maps/dir/'+ currPost +'/' + dest, '_blank');
        }
        
    </script>
    </body>

    </html>
<?php
  } else {
    header("Location: ../");
  }
} else {
  header("Location: ../");
}
?>