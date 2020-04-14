<?php
require "../config.php";
$getAdmin = mysqli_query($db, "SELECT * FROM parking_slot_detail");
$admin_rows = mysqli_num_rows($getAdmin);
if ($admin_rows > 0) {
?>
    <table class="responsive-table col s12">
        <thead>
            <tr>
                <th>Parking ID</th>
                <th>Parking Name</th>
                <th>Total Slot</th>
                <th>Price of Slot / Hour</th>
                <th>Parking Address</th>
                <th>Manager Name</th>
                <th>Manager Contact</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
                while ($data = mysqli_fetch_assoc($getAdmin)) {
                    ?>
                    <tr>
                        <td><?php echo $data['slot_table']; ?></td>
                        <td><?php echo $data['slot_name']; ?></td>
                        <td><?php echo $data['slot_capacity']; ?></td>
                        <td><?php echo $data['slot_charge']; ?></td>
                        <td><?php echo $data['slot_address']; ?></td>
                        <td><?php echo $data['slot_manager_name']; ?></td>
                        <td><?php echo $data['slot_manager_contact']; ?></td>
                        <td>
                            <form name="viewMap"><input type="hidden" name="pid" value="<?php echo $data['slot_table']; ?>"><button type="submit" class="btn waves waves-effect green"><i class="material-icons">map</i></button></form>
                        </td>
                        <td>
                            <form name="deleteParkingLot"><input type="hidden" name="qd" value="<?php echo $data['slot_table']; ?>"><button type="submit" class="btn waves waves-effect red"><i class="material-icons">delete</i></button></form>
                        </td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
<?php
} else {
    echo "<h5 class='center'> No admin found ! </h5>";
}
?>