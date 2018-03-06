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
<div align="center"?
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
<input id="date" name="date" />

<script>
   document.getElementById('date').value = (new Date()).format("m/dd/yy");
</script>
Year:
<select>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
</select>
<table width="800">
<tr><th align="center" width="38">Day</th>
<td align="center" width="38">Monday</td>
<td align="center" width="38">Tuesday</td>
<td align="center" width="38">Wednesday</td>
<td align="center" width="38">Thursday</td>
<td align="center" width="38">Friday</td>
<td align="center" width="38">Saturday</td>
<td align="center" width="38">Sunday</td>
<td align="center" width="38">Weekly Total</td></tr>
<tr><th align="center" width="38">Hours</th>
<td align="center" width="38"><input type="number" name="Monday" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Tuesday" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')" onblur="calc()" min="0" max="8">
</td>
<td align="center" width="38"><input type="number" name="Wednesday" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>



<td align="center" width="38"><input type="number" name="Thursday" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Friday" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>


<td align="center" width="38"><input type="number" name="Saturday" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>


<td align="center" width="38"><input type="number" name="Sunday" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>


<td align="center" width="38"><input class="right" type="number" name="Total" readonly="readonly" size="5" value="">
</td>
</tr>
</table>


<table width="800">



<tr><th align="center" width="38">Day</th>
<td align="center" width="38">Monday</td>
<td align="center" width="38">Tuesday</td>
<td align="center" width="38">Wednesday</td>
<td align="center" width="38">Thursday</td>
<td align="center" width="38">Friday</td>
<td align="center" width="38">Saturday</td>
<td align="center" width="38">Sunday</td>
<td align="center" width="38">Weekly Total</td></tr>
<tr><th align="center" width="38">Hours</th>



<td align="center" width="38"><input type="number" name="Monday2" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Tuesday2" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')" onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Wednesday2" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Thursday2" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>


<td align="center" width="38"><input type="number" name="Friday2" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Saturday2" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>

<td align="center" width="38"><input type="number" name="Sunday2" size="1" maxlength="1" value=""
 onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8">
</td>



<td align="center" width="38"><input class="right" type="number" name="Total" readonly="readonly" size="5" value="">
</td>
</tr>
</table>





</form>

</div>

        </div>

                </div>'
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
  var RptTime = (Monday*1) + (Tuesday*1) + (Wednesday*1) + (Thursday*1) + (Friday*1) + (Saturday*1) + (Sunday*1);
  document.Timesheet.Total.value = RptTime.toFixed(2);
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


      if($username && $userid){
                echo "Welcome $username \n $form";
      }else
      echo "Please login <a href='./login.php>Login here.</a>";
     ?>



</script>
</div>
</body>
</html>


