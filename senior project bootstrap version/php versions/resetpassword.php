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

  <body class='text-center'>
  	<div class = "form">
  		<form action='' method='post'>
  			<?php
if(!isset($_GET["var"])){
	 echo "Error: This page is for administrators only. Click <a href='login.php'>here</a> to login.\n";
	 $form = '';
}else{
	
	echo "<h1><center>Reset Password</center></h1>";
	$code = $_GET["var"];
	$query = "SELECT * FROM users WHERE code = $code";
	$result = mysqli_query($dbh, $query);
	$numrows = mysqli_num_rows($result);
	if($numrows == 1){
		$row = mysqli_fetch_assoc($result);
		$fname = $row['firstname'];
		$lname = $row['lastname'];
		
		$f = "<p>" . $fname.  " " . $lname . ", please reset your password using the form below: </p>";
	
	$form = $f . "
        <input type='password' class='form-control' name='password' placeholder='Enter New Password'>
        <input type='password' class='form-control mb-2' name='password2' placeholder='Retype New Password'>
        <input class='btn btn-lg btn-warning btn-block' type='submit' name='submit' value='Reset Password'>
        <p class='message'>Already have an account?<a href='./login.php'> Login here</a></p>
		</form>";
	
	if($_POST['submit'] && isset($_GET["var"])){
	$code = $_GET["var"];
	$password = mysqli_real_escape_string($dbh, $_POST['password']);
	$password2 = mysqli_real_escape_string($dbh, $_POST['password2']);
	
	if($password == $password2){
		if(strlen($password)>4){
			$hashedpassword = password_hash($password, PASSWORD_DEFAULT);
			$sql = "UPDATE users SET password='$hashedpassword' WHERE code = $code";
		$result = mysqli_query($dbh, $sql);
		if($result){
			echo "Password has been successfully updated! Please click <a href='login.php'>here</a> to login.";
			$form = '';
		}else{
			echo "Error: Password was not updated. mySQL error: " . mysqli_error($dbh);
			echo nl2br("\n");
			echo $sql;
		}
		}else{
			echo "Please make sure your new password is atleast 4 characters long.";
		}
	}else{
		echo "You must retype your password correctly to reset it.";
	}
}
	
		echo $form;
	}else{
		 echo "Error: The specificed code either does not exist, or is not unique.\n";
         echo "Contact your database administrator to determine the proper solution to this problem.\n";
	}
}
?>
  		</form>
  	</div>

  	<!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

  </html>