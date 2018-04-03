<?php

// Connect to the database

error_reporting(E_ALL ^ E_NOTICE);

ini_set('display_errors', 1);

include('connect.php');

$dbh = ConnectDB();

mysqli_query($dbh, "SET SESSION sql_mode = ''");

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
	
	<?php
	
	
if($_POST['submit']){
		$sunday1 = $_POST['Sunday'];

        $monday1 = $_POST['Monday'];

        $tuesday1 = $_POST['Tuesday'];

        $wednesday1 = $_POST['Wednesday'];

        $thursday1 = $_POST['Thursday'];

        $friday1 = $_POST['Friday'];

        $saturday1 = $_POST['Saturday'];

        $sunday2 = $_POST['Sunday2'];

        $monday2 = $_POST['Monday2'];

        $tuesday2 = $_POST['Tuesday2'];

        $wednesday2 = $_POST['Wednesday2'];

        $thursday1 = $_POST['Thursday2'];

        $friday2 = $_POST['Friday2'];

        $saturday2 = $_POST['Saturday2'];
		
		echo print_r($_POST);
		
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


       
        }
?>

</head>
<body>

  <div class="nav">
        <img src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" class="mainavatar">
            <label for="toggle">&#9776;</label>
        <input type="checkbox" id="toggle"/>
        <div class="menu">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="timesheets.php"><i class="fas fa-clock"></i> Timesheet</a>
                <a href="connections.php"><i class="fas fa-users"></i> Connections</a>
                <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="login.php" style="float:right;font-size:20px;color:white" ><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>

<div style="width: 600px; text-align: left; padding: 15px;">
<form name="Timesheet" method="post" action="./timesheet.php">


<div class="heading">
<br>
 <h2 align="center">Timesheet</h2>
    <br></br>
  </div>

<fieldset>
<legend> Week 1 </legend>
<table width="800">

<tr><th align="center" width="38">Day</th>
<td align="center" width="38">Monday</td>
<td align="center" width="38">Tuesday</td>
<td align="center" width="38">Wednesday</td>
<td align="center" width="38">Thursday</td>
<td align="center" width="38">Friday</td>
<td align="center" width="38">Saturday</td>
<td align="center" width="38">Sunday</td>

<tr><th align="center" width="38">Hours</th>

<td align="center" width="38"><input type="number" name="Monday" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Tuesday" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')" onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Wednesday" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Thursday" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Friday" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Saturday" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Sunday" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>


</td>
</tr>
</table>

</fieldset>

<fieldset>
<legend> Week 2 </legend>
<table width="800">

<tr><th align="center" width="38">Day</th>
<td align="center" width="38">Monday</td>
<td align="center" width="38">Tuesday</td>
<td align="center" width="38">Wednesday</td>
<td align="center" width="38">Thursday</td>
<td align="center" width="38">Friday</td>
<td align="center" width="38">Saturday</td>
<td align="center" width="38">Sunday</td>
<td align="center" width="38"> Total Hours</td></tr>
<tr><th align="center" width="38">Hours</th>

<td align="center" width="38"><input type="number" name="Monday2" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Tuesday2" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')" onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Wednesday2" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Thursday2" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Friday2" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Saturday2" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Sunday2" size="1" maxlength="1" value="0"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="100"><input class="right" type="number" name="Total" readonly="readonly" size="5" value="">
</td>
</tr>
</table>

</fieldset>

 <input type="submit" name="submit" value="Submit Timesheet">
</form>

<script type="text/javascript" language="javascript">

//////////////////////////////////////////////////////////////////////////////////////////////


function calc(){
  Monday = document.Timesheet.Monday.value;
  Tuesday = document.Timesheet.Tuesday.value; 
  Wednesday = document.Timesheet.Wednesday.value;
  Thursday = document.Timesheet.Thursday.value;
  Friday = document.Timesheet.Friday.value;
  Saturday = document.Timesheet.Saturday.value;
  Sunday = document.Timesheet.Sunday.value;
  Monday2 = document.Timesheet.Monday2.value;
  Tuesday2 = document.Timesheet.Tuesday2.value; 
  Wednesday2 = document.Timesheet.Wednesday2.value;
  Thursday2 = document.Timesheet.Thursday2.value;
  Friday2 = document.Timesheet.Friday2.value;
  Saturday2 = document.Timesheet.Saturday2.value;
  Sunday2 = document.Timesheet.Sunday2.value;
  var RptTime = (Monday*1) + (Tuesday*1) + (Wednesday*1) + (Thursday*1) + (Friday*1) + (Saturday*1) + (Sunday*1) + (Monday2*1) + (Tuesday2*1) + (Wednesday2*1) + (Thursday2*1) + (Friday2*1) + (Saturday2*1) + (Sunday2*1);
  document.Timesheet.Total.value = RptTime.toFixed(4);
  var Frac = 0;
  var Full = parseInt(RptTime);
  RptTimeFrac = RptTime - Full;
  if (RptTimeFrac < 0.25) { Frac = 0; } 
  else { if (RptTimeFrac < 0.5) { Frac = 0.25; }
         else { if (RptTimeFrac < 0.75) { Frac = 0.5; }
                else { Frac = 0.75; }
              }
       }
  document.Timesheet.ReportTime.value = (Full+Frac).toFixed(2);
}

//////////////////////////////////////////////////////////////////////////////////////////////

function inputLimiter(e,allow) {
  var AllowableCharacters = '';
  if (allow == 'Numbers'){AllowableCharacters='.1234567890';}
  var k;
  k=document.all?parseInt(e.keyCode): parseInt(e.which);
  if (k!=13 && k!=8 && k!=0){
    if ((e.ctrlKey==false) && (e.altKey==false)) {
      return (AllowableCharacters.indexOf(String.fromCharCode(k))!=-1);
    } else {
      return true;
    }
  } else {
    return true;
  }
}

//////////////////////////////////////////////////////////////////////////////////////////////

</script>
</div>
  </body>
</html>
