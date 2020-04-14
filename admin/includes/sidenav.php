<?php
$uquery = mysqli_query($db, "SELECT admin_name, admin_profile FROM admin_details WHERE username = '{$_SESSION['username']}'");
$data = mysqli_fetch_assoc($uquery);
?>
<ul id="slide-out" class="sidenav">
  <li>
    <div class="user-view">
      <div class="background">
        <img src="../images/backNav2.jpg">
      </div>

      <?php
      if (!empty($data['admin_profile'])) { ?>
        <a href="#user"><img class="circle" src="../images/profiles/admin/<?php echo $data['admin_profile']; ?>"></a>
      <?php
      } else {
        ?>
        <a href="#user"><img class="circle" src="../images/user.jpg"></a>
      <?php
      }
      ?>
      <a href="#name"><span class="white-text name"><b><?php echo $data['admin_name']; ?></b></span></a>
      <a href="#email"><span class="white-text email"><b><?php echo $_SESSION['username']; ?></b></span></a>
    </div>
  </li>
  <li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
  <li><a href="bookingHistory.php"><i class="material-icons">history</i>Booking History</a></li>
  <li><a href="cancelledHistory.php"><i class="material-icons">cancel</i>Cancelled History</a></li>
  <li>
    <div class="divider"></div>
  </li>
  <li><a class="subheader">Manage Places</a></li>
  <li><a class="waves-effect" href="addParking.php"><i class="material-icons">add</i>Add Parking Place</a></li>
  <li><a class="waves-effect" href="viewParking.php"><i class="material-icons">visibility</i>View Parking Places</a></li>
  <li><a class="waves-effect" href="updateParking.php"><i class="material-icons">sync</i>Update Parking Place</a></li>
  <li>
    <div class="divider"></div>
  </li>
  <li><a class="subheader">Manage User</a></li>
  <li><a class="waves-effect" href="userList.php"><i class="material-icons">contacts</i> User List</a></li>
  <li>
    <div class="divider"></div>
  </li>
  <li><a class="subheader">Manage Admin</a></li>
  <li><a class="waves-effect" href="addAdmin.php"><i class="material-icons">people_outline</i>Add Admin</a></li>
  <li><a class="waves-effect" href="viewAdminList.php"><i class="material-icons">portrait</i>View Admin List</a></li>
  <li>
    <div class="divider"></div>
  </li>
  <li><a class="subheader">Setting</a></li>
  <li><a class="waves-effect" href="logout.php"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul>