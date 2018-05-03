
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

  <body class="text-center">
    <div class = "form">
    	<form class="register-form" action='./register.php' method='post'>
      <img class="mb-4" src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" alt="" width="72" height="72">
      <input type="text" name="rfname" class="form-control" placeholder="First Name" required autofocus>
      <input type="text" name="rlname" class="form-control" placeholder="Last Name" required>
      <input type="password" name="rpassword" class="form-control" placeholder="Password" required>
      <input type="password" name="rpassword2" class="form-control" placeholder="Re-enter Password" required>
      <input type="text" name="remail" class="form-control" placeholder="Email address" required autofocus>
      <input type="text" name="rphone" class="form-control" placeholder="Phone Number" required>
      <select name="semesterform">
        <option value="spring2018">Spring 2018</option>
        <option value="fall2018">Fall 2018</option>
        <option value="spring2019">Spring 2019</option>
        <option value="fall2019">Fall 2019</option>
      </select>
      <select name="usertype">
        <option value="student">Student</option>
        <option value="supervisor">Supervisor</option>
       </select>
      <input class="btn btn-lg btn-warning btn-block" type="submit" name="register" value="Register"></input>
      <p class="message">Already have an account?<a href="login.php"> Login</a>
      <p class="mt-5 mb-3 text-muted"></p>
    </form>
    </div>
	
	<?php
if ($_POST['register']){
        $rfname = $_POST['rfname'];
		$rlname = $_POST['rlname'];
        $rpassword = $_POST['rpassword'];
        $rpassword2 = $_POST['rpassword2'];
        $remail = $_POST['remail'];
        $rphone = $_POST['rphone'];
		$type = $_POST['usertype'];
		$semester = $_POST['semesterform'];
        if(!$rfname=="" || !$rlname==""){
        if($rphone){
        if($remail){
        if($rpassword){
        if($rpassword2){
                if ($rpassword === $rpassword2 ){
                        if ( (strlen($remail) > 6) && (strstr($remail, "@")) && (strstr($remail, "."))){
							
								$rfname = trim($rfname);
								$rfname = strtolower($rfname);
								$rlname = trim($rlname);
								$rlname = strtolower($rlname);
								$namecounter = 1;
								$fnamesplit = str_split($rfname);
								$firstinitial = $fnamesplit[0];
							
							
                                $sqlll = "SELECT * FROM users WHERE firstname LIKE '$firstinitial" . "%' AND lastname LIKE '$rlname'";
                                $query = mysqli_query($dbh, $sqlll);
                                $numrowsss = mysqli_num_rows($query);
								$namecounter += $numrowsss;
								$rusername = $rusername = $rfname[0] . $rlname . $namecounter;
                                
                                $sql = "SELECT * FROM users WHERE email='$remail'";
                                $query = mysqli_query($dbh, $sql);
                                $numrows = mysqli_num_rows($query);
                                if($numrows == 0){
                                        $hashedpassword = password_hash($rpassword, PASSWORD_DEFAULT);
                                        $code = mt_rand(1000,9999);
										if($type == "supervisor"){
											$roleID = 3;
										}else{
											$roleID = 2;
										}
                                        $insert =  "INSERT INTO users (username, email, semester, phone_number, password, ";
                                        $insert .= "firstname, lastname, active, code, roleID) VALUES ";
                                        $insert .= "('$rusername', '$remail', '$semester', '$rphone', '$hashedpassword', ";
                                        $insert .= "'$rfname', '$rlname', '0', '$code', '$roleID')";
                                        $insertquery = mysqli_query($dbh, $insert);
                                        if(!$insertquery){
                                        $iresult = "query returned false." . mysqli_error($dbh);
                                        }
                                        
                                        $query = mysqli_query($dbh, "SELECT * FROM users WHERE username='$rusername'");
                                        $numrows = mysqli_num_rows($query);
                                        if($numrows == 1){
                                                $site = "http://elvis.rowan.edu/~mcgrathj2/SeniorProject";
                                                $webmaster = "rodrigueb6@students.rowan.edu";
                                                $subject = "New User Account Request (HSFE)";
                                                $message = "A new user has requested an account.\n";
                                                $message .= "Click the link below to activate the account.\n";
                                                $message .= "$site/activate.php?user=$rusername&code=$code\n";
                                                if(mail($webmaster, $subject, $message)){
                                                        echo "You have been registered. Activation email has been succesfully sent.\n";
												
                                                }else
                                                        echo "An error has occured. Your activation email was not sent.";
                                        }else
                                                echo "An error has occured. Your account was not created. $iresult";
                                }else
                                echo "That email is currently being used for another account.";
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
                echo "You must enter your first and last name to register.";
}
?>

<!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>