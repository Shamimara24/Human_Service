<?php

// Connect to the database

error_reporting(E_ALL ^ E_NOTICE);

ini_set('display_errors', 1);

include('connect.php');

$dbh = ConnectDB();

session_start();



$userid = $_SESSION['userid'];

$username = $_SESSION['username'];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>
<body>
    <div class="nav">
        <img src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" class="mainavatar">
            <label for="toggle">&#9776;</label>
        <input type="checkbox" id="toggle"/>
        <div class="menu">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="timesheets.php"><i class="fas fa-clock"></i> Timesheet</a>

                <a href="connections.php"><i class="fas fa-users"></i> Connections</a>

                <a href="profile.php"><i class="fas fa-user"></i> Profile</a>

                <a href="login.php" style="float:right"><i class="fas fa-sign-out-alt"></i></a>

        </div>

    </div>



<div class="heading">
    <br></br>
        <h2><center>Current Timesheets</center></h2>

</div>
        <div class="box5">
<center>
        <table>

                <tr>

                <th>Timesheet #</th>

                <th>Date Created</th>

                <th>Total # of Hours</th>

                <th>Supervisor</th>

                <th>Status</th>

                <th>Open</th>

                </tr>


</center>
<?php



$query = "

SELECT t.*, CONCAT(us.firstname, ' ', us.lastname) AS SupervisorName, st.coordinatorid

 FROM timesheets t JOIN

                          studenttimesheets st ON (t.timesheetsid = st.timesheetsid) JOIN

              students s ON (st.bannerid = s.bannerid) JOIN

                          users u ON (s.userid = u.userid) JOIN

              coordinators c ON (st.coordinatorid = c.coordinatorid) JOIN

                          users us ON (c.user_id = us.userid) WHERE

              st.coordinatorid IN (SELECT st.coordinatorid FROM timesheets t JOIN

                          studenttimesheets st ON (t.timesheetsid = st.timesheetsid) JOIN

              students s ON (st.bannerid = s.bannerid) JOIN

                          users u ON (s.userid = u.userid) WHERE

              u.userid = $userid) AND

              u.userid = $userid";
$results = mysqli_query($dbh, $query);
while($row = mysqli_fetch_array($results)){
?>
        <tr>
                <td><?php echo $row['timesheetsid']?></td>
                <td><?php echo $row['datestart']?></td>
                <td><?php echo $row['total_hours']?></td>
                <td><?php echo $row['SupervisorName']?></td>
                <td><?php echo $row['status']?></td>
                <td><?php echo "(<a href='./currernttimesheet.php?timesheetsid=" . $row['timesheetsid'] . "'>Edit</a>)"?></td>
        </tr>
        <?php
}
      if($username && $userid){
                echo "Welcome $username \n";
      }else
      echo "Please login <a href='./login.php>Login here.</a>";
     ?>



</div>
<div>
              <a href="currenttimesheet.php"><input type='submit' name='submit' value='Create new timesheet'></a>

</div>

</div>
<body>
   </body>
</html>
