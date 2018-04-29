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
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <?php
if(isset($_GET["timesheetsid"])){
        $timesheetsid = $_GET["timesheetsid"];
        $query = "SELECT t.* FROM timesheets t JOIN
        studenttimesheets st ON (t.timesheetsid = st.timesheetsid) JOIN
        students s ON (st.bannerid = s.bannerid) JOIN
        users u ON (s.userid = u.userid) WHERE
        u.userid = $userid AND t.timesheetsid = $timesheetsid";
        $result = mysqli_query($dbh, $query);
        if($result){
                while($row = mysqli_fetch_array($result)){
                $sunday1 = $row['sunday1'];
        $monday1 = $row['monday1'];
        $tuesday1 = $row['tuesday1'];
        $wednesday1 = $row['wednesday1'];
        $thursday1 = $row['thursday1'];
        $friday1 = $row['friday1'];
        $saturday1 = $row['saturday1'];
        $sunday2 = $row['sunday2'];
        $monday2 = $row['monday2'];
        $tuesday2 = $row['tuesday2'];
        $wednesday2 = $row['wednesday2'];
        $thursday2 = $row['thursday2'];
        $friday2 = $row['friday2'];
        $saturday2 = $row['saturday2'];
                }
        }else{
                echo "GET timesheet query failed. Error: " . mysqli_error($dbh) . "\n";
		}
		if($_POST['save']){
			echo "You pressed save on an already existing timesheet";
		}
		
}else{
        $sunday1 = "0";
        $monday1 = "0";
        $tuesday1 = "0";
        $wednesday1 = "0";
        $thursday1 = "0";
        $friday1 = "0";
        $saturday1 = "0";
        $sunday2 = "0";
        $monday2 = "0";
        $tuesday2 = "0";
        $wednesday2 = "0";
        $thursday2 = "0";
        $friday2 = "0";
        $saturday2 = "0";

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
        $thursday2 = $_POST['Thursday2'];
        $friday2 = $_POST['Friday2'];
        $saturday2 = $_POST['Saturday2'];
                $totalhr = $_POST['Total'];
                $todaysdate = time();
                $insert =  "INSERT INTO timesheets (total_hours, status, unixstamp, sunday1, monday1, tuesday1, wednesday1, ";
        $insert .= "thursday1, friday1, saturday1, sunday2, monday2, tuesday2, wednesday2, thursday2, ";
        $insert .= "friday2, saturday2, userid) VALUES ";
        $insert .= "('$totalhr', 'Pending', '$todaysdate', '$sunday1', '$monday1', '$tuesday1', '$wednesday1', '$thursday1', '$friday1', '$saturday1', ";
        $insert .= "'$sunday2', '$monday2', '$tuesday2', '$wednesday2', '$thursday2', '$friday2', '$saturday2', '$userid')";
        $insertquery = mysqli_query($dbh, $insert);
                  if(!$insertquery){
            echo "Timesheet Query returned false." . mysqli_error($dbh) . "\n";
            }else
                echo "Timesheet Query worked!\n";
                                $bannerquery = "SELECT bannerid FROM students WHERE userid = $userid";
                                $bannerresult = mysqli_query($dbh, $bannerquery);
                                if($bannerresult){
                                        $row = mysqli_fetch_assoc($bannerresult);
                                        $bannerid = $row['bannerid'];
                                        $idquery = "SELECT timesheetsid FROM timesheets WHERE unixstamp = $todaysdate
                                                                AND userid = $userid";
                                        $idresult = mysqli_query($dbh, $idquery);
                                        if($idresult){
                                                $row2 = mysqli_fetch_assoc($idresult);
                                                $timesheetsid = $row2['timesheetsid'];
                                                $insert = "INSERT INTO studenttimesheets (bannerid, timesheetsid, fieldsiteid,
                                                                coordinatorid) VALUES ('$bannerid', '$timesheetsid', '1',
                                                                '1')";
                                                $insertstutimesheets = mysqli_query($dbh, $insert);
                                                if($insertstutimesheets){
                                                        echo "Current timesheet has been successfully submitted! \n";
                                                }else{
                                                        echo "Studenttimesheets insert query failed. timesheetsid: $timesheetsid Error: " . mysqli_error($dbh);
                                                }
                                        }else{
                                                echo "Select timesheetid query failed. Error: " . mysqli_error($dbh) . "\n";
                                        }
                                }else{
                                        echo "Select banenrid query failed. Error: " . mysqli_error($dbh) . "\n";
                                }
        }
