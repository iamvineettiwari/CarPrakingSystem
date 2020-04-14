<?php
session_start();
require "../config.php";

$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);

$sql = "SELECT user_id, user_account_status, user_password FROM user_details WHERE username = '{$username}'";
$query = mysqli_query($db, $sql);
$row = mysqli_num_rows($query);
if ($row > 0) {
    $data = mysqli_fetch_assoc($query);
    if ($data['user_password'] == $password) {
        if ($data['user_account_status'] == "1") {
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = "user";
            echo "true";
        } else if ($data['user_account_status'] == "2") {
            echo "suspended";
        } else {
            echo "not verified";
        }
    } else {
        echo "password";
    }
} else {
    echo "username";
}
?>