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
    <style>
      form {
        /* Just to center the form on the page */
        margin: 0 auto;
        width: 400px;
        /* To see the outline of the form */
        padding: 1em;
        border: 1px solid #CCC;
        border-radius: 1em;
      }
      form div + div {
        margin-top: 1em;
      }
      label {
        /* To make sure that all labels have the same size and are properly aligned */
        display: inline-block;
        width: 90px;
        text-align: right;
      }
      input, textarea {
        /* To make sure that all text fields have the same font settings By default, textareas have a monospace font */
        font: 1em sans-serif;
        /* To give the same size to all text fields */
        width: 300px;
        box-sizing: border-box; /* To harmonize the look & feel of text field border */
        border: 1px solid #999;
      }
      input:focus, textarea:focus {
        /* To give a little highlight on active elements */
        border-color: #000;
      }
      textarea {
        /* To properly align multiline text fields with their labels */
        vertical-align: top;
        /* To give enough room to type some text */
        height: 5em;
      }
      .button {
        /* To position the buttons to the same position of the text fields */
        padding-left: 90px;
        /* same size as the label elements */
      }
	  input[type=number]{
    width: 50px;
} 
      button {
        /* This extra margin represent roughly the same space as the space between the labels and their text fields */
        margin-left: .5em;
      }
    </style>
</head>



<body>
    <div class="nav">
        <img src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" class="mainavatar">
            <label for="toggle">&#9776;</label>
        <input type="checkbox" id="toggle"/>
        <div class="menu">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="timesheet.php"><i class="fas fa-clock"></i> Timesheet</a>
                <a href="connections.php"><i class="fas fa-users"></i> Connections</a>
                <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="login.php" style="float:right"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
        <div class="wrapper2">
        <div class="box5">
            <h2>Timesheet</h2>

<form name="Timesheet">
<div align="center">
<p>Week of:
<p>Month:
<select>
    <option value="January">January</option>
    <option value="February">February</option>
    <option value="March">March</option>
    <option value="April">April</option>
    <option value="May">May</option>
    <option value="June">June</option>
    <option value="July">July</option>
    <option value="August">August</option>
    <option value="September">September</option>
    <option value="October">October</option>
    <option value="November">November</option>
    <option value="December">December</option>
</select>


Year:
<select>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
   
  <form action='./login.php' method='post'> 
   
</select>
<table width="800">
    <div>
		<td align="center" width="38">
        <label for="name">Sunday:</label>
        <input type="number" value="0" name="sunday1" /> 
		</td>
    </div>
    <div>
		<td align="center" width="38">
        <label for="name">Monday:</label>
        <input type="number" value="0" name="monday1" /> 
		</td>
    </div>
    <div>
		<td align="center" width="38">
        <label for="name">Tuesday:</label>
        <input type="number" value="0" name="tuesday1" /> 
		</td>
	</div>
	<div>
		<td align="center" width="38">
        <label for="name">Wednesday:</label>
        <input type="number" value="0" name="wednesday1" /> 
		</td>
    </div>
	<div>
		<td align="center" width="38">
        <label for="name">Thursday:</label>
        <input type="number" value="0" name="thursday1" /> 
		</td>
    </div>
	<div>
		<td align="center" width="38">
        <label for="name">Friday:</label>
        <input type="number" value="0" name="friday1" /> 
		</td>
    </div>
	<div>
		<td align="center" width="38">
        <label for="name">Saturday:</label>
        <input type="number" value="0" name="saturday1" /> 
		</td>
    </div>
	</table>
	<br>
	
	<table width="800">
	 <div>
		<td align="center" width="38">
        <label for="name">Sunday:</label>
        <input type="number" value="0" name="sunday2" /> 
		</td>
    </div>
    <div>
		<td align="center" width="38">
        <label for="name">Monday:</label>
        <input type="number" value="0" name="monday2" />
		</td>
    </div>
    <div>
		<td align="center" width="38">
        <label for="name">Tuesday:</label>
        <input type="number" value="0" name="tuesday2" />
		</td>
    </div>
	<div>
		<td align="center" width="38">
        <label for="name">Wednesday:</label>
        <input type="number" value="0" name="wednesday2" />
		</td>
    </div>
	<div>
		<td align="center" width="38">
        <label for="name">Thursday:</label>
        <input type="number" value="0" name="thursday2" /> 
		</td>
    </div>
	<div>
		<td align="center" width="38">
        <label for="name">Friday:</label>
        <input type="number" value="0" name="friday2" />
		</td>
    </div>
	<div>
		<td align="center" width="38">
        <label for="name">Saturday:</label>
        <input type="number" value="0" name="saturday2" /> 
		</td>
	</table>
	<br>
	
	<input type="submit" name="submit" value="Submit Timesheet">

</form>

<?php

if(isset($_POST['submit']) && !empty($_POST['submit'])){
	echo "test test test test test \n";
	$sunday1 = $_POST['sunday1'];
	$monday1 = $_POST['monday1'];
	$tuesday1 = $_POST['tuesday1'];
	$wednesday1 = $_POST['wednesday1'];
	$thursday1 = $_POST['thursday1'];
	$friday1 = $_POST['friday1'];
	$saturday1 = $_POST['saturday1'];
	$sunday2 = $_POST['sunday2'];
	$monday2 = $_POST['monday2'];
	$tuesday2 = $_POST['tuesday2'];
	$wednesday2 = $_POST['wednesday2'];
	$thursday1 = $_POST['thursday1'];
	$friday2 = $_POST['friday2'];
	$saturday2 = $_POST['saturday2'];
	
	$insert =  "INSERT INTO timesheets (total_hours, status, sunday1, monday1, tuesday1, wednesday1, "; 
	$insert .= "thursday1, friday1, saturday1, sunday2, monday2, tuesday2, wednesday2, thursday2, ";
	$insert .= "friday2, saturday2) VALUES ";
	$insert .= "('40', 'Pending', '$sunday1', '$monday1', '$tuesday1', '$wednesday1', '$thursday1', '$friday1', '$saturday1', ";
	$insert .= "'$sunday2', '$monday2', '$tuesday2', '$wednesday2', '$thursday2', '$friday2', '$saturday2')";
	
	$insertquery = mysqli_query($dbh, $insert);
	if(!$insertquery){
					echo "Timesheet Query returned false." . mysqli_error($dbh) . "\n";
					}else
						echo "Timesheet Query worked!\n";
	
	

	$sql = "SELECT s.bannerid FROM students s JOIN ";
	$sql .= "users u ON (s.userid = u.userid) WHERE ";
	$sql .= "u.userid = $userid";
	
	$query = mysqli_query($dbh, $sql);
	if(!$query){
		echo "Select bannerid Query returned false." . mysqli_error($dbh) . "\n";
					}else
						echo "Select bannerid Query worked!\n";
					$result = mysqli_fetch_assoc($query);
					$dbbannerid = $row['bannerid'];
	
	$date = date("Y-m-d");
	$insert2 = "INSERT INTO studenttimesheets (bannerid, timesheetsid, fieldsiteid, coordinatorid, lastmodified) ";
	$insert2 .= "VALUES ('$dbbannerid', 'tsidPlaceholder', 'fsidPlaceholder', 'coidPlaceholder', '$date')";
	
	$insertquery2 = mysqli_query($dbh, $insert2);
	if(!$insertquery2){
		echo "studenttimesheets Insert Query returned false." . mysqli_error($dbh) . "\n";
					}else
						echo "studenttimesheets Insert Query worked!\n";
	
	
	}



?>
    
  </body>
</html>


