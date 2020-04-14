<?php
require "../config.php";

$title =  mysqli_real_escape_string($db, $_POST['title']);
$noLot = mysqli_real_escape_string($db, $_POST['nolot']);
$chargeLot = mysqli_real_escape_string($db, $_POST['chargeLot']);
$name = mysqli_real_escape_string($db, $_POST['managerName']);
$contact = mysqli_real_escape_string($db, $_POST['contact']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$lat = mysqli_real_escape_string($db, $_POST['lat']);
$long = mysqli_real_escape_string($db, $_POST['long']);
$addr = mysqli_real_escape_string($db, $_POST['faddress']);

$token = md5($title . microtime(true));
$count = 0;
$createTable = "CREATE TABLE ".$token." (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    slot INT(4) NOT NULL,
    datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
$queryTable = mysqli_query($db, $createTable); 

if ($queryTable) {
    for ($i = 0; $i < $noLot; $i++) {
        $sql = mysqli_query($db, "INSERT INTO ".$token." (slot) VALUES('0')");
        if($sql) {
            $count++;
        }
    }
}

if ($count == $noLot) {
        $query = mysqli_query($db, "INSERT INTO parking_slot_detail (slot_name, slot_capacity, slot_charge, slot_manager_name, slot_manager_contact, slot_manager_email, slot_longitude, slot_latitude, slot_address, slot_table) VALUES ('{$title}', '{$noLot}', '{$chargeLot}', '{$name}', '{$contact}', '{$email}', '{$long}', '{$lat}', '{$addr}', '{$token}')");
        if ($query) {
            echo "true";
        } else {
            echo mysqli_error($db);
        }
} else {
    echo mysqli_error($db);
}
?>