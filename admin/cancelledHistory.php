<?php
session_start();
require "../bin/config.php";
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == "admin" && $_SESSION['user_id'] != "") {
        $title = "Booking History";
        ?>
        <?php include "includes/header.php"; ?>
        <div class="col s12 welcome-content">
            <div class="row">
              <div class="col m12">
                <h5 style="padding:20px; font-weight:bold;"><strong>Cancellation History</strong></h5>
                <p class="red-text center" style="margin:10px 0px;">Note : Initiated cancellation refunds may take 48 hours from bank side to refund the amount.</p>
              </div>
            </div>
      </div>
        <div class="col s12" style="padding:0px 20px;">
            <?php

            $per_page = 10;
            $get_data = mysqli_query($db, "SELECT * FROM cancel_refund");
            $total_data = mysqli_num_rows($get_data);
            
            $total_page_required = ceil($total_data / $per_page);
            $current_page = (isset($_GET['page'])) ? $_GET['page'] : 1;
            $offset = ($current_page-1) * $per_page;

            ?>
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Refund ID</th>
                        <th>Payment ID</th>
                        <th>Refund Status</th>
                        <th>Paid Amount</th>
                        <th>Refunded Amount</th>
                        <th>Parking Place</th>
                        <th>Booked Date</th>
                        <th>Cancelled Date</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if ($total_data > 0) {
                        $sql = "SELECT * FROM cancel_refund ORDER BY cancel_date DESC LIMIT $offset, $per_page";
                        $res_data = mysqli_query($db , $sql);
                        while($row = mysqli_fetch_array($res_data)){
                    ?>                    
                    <tr>
                        <td><?= $row['refund_token'] ?></td>
                        <td><?= $row['payment_id'] ?></td>
                        <td><?php 
                        if ($row['refund_status'] == "Refunded") { ?>
                            <p class="green-text"><?= $row['refund_status'] ?></p>
                        <?php
                        } else { ?>
                            <p class="red-text"><?= $row['refund_status'] ?></p>
                        <?php 
                        }
                        ?></td>
                        <td>&#8377; <?= $row['paid_amount'] ?></td>
                        <td>&#8377; <?= $row['refunded_amount'] ?></td>
                        <td><?= $row['parking_name'] ?></td>
                        <td><?= date('d-m-Y h:i:s A', strtotime($row['book_date_time'])) ?></td>
                        <td><?= date('d-m-Y h:i:s A', strtotime($row['cancel_date'])) ?></td>
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
                            echo "cancelledHistory.php?page=". ($current_page - 1); 
                            } 
                        ?>">Prev</a>
                </li>
                <?php
                    if ($total_page_required > 1) {
                        for ($i = 1; $i <= $total_page_required; $i++) { ?>
                        <li class="<?php if ($current_page == $i) echo 'active'; ?>">
                            <a href="cancelledHistory.php?page=<?= $i ?>"><?= $i ?></a>
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
                            echo "cancelledHistory.php?page=". ($current_page + 1); 
                        } 
                    ?>">Next</a>
                </li>
            </ul>
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