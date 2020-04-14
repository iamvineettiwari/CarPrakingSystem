<?php
require "../config.php";
$admin_id = mysqli_real_escape_string($db, $_GET['aid']);
$getAdmin = mysqli_query($db, "SELECT * FROM user_details WHERE user_id = '{$admin_id}'");
$row = mysqli_num_rows($getAdmin);
if ($row > 0) {
    $data = mysqli_fetch_assoc($getAdmin); ?>

    <table>
        <tbody>
            <tr>
                <td><b>User ID : </b><?php echo $data['user_id']; ?></td>
            </tr>
            <tr>
                <td><b>Name : </b><?php echo $data['user_first_name'] . " " . $data['user_last_name']; ?></td>
            </tr>
            <tr>
                <td><b>Username : </b><?php echo $data['username']; ?></td>
            </tr>
            <tr>
                <td><b>Email : </b><?php echo $data['user_email']; ?></td>
            </tr>
            <tr>
                <td><b>Occupation : </b><?php echo $data['user_occupation']; ?></td>
            </tr>
            <tr>
                <td><b>Contact : </b><?php echo $data['user_contact']; ?></td>
            </tr>
            <tr>
                <td><b>Address : </b><?php echo $data['user_address']; ?></td>
            </tr>
            <tr>
                <td><b>Account Status : </b><?php 
                if ($data['user_account_status'] == '0') {
                    echo '<span class="red-text">Not Verified</span>';
                } else if ($data['user_account_status'] == '1') {
                    echo '<span class="green-text">Verified</span>';
                } else {
                    echo '<span class="red-text">Suspended</span>';
                }
                
                ?></td>
            </tr>
            <tr>
                <td><b>Registered On : </b><?php echo $data['user_reg_datetime']; ?></td>
            </tr>
        </tbody>
    </table>
<?php
} else {
    echo "<br><br><h5 class='center'>Requested data not available.</h5><p class='center'>Please try again. </p>";
}
?>