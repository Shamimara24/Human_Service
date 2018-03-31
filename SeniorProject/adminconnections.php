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
FROM users";

//$sql = "SELECT * FROM users";
$result = mysqli_query($dbh,$sql);

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
<br></br>
 <h2 align="center">Connections</h2>
</div>


<form align="center"  name="Reports">
        <?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
            echo "Name:  ". $row["firstname"]. " ". $row["lastname"] . "" ;
            echo "<br> Email Address:  ". $row["email"] . "" ;
            echo "<br> Phone Number:  ". $row["phone_number"] . "<br><br>";
    }
} else {
    echo "0 results";
}
?>



<script>
   document.getElementById('date').value = (new Date()).format("m/dd/yy");
</script>
</form>
</div>
</body>
</html>
