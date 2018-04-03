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
        <input type="checkbox" id="toggle"/>
        <div class="menu">
                <a href="admindashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="adminreporting.php"><i class="fas fa-clipboard"></i> Reporting</a>
                <a href="adminconnections.php"><i class="fas fa-users"></i> Connections</a>
                <a href="adminprofile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="login.php" style="float:right;font-size:20px;color:white" ><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>


<div  class="heading">
<br>
 <h2 align="center">Connections</h2>
</div>


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
</div>
</body>
</html>
