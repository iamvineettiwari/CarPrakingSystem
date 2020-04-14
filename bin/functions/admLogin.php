<?php
session_start();
require "../config.php";

$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);

$sql = "SELECT user_id, pass FROM admin_details WHERE username = '{$username}'";
$query = mysqli_query($db, $sql);
$row = mysqli_num_rows($query);
if ($row > 0) {
    $data = mysqli_fetch_assoc($query);
    if ($data['pass'] == $password) {
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = "admin";
            echo "true";
    } else {
        echo "password";
    }
} else {
    echo "username";
}
?>