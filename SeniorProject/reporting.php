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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timesheet</title>
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
                <a href="reporting.php"><i class="fas fa-clock"></i> Reporting</a>
                <a href="connections.php"><i class="fas fa-users"></i> Connections</a>
                <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="login.php" style="float:right"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
        <div class="wrapper2">
        <div class="box5">
            <h2>Student Reports</h2>

<form name="Reports">
<p>Student:
<select>
<?php

  // Prepare the SQL for territory name
  $sql = "select distinct username ";
  $sql .= "from rodrigueb6.users";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  // Loop through the rows to find all the values for territory name
  foreach ($stmt->fetchAll() as $row) {

     echo '<option value="' . $row['name'] . '">'. $row['name'] . '</option>\n';
  }
?>

</select>
<p>Organize By:
<select>
    <option value="Name">Student Name</option>
    <option value="Date">Date</option>

</select>


            <h2> </h2>

<style>
* {
    box-sizing: border-box;
}

/* Create four unequal columns that floats next to each other */
.column {
    float: left;
    padding: 10px;

}

.left, .lmiddle {
  width: 30%;
}


.rmiddle, .right {
  width: 20%;
}


/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

div.relative {
position:relative;
left: 50%;
margin-top:50%;
}
</style>
<div class="row">
  <div class="column left">
    <h2>Name</h2>
	<p>Jonathan Diamond <p>
	<p>Brandon<p>
  </div>
  <div class="column lmiddle">
    <h2>Week</h2>
	<p>3/12/18 - 3/23/18<p>
  </div>
  <div class="column rmiddle">
    <h2>Hours Completed</h2>
	<p>65<p>
  </div>
  <div class="column right">
    <h2>Accept/Reject</h2>
	<select>
    <option value="Accept">Accept</option>
    <option value="Decline">Decline</option>

	</select>
	<p><p>
  </div>
</div>

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


