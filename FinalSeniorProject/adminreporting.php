<?php

// Connect to the database

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$sql = "SELECT CONCAT(firstname, ' ' , lastname) AS fullName FROM users where roleId = 2 and active = 1 order BY firstname ASC;";
$result = mysqli_query($dbh,$sql);
$sql2 = "select datestart from timesheets";
$result2 = mysqli_query($dbh,$sql2);

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

<center><h1>Timesheet Search</h1></center>

<form method="post" action="export.php">
                                <input type="submit" name="export" class="btn btn-success" value="Export All Timesheets" />
                                </form>



<div class="form">
<form action="" method="post">
<form align="center"  name="Reports">
<p>Select a student:
<select id='studentname' name='studentname'>
        <?php
        while($row1 = mysqli_fetch_array($result)):;
        ?>
        <option><?php echo $row1[0];?></option>
        <?php endwhile;?>
</select>
        <input type="submit" name="submit" value="Search">
<center>

<?php

if($_POST['submit']){
$studentname = $_POST['studentname'];
$namesplit = explode(" ", $studentname);
$name = $namesplit[0];
$tbl = "select concat(firstname, ' ', lastname) as name, timesheetsid, unixstamp, total_hours,
                coordinatorid, status ";
$tbl .="from rodrigueb6.users ";
$tbl .= "join rodrigueb6.students s using (userID) ";
$tbl .= "join rodrigueb6.studenttimesheets sts using (bannerID) ";
$tbl .= "join rodrigueb6.timesheets ts using (timesheetsID) ";
$tbl .= "WHERE firstName = '" . $name . "' ";
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

if ($row = mysqli_fetch_assoc($tblresults)){
        $tableresult .= "<br>Timesheets for " . $row['name'] . "<br></br>";
}

while ($row = mysqli_fetch_assoc($tblresults)){
                $tsidnumber = $row['timesheetid'];
                $tableresult .= "<tr>";
                $tableresult .= "<td>" . $row['name'] . "</td>";
                $tableresult .= "<td>" . $row['timesheetsid'] . "</td>";
                $tableresult .= "<td>" . $row['unixstamp'] . "</td>";
                $tableresult .= "<td>" . $row['total_hours'] . "</td>";
                $tableresult .= "<td>" . $row['coordinatorid'] . "</td>";
                $tableresult .= "<td>" . $row['status'] . "</td>";
                $tableresult .= "<td>(<a href='./adminviewtimesheet.php?timesheetsid=" . $row['timesheetsid'] . "'>View</a>)</td>";
                $tableresult .= "<td> &nbsp &nbsp &nbsp <input type='checkbox' name='approvebox[".$tsidnumber."]' id='approvebox[$tsidnumber]' value='".$tsidnumber."'/></td>";
                $tableresult .= "</tr>";
                }

                $tableresult .= "</table>";
                echo $tableresult;
                echo "<br></br><center>
                <input style='padding:5px' type='submit' name='approve' class='btn btn-success' value='Approve' />
                &nbsp &nbsp
                <input style='padding:5px' type='submit' name='reject' class='btn btn-success' value='Reject' />
                </center>";
}
                else{
                echo "No timesheets found for student" . mysqli_error($dbh);
        }
}


if($_POST['approve']){
        echo "You've pressed approve.\n";
        print_r($_POST);
        }

if($_POST['reject']){
        echo "You've pressed reject.";
}
?>

</center>

<script>
   document.getElementById('date').value = (new Date()).format("m/dd/yy");
</script>
</form>
<br />

</div>
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

</div></body>
</html>
