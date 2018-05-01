<?php
// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();
?>

<html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>   		
</head>

<body style = "background: url(https://www.rowanblog.com/wp-content/uploads/2018/04/Holly-Pointe-roommates-710x335.jpg); background-size: 100% 100%;"

	<div class="activate-box">
	<div class="form">
	<form action='' method='post'>

	<br></br>	

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
	
	$form = $f . "<form>
        <p>New Password</p>
        <input type='password' name='password' placeholder='Enter new password'>
        <p>Retype Password</p>
        <input type='password' name='password2' placeholder='Retype new password'>
        <br></br>
        <input type='submit' name='submit' value='Submit'>
		</form>";
	
	if($_POST['submit'] && isset($_GET["var"])){
	$code = $_GET["var"];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	
	if($password == $password2){
		if(strlen($password)>4){
			$sql = "UPDATE users SET password='$password' WHERE code = $code";
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