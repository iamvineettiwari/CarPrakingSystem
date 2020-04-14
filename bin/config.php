<?php
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DBNAME", "carparkingsystem");
date_default_timezone_set("Asia/Kolkata");
$db = mysqli_connect(HOST, USER, PASS);
if ($db) {
    mysqli_select_db($db, DBNAME) or die (mysqli_error($db));
} else {
    echo "Can not connect to server";
}


?>