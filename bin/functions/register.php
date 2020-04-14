<?php
require "../config.php";
$firstName = mysqli_real_escape_string($db, $_POST['firstname']);
$lastName = mysqli_real_escape_string($db, $_POST['lastname']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$password = mysqli_real_escape_string($db, $_POST['password']);
$contact = mysqli_real_escape_string($db, $_POST['contact']);
$occupation = mysqli_real_escape_string($db, $_POST['occupation']);
$address = mysqli_real_escape_string($db, $_POST['address']);

$check = mysqli_query($db, "SELECT * FROM user_details WHERE user_email = '{$email}'");
$rowD = mysqli_num_rows($check);
if ($rowD > 0) {
    echo "not true";
} else {
$sql = "INSERT INTO user_details (username, user_first_name, user_last_name, user_email, user_password, user_contact, user_occupation, user_address) VALUES ('{$email}', '{$firstName}', '{$lastName}', '{$email}', '{$password}', '{$contact}', '{$occupation}', '{$address}')";
$query = mysqli_query($db, $sql);
if ($query) {
    $user_ids = mysqli_insert_id($db);
    $token = sha1(substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,20))), 1, 20));

    $sql2 = "INSERT INTO validate_user_reg (user_id, reg_token) VALUES ('{$user_ids}', '{$token}')";
    $query2 = mysqli_query($db, $sql2);
    if ($query2) {
        $to = $email;
        $subject = 'Registration Confirmation';
        $from = 'iamvineettiwari013@gmail.com';
         
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<h3 style="color:#f40;">Hi, ' . strtoupper($firstName .' ' . $lastName) . '</h3>';
        $message .= '<p>Thank you for registering with Arduino based car parking system. Please click on the link below to verify your mail.</p> <a href="https://carparkingecs.000webhostapp.com/registrationConfirm.php?uH='. $user_ids .'&pHi='.$token.'&ac=true">https://carparkingecs.000webhostapp.com/registrationConfirm.php?uH='. $user_ids .'&pHi='.$token.'&ac=true</a>';
        $message .= '</body></html>';
         
        // Sending email
        if(mail($to, $subject, $message, $headers)){
            echo "true";
        } else{
            echo 'not true' . mysqli_error($db);
        }
    } else {
        echo "false";
    }
} else {
    echo mysqli_error($db);
}
}



?>