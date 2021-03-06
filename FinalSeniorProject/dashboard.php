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


$sql2 = "SELECT 120-sum(t.total_hours) as Hours, CONCAT(u.firstname, ' ', u.lastname) as StudentName FROM timesheets t JOIN
                                studenttimesheets st ON (t.timesheetsid = st.timesheetsid) JOIN
                students s ON (st.bannerid = s.bannerid) JOIN
                users u ON (s.userid = u.userid) WHERE
                t.status = 'Approved' AND u.userid = $userid GROUP BY 2";
$totalhours = mysqli_query($dbh,$sql2);


$sql3 = "SELECT CONCAT(u.firstname, ' ', u.lastname) as FullName
FROM users u WHERE userid = $userid";

$nameresult = mysqli_query($dbh,$sql3);
?>





<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>

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
        <a href="logout.php" align="right">Logout</a>
</div>



<center><h1>Dashboard</h1></center>

   <div class="wrapper2">
        <div class="box1">
        <h2>Connections</h2>


<font color="blue"><b>Supervisors</b></font>



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
            <h2>Hours Remaining</h2>
<b><p style="color:#339933;font-size:70px">
<?php
if ($result->num_rows > 0) {
        // output data of each row
    while($row = $totalhours->fetch_assoc()) {
            echo "". $row["Hours"] .  "" ;
                }
                }
                        else {
                         echo "0 results";
                        }
?>
</p></b>



        </div>
        <div class="box3">
        <h2>Profile</h2>
                <br>
<center><img width="100" height"100" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg"></center>

        <br>

<?php
if ($result->num_rows > 0) {
        // output data of each row
    while($row = $nameresult->fetch_assoc()) {
                echo "Welcome  ". $row["FullName"] . "!" ;

                        }
                }
                        else {
                         echo "0 results";
                        }
?>



<br></br>
<br></br>
<form action="profile.php">
    <input type="submit" value="Change Password"/>
</form>
<br>
       </div>


        <div class="box4">

            <h2>Timesheet</h2>

<center>
        <table border = '1'>
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
                <td><?php echo $row['unixstamp']?></td>
                <td><?php echo $row['total_hours']?></td>
                <td><?php echo $row['SupervisorName']?></td>
                <td><?php echo $row['status']?></td>
                <td><?php echo "(<a href='./currenttimesheet.php?timesheetsid=" . $row['timesheetsid'] . "'>Edit</a>)"?></td>
        </tr>
       <?php

}
     if($username && $userid){
      }else
      echo "Please login <a href='./login.php>Login here.</a>";
     ?>

             <br><a href="currenttimesheet.php"><input type='submit' name='submit' value='Create New Timesheet'></a><br></br>

        </div>
    </div>
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
</body>
</html>
