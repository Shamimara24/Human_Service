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

    <title>Forgot Password</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <div class = "form">
      <form class="login-form" action='./forgotpassword.php' method='post'>
      <img class="mb-4" src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" alt="" width="72" height="72">
      <p>We'll send you an email to reset your password.</p>
      <input type="text" name="email" class="form-control mb-2" placeholder="Email Address" required autofocus>
      <input class="btn btn-lg btn-warning btn-block" type="submit" name="submit" value="Send Email"></input>
      <p class="message">Already have an account?<a href="./login.php"> Login here</a></p>
      <p></p>
      <?php
if ($_POST['submit']){
  $email = mysqli_real_escape_string($dbh, $_POST['email']);
  if($email){
    $sql = "SELECT * FROM users WHERE email = '" . $email ."'";
    $result = mysqli_query($dbh, $sql);
    $numrows = mysqli_num_rows($result);
    if($numrows == 1){
      $row = mysqli_fetch_assoc($result);
      $code = $row['code'];

       $site = "http://elvis.rowan.edu/~mcgrathj2/SeniorProject";
             $destination = $email;
             $subject = "Password Reset (HSFE)";
             $message = "If you've requested to reset your password for the Human Services Field Experience Portal, click the link below:\n";
       $message .= "$site/resetpassword.php?var=$code \n";
       $message .= "If you didn't request a password reset, please feel free to ignore and delete this message.\n\n";
       $message .= "Thank you!\n";
       if(mail($destination, $subject, $message)){
         echo "An email has been sent to your inbox. Please follow the directions within the message.";
       }else{
       echo "An error has occured. Your password reset email was not sent.";
       }
    }
    else{
      echo "Error: The email you've provided is not in use.";
    }
  }else{
    echo "You must enter your email first!";
}}
?>
    </form>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>