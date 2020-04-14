<?php
session_start();
require_once "../config.php";

$parking_id = mysqli_real_escape_string($db, $_GET['qd']);


$del1 = mysqli_query($db, "DELETE FROM parking_slot_detail WHERE slot_table = '{$parking_id}'");

if ($del1) {
    
    $del2 = mysqli_query($db, "DROP TABLE " . $parking_id);
    
    if ($del2) {
        
        echo "true";
        
    } else {
        echo "false 1" . mysqli_error($db);
    }
    
} else {
    echo "false" . mysqli_error($db);
}

?>