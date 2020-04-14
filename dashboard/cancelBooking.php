<?php
session_start();
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "user" && $_SESSION['user_id'] != "") {
        require "../bin/config.php";
$user_id_get = $_SESSION['user_id'];

$parking_name = mysqli_real_escape_string($db, $_POST['slot']);
$payment_id = mysqli_real_escape_string($db, $_POST['pid']);
$booking_id = mysqli_real_escape_string($db, $_POST['bid']);
$bookedTime = mysqli_real_escape_string($db, $_POST['btime']);

$dateTime = date('Y-m-d H:i:s');

$doSql = mysqli_query($db, "DELETE FROM booking_record WHERE payment_id = '{$booking_id}'");
$doSql = mysqli_query($db, "DELETE FROM payment_info WHERE payment_id = '{$payment_id}'");
if ($doSql) {
include '../bin/Instamojo.php';
$api = new Instamojo\Instamojo('test_6b9603b1b3b55b8cad0074b56fc', 'test_834de994ea5dcfa67a61796a9df','https://test.instamojo.com/api/1.1/');
try {
    $response = $api->refundCreate(array(
        'transaction_id' => $booking_id,
        'payment_id'=> $payment_id,
        'type'=>'QFL',
        'body'=>'Customer is not satified.'
        ));
    
    if ($response['status'] == "Refunded") {
        $sql = mysqli_query($db, "INSERT INTO cancel_refund (refund_token, user_id, payment_id, refund_status, refunded_amount, parking_name, cancel_date, book_date_time, paid_amount) VALUES ('{$response['id']}', '{$user_id_get}', '{$response['payment_id']}', '{$response['status']}', '{$response['refund_amount']}', '{$parking_name}', '{$dateTime}', '{$bookedTime}', '{$response['total_amount']}')");
        if ($sql) { ?>
            <script>
                window.location = "cancelledBookings.php?can=true";
            </script>
        <?php
        } else {
            echo mysqli_error($db);
        }
    } else { ?>
    <center><h1>Something went wrong !</h1></center>
    <script>
        setTimeout(4000, function() {
           window.location = "index.php"; 
        });
    </script>
<?php
    }
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