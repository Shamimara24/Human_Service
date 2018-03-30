<?php

// Connect to the database

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();



$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

$sql = "SELECT CONCAT(firstname, ' ' , lastname) AS fullName FROM users ORDER BY firstname ASC;";
$result = mysqli_query($dbh,$sql);


$sql2 = "select datestart from timesheets";
$result2 = mysqli_query($dbh,$sql2);



$tbl = "select concat(firstname, ' ', lastname) as name, timesheetsid, datestart, total_hours, coordinatorid, status ";
$tbl .="from rodrigueb6.users ";
$tbl .= "join rodrigueb6.students s using (userID) ";
$tbl .= "join rodrigueb6.studenttimesheets sts using (bannerID) ";
$tbl .= "join rodrigueb6.timesheets ts using (timesheetsID);";
$tblresults = mysqli_query($dbh,$tbl) or die('error getting database');



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


<div class="heading">
<br>
 <h2 align="center">Reports</h2>
</div>



<div class="form">
<form action="search.php" method="get">

<form align="center"  name="Reports">
<p>Student:
<select>
        <?php
        while($row1 = mysqli_fetch_array($result)):;
        ?>
        <option><?php echo $row1[0];?></option>
        <?php endwhile;?>
</select>





<br></br>
        <button type = "submit">Submit</button>
</br>


<center>
<?php
echo "<table border= '1'>";
echo "<tr><th>&nbsp &nbsp Student's Name &nbsp &nbsp </th>
        <th>&nbsp &nbsp Timeheet &nbsp &nbsp</th>
        <th>&nbsp &nbsp Date Submitted  &nbsp &nbsp  </th>
        <th>&nbsp &nbsp Total Hours &nbsp &nbsp &nbsp  </th>
        <th>&nbsp &nbsp CoordinatorID  &nbsp  &nbsp  </th>
        <th>&nbsp &nbsp Status &nbsp &nbsp </th></tr>";

while ($row = mysqli_fetch_array($tblresults,MYSQLI_ASSOC)){
        echo "<tr><td>";
        echo $row['name'];
        echo "</td><td>";
        echo $row['timesheetsid'];
        echo "</td><td>";
        echo $row['datestart'];
        echo "</td><td>";
        echo $row['total_hours'];
        echo "</td><td>";
        echo $row['coordinatorid'];
        echo "</td><td>";
        echo $row['status'];
        echo "</td></tr>";

}

echo "</table>";

?>
</center>


<script>
   document.getElementById('date').value = (new Date()).format("m/dd/yy");
</script>
</form>
</div>

</form>
</div></body>
</html>

