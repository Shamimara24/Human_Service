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
$tbl = "select concat(firstname, ' ', lastname) as name, timesheetsid, unixstamp, total_hours, coordinatorid, status ";
$tbl .="from rodrigueb6.users ";
$tbl .= "join rodrigueb6.students s using (userID) ";
$tbl .= "join rodrigueb6.studenttimesheets sts using (bannerID) ";
$tbl .= "join rodrigueb6.timesheets ts using (timesheetsID) ";
$tbl .= "WHERE firstName = '" . $studentname . "' ";
$tblresults = mysqli_query($dbh,$tbl) or die('error getting database');
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
                <input class="btn btn-sm btn-outline-secondary" type="submit" name="export" value="Approve"></input>
                <input class="btn btn-sm btn-outline-secondary" type="submit" name="export" value="Reject"></input>
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
                <tr>
                  <th>Student Name</th>
                  <th>Timesheet</th>
                  <th>Date Submitted</th>
                  <th>Total Hours</th>
                  <th>Coordinator ID</th>
                  <th>Status</th>
                  <th>Checkbox</th>
                </tr>
              <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($tblresults)){
                echo "
                  <tr>
                  <td>".$row['name']."</td>
                  <td>".$row['timesheetid']."</td>
                  <td>".$row['datestart']."</td>
                  <td>".$row['total_hours']."</td>
                  <td>".$row['coordinatorid']."</td>
                 <td>".$row['status']."</td>
                 <td> &nbsp &nbsp &nbsp <input type='checkbox' name='name1' /></td>
                </tr>";
                }?>
              </tbody>
            </table>
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
