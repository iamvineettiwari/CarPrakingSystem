<?php
session_start();
require "../bin/config.php";
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "admin" && $_SESSION['user_id'] != "") {
        $title = "Dashboard";
        ?>
        <?php include "includes/header.php"; ?>
        <div class="row">
            <div class="col s12 m4 offset-m4 center main-welcome">
                <div class="welcome-text">
                    <h4>Welcome Back Admin !</h4>
                </div>
            </div>
        </div>
        <?php include "includes/footer.php"; ?>
<?php
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
?>