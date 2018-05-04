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
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Activate</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">

    <?php   
    if (!isset($_GET["user"]) && !isset($_GET["code"]) && !$userid == 1){
      echo "Error: This page is for administrators only. Click <a href='login.php'>here</a> to login.\n";
    }else{
      echo $form;
      $user = $_GET["user"];
      $code = $_GET["code"];
      $query = "SELECT * FROM users WHERE username = '$user' AND code = '$code'";
      $result = mysqli_query($dbh, $query);
      $numrows = mysqli_num_rows($result);

      if($numrows == 1){
        $row = mysqli_fetch_assoc($result);
        $dbuser = $row['username'];
        $dbfname = $row['firstname'];
        $dblname = $row['lastname'];
        $dbpnumber = $row['phone_number'];
        $dbemail = $row['email'];
    }
    else{
      echo "Error: The specificed username and code either does not exist, or is not unique.\n";
      echo "Contact your database administrator to determine the proper solution to this problem.\n";
    }
  }

    if ($_POST['submit']){

    $update = "UPDATE users SET active = 1 WHERE username = '$user' AND code = '$code'";
    $updateresult = mysqli_query($dbh,$update);
    if($updateresult){
      echo "Account has been successfully set to active! Click <a href='admindashboard.php'>here</a> to return to dashboard.\n";
      $querycheck = "SELECT * FROM users WHERE username = '$user' AND code = '$code'";
      $resultcheck = mysqli_query($dbh, $querycheck);
      $rowcheck = mysqli_fetch_assoc($resultcheck);
      $active = $rowcheck['active'];
      echo "Current info set: " . $rowcheck['username'] . "\n" . $rowcheck['active'] . "\n";
    }else{
      echo "Account update failed; the specified user account has not been set to active. Error: " . mysqli_error($dbh) . "\n";
    }
}
?>
  </head>

  <body class="text-center">
    <div class = "form">

    <form class="form-activate" action='' method='post'>
      <img class="mb-4" src="http://elvis.rowan.edu/~rodrigueb6/SeniorProject/rowan%20logo%202.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Activate Account</h1>
      <p>Username: <?php echo $dbuser ?></p>
      <p>First Name: <?php echo $dbfname ?></p>
      <p>Last Name: <?php echo $dblname ?></p>
      <p>Phone Number: <?php echo $dbpnumber ?></p>
      <p>Email Address: <?php echo $dbemail ?></p>
      <input class="btn btn-lg btn-warning btn-block" type="submit" name="submit" value="Activate"></input>
      <p class="message">Go to website: <a href="login.php">Click Here</a></p>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
    </form>
    </div>



    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
  </body>
</html>
