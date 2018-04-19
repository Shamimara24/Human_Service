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
FROM users WHERE roleID = '1'";


$sql2 = "SELECT firstname, lastname, email, concat('(', substring(phone_number, 1, 3), ') ',
substring(phone_number, 4, 3), '-',  substring(phone_number, 7, 9)) AS phone_number
FROM users WHERE roleID = '2'";




//$sql = "SELECT * FROM users";
$result = mysqli_query($dbh,$sql);

$response = mysqli_query($dbh,$sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporting</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>



<body>
    <div class="nav">
                <img src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" class="mainavatar">
            <label for="toggle">&#9776;</label>
                        <br>
                <b><center><font size="6" color="white">Rowan University Field Experience System</font></center></b>
    </div>
<div class="navbar">
  <a href="dashboard.php">Dashboard</a>
  <div class="dropdown">
    <button class="dropbtn" onclick="myFunction()">Timesheets
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" id="myDropdown">
        <a href="timesheets.php">Timesheets</a>
        <a href="currenttimesheet.php">Current Timesheet</a>
    </div>
  </div>
        <a href="connections.php">Connections</a>
        <a href="profile.php">Profile</a>
        <a href="login.php" align="right">Logout</a>
</div>

<center><h1>Connections</h1></center>




<form align="center"  name="Reports">
<!-- <p class="double"> -->
<font color="blue"><h3>Supervisors</h3></font>
        <?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
            echo "". "<b>",$row["firstname"],"</b>" . " " . "<b>", $row["lastname"],"</b>" . "" ;
            echo "<br> Email Address:  ". $row["email"] . "" ;
            echo "<br> Phone Number:  ". $row["phone_number"] . "<br><br>" ;
    }
} else {
    echo "Currently no supervisors";
}
?>
<!-- </p> -->


<!-- <p class="double"> -->
<font color="Blue"><h3>Students</h3></font>
        <?php
if ($response->num_rows > 0) {
    // output data of each row
    while($row = $response->fetch_assoc()) {
            echo "". "<b>",$row["firstname"],"</b>" . " " . "<b>", $row["lastname"],"</b>" . "" ;
            echo "<br> Email Address:  ". $row["email"] . "" ;
            echo "<br> Phone Number:  ". $row["phone_number"] . "<br><br>";
    }
} else {
    echo "Currently no students";
}
?>
<!-- </p> -->

</form>




<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
  }
}
</script>

</div>

</body>
</html>

