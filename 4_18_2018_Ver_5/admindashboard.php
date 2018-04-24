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
                users u ON (s.userid = u.userid) WHERE t.status = 'approved' GROUP BY 2";
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
  <a href="admindashboard.php">Dashboard</a>
        <a href="adminreporting.php">Reporting</a>
 <div class="dropdown">
    <button class="dropbtn" onclick="myFunction()">Connections
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" id="myDropdown">
        <a href="adminconnections.php">Users</a>
        <a href="adminfieldsites.php">Field Sites</a>
    </div>
  </div>

        <a href="adminprofile.php">Profile</a>
        <a href="login.php" align="right">Logout</a>
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
            echo "". "<b>",$row["firstname"],"</b>" . " " . "<b>", $row["lastname"],"</b>" . "" ;
            echo "<br> Email Address:  ". $row["email"] . "" ;
            echo "<br> Phone Number:  ". $row["phone_number"] . "<br><br>" ;
                }
}
                        else {
                         echo "0 results";
                        }
?>




        </div>
        <div class="box2">
            <h2>Hours Remaining</h2>
<?php
if ($result->num_rows > 0) {
        // output data of each row
    while($row = $totalhours->fetch_assoc()) {
            echo "". $row["StudentName"]. " &nbsp " . "<b>" . $row["Hours"] .  "</b><br><br>" ;
                }
                }
                        else {
                         echo "0 results";
                        }
?>




        </div>
        <div class="box3">
        <h2>Profile</h2>
        <br></br>

<?php
if ($result->num_rows > 0) {
        // output data of each row
    while($row = $nameresult->fetch_assoc()) {
                echo "Welcome  ". $row["FullName"] . "" ;

                        }
                }
                        else {
                         echo "0 results";
                        }
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

<?php

$tbl = "select concat(firstname, ' ', lastname) as name, timesheetsid, unixstamp, total_hours,
                coordinatorid, status ";
$tbl .="from rodrigueb6.users ";
$tbl .= "join rodrigueb6.students s using (userID) ";
$tbl .= "join rodrigueb6.studenttimesheets sts using (bannerID) ";
$tbl .= "join rodrigueb6.timesheets ts using (timesheetsID) WHERE ts.status = 'Pending' ORDER BY name DESC";

$tblresults = mysqli_query($dbh,$tbl);


if($tblresults ->num_rows > 0){
        echo "<table border= '1'>";
        echo "<tr><th>&nbsp &nbsp Student's Name &nbsp &nbsp </th>
        <th>&nbsp &nbsp Timeheet &nbsp &nbsp</th>
        <th>&nbsp &nbsp Date Submitted  &nbsp &nbsp  </th>
        <th>&nbsp &nbsp Total Hours &nbsp &nbsp &nbsp  </th>
        <th>&nbsp &nbsp CoordinatorID  &nbsp  &nbsp  </th>
        <th>&nbsp &nbsp Status &nbsp &nbsp </th>
                <th>&nbsp &nbsp View Timesheet &nbsp &nbsp </th>
                <th> Select </th></tr>";
        $tableresult = "";


while ($row = mysqli_fetch_assoc($tblresults)){
                $tsidnumber = $row['timesheetid'];
                $tableresult .= "<tr>";
                $tableresult .= "<td>" . $row['name'] . "</td>";
                $tableresult .= "<td>" . $row['timesheetsid'] . "</td>";
                $tableresult .= "<td>" . $row['unixstamp'] . "</td>";
                $tableresult .= "<td>" . $row['total_hours'] . "</td>";
                $tableresult .= "<td>" . $row['coordinatorid'] . "</td>";
                $tableresult .= "<td>" . $row['status'] . "</td>";
                $tableresult .= "<td>(<a href='./currenttimesheets.php?timesheetsid=" . $row['timesheetsid'] . "'>View</a>)</td>";
                $tableresult .= "<td> &nbsp &nbsp &nbsp <input type='checkbox' name='approvebox[".$tsidnumber."]' id='approvebox[$tsidnumber]' value='".$tsidnumber."'/></td>";
                $tableresult .= "</tr>";
                }
                $tableresult .= "</table>";
                echo $tableresult;
}
?>


</center>


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
