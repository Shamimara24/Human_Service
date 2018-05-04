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
FROM users WHERE roleID = '1'";


$sql2 = "SELECT firstname, lastname, email, concat('(', substring(phone_number, 1, 3), ') ',
substring(phone_number, 4, 3), '-',  substring(phone_number, 7, 9)) AS phone_number
FROM users WHERE roleID = '2'";




//$sql = "SELECT * FROM users";
$result = mysqli_query($dbh,$sql);

$response = mysqli_query($dbh,$sql2);
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

    <title>Connections</title>

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
                <a class="nav-link" href="dashboard.php">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="timesheets.php">
                  <span data-feather="clock"></span>
                  Timesheets
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="connections.php">
                  <span data-feather="users"></span>
                  Connections <span class="sr-only">(current)</span>
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
            <h1 class="h2">Connections</h1>
          </div>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-1 mb-2">
            <h1 class="h3">Supervisors</h1>
          </div>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-1 mb-2">
            <div class="table-responsive pb-2 mb-2">          
              <table class="table">
                <tr>
                  <th>Name</th>
                  <th>Email Address</th>
                  <th>Phone Number</th>
                </tr>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                  // output data of each row
                    while($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>". $row["firstname"] . " " .$row["lastname"] . "</td>";
                      echo "<td>" . $row["email"] . "</td>";
                      echo "<td>" . $row["phone_number"] . "</td>";
                      echo "</tr>";
                    }
                  }else {
                      echo "Currently no supervisors";
                    }
                ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-1 mb-2">
            <h1 class="h3">Students</h1>
          </div>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <div class="table-responsive pb-2 mb-2">          
              <table class="table">
                <tr>
                  <th>Name</th>
                  <th>Email Address</th>
                  <th>Phone Number</th>
                </tr>
                <tbody>
                  <?php
                  if ($response->num_rows > 0) {
                  // output data of each row
                    while($row = $response->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>". $row["firstname"] . " " .$row["lastname"] . "</td>";
                      echo "<td>" . $row["email"] . "</td>";
                      echo "<td>" . $row["phone_number"] . "</td>";
                      echo "</tr>";
                    }
                  }else {
                      echo "Currently no supervisors";
                    }
                ?>
              </tbody>
            </table>
          </div>
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
