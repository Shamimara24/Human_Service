<?php
// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

$sql = "select username from users";
$result = mysqli_query($dbh,$sql);

$sqltbl = "select username, ts.total_hours as total_hours from rodrigueb6.users u join rodrigueb6.students s using (Userid) join rodrigueb6.studenttimesheets sts using (bannerID) join rodrigueb6.timesheets ts using (timesheetsid)";

$sqldata = mysqli_query($dbh,$sqltbl) or die('error getting database');


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
                <a href="AdminDashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="reporting.php"><i class="fas fa-clock"></i> Reporting</a>
                <a href="AdminConnections.php"><i class="fas fa-users"></i> Connections</a>
                <a href="AdminProfile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="login.php" style="float:right"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
        <div class="wrapper2">
        <div class="box5">
            <h2>Student Reports</h2>

<form name="Reports">

<p>Student:
<select>
	<option value ="all">Select All</option>
	<?php
	while($row1 = mysqli_fetch_array($result)):;
	?>
	<option><?php echo $row1[0];?></option>
	<?php endwhile;?>

</select>
<p>Organize By:
<select>
    <option value="Name">Student Name</option>
    <option value="Date">Date</option>

</select>


            <h2> </h2>

<?php
echo "<table>";
echo "<tr><th>Name</th><th>Hours</th></tr>";

while ($row = mysqli_fetch_array($sqldata,MYSQLI_ASSOC)){
	echo "<tr><td>";
	echo $row['username'];
	echo "</td><td>";
	echo $row['total_hours'];
	echo "<td></tr>";
	
}

echo "</table>";


?>
<script>
   document.getElementById('date').value = (new Date()).format("m/dd/yy");
</script>




</form>

</div>

        </div>

                </div>'
<script type="text/javascript" language="javascript">




      if($username && $userid){
                echo "Welcome $username \n $form";
      }else
      echo "Please login <a href='./login.php>Login here.</a>";
     ?>



</script>
</div>
<div class = "relative">
	<button type = "submit">Submit</button>
</div>
</body>
</html>


