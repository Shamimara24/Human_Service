<?php
// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);	
include('connect.php');

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

<?php
$form = '<div class="nav">
        <label for="toggle">&#9776;</label>
        <input type="checkbox" id="toggle"/>
        <div class="menu">
                <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="timesheet.php"><i class="fas fa-clock"></i> Timesheet</a>
                <a href="connections.php"><i class="fas fa-users"></i> Connections</a>
                <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
    
   <div class="wrapper2">
        <div class="box1"> 
            <h2>Timesheet</h2>
        </div>
        <div class="box2"> 
            <h2>Connections</h2>
        </div>
        <div class="box3"> 
            <h2>Calendar</h2>
        </div>
        <div class="box4"> 
            <h2>Profile</h2>
        </div>
    </div>';

	if($username && $userid){
	echo "Welcome <b>$username</b> \n $form";
	}
	else
		echo "You must be logged in to view this page. <a href='./login.php'>Login here.</a>";
?>
  </body>
</html>
