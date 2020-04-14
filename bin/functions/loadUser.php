<?php
require "../config.php";
$getAdmin = mysqli_query($db, "SELECT * FROM user_details");
$admin_rows = mysqli_num_rows($getAdmin);
if ($admin_rows > 0) {
?>
    <table class="responsive-table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Contact</th>
                <th>Account Status</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
                while ($data = mysqli_fetch_assoc($getAdmin)) {
                    ?>
                    <tr>
                        <td><?php echo $data['user_id']; ?></td>
                        <td><?php echo $data['user_first_name'] . " " . $data['user_last_name']; ?></td>
                        <td><?php echo $data['user_email']; ?></td>
                        <td><?php echo $data['user_contact']; ?></td>
                        <td>
                        <?php 
                if ($data['user_account_status'] == '0') {
                    echo '<span class="red-text">Not Verified</span>';
                } else if ($data['user_account_status'] == '1') {
                    echo '<span class="green-text">Verified</span>';
                } else {
                    echo '<span class="red-text">Suspended</span>';
                }
                
                ?>    </td>
                        <td>
                            <form name="viewProfile"><input type="hidden" name="aid" value="<?php echo $data['user_id']; ?>"><button type="submit" class="btn waves waves-effect green"><i class="material-icons">visibility</i></button></form>
                        </td>
                        <td>
                            <form name="deleteProfileBtn"><input type="hidden" name="aid" value="<?php echo $data['user_id']; ?>"><button type="submit" class="btn waves waves-effect red"><i class="material-icons">delete</i></button></form>
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