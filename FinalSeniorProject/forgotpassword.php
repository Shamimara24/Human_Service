<?php
// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();
?>

<html>
<head>
        <title> Rowan University Human Services Field Experience Portal </title>
        <link rel="stylesheet" type="text/css" href="index_style.css">
</head>
<body>
        <div class="login-box">
        <div class="form">
        <img src='https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png' class='avatar'>
                <form action='./forgotpassword.php' name='passwordform' method='post'>
                <div class="login-form">
                <h1><center>Forget your Password?</center></h1>
                        <form>
                        <p>Enter your Email below:</p>
                        <input type="text" name="email" placeholder="Enter Email Here">
                        <p>We'll send you an email to reset your password.</p><br><br>
                        <input type="submit" name="submit" value="Submit">
                        <p class="message"><a href='./login.php'>Go back to Login<br><br></a></p>
        </div>
                </div>
<?php
if ($_POST['submit']){
	$email = $_POST['email'];
	if($email){
		$sql = "SELECT * FROM users WHERE email = '" . $email ."'";
		$result = mysqli_query($dbh, $sql);
		$numrows = mysqli_num_rows($result);
		if($numrows == 1){
			$row = mysqli_fetch_assoc($result);
			$code = $row['code'];

			 $site = "http://elvis.rowan.edu/~rodrigueb6/SeniorProject";
             $destination = "rodrigueb6@students.rowan.edu";
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
	
	
	
