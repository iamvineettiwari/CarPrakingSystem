<?php
session_start();
require "../bin/config.php";
$pid = mysqli_real_escape_string($db, $_POST['pid']);
$name = mysqli_real_escape_string($db, $_POST['title']);
$cap = mysqli_real_escape_string($db, $_POST['nolot']);
$charge = mysqli_real_escape_string($db, $_POST['chargeLot']);
$mname = mysqli_real_escape_string($db, $_POST['managerName']);
$mcont = mysqli_real_escape_string($db, $_POST['contact']);
$memail =  mysqli_real_escape_string($db, $_POST['email']);
$sql = mysqli_query($db, "UPDATE parking_slot_detail SET slot_name = '{$name}', slot_capacity = '{$cap}', slot_charge = '{$charge}', slot_manager_name = '{$mname}', slot_manager_contact = '{$mcont}', slot_manager_email = '{$memail}' WHERE slot_id = '{$pid}'");
if ($sql) {
    header("Location: updateParking.php?msg=true");
} else {
    header("Location: updateParking.php?msg=false");
}
?>