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
$sql = "SELECT firstname, lastname, email, concat('(', substring(phone_number, 1, 3), ') ',
substring(phone_number, 4, 3), '-',  substring(phone_number, 7, 9)) AS phone_number
FROM users WHERE roleID = '1' ORDER BY lastname ASC";

$sql2 = "SELECT 120-sum(t.total_hours) as Hours, CONCAT(u.firstname, ' ', u.lastname) as StudentName FROM timesheets t JOIN
                                studenttimesheets st ON (t.timesheetsid = st.timesheetsid) JOIN
                students s ON (st.bannerid = s.bannerid) JOIN
                users u ON (s.userid = u.userid) WHERE
                t.status = 'Approved' AND u.userid = $userid GROUP BY 2";
$totalhours = mysqli_query($dbh,$sql2);


//$sql = "SELECT * FROM users";
$result = mysqli_query($dbh,$sql);
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

    <title>Dashboard</title>

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
                <a class="nav-link active" href="dashboard.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="timesheets.php">
                  <span data-feather="clock"></span>
                  Timesheets
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
            <h1 class="h2">Welcome 
              <?php 
                echo $username . "!";
              ?>
            </h1>
          </div>

          <div class="jumbotron">
                <h1 class="display-4">Timesheets</h1>
				<h2>Hours Remaining</h2>
<b><p style="color:#339933;font-size:70px">
<?php
if ($result->num_rows > 0) {
        // output data of each row
    while($row = $totalhours->fetch_assoc()) {
            echo "". $row["Hours"] .  "" ;
                }
                }
                        else {
                         echo "0 results";
                        }
?>
                <p>Submit new timesheets or look at previously submitted timesheets.</p>
                <p><a class="btn btn-warning btn-lg" href="timesheets.php" role="button">Go to timesheets &raquo;</a></p>
          </div>

          <div class="jumbotron">
                <h1 class="display-4">Connections</h1>
                <p>View connected supervisors and students..</p>
                <p><a class="btn btn-warning btn-lg" href="connections.php" role="button">Go to connections &raquo;</a></p>
          </div>

          <div class="jumbotron">
                <h1 class="display-4">Profile</h1>
                <p>Edit profile information, preferences, seettings, or change your password.</p>
                <p><a class="btn btn-warning btn-lg" href="profile.php" role="button">Go to profile &raquo;</a></p>
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
