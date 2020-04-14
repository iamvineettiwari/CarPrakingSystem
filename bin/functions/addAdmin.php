<?php
require "../config.php";
$target_path = "../../images/profiles/admin/";  
$temp = explode(".", $_FILES["profile"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_path = $target_path.$newfilename;   
$username = mysqli_real_escape_string($db, $_POST['username']);
$name = mysqli_real_escape_string($db, $_POST['name']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$pass = mysqli_real_escape_string($db, $_POST['password']);
$contact = mysqli_real_escape_string($db, $_POST['contact']);
$occupation = mysqli_real_escape_string($db, $_POST['occupation']);

$check_username = mysqli_query($db, "SELECT * FROM admin_details WHERE username = '{$username}'");
$row1 = mysqli_num_rows($check_username);

$check_email = mysqli_query($db, "SELECT * FROM admin_details WHERE admin_email = '{$email}'");
$row2 = mysqli_num_rows($check_email);

if ($row2 == 0) {
if ($row1 == 0) {
$uploaded = move_uploaded_file($_FILES['profile']['tmp_name'], $target_path);
if ($uploaded) {
$query = mysqli_query($db, "INSERT INTO admin_details (username, admin_name, pass, admin_email, admin_contact, admin_occupation, admin_profile) VALUES ('{$username}', '{$name}', '{$pass}', '{$email}', '{$contact}', '{$occupation}', '{$newfilename}')");
if ($query) { 
    echo "true";
} else {
    echo "false";
}
} else {
    echo "file size exceed";
}
} else {
    echo "duplicate username";
}
} else {
    echo "duplicate email";
}
?>