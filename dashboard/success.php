<?php
session_start();
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "user" && $_SESSION['user_id'] != "") {
        require "../bin/config.php";
        
        $get_user = mysqli_query($db, "SELECT * FROM user_details WHERE user_id = " . mysqli_real_escape_string($db, $_SESSION['user_id']));
        $user = mysqli_fetch_assoc($get_user);

        $genPay = mysqli_real_escape_string($db, $_GET['pTq']);
        $paymentId = mysqli_real_escape_string($db, $_GET['payment_id']);
        $paymentStatus = mysqli_real_escape_string($db, $_GET['payment_status']);
        $paymentReqId = mysqli_real_escape_string($db, $_GET['payment_request_id']);
        $amount = mysqli_real_escape_string($db, $_GET['amount']);
        
        if ($paymentStatus !== "Failed") {
            
        $datetime = date('Y-m-d H:i:s');
        $update_pay_data = mysqli_query($db, "UPDATE booking_record SET status = '1' WHERE user_id = '{$_SESSION['user_id']}' AND payment_id = '{$genPay}'");
        $get_pay_data = mysqli_query($db, "SELECT * FROM booking_record WHERE payment_id = '{$genPay}' AND user_id = {$_SESSION['user_id']}");
        $pay_data = mysqli_fetch_assoc($get_pay_data);
        $insert_into = mysqli_query($db, "INSERT INTO payment_info (payment_id, transaction_id, ammount_paid, user_id, transacted_id, status, payment_datetime) 
        VALUES ('{$paymentId}', '{$paymentReqId}', '{$amount}', '{$_SESSION["user_id"]}', '{$genPay}', '1', '{$datetime}')");
        if (!$insert_into) echo mysqli_error($db);
        $getTable = mysqli_query($db, "SELECT * FROM parking_slot_detail WHERE slot_table = '{$pay_data["slot_table"]}'");
        $table_detail = mysqli_fetch_assoc($getTable);
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
                        <p class="welcome-text">Thanks, <span class="green-text"><?php echo strtoupper($user['user_first_name'] . " " . $user['user_last_name']); ?></span> for booking the parking area !</p>
                    </div>
                </div>
            </div>

            <div class="col 12">
                <table class="highlight">
                    <tr>
                        <th><b>Booking Name</b></th>
                        <td><?php echo $user['user_first_name'] . ' ' . $user['user_last_name'] . ''; ?></td>
                    </tr>
                    <tr>
                        <th><b>User Email</b></th>
                        <td><?php echo $user['user_email']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Booked Slot</b></th>
                        <td><?php echo $pay_data['slot_no']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Parking Place Name</b></th>
                        <td><?php echo $table_detail['slot_name']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Parking Place Address</b></th>
                        <td><?php echo $table_detail['slot_address']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Parking Manager Contact</b></th>
                        <td><?php echo $table_detail['slot_manager_contact']; ?></td>
                    </tr>
                    <tr>
                        <th><b>Booked Data</b></th>
                        <td><?php echo $pay_data['book_date']; ?></td>
                    </tr>
                    <tr>
                        <th><b>In Time</b></th>
                        <td><?php echo date('h:i:s a', strtotime($pay_data['book_time_in'])); ?></td>
                    </tr>
                    <tr>
                        <th><b>Out Time</b></th>
                        <td><?php echo date('h:i:s a', strtotime($pay_data['book_time_out'])); ?></td>
                    </tr>
                    <tr>
                        <th><b>Total Time</b></th>
                        <td><?php echo round(abs(strtotime($pay_data['book_time_out']) - strtotime($pay_data['book_time_in'])) / 60 / 60,2); ?> Hours</td>
                    </tr>
                    <tr>
                        <th><b>Total amount paid</b></th>
                        <td>&#8377; <?php echo $amount; ?></td>
                    </tr>
                </table>
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
            <script src="../js/user-app.js"></script>
            <script>
                $(document).ready(function() {
                    $('.sidenav').sidenav();
                    $("#modal1").modal();
                });
            </script>
        </body>

        </html>
<?php
        } else { 
             $del = mysqli_query($db, "DELETE FROM booking_record WHERE user_id = '{$_SESSION['user_id']}' AND payment_id = '{$genPay}'");
        ?>
        <h1>Payment Was Cancelled ! We are redirecting back to the dashboard please wait.</h1>
        <script>
            function sendBack() {
                window.location = "index.php";
            }
            setTimeout(sendBack, 5000);
        </script>
        <?php }
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
?>