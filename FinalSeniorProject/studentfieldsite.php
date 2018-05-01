<?php

// Connect to the database

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$sql = "select f.fieldsiteid as fsid, f.name as fsName, f.address as fsAddress, f.type as fsType, concat(u.firstname, ' ', u.lastname) as coordName "; 
$sql .= "from rodrigueb6.fieldsites f ";
$sql .= "join rodrigueb6.coordinators c using (coordinatorid) ";
$sql .= "join rodrigueb6.users u on (c.user_id = u.userid);";
$result = mysqli_query($dbh,$sql);

$emptyarray = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Fieldsite</title>
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
        <a href="logout.php" align="right">Logout</a>
</div>

<center><h1>Select a Fieldsite</h1></center>


<div class="form">
<form action="" method="post">
<form align="center"  name="Sites">
<center>

<?php



if($result ->num_rows > 0){
        echo "<table border= '1'>";
        echo "<tr><th>&nbsp &nbsp Site Name &nbsp &nbsp </th>
        <th>&nbsp &nbsp Address &nbsp &nbsp</th>
        <th>&nbsp &nbsp Type  &nbsp &nbsp  </th>
        <th>&nbsp &nbsp Coordinator  &nbsp  &nbsp  </th>
                <th> Select </th></tr>";
        $tableresult = "";

while ($row = mysqli_fetch_assoc($result)){
               	echo "<tr>";
		echo "<td>" . $row['fsName'] . "</td>";
		echo "<td>" . $row['fsAddress'] . "</td>";
		echo "<td>" . $row['fsType'] . "</td>";
		echo "<td>" . $row['coordName'] . "</td>";
		echo "<td> &nbsp &nbsp &nbsp <input type='checkbox' name='select[{$row['fsid']}]' value='{$row['fsid']}' /></td>";
		echo "</tr>";
		}
		
		echo "</table>";
        echo "<br></br><center>
              <input style='padding:5px' type='submit' name='approve' class='btn btn-success' value='Select' />
              </center>";
		
}
                else{
                echo "No Fieldsites found for student" . mysqli_error($dbh);
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
