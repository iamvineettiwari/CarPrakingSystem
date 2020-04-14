<?php
require "../config.php";
$admin_id = mysqli_real_escape_string($db, $_GET['aid']);
$getAdmin = mysqli_query($db, "SELECT * FROM admin_details WHERE user_id = '{$admin_id}'");
$row = mysqli_num_rows($getAdmin);
if ($row > 0) {
    $data = mysqli_fetch_assoc($getAdmin); ?>

    <table>
        <tbody>
            <tr>
                <td class="center"><img src="../images/profiles/admin/<?php echo $data['admin_profile']; ?>" height="100" width="100" class="responsive-img"></td>
            </tr>
            <tr>
                <td><b>Admin ID : </b><?php echo $data['user_id']; ?></td>
            </tr>
            <tr>
                <td><b>Admin Name : </b><?php echo $data['admin_name']; ?></td>
            </tr>
            <tr>
                <td><b>Admin Username : </b><?php echo $data['username']; ?></td>
            </tr>
            <tr>
                <td><b>Admin Email : </b><?php echo $data['admin_email']; ?></td>
            </tr>
            <tr>
                <td><b>Admin Occupation : </b><?php echo $data['admin_occupation']; ?></td>
            </tr>
            <tr>
                <td><b>Admin Contact : </b><?php echo $data['admin_contact']; ?></td>
            </tr>
        </tbody>
    </table>
<?php
} else {
    echo "<br><br><h5 class='center'>Requested data not available.</h5><p class='center'>Please try again. </p>";
}
?>