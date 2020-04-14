<?php
require_once "../bin/config.php";
echo $date = date('h:i:s a');
$data = mysqli_query($db, "SELECT * FROM booking_record WHERE slot_no = '2' AND slot_table = 'ad7a116e2ac308ea008d2a8a6f76821d' AND book_time_in <= '{$date}' AND  book_time_out > '{$date}'");
if ($data) {
$row = mysqli_num_rows($data);
while ($datas = mysqli_fetch_assoc($data)) {
    echo $datas['book_time_out'];
    if(strtotime($datas['book_time_out']) > $date) echo 'true';
}
echo $row;
} else {
    echo mysqli_error($db);
}
?>