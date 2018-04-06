<?php
// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

$sql = "SELECT firstname, lastname, email, concat('(', substring(phone_number, 1, 3), ') ',
substring(phone_number, 4, 3), '-',  substring(phone_number, 7, 9)) AS phone_number
FROM users WHERE roleID = '1' ORDER BY lastname ASC";




//$sql = "SELECT * FROM users";
$result = mysqli_query($dbh,$sql);

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
                <a href="login.php" style="float:right;font-size:20px;color:white" ><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>

<div class="heading">
<br>
 <h2 align="center">Dashboard</h2>
    <br></br>
  </div>
</div>


   <div class="wrapper2">
        <div class="box1">
        <h2>Connections</h2>
<b>Supervisors</b>
<br></br>
        <?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
            echo "Name:  ". $row["firstname"]. " ". $row["lastname"] . "" ;
            echo "<br> Email Address:  ". $row["email"] . "" ;
            echo "<br> Phone Number:  ". $row["phone_number"] . "<br><br><br>";
                }
                }
                        else {
                         echo "0 results";
                        }
?>

        </div>
        <div class="box2">
            <h2>Calendar</h2>
                <iframe src="https://calendar.google.com/calendar/embed?title=My%20Calendar&amp;showNav=0&amp;showPrint=0&amp;height=250&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%23711616&amp;ctz=America%2FNew_York" style="border-width:0" width="400" height="250" frameborder="0" scrolling="no"></iframe>
        </div>
        <div class="box3">
        <h2>Profile</h2>
        <i class="fas fa-user" style="font-size:48px;center"></i>
        <br></br>
<?php
      if ($username && $userid){
                echo "Welcome $username \n $form";
      }else
      echo "Please login <a href='./login.php>Login here.</a>";
?>


<br></br>
<br></br>
<br></br>
<br></br>

<form action="profile.php">
    <input type="submit" value="Change Password"/>
</form>
        </div>
        <div class="box4">
            <h2>Timesheet</h2>

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
curre
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
                <td><?php echo "(<a href='./currenttimesheet.php?timesheetsid=" . $row['timesheetsid'] . "'>Edit</a>)"?></td>
        </tr>
        <?php
}
      if($username && $userid){
                echo "Welcome $username \n";
      }else
      echo "Please login <a href='./login.php>Login here.</a>";
     ?>



             <br></br><a href="currenttimesheet.php"><input type='submit' name='submit' value='Create new timesheet'></a><br></br>



        </div>
    </div>

<body>
   </body>
</html>
