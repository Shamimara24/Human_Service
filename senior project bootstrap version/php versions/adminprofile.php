<?php
// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$roleID = $_SESSION['roleID'];
$sql = "SELECT firstname, lastname, email, concat('(', substring(phone_number, 1, 3), ') ',
substring(phone_number, 4, 3), '-',  substring(phone_number, 7, 9)) AS phone_number
FROM users";

//$sql = "SELECT * FROM users";
$result = mysqli_query($dbh,$sql);
if(!isset($_SESSION['userid'])) {
  header("Location: http://elvis.rowan.edu/~mcgrathj2/SeniorProject/login.php"); /* Redirect browser */
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

    <title>Profile</title>

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
                <a class="nav-link" href="adminreporting.php">
                  <span data-feather="clock"></span>
                  Reporting
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
                <a class="nav-link active" href="adminprofile.php">
                  <span data-feather="user"></span>
                  Profile <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Content Section -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Profile</h1>
          </div>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          </div>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <form class="form-changepass" action='./profile.php' method='post'>
              <h1 class="h3 mb-3 font-weight-normal">Change password</h1>
              <input type="password" class="form-control" name ="password" placeholder="Old Password" required>
              <input type="password" class="form-control" name='updatepassword' placeholder="New Password" required>
              <input type="password" class="form-control" name='updatepassword2' placeholder="Re-Enter New Password" required>
              <input class="btn btn-lg btn-warning btn-block" type="submit" name="submit" value="Change Password"></input>
            </form>
          </div>
        </main>
      </div>
    </div>

    <!-- Main PHP block
     ================================================== -->

        <?php
if ($_POST['submit']){
        $password = mysqli_real_escape_string($dbh, $_POST['password']);
        $updatepassword = mysqli_real_escape_string($dbh, $_POST['updatepassword']);
    $updatepassword2 = mysqli_real_escape_string($dbh, $_POST['updatepassword2']);
        if($password){
                if($updatepassword){
          if($updatepassword2){
            if(strlen($updatepassword)>4){
              if($updatepassword == $updatepassword2){
                $getpass = "SELECT * FROM users WHERE username = '$username' AND userid = $userid";
                $result = mysqli_query($dbh, $getpass);
                if($result){
                  $row = mysqli_fetch_assoc($result);
                  $dbpassword = $row['password'];
                  if(password_verify($password, $dbpassword)){
                    $hashedpassword = password_hash($updatepassword, PASSWORD_DEFAULT);
                     $sql = "UPDATE users SET password='$hashedpassword' WHERE
                      userid = $userid";
                    if(mysqli_query($dbh, $sql)){
                      echo "Password has been updated successfully!\n";
                    }else{
                      echo "Error updating password: " . mysqli_error($dbh);
                    }
                  }else{
                    echo "You did not enter the correct password for your account.";
                  }
                }else{
                  echo "Error: getpass query failed. Error: " . mysqli_error($dbh);
                }
            }else{
              echo "You must retype your password correctly to change it.";
            }
            }else{
              echo "Please make sure your new password is atleast 4 characters long.";
            }
            
          }else{
            echo "You must re-enter your new password first.";
          }
                }else
                        echo "You must enter your new password first.\n";
        }else
                echo "You must enter your password first.\n";
}
?>

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