<?php
session_start();
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "user" && $_SESSION['user_id'] != "") {
        require "../bin/config.php";
$user_id_get = $_SESSION['user_id'];
$table_id = mysqli_real_escape_string($db, $_POST["pid"]);
$date = mysqli_real_escape_string($db, $_POST["date"]);
$inTime = mysqli_real_escape_string($db, $_POST["inTime"]);
$outTime = mysqli_real_escape_string($db, $_POST["outTime"]);
$allotSlot = mysqli_real_escape_string($db, $_POST["slot_alloted"]);

$dateTime = date('Y-m-d H:i:s');
$inTime = date('H:i:s', strtotime($inTime));
$outTime = date('H:i:s', strtotime($outTime));

$cal_query = mysqli_query($db, "SELECT slot_charge, slot_table FROM parking_slot_detail WHERE slot_id = '{$table_id}'");
$tableData = mysqli_fetch_assoc($cal_query);

$slot_per = $tableData['slot_charge'];
$table_name = $tableData['slot_table'];

$getUser = mysqli_query($db, "SELECT user_first_name, user_last_name, user_email, user_contact FROM user_details WHERE user_id = '{$user_id_get}'");
$user_data = mysqli_fetch_assoc($getUser);

$username = strtoupper($user_data['user_first_name'] . ' ' . $user_data['user_last_name']);
$userEmail = $user_data['user_email'];
$userContact = $user_data['user_contact'];

$total_charge = $slot_per * round(abs(strtotime($outTime) - strtotime($inTime)) / 60 / 60,2);

$token = md5(microtime(true));

$doSql = mysqli_query($db, "INSERT INTO booking_record (user_id, user_name, book_date,
book_time_in, book_time_out, slot_table, slot_no, payment_id, ammount, status, booking_time) VALUES ('{$user_id_get}',
'{$username}', '{$date}', '{$inTime}', '{$outTime}', '{$table_name}', '{$allotSlot}', '{$token}', '{$total_charge}', '0', '{$dateTime}')");
if ($doSql) {
include '../bin/Instamojo.php';
$api = new Instamojo\Instamojo('test_6b9603b1b3b55b8cad0074b56fc', 'test_834de994ea5dcfa67a61796a9df','https://test.instamojo.com/api/1.1/');
try {
    $response = $api->paymentRequestCreate(array(
        'purpose' => 'Parking Area Booking',
        'amount' => $total_charge,
        'phone' => $userContact,
        'buyer_name' => $username,
        'redirect_url' => 'http://127.0.0.1/CarParkingSystem/dashboard/success.php?pTq='.$token.'&amount='.$total_charge.'',
        'send_email' => false,
        'webhook' => 'http://127.0.0.1/CarParkingSystem/dashboard/storeData.php',
        'send_sms' => false,
        'email' => $userEmail,
        'allow_repeated_payments' => false
        ));
    $pay_ulr = $response['longurl'];
    header("Location: $pay_ulr");
    exit();
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}    
} else {
    echo "Something went wrong !" . mysqli_error($db);
} 
?>

<?php
    } else { ?>
        <script>
            window.location = "../";
        </script>
<?php
    }
} else {?>
        <script>
            window.location = "../";
        </script>
<?php
}
?>