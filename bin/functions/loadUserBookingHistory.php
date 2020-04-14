<?php
session_start();
require "../config.php"; ?>
        <div class="col s12" style="padding:0px 20px;">
            <?php

            $per_page = 10;
            $get_data = mysqli_query($db, "SELECT * FROM booking_record WHERE user_id = '{$_SESSION['user_id']}'");
            $total_data = mysqli_num_rows($get_data);
            
            $total_page_required = ceil($total_data / $per_page);
            $current_page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page-1) * $per_page;

            ?>
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Payment ID</th>
                        <th>Parking Place</th>
                        <th>Slot Alotted</th>
                        <th>Check In Time</th>
                        <th>Check Out Time</th>
                        <th>Booked For Date</th>
                        <th>Booking Time</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if ($total_data > 0) {
                        $sql = "SELECT * FROM booking_record WHERE user_id = '{$_SESSION['user_id']}' ORDER BY booking_time DESC LIMIT $offset, $per_page";
                        $res_data = mysqli_query($db , $sql);
                        while($row = mysqli_fetch_array($res_data)){
                            $table = mysqli_query($db, "SELECT slot_name, slot_latitude, slot_longitude FROM parking_slot_detail WHERE slot_table = '".$row['slot_table']."'");
                            $tableData = mysqli_fetch_assoc($table);
                            $payment = mysqli_query($db, "SELECT payment_id FROM payment_info WHERE transacted_id = '".$row['payment_id']."'");
                            $payData = mysqli_num_rows($payment);
                            $payment_detail = mysqli_fetch_assoc($payment);
                            $dest = $tableData['slot_latitude'] . ',' . $tableData['slot_longitude']; 
                    ?>                    
                    <tr>
                        <td><?= $row['booking_id'] ?></td>
                        <td><?php 
                        if ($payData > 0) {
                            echo $payment_detail['payment_id'];
                        } else {
                            echo '<p class="red-text">NA</p>';
                        }
                        ?></td>
                        <td><?= $tableData['slot_name'] ?></td>
                        <td><?= $row['slot_no'] ?></td>
                        <td><?= date('h:i:s a', strtotime($row['book_time_in'])) ?></td>
                        <td><?= date('h:i:s a', strtotime($row['book_time_out'])) ?></td>
                        <td><?= $row['book_date'] ?></td>
                        <td><?= date('d-m-Y h:i:s a', strtotime($row['booking_time'])) ?></td>
                        <td>&#8377; <?= $row['ammount'] ?></td>
                        <td>
                            <?php
                                if ($row['status'] == 0) {
                                    echo '<p class="red-text">Not Paid and booking cancelled</p>';
                                } else if ($row['status'] == 1) {
                                    echo '<p class="green-text">Paid and Booked</p>';
                                } else if ($row['status'] == 2) {
                                    echo '<p class="yellow-text">Parked !</p>';
                                } else if ($row['status'] == 3) {
                                    echo '<p class="red-text">Service Done !</p>';
                                }
                            ?>    
                        </td>     
                        <?php
                         if ($row['status'] == 3 || $row['status'] == 2) { ?>
                             <td colspan="2" class="center red-text">N/A</td>
                         <?php
                         } else if ($row['status'] == 1){
                         ?>
                        <td>
                            <a class="btn-floating btn-medium waves-effect waves-light green tooltipped" data-position="bottom" data-tooltip="Open Direction" target="_blank" onclick="sendToMap('<?= $dest ?>')"><i class="material-icons">map</i></a>
                        </td>
                        <td>
                            <form action="cancelBooking.php" method="post">
                                <input type="hidden" name="bid" value="<?= $row['payment_id'] ?>">
                                <input type="hidden" name="pid" value="<?= $payment_detail['payment_id'] ?>">
                                <input type="hidden" name="slot" value="<?= $tableData['slot_name'] ?>">
                                <input type="hidden" name="btime" value="<?= $row['booking_time'] ?>">
                                <button class="btn-floating btn-medium waves-effect waves-light red tooltipped"  data-position="bottom" data-tooltip="Cancel Booking" type="submit"><i class="material-icons">cancel</i></button>
                            </form>
                        </td>
                        <?php 
                        } 
                        ?>
                    </tr>
                    <?php     
                        }
                    } else { ?>
                    <tr>
                        <td colspan="9" class="center">
                            <p class="red-text"><b>No data found !</b></p>
                        </td>
                    </tr>
                <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col s12">
            <ul class="pagination <?php if ($total_page_required == 1) echo 'hide'; ?>">
                <li class="<?php if($current_page <= 1) echo 'disabled'; ?>">
                    <a href="<?php 
                        if ( $current_page <= 1 ) { 
                            echo '#'; 
                        } else { 
                            echo "booking-history.php?page=". ($current_page - 1); 
                            } 
                        ?>">Prev</a>
                </li>
                <?php
                    if ($total_page_required > 1) {
                        for ($i = 1; $i <= $total_page_required; $i++) { ?>
                        <li class="<?php if ($current_page == $i) echo 'active'; ?>">
                            <a href="booking-history.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                <?php
                        }
                    }
                ?>
                <li class="<?php if($current_page >= $total_page_required) echo 'disabled'; ?>">
                    <a href="<?php 
                        if ( $current_page >= $total_page_required ) {
                            echo '#'; 
                        } else { 
                            echo "booking-history.php?page=". ($current_page + 1); 
                        } 
                    ?>">Next</a>
                </li>
            </ul>
        </div>