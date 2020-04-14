<?php
    require "../config.php"; ?>
<div class="col s12">
<table>
    <tr>
        <th><b>Slot Number</b></th>
        <th><b>Status</b></th>
    </tr>
<?php
    $sql = mysqli_query($db, "SELECT * FROM ". mysqli_real_escape_string($db, $_POST['pid']) ."");
    $row = mysqli_num_rows($sql);
    if ($row > 0) {
        while ($data = mysqli_fetch_assoc($sql)) {
            $msg = ($data['slot'] == 1) ? "Parked" : "Not Parked";
            ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <?php
                if ($msg == "Parked") { ?>
                <td class="red-text"><?php echo $msg; ?></td>
                <?php
                } else { ?>
                    <td class="green-text"><?php echo $msg; ?></td>
                <?php
                }
                ?>
            </tr>
<?php
        }
    } else {  ?>
    <tr>
        <td colspan="2" class="red-text center">No Data available</td>
    </tr>
<?php
    }
?>

</table>
</div>