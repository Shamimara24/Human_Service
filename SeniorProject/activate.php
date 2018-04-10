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

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation</title>
    <link rel="stylesheet" href="style.css"><div class='activate-box'>

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</head>

        <body>

                <form action='' method='post'>

                <div class='activate-box'>

                <div class='form'>

<?php
$form = "<img src = 'https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png' class='avatar' height='150'>
        <form class='activate-form'>
        <h1><center>Activate Account</center></h1>
        </div>";
		
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

        <p><b>Username:</b></p>
        <p><b><?php echo $dbuser ?></b></p>
        <p><b>First Name:</b></p>
		<p><b><?php echo $dbfname ?></b></p>
        <p><b>Last Name:</b></p>
		<p><b><?php echo $dblname ?></b></p>
        <p><b>Phone Number:</b></p>
		<p><b><?php echo $dbpnumber ?></b></p>
		<p><b>Email:</b></p>
		<p><b><?php echo $dbemail ?></b></p>

        <input type='submit' name='submit' value='Activate'>
		
		 </form>
        </div>
        </body>