<?php
require "bin/config.php";
if (isset($_GET['uH']) && isset($_GET['pHi']) && isset($_GET['ac'])) {
    if ($_GET['ac'] == true) {
        $sql = "SELECT * FROM validate_user_reg WHERE user_id = '".$_GET['uH']."' AND reg_token = '".$_GET['pHi']."'";
        $query = mysqli_query($db, $sql);
        $row = mysqli_num_rows($query);
        if ($row > 0) {
            $query = mysqli_query($db, "DELETE FROM validate_user_reg WHERE user_id = '".$_GET['uH']."'");
            $query = mysqli_query($db, "UPDATE user_details SET user_account_status = 1 WHERE user_id = '".$_GET['uH']."'");

            echo "<center><h1>Account Success fully verified. Login with your email as username and password.</h1><h3>Arduino Based Car Parking System</h3></center>";
?>
<script>
    function sendBack() {
        window.location.href = "login.php";
    }
    setTimeout(sendBack, 3000);
</script>
<?php
        } else {
            header("Location: register.php");
        }
    } else {
        header("Location: register.php");
    }
} else {
    header("Location: register.php");
}
?>