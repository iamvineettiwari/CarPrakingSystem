<?php
require 'bin/config.php';
if (isset($_GET['slot']) && isset($_GET['val']) && isset($_GET['token'])) {
    $get = mysqli_query($db, "SELECT * FROM parking_slot_detail WHERE slot_table = '".$_GET['token']."'");
    $row = mysqli_num_rows($get);
    if ($row > 0) {
        $sql = "UPDATE " . $_GET['token'] ." SET slot = '". $_GET['val'] ."' WHERE id = " . $_GET['slot'];
        $query = mysqli_query($db, $sql);
        if ($query) {
            $date = date('H:i:s');
            $getdata = mysqli_query($db, "SELECT * FROM booking_record WHERE slot_no = '{$_GET['slot']}' AND slot_table = '{$_GET['token']}' AND book_time_in <= '{$date}' AND book_time_out > '{$date}'");
            if ($getdata) {
                echo mysqli_num_rows($getdata);
                $book_record = mysqli_fetch_assoc($getdata);
                $select_user = mysqli_query($db, "SELECT user_email, user_first_name, user_last_name FROM user_details WHERE user_id = '{$book_record['user_id']}'");
                $userData = mysqli_fetch_assoc($select_user);
                if ($_GET['val'] == 1 && $book_record['status'] == 1) {
                    $up = mysqli_query($db, "UPDATE booking_record SET status = '2' WHERE slot_no = '{$_GET['slot']}' AND slot_table = '{$_GET['token']}' AND book_time_in <= '{$date}' AND user_id = '{$book_record['user_id']}' AND book_time_out > '{$date}'");
                    
                    if ($up) {
                        $to = $userData['user_email'];
                        $subject = 'Outing Alert';
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
                        $message .= '<h3 style="color:#f40;">Hi, ' . strtoupper($userData['user_first_name'] .' ' . $userData['user_last_name']) . '</h3>';
                        $message .= '<p>Thank you for check in. Kindly check out on time i.e. <strong>'.strtoupper($book_record['book_time_out']).'</strong> to enjoy hassles service</p><p><strong>Thanks and regards,</strong> <br>Car Parking System <br>VIT AP</p>';
                        $message .= '</body></html>';
                         
                        // Sending email
                        if(mail($to, $subject, $message, $headers)){
                            echo "2008";
                        } else{
                            echo "2007";
                        }
                    } else {
                        echo mysqli_error($db);
                    }
                } else if ($_GET['val'] == 0 && $book_record['status'] == 2){
                    $up = mysqli_query($db, "UPDATE booking_record SET status = '3' WHERE slot_no = '{$_GET['slot']}' AND slot_table = '{$_GET['token']}' AND book_time_in <= '{$date}' AND user_id = '{$book_record['user_id']}' AND book_time_out > '{$date}'");
                    if ($up) {
                        echo $to = $userData['user_email'];
                        $subject = 'Thanks for using Car Parking System';
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
                        $message .= '<h3 style="color:#f40;">Hi, ' . strtoupper($userData['user_first_name'] .' ' . $userData['user_last_name']) . '</h3>';
                        $message .= '<p>Thank you for giving us a chance to serve you. We hope that you enjoyed the service. Use <strong>Car Parking System</strong> for seamless and hassles parking.</p><p>Thanks and regards, <br>Car Parking System <br>VIT AP</p>';
                        $message .= '</body></html>';
                         
                        // Sending email
                        if(mail($to, $subject, $message, $headers)){
                            echo "2006";
                        } else{
                            echo '2005' . mysqli_error($db);
                        }
                    } else {
                        echo "2004" . mysqli_error($db);
                    }
                }
            } else {
                echo "2003";
            }
        } else {
            echo "2001" . mysqli_error($db);
        }
    } else {
        echo '2002';
    }
} else if (isset($_GET['token'])) {
    $sql = mysqli_query($db, "SELECT * FROM ". $_GET['token'] ."");
    $row = mysqli_num_rows($sql);
    if ($row > 0) {
        while ($data = mysqli_fetch_assoc($sql)) {
            $msg = ($data['slot'] == 1) ? "Parked" : "Not Parked";
            echo $data['id'] . " => " . $msg . "<br><br>";
        }
    }
}
?>