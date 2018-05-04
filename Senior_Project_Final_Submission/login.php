
<?php
// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');

$dbh = ConnectDB();
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">
  </head>

  <!-- Main Code Portion -->

  <body class="text-center">
    <div class = "form">

    <form class="login-form" action='./login.php' method='post'>
      <img class="mb-4" src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" alt="" width="72" height="72">
      <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
      <input class="btn btn-lg btn-warning btn-block" type="submit" name="login" value="Login"></input>
      <p class="message">Don't have an account?<a href="register.php"> Register here</a></p>
      <p class="message">Forgot your password?<a href="forgotpassword.php"> Reset here</a></p>
      <p></p>
    </form>
    </div>

    <!-- PHP BLOCK -->
    <?php
if ($_POST['login']){
        $username = mysqli_real_escape_string($dbh, $_POST['username']);
        $password = mysqli_real_escape_string($dbh, $_POST['password']);
        if($username){
                if($password){
                        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
                       // echo $passwordhash . "\n";
                        $sql = "SELECT u.*, a.adminid FROM users u ";
                        $sql .= "LEFT JOIN administrators a ON (u.userid = a.userid) ";
                        $sql .= "WHERE username='$username'";
                        $query = mysqli_query($dbh, $sql);
                        $numrows = mysqli_num_rows($query);
                        if($numrows == 1){
                                $row = mysqli_fetch_assoc($query);
                                $dbid = $row['userid'];
                                $dbuser = $row['username'];
                                $dbpass = $row['password'];
                                $dbactive = $row['active'];
                                if(password_verify($password, $dbpass)){
                                        if($dbactive == 1){
                                                //set session info
                                                $_SESSION['userid'] = $dbid;
                                                $_SESSION['username'] = $dbuser;
                                                $dbrole = $row[roleID];
                                                        if($dbrole == 1){
                                                                header('Location: http://elvis.rowan.edu/~rodrigueb6/SeniorProject/admindashboard.php');
                                                                }
                                                        else if($dbrole ==2){
                                                header('Location: http://elvis.rowan.edu/~rodrigueb6/SeniorProject/dashboard.php');
                                                                        }
                                                exit();
                                                echo "You have logged in as <b>$username</b>";
                                        }
                                        else
                                                echo "You must activate your acount to login.";
                                }
                                else
                                        echo "You did not enter the correct password.";
                        }
                        else
                                echo "The username you've entered was not found.";
                }
                else
                        echo "You must enter your password.";
        }
        else
                echo "You must enter your username.";
}

?>


    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
  </body>
</html>
