<?php
require "../config.php";
$admin_id = mysqli_real_escape_string($db, $_GET['aid']);
$getProfile = mysqli_query($db, "SELECT admin_profile FROM admin_details WHERE user_id = '{$admin_id}'");
$data = mysqli_fetch_assoc($getProfile);
if (file_exists("../../images/profiles/admin/".$data['admin_profile'])) {
    unlink("../../images/profiles/admin/".$data['admin_profile']);
}
$delete_admin = mysqli_query($db, "DELETE FROM admin_details WHERE user_id = '{$admin_id}'");
if ($delete_admin) {
    echo "deleted";
} else {
    echo "not deleted";
}
?>