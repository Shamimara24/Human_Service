
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
    <form class="register-form" action='./login.php' method='post'>
      <img class="mb-4" src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" alt="" width="72" height="72">
      <input type="text" name="rusername" class="form-control" placeholder="Username" required autofocus>
      <input type="password" name="rpassword" class="form-control" placeholder="Password" required>
      <input type="password" name="rpassword2" class="form-control" placeholder="Re-enter Password" required>
      <input type="text" name="remail" class="form-control" placeholder="Email address" required autofocus>
      <input type="text" name="rphone" class="form-control" placeholder="Phone Number" required>
      <select>
        <option value="spring2018">Spring 2018</option>
        <option value="fall2018">Fall 2018</option>
      </select>
      <input class="btn btn-lg btn-success btn-block" type="submit" name="register" value="Register"></input>
      <p class="message">Already have an account?<a href="#"> Login</a>
      <p class="mt-5 mb-3 text-muted"></p>
    </form>

    <form class="login-form" action='./login.php' method='post'>
      <img class="mb-4" src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" alt="" width="72" height="72">
      <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
      <input class="btn btn-lg btn-success btn-block" type="submit" name="login" value="Login"></input>
      <p class="message">Don't have an account?<a href="#"> Register here</a></p>
      <p></p>
    </form>
    </div>

    <!-- PHP BLOCK -->
    <?php
    if ($_POST['login']){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username){
                if($password){
                        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                        echo $passwordhash . "\n";
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
                                if($password == $dbpass){
                                        if($dbactive == 1){
                                                //set session info
                                                $_SESSION['userid'] = $dbid;
                                                $_SESSION['username'] = $dbuser;
                                                $dbrole = $row[roleID];
                                                        if($dbrole == 1){
                                                                header('Location: http://elvis.rowan.edu/~mcgrathj2/SeniorProject/admindashboard.php');
                                                                }
                                                        else if($dbrole ==2){
                                                header('Location: http://elvis.rowan.edu/~mcgrathj2/SeniorProject/dashboard.php');
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
if ($_POST['register']){
        $rusername = $_POST['rusername'];
        $rpassword = $_POST['rpassword'];
        $rpassword2 = $_POST['rpassword2'];
        $remail = $_POST['remail'];
        $rphone = $_POST['rphone'];
        if(!$rusername==""){
        if($rphone){
        if($remail){
        if($rpassword){
        if($rpassword2){
                if ($rpassword === $rpassword2 ){
                        if ( (strlen($remail) > 6) && (strstr($remail, "@")) && (strstr($remail, "."))){
                                $sql = "SELECT * FROM users WHERE username='$rusername'";
                                $query = mysqli_query($dbh, $sql);
                                $numrows = mysqli_num_rows($query);
                                if($numrows == 0){
                                        $sql = "SELECT * FROM users WHERE email='$remail'";
                                $query = mysqli_query($dbh, $sql);
                                $numrows = mysqli_num_rows($query);
                                if($numrows == 0){
                                        $password = password_hash($rpassword, PASSWORD_DEFAULT);
                                        $code = mt_rand(1000,9999);
                                        $insert =  "INSERT INTO users (username, email, semester, phone_number, password, ";
                                        $insert .= "firstname, lastname, active, code, roleID) VALUES ";
                                        $insert .= "('$rusername', '$remail', 'spring2018', '$rphone', '$rpassword', ";
                                        $insert .= "'fname', 'lname', '0', '$code', '2')";
                                        $insertquery = mysqli_query($dbh, $insert);
                                        if(!$insertquery){
$iresult = "query returned false." . mysqli_error($dbh);
                                        }
                                        $query = mysqli_query($dbh, "SELECT * FROM users WHERE username='$rusername'");
                                        $numrows = mysqli_num_rows($query);
                                        if($numrows == 1){
                                                $site = "http://elvis.rowan.edu/~rodrigueb6/SeniorProject";
                                                $webmaster = "rodrigueb6@students.rowan.edu";
                                                $subject = "New User Account Request (HSFE)";
                                                $message = "A new user has requested an account.\n";
                                                $message .= "Click the link below to activate the account.\n";
                                                $message .= "$site/activate.php?user=$rusername&code=$code\n";
                                                if(mail($webmaster, $subject, $message)){
                                                        echo "You have been registered. Activation email has been successfully sent.";
                                                }else
                                                        echo "An error has occured. Your activation email was not sent.";
                                        }else
echo "An error has occured. Your account was not created. $iresult";
                                }else
                                echo "That email is currently being used for another account.";
                                }else
                                echo "That username has already been taken.";
                                }
                        else
                        echo "You must enter a valid email address to register. $remail";
                }
                else
                echo "Your passwords did not match.";
                                }else
                                echo "You must retype your password to register.";
                        }else
                        echo "You must enter your password to register.";
                }else
                echo "You must enter your email to register.";
                }else
                echo "You must enter your phone number to register";
}else
                echo "You must enter your username to register.";

}
?>


    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function(){
      $(".message a").click(function(){
        $(".login-form").toggle();
        $(".register-form").toggle();
      });
    });
    </script>
    
  </body>
</html>