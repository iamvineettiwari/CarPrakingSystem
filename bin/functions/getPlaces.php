<?php
require "../config.php";
$i = 0;

$currLat = mysqli_real_escape_string($db, $_GET['lat']);
$currLong = mysqli_real_escape_string($db, $_GET['long']);

$slots = array();
$get_parking = mysqli_query($db, "SELECT slot_longitude, slot_latitude, slot_table FROM parking_slot_detail");
$row = mysqli_num_rows($get_parking);
if ($row > 0) {
    while ($data = mysqli_fetch_assoc($get_parking)) {
        $distance = calculateDistance($currLat, $currLong, $data['slot_latitude'], $data['slot_longitude']);
        $slots[strval(round($distance, 2))] = $data['slot_table'];
    }
    ksort($slots);
    foreach ($slots as $key => $value) {
    $get_data_from_table= mysqli_query($db, "SELECT * FROM parking_slot_detail WHERE slot_table = '{$value}'");
    $details = mysqli_fetch_assoc($get_data_from_table);
    ?>
        <div class="col s12 m4">
            <div class="col s12 places">
                <div class="place-head">
                    <?php echo $details['slot_name']; ?>
                </div>
                <div class="place-location">
                    Address : <span><?php echo $details['slot_address']; ?></span>
                </div>
                <div class="place-distance">
                    Distance : <span><?php echo $key; ?> KM</span>
                </div>
                <div class="book-btn">
                    <form name="booking-form" method="post" action="checkAvailability.php">
                        <input type="hidden" name="pid" value="<?php echo $details['slot_id']; ?>">
                        <button class="btn waves-effect waves-light col s12 green" type="submit" name="avail">Check Availability
                        </button>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "Sorry, no parking slot are registered.";
}

function calculateDistance($lat1, $lon1, $lat2, $lon2)
{

    $dLat = ($lat2 - $lat1) * M_PI / 180.0;
    $dLon = ($lon2 - $lon1) * M_PI / 180.0;

    $lat1 = ($lat1) * M_PI / 180.0;
    $lat2 = ($lat2) * M_PI / 180.0;

    $a = pow(sin($dLat / 2), 2) + pow(sin($dLon / 2), 2) * cos($lat1) * cos($lat2);
    $rad = 6371;
    $c = 2 * asin(sqrt($a));

    return $rad * $c;
}

?>