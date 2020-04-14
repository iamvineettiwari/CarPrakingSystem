<?php
require "../config.php";
$getAdmin = mysqli_query($db, "SELECT * FROM admin_details");
$admin_rows = mysqli_num_rows($getAdmin);
if ($admin_rows > 0) {
?>
    <table class="responsive-table">
        <thead>
            <tr>
                <th>Admin ID</th>
                <th>Admin Name</th>
                <th>Admin Username</th>
                <th>Admin Email</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
                while ($data = mysqli_fetch_assoc($getAdmin)) {
                    ?>
                    <tr>
                        <td><?php echo $data['user_id']; ?></td>
                        <td><?php echo $data['admin_name']; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['admin_email']; ?></td>
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