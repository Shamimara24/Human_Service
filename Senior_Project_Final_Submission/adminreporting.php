<?php

// Connect to the database

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$roleID = $_SESSION['roleID'];
$sql = "SELECT CONCAT(firstname, ' ' , lastname) AS fullName FROM users where roleId = 2 and active = 1 order BY firstname ASC;";
$result = mysqli_query($dbh,$sql);
$sql2 = "select datestart from timesheets";
$result2 = mysqli_query($dbh,$sql2);

$emptyarray = array();
$selectedtimesheets2 = array();
if(!isset($_SESSION['userid'])) {
	header("Location: http://elvis.rowan.edu/~rodrigueb6/SeniorProject/login.php"); /* Redirect browser */
exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reporting</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
  </head>

  
  <body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0" style="background-color: #333333">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="admindashboard.php">Rowan University</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
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
                <a class="nav-link" href="admindashboard.php">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="adminreporting.php">
                  <span data-feather="clock"></span>
                  Reporting <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminconnections.php">
                  <span data-feather="users"></span>
                  Connections
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminfieldsite.php">
                  <span data-feather="target"></span>
                  Field Sites <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminprofile.php">
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
            <h1 class="h2">Reporting</h1>
          </div>        
          
          <form name="form-time" align="center" action="./adminreporting.php" method="post">
            <div class="btn-toolbar mb-2">
              <div class="btn-group mr-2 pb-2">
                <input class="btn btn-sm btn-outline-secondary" type="submit" name="approve" value="Approve"></input>
                <input class="btn btn-sm btn-outline-secondary" type="submit" name="reject" value="Reject"></input>
                <form method="post" action="export.php">
                  <input class="btn btn-sm btn-outline-secondary" type="submit" name="export" value="Export"></input>
                </form>
              </div>
              <div class="btn-group mr-2 pb-2">
                <input class="btn btn-sm btn-outline-secondary" type="submit" name="submit" value="Search"></input>
                <select class="btn btn-sm btn-outline-secondary" id='studentname' name='studentname'>
                  <option value="" disabled selected>Select a student</option>
                      <?php
                      while($row1 = mysqli_fetch_array($result)):;
                       ?>
                      <option><?php echo $row1[0];?></option>
                      <?php endwhile;?>
                </select>
              </div>

            <div class="table-responsive pb-2 mb-2">          
            <table class="table">
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
                echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['timesheetsid'] . "</td>";
    echo "<td>" . $row['unixstamp'] . "</td>";
    echo "<td>" . $row['total_hours'] . "</td>";
    echo "<td>" . $row['coordinatorid'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>(<a href='./adminviewtimesheet.php?timesheetsid=" . $row['timesheetsid'] . "'>View</a>)</td>";
    echo "<td> &nbsp &nbsp &nbsp <input type='checkbox' name='approvebox[{$row['timesheetsid']}]' value='{$row['timesheetsid']}' /></td>";
    echo "</tr>";
    }
    
    echo "</table>";
}
                else{
                echo "No timesheets found for student" . mysqli_error($dbh);
        }
}


