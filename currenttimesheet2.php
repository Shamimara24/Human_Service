
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

<center><h1>Current Timesheets</h1></center>
<!--<div style="width: 600px; text-align: left; padding: 15px;">-->
<form name="Timesheet" method="post" action="">
<div class="heading">
  </div>
<center>
<fieldset>
<center>
<fieldset>
<fieldset>
<input id="week" type="week" name="week" value="">


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
</tr>
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


</td>
</tr>
</table>

</fieldset>

<fieldset>
<legend> Total Hours</legend>
<div align="left" width="10"><input class="right" type="number" name="Total" readonly="readonly" size="5" value="">
</fieldset>

	
<input type='submit' name='newsave' value='Save'> &nbsp &nbsp &nbsp<input type='submit' name='newsubmit' value='Submit'>
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