if($_POST['save'] && !isset($_GET["timesheetsid"])){
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
        $thursday2 = $_POST['Thursday2'];
        $friday2 = $_POST['Friday2'];
        $saturday2 = $_POST['Saturday2'];
                $totalhr = $_POST['Total'];
                $todaysdate = time();
                $insert =  "INSERT INTO timesheets (total_hours, status, unixstamp, sunday1, monday1, tuesday1, wednesday1, ";
        $insert .= "thursday1, friday1, saturday1, sunday2, monday2, tuesday2, wednesday2, thursday2, ";
        $insert .= "friday2, saturday2, userid) VALUES ";
        $insert .= "('$totalhr', 'Saved', '$todaysdate', '$sunday1', '$monday1', '$tuesday1', '$wednesday1', '$thursday1', '$friday1', '$saturday1', ";
        $insert .= "'$sunday2', '$monday2', '$tuesday2', '$wednesday2', '$thursday2', '$friday2', '$saturday2', '$userid')";
        $insertquery = mysqli_query($dbh, $insert);
                  if(!$insertquery){
            echo "Timesheet Query returned false." . mysqli_error($dbh) . "\n";
            }else
                echo "Timesheet Query worked!\n";
                                $bannerquery = "SELECT bannerid FROM students WHERE userid = $userid";
                                $bannerresult = mysqli_query($dbh, $bannerquery);
                                if($bannerresult){
                                        $row = mysqli_fetch_assoc($bannerresult);
                                        $bannerid = $row['bannerid'];
                                        $idquery = "SELECT timesheetsid FROM timesheets WHERE unixstamp = $todaysdate
                                                                AND userid = $userid";
                                        $idresult = mysqli_query($dbh, $idquery);
                                        if($idresult){
                                                $row2 = mysqli_fetch_assoc($idresult);
                                                $timesheetsid = $row2['timesheetsid'];
                                                $insert = "INSERT INTO studenttimesheets (bannerid, timesheetsid, fieldsiteid,
                                                                coordinatorid) VALUES ('$bannerid', '$timesheetsid', '1',
                                                                '1')";
                                                $insertstutimesheets = mysqli_query($dbh, $insert);
                                                if($insertstutimesheets){
                                                        echo "Current timesheet has been successfully saved! \n";
                                                }else{
                                                        echo "Studenttimesheets insert query failed. timesheetsid: $timesheetsid Error: " . mysqli_error($dbh);
                                                }
                                        }else{
                                                echo "Select timesheetid query failed. Error: " . mysqli_error($dbh) . "\n";
                                        }
                                }else{
                                        echo "Select banenrid query failed. Error: " . mysqli_error($dbh) . "\n";
                                }
        }
	}
?>
</head>
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
        <a href="login.php" align="right">Logout</a>
</div>
<center><h1>Current Timesheets</h1></center>
<!--<div style="width: 600px; text-align: left; padding: 15px;">-->
<form name="Timesheet" method="post" action="./currenttimesheet.php">
<div class="heading">
  </div>
<center>
<fieldset>
<center>
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
<td align="center" width="38"><input type="number" name="Monday" size="1" maxlength="1" value="<?php echo $monday1 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Tuesday" size="1" maxlength="1" value="<?php echo $tuesday1 ?>"
 onkeypress="return inputLimiter(event,'Numbers')" onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Wednesday" size="1" maxlength="1" value="<?php echo $wednesday1 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Thursday" size="1" maxlength="1" value="<?php echo $thursday1 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Friday" size="1" maxlength="1" value="<?php echo $friday1 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Saturday" size="1" maxlength="1" value="<?php echo $saturday1 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Sunday" size="1" maxlength="1" value="<?php echo $sunday1 ?>"
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
<td align="center" width="38"><input type="number" name="Monday2" size="1" maxlength="1" value="<?php echo $monday2 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Tuesday2" size="1" maxlength="1" value="<?php echo $tuesday2 ?>"
 onkeypress="return inputLimiter(event,'Numbers')" onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Wednesday2" size="1" maxlength="1" value="<?php echo $wednesday2 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Thursday2" size="1" maxlength="1" value="<?php echo $thursday2 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Friday2" size="1" maxlength="1" value="<?php echo $friday2 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Saturday2" size="1" maxlength="1" value="<?php echo $saturday2 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Sunday2" size="1" maxlength="1" value="<?php echo $sunday2 ?>"
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>
<td align="center" width="100"><input class="right" type="number" name="Total" readonly="readonly" size="5" value="">
</td>
</tr>
</table>
</fieldset>
<input type="submit" name="submit" value="Submit Timesheet">
<input type="submit" name="save" value="Save Timesheet">
<p style="font-size:14px;"><u style="color:red;">WARNING: You will not be able to edit your timesheet once it's submitted. Please double check that your timesheet has the correct info!</p></u>
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
</div>
  </body>
</html>
