<?php
require "../config.php";
$table_id = mysqli_real_escape_string($db, $_POST["pid"]);
$dateReq = mysqli_real_escape_string($db, $_POST['date']);
$timeReq = mysqli_real_escape_string($db, $_POST['time']);
$timeReqOut = mysqli_real_escape_string($db, $_POST['out']);

$timeReq = date('H:i:s', strtotime($timeReq));
$timeReqOut = date('H:i:s', strtotime($timeReqOut));

$timeInMicro = strtotime($timeReq);
$timeOutMicro = strtotime($timeReqOut);
?>
<?php

$checkTable = mysqli_query(
    $db,
    "SELECT slot_table, slot_capacity, slot_charge, slot_name FROM parking_slot_detail WHERE slot_id = '{$table_id}'"
);
$tableData = mysqli_fetch_assoc($checkTable);
$table = $tableData['slot_table'];
$total_slot = $tableData['slot_capacity'];
$slot_per = $tableData['slot_charge'];
$slot_name = $tableData['slot_name'];

$checkInTable = "SELECT * FROM booking_record WHERE slot_table = '{$table}' AND status != '3'";
$queryCheckTable = mysqli_query($db, $checkInTable);
$row = mysqli_num_rows($queryCheckTable);
if ($row > 0) {
    $slot_booked = array();
    $available_slot = array();
    while ($tableSlotData = mysqli_fetch_assoc($queryCheckTable)) {
        $inDB = strtotime($tableSlotData['book_time_in']);
        $outDB = strtotime($tableSlotData['book_time_out']);
        if (($timeInMicro >= $inDB && $timeInMicro <= $outDB) || ($timeOutMicro >= $inDB && $timeOutMicro <= $outDB)
            || ($timeInMicro <= $inDB && $timeOutMicro >= $outDB)
        ) {
            array_push($slot_booked, $tableSlotData['slot_no']);
        }
    }

    for ($i = 1; $i <= $total_slot; $i++) {
        if (!in_array($i, $slot_booked)) {
            array_push($available_slot, $i);
        }
    }

    if (count($available_slot) > 0) {
        $allot_slot = $available_slot[array_rand($available_slot)];
        ?>
        <p class="welcome-text">Availability - <?php echo $slot_name; ?></p>
        <div class="col s12">
            <div class="row">
                <div class="col s12 m12">
                    <p class="green-text">Slot is available !</p>
                    <div class="col hide-on-small-and-down m4"></div>
                    <table class="col s12">
                        <tr>
                            <th><b>Slot Number</b></th>
                            <td><?php echo $allot_slot; ?></td>
                        </tr>
                        <tr>
                            <th><b>In Time</b></th>
                            <td><?php echo $timeReq; ?></td>
                        </tr>
                        <tr>
                            <th><b>Out Time<b></th>
                            <td><?php echo $timeReqOut; ?></td>
                        </tr>
                        <tr>
                            <th><b>Total Time</b></th>
                            <td><?php echo round(abs(strtotime($timeReqOut) - strtotime($timeReq)) / 60 / 60, 2); ?> Hours</td>
                        </tr>
                        <tr>
                            <th><b>Total Charge</b></th>
                            <td>&#8377; <?php echo $slot_per * round(abs(strtotime($timeReqOut) - strtotime($timeReq)) / 60 / 60, 2); ?></td>
                        </tr>
                    </table>
                    <form action="bookSlot.php" method="post">
                        <input type="hidden" name="pid" value="<?php echo $table_id; ?>">
                        <input type="hidden" name="date" value="<?php echo $dateReq; ?>">
                        <input type="hidden" name="inTime" value="<?php echo $timeReq; ?>">
                        <input type="hidden" name="outTime" value="<?php echo $timeReqOut; ?>">
                        <input type="hidden" name="slot_alloted" value="<?php echo $allot_slot; ?>">
                        <button class="btn waves-effect waves-light col s12 green" type="submit" name="avail">
                            Book Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php
        } else { ?>
        <p class="center red-text">Slot not available !</p>
    <?php
        }
    } else {
        $available_slot = array();
        for ($i = 1; $i <= $total_slot; $i++) {
            array_push($available_slot, $i);
        }
        $allot_slot = $available_slot[array_rand($available_slot)];
        ?>
    <p class="welcome-text">Availability - <?php echo $slot_name; ?></p>
    <div class="col s12">
        <div class="row">
            <div class="col s12 m12">
                <p class="green-text">Slot is available !</p>
                <div class="col hide-on-small-and-down m4"></div>
                <table class="col s12">
                    <tr>
                        <th><b>Slot Number</b></th>
                        <td><?php echo $allot_slot; ?></td>
                    </tr>
                    <tr>
                        <th><b>In Time</b></th>
                        <td><?php echo $timeReq; ?></td>
                    </tr>
                    <tr>
                        <th><b>Out Time<b></th>
                        <td><?php echo $timeReqOut; ?></td>
                    </tr>
                    <tr>
                        <th><b>Total Time</b></th>
                        <td><?php echo round(abs(strtotime($timeReqOut) - strtotime($timeReq)) / 60 / 60, 2); ?> Hours</td>
                    </tr>
                    <tr>
                        <th><b>Total Charge</b></th>
                        <td>&#8377; <?php echo $slot_per * round(abs(strtotime($timeReqOut) - strtotime($timeReq)) / 60 / 60, 2); ?></td>
                    </tr>
                </table>
                <form action="bookSlot.php" method="post">
                    <input type="hidden" name="pid" value="<?php echo $table_id; ?>">
                    <input type="hidden" name="date" value="<?php echo $dateReq; ?>">
                    <input type="hidden" name="inTime" value="<?php echo $timeReq; ?>">
                    <input type="hidden" name="outTime" value="<?php echo $timeReqOut; ?>">
                    <input type="hidden" name="slot_alloted" value="<?php echo $allot_slot; ?>">
                    <button class="btn waves-effect waves-light col s12 green" type="submit" name="avail">
                        Book Now
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>