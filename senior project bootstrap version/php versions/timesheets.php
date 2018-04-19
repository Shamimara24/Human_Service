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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Timesheets</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <?php
if(isset($_GET["timesheetsid"])){
        $timesheetsid = $_GET["timesheetsid"];
        $query2 = "SELECT t.* FROM timesheets t JOIN
        studenttimesheets st ON (t.timesheetsid = st.timesheetsid) JOIN
        students s ON (st.bannerid = s.bannerid) JOIN
        users u ON (s.userid = u.userid) WHERE
        u.userid = $userid AND t.timesheetsid = $timesheetsid";
        $result = mysqli_query($dbh, $query2);
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
        }else

                echo "GET timesheet query failed. Error: " . mysqli_error($dbh) . "\n";
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
}


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
                $insert =  "INSERT INTO timesheets (total_hours, status, datestart, sunday1, monday1, tuesday1, wednesday1, ";
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
                                        $idquery = "SELECT timesheetsid FROM timesheets WHERE datestart = $todaysdate
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
                                                        echo "Studenttimesheets insert query success! \n";
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
        ?>
  </head>

  <body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0" style="background-color: #333333">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">Rowan University</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="login.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <!-- Sidebar -->
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="timesheets.php">
                  <span data-feather="clock"></span>
                  Timesheets <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="connections.php">
                  <span data-feather="users"></span>
                  Connections
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="profile.php">
                  <span data-feather="user"></span>
                  Profile
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Main dashboard section -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Timesheet</h1>
          </div>
          
          <form name="form-time" align="center" method="post" action="./timesheets.php">
            <div class="table-responsive pb-2 mb-2">          
            <table class="table">
                <tr>
                  <th></th>
                  <th>Monday</th>
                  <th>Tuesday</th>
                  <th>Wednesday</th>
                  <th>Thursday</th>
                  <th>Friday</th>
                  <th>Saturday</th>
                  <th>Sunday</th>
                </tr>
              <tbody>
                <tr>
                  <td>Week 1</td>
                  <td>
                    <input type="number" name="Monday" size="1" maxlength="1" class="form-control" value="<?php echo $monday1 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Tuesday" size="1" maxlength="1" class="form-control" value="<?php echo $tuesday1 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Wednesday" size="1" maxlength="1" class="form-control" value="<?php echo $wednesday1 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Thursday" size="1" maxlength="1" class="form-control" value="<?php echo $thursday1 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Friday" size="1" maxlength="1" class="form-control" value="<?php echo $friday1 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Saturday" size="1" maxlength="1" class="form-control" value="<?php echo $saturday1 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Sunday" size="1" maxlength="1" class="form-control" value="<?php echo $sunday1 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                </tr>
                <tr>
                  <td>Week 2</td>
                  <td>
                    <input type="number" name="Monday2" size="1" maxlength="1" class="form-control" value="<?php echo $monday2 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Tuesday2" size="1" maxlength="1" class="form-control" value="<?php echo $tuesday2 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Wednesday2" size="1" maxlength="1" class="form-control" value="<?php echo $wednesday2 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Thursday2" size="1" maxlength="1" class="form-control" value="<?php echo $thursday2 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Friday2" size="1" maxlength="1" class="form-control" value="<?php echo $friday2 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Saturday2" size="1" maxlength="1" class="form-control" value="<?php echo $saturday2 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                  <td>
                    <input type="number" name="Sunday2" size="1" maxlength="1" class="form-control" value="<?php echo $sunday2 ?>" 
                    onkeypress="return inputLimiter(event,'Numbers')"  onblur="calc()" min="0" max="8" required>
                  </td>
                </tr>
              </tbody>
            </table>
            </div>
            <input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Submit TimeSheet"></input>
          </form>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 mt-3 border-top">
            <h1 class="h2">Submitted Timesheets</h1>
          </div>
            <div class="table-responsive pb-2 mb-2">          
            <table class="table">
              <thead>
                <tr>
                  <th>Timesheet #</th>
                  <th>Date Created</th>
                  <th>Total # of Hours</th>
                  <th>Supervisor</th>
                  <th>Status</th>
                  <th>Open</th>
                </tr>
              </thead>

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
                echo "<tr>";
                echo "<td>" . $row['timesheetsid'] . "</td>";
                echo "<td>" . $row['unixstamp'] . "</td>";
                echo "<td>" . $row['total_hours'] . "</td>";
                echo "<td>" . $row['SupervisorName'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . "(<a href='./timesheets.php?timesheetsid=" . $row['timesheetsid'] . "'>Edit</a>)</td>";
                echo "</tr>"; 
              }
              ?>
              
            </table>
            </div>
      </main>
    </div>
  </div>

                <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!--//////////////////////////////////////////////////////////////////////////////////////////////-->
<script type="text/javascript">
  function calc(){
  Monday = document.form-time.Monday.value;
  Tuesday = document.form-time.Tuesday.value;
  Wednesday = document.form-time.Wednesday.value;
  Thursday = document.form-time.Thursday.value;
  Friday = document.form-time.Friday.value;
  Saturday = document.form-time.Saturday.value;
  Sunday = document.form-time.Sunday.value;
  Monday2 = document.form-time.Monday2.value;
  Tuesday2 = document.form-time.Tuesday2.value;
  Wednesday2 = document.form-time.Wednesday2.value;
  Thursday2 = document.form-time.Thursday2.value;
  Friday2 = document.form-time.Friday2.value;
  Saturday2 = document.form-time.Saturday2.value;
  Sunday2 = document.form-time.Sunday2.value;
  var RptTime = (Monday*1) + (Tuesday*1) + (Wednesday*1) + (Thursday*1) + (Friday*1) + (Saturday*1) + (Sunday*1) + (Monday2*1) + (Tuesday2*1) + (Wednesday2*1) + (Thursday2*1) + (Friday2*1) + (Saturday2*1) + (Sunday2*1);
  document.form-time.Total.value = RptTime.toFixed(4);
  var Frac = 0;
  var Full = parseInt(RptTime);
  RptTimeFrac = RptTime - Full;
  if (RptTimeFrac < 0.25) { Frac = 0; }
  else { if (RptTimeFrac < 0.5) { Frac = 0.25; }
         else { if (RptTimeFrac < 0.75) { Frac = 0.5; }
                else { Frac = 0.75; }
              }
       }
  document.form-time.ReportTime.value = (Full+Frac).toFixed(2);
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
</script>
<!--//////////////////////////////////////////////////////////////////////////////////////////////-->

  </body>
</html>
