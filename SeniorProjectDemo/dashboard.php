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



<?php
$form ='<body>
    <div class="nav">
        <img src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" class="mainavatar">
            <label for="toggle">&#9776;</label>
        <input type="checkbox" id="toggle"/>
        <div class="menu">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="timesheet.php"><i class="fas fa-clock"></i> Timesheet</a>
                <a href="connections.php"><i class="fas fa-users"></i> Connections</a>
                <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="login.php" style="float:right"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>

<div class="heading">
    <h2>Dashboard</h2>
    <br><br></br></br>
  </div>
</div>


   <div class="wrapper2">
        <div class="box1">
            <h2>Connections</h2>
        </div>
        <div class="box2">
            <h2>Calendar</h2>
                <iframe src="https://calendar.google.com/calendar/embed?title=My%20Calendar&amp;showNav=0&amp;showPrint=0&amp;height=250&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%23711616&amp;ctz=America%2FNew_York" style="border-width:0" width="400" height="250" frameborder="0" scrolling="no"></iframe>
        </div>
        <div class="box3">
        <h2>Profile</h2>
        </div>
        <div class="box4">
            <h2>Timesheet</h2>
        </div>
    </div>';

      if($username && $userid){
                echo "Welcome $username \n $form";
      }else
      echo "Please login <a href='./login.php>Login here.</a>";
     ?>
<body>
   </body>
</html>
