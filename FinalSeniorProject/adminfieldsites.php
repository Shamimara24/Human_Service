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

$sql2 = "select name FROM fieldsites";
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

<center><h1>Fieldsite Workers</h1></center>


<div class="form">
<form action="" method="post">
<form align="center"  name="Reports">
<p>Select a Field Site:
<select id='fieldsitename' name='fieldsitename'>
        <?php
        while($row1 = mysqli_fetch_array($result2)):;
        ?>
        <option><?php echo $row1[0];?></option>
        <?php endwhile;?>
</select>
        <input type="submit" name="submit" value="Search">
<center>

<?php
$link = "./admineditfieldsite.php?fieldsitename=";
if($_POST['submit']){
$fieldsitename = $_POST['fieldsitename'];
$tbl = "select distinct concat(firstname, ' ', lastname) as workerName, email, f.fieldsiteid as fieldid from fieldsites f ";
$tbl .= "join studenttimesheets sts on (f.fieldsiteid = sts.fieldsiteid) ";
$tbl .= "join students s using (bannerid) ";
$tbl .= "join users u using (userid) ";
$tbl .= "where f.name = '" . $fieldsitename . "' ";
$tblresults = mysqli_query($dbh,$tbl);

$getID = "select fieldsiteid from fieldsites where name = '" . $fieldsitename . "' ";
$getResults = mysqli_query($dbh,$getID);
if($getResults ->num_rows > 0){
	while ($row = mysqli_fetch_assoc($getResults)){
	$fsid = "./admineditfieldsite.php?fieldsiteid=" . $row['fieldsiteid'];
}
}


if($tblresults ->num_rows > 0){
        echo "<table border= '1'>";
        echo "<tr><th>&nbsp &nbsp Name &nbsp &nbsp </th>
                <th> Email </th></tr>";
        $tableresults = "";


while ($row = mysqli_fetch_assoc($tblresults)){
                $tsidnumber = $row['timesheetid'];
                $tableresult .= "<tr>";
                $tableresult .= "<td>" . $row['workerName'] . "</td>";
                $tableresult .= "<td>" . $row['email'] ."</td>";
                $tableresult .= "</tr>";
				
                }
			
                $tableresult .= "</table>";
                echo $tableresult;
                
}
                else{
                echo "Error. No students working at fieldsite." . mysqli_error($dbh);
        }
}
?>

		<br><center>
                <input type='button' value='Edit Fieldsite' onclick="window.location.href='<?php echo $fsid; ?>'"/>
                </center>


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