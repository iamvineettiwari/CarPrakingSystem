<?php
session_start();
require "../bin/config.php";
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "admin" && $_SESSION['user_id'] != "") {
        $title = "Admin Profile";
?>
<?php include "includes/header.php"; ?>
<h1>Admin Profile</h1>
<?php include "includes/footer.php"; ?>
<?php
    } else {
        header("Location: ../");    
    }
} else {
    header("Location: ../");
}
?>