if($_POST['approve']){
        echo "<p style='font-size:15px;'><o style='color:red;'>Are you sure you want to APPROVE these timesheets?</p></o>";
      echo "<table class='table'>";
     echo "<tr><th>&nbsp &nbsp Student's Name &nbsp &nbsp </th>
        <th>&nbsp &nbsp Timeheet &nbsp &nbsp</th>
        <th>&nbsp &nbsp Date Submitted  &nbsp &nbsp  </th>
        <th>&nbsp &nbsp Total Hours &nbsp &nbsp &nbsp  </th>
        <th>&nbsp &nbsp CoordinatorID  &nbsp  &nbsp  </th>
        <th>&nbsp &nbsp Status &nbsp &nbsp </th>
                <th>&nbsp &nbsp View Timesheet &nbsp &nbsp </th></tr>";
    foreach ($_POST['approvebox'] as $approvebox){
    $tbl = "select concat(firstname, ' ', lastname) as name, timesheetsid, unixstamp, total_hours,
                coordinatorid, status ";
    $tbl .="from rodrigueb6.users ";
    $tbl .= "join rodrigueb6.students s using (userID) ";
    $tbl .= "join rodrigueb6.studenttimesheets sts using (bannerID) ";
    $tbl .= "join rodrigueb6.timesheets ts using (timesheetsID) ";
    $tbl .= "WHERE timesheetsid = " . $approvebox;
    $tblresults = mysqli_query($dbh,$tbl);
    while($row = mysqli_fetch_assoc($tblresults)){
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['timesheetsid'] . "</td>";
    echo "<td>" . $row['unixstamp'] . "</td>";
    echo "<td>" . $row['total_hours'] . "</td>";
    echo "<td>" . $row['coordinatorid'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>(<a href='./timesheets.php?timesheetsid=" . $row['timesheetsid'] . "'>View</a>)</td>";
    echo "</tr>";
        }
      }
    echo "</table>";
    $_SESSION['selectedtimesheets'] = array_merge($emptyarray, $_POST['approvebox']);
    $selectedtimesheets2 = array_merge($emptyarray, $_POST['approvebox']);

     echo "<br></br><center>
                <input style='padding:5px' type='submit' name='approveaccept' class='btn btn-success' value='Accept' />
                &nbsp &nbsp
                <input style='padding:5px' type='submit' name='goback' class='btn btn-success' value='Go Back' />
                </center>";     
        }
    
if($_POST['approveaccept']){
				$selectedtimesheets = $_SESSION['selectedtimesheets'];
				foreach ($selectedtimesheets as $approvebox2){
				$sql = "UPDATE timesheets SET status = 'Approved' WHERE timesheetsid = " . $approvebox2;
				$sqlresult = mysqli_query($dbh,$sql);
				if($sqlresult){
					echo nl2br("\n");
					echo "Timesheet #" . $approvebox2 . " has been successfully approved!";
					$getemail = "SELECT u.email, t.timesheetsid, u.firstname FROM users u JOIN 
							students s ON (u.userid = s.userid) JOIN 
							studenttimesheets st ON (s.bannerid = st.bannerid) JOIN
							timesheets t ON (st.timesheetsid = t.timesheetsid) WHERE
							t.timesheetsid = $approvebox2";
				$gemail = mysqli_query($dbh, $getemail);
				if($gemail){
					$result = mysqli_fetch_assoc($gemail);
					$dbemail = $result['email'];
					$dbfname = $result['firstname'];
					$subject = "Your timesheet has been approved. (HSFE)";
					$message = "Dear $dbfname, \n A coordinator has recently approved one of your timesheets (Timesheet # " . $approvebox2;
					$message .= "). \n Congratulations!\n";
					$message .="Thank you!";
					if(mail($dbemail, $subject, $message)){
						echo nl2br("\n Student alert email successfully sent!\n");
					}else{
						echo "Error: Student email alert did not send for timesheet #" . $approvebox2;
				      }
				}else{
					echo "Error getting email. Error: " . mysqli_error($dbh);
				}
					echo nl2br("\n");
					}else{
					echo "Error: Timesheet #" . $approvebox2 . " has has not been successfully approved.";
					echo nl2br("\nError: ");
					echo mysqli_error($dbh);
				
					}
				}
			}
      

if($_POST['reject']){
        echo "<p style='font-size:15px;'><o style='color:red;'>Are you sure you want to REJECT these timesheets?</p></o>";
     echo "<table class='table'>";
     echo "<tr><th>&nbsp &nbsp Student's Name &nbsp &nbsp </th>
        <th>&nbsp &nbsp Timeheet &nbsp &nbsp</th>
        <th>&nbsp &nbsp Date Submitted  &nbsp &nbsp  </th>
        <th>&nbsp &nbsp Total Hours &nbsp &nbsp &nbsp  </th>
        <th>&nbsp &nbsp CoordinatorID  &nbsp  &nbsp  </th>
        <th>&nbsp &nbsp Status &nbsp &nbsp </th>
                <th>&nbsp &nbsp View Timesheet &nbsp &nbsp </th></tr>";
    foreach ($_POST['approvebox'] as $approvebox){
    $tbl = "select concat(firstname, ' ', lastname) as name, timesheetsid, unixstamp, total_hours,
                coordinatorid, status ";
    $tbl .="from rodrigueb6.users ";
    $tbl .= "join rodrigueb6.students s using (userID) ";
    $tbl .= "join rodrigueb6.studenttimesheets sts using (bannerID) ";
    $tbl .= "join rodrigueb6.timesheets ts using (timesheetsID) ";
    $tbl .= "WHERE timesheetsid = " . $approvebox;
    $tblresults = mysqli_query($dbh,$tbl);
    while($row = mysqli_fetch_assoc($tblresults)){
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['timesheetsid'] . "</td>";
    echo "<td>" . $row['unixstamp'] . "</td>";
    echo "<td>" . $row['total_hours'] . "</td>";
    echo "<td>" . $row['coordinatorid'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>(<a href='./adminviewtimesheet.php?timesheetsid=" . $row['timesheetsid'] . "'>View</a>)</td>";
    echo "</tr>";
        }
      }
    echo "</table>";
    $_SESSION['selectedtimesheets'] = array_merge($emptyarray, $_POST['approvebox']);
    $selectedtimesheets2 = array_merge($emptyarray, $_POST['approvebox']);

     echo "<br></br><center>
                <input style='padding:5px' type='submit' name='rejectaccept' class='btn btn-success' value='Accept' />
                &nbsp &nbsp
                <input style='padding:5px' type='submit' name='goback' class='btn btn-success' value='Go Back' />
                </center>";     
        }
    
if($_POST['rejectaccept']){
				$selectedtimesheets = $_SESSION['selectedtimesheets'];
				foreach ($selectedtimesheets as $approvebox2){
				$sql = "UPDATE timesheets SET status = 'Rejected' WHERE timesheetsid = " . $approvebox2;
				$sqlresult = mysqli_query($dbh,$sql);
				if($sqlresult){
					echo nl2br("\n");
					echo "Timesheet #" . $approvebox2 . " has been successfully rejected!";
					$getemail = "SELECT u.email, t.timesheetsid, u.firstname FROM users u JOIN 
							students s ON (u.userid = s.userid) JOIN 
							studenttimesheets st ON (s.bannerid = st.bannerid) JOIN
							timesheets t ON (st.timesheetsid = t.timesheetsid) WHERE
							t.timesheetsid = $approvebox2";
				$gemail = mysqli_query($dbh, $getemail);
				if($gemail){
					$result = mysqli_fetch_assoc($gemail);
					$dbemail = $result['email'];
					$dbfname = $result['firstname'];
					$subject = "Your timesheet has been rejected. (HSFE)";
					$message = "Dear $dbfname, \n A coordinator has recently rejected one of your timesheets (Timesheet # ";
					$message .= $approvebox2 . "). \n Please make sure to submit another one to ensure your hours are recorded!\n";
					$message .="Thank you!";
					if(mail($dbemail, $subject, $message)){
						echo nl2br("\n Student alert email successfully sent!\n");
					}else{
						echo "Error: Student email alert did not send for timesheet #" . $approvebox2;
						}	
					}else{
					echo "Error getting email. Error: " . mysqli_error($dbh);
				       }
				
					echo nl2br("\n");
					}else{
					echo "Error: Timesheet #" . $approvebox2 . " has has not been successfully rejected.";
					echo nl2br("\nError: ");
					echo mysqli_error($dbh);
					}
				}
}

?>
            <script>
            document.getElementById('date').value = (new Date()).format("m/dd/yy");
        </script>
            </div>
          </form>       
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

  </body>
</html>

