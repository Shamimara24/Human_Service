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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Activate Account</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>   		
</head>

<body style = "background: url(https://www.rowanblog.com/wp-content/uploads/2018/04/Holly-Pointe-roommates-710x335.jpg); background-size: 100% 100%;"

	<div class="activate-box">
	<div class="form">
	<form action='' method='post'>

	<br></br>	

<?php		
if (!isset($_GET["user"]) && !isset($_GET["code"]) && !$userid == 1){
	echo "Error: This page is for administrators only. Click <a href='login.php'>here</a> to login.\n";
}else{
	echo $form;
	$user = $_GET["user"];
	$code = $_GET["code"];
	$query = "SELECT * FROM users WHERE username = '$user' AND code = '$code' limit 1";
	$result = mysqli_query($dbh, $query);
	$numrows = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		$dbuser = $row['username'];
		$dbfname = $row['firstname'];
		$dblname = $row['lastname'];
		$dbpnumber = $row['phone_number'];
		$dbemail = $row['email'];
	
}
if ($_POST['submit']){
        $update = "UPDATE users SET active = 1 WHERE username = '$user' AND code = '$code';";
		$updateresult = mysqli_query($dbh,$update);
		if($updateresult){
			echo $update;
			echo "Account has been successfully set to active! Click <a href='login.php'>here</a> to Log In.\n";
			$querycheck = "SELECT * FROM users WHERE username = '$user' AND code = '$code'";
			$resultcheck = mysqli_query($dbh, $querycheck);
			$rowcheck = mysqli_fetch_assoc($resultcheck);
			$active = $rowcheck['active'];
		}else{
			echo "Account update failed; the specified user account has not been set to active. Error: " . mysqli_error($dbh) . "\n";
		}
}
?>
		<h1><center>Activate Account</center></h1>
		<p>Username: <input type="text" name="uname" value="<?php echo $dbuser; ?>" readonly></p>
        
		<p>First Name: <input type="text" name="first" value="<?php echo $dbfname; ?>" readonly></p>
       
		<p>Last Name: <input type="text" name="last" value="<?php echo $dblname; ?>" readonly></p>
       
		<p>Phone Number: <input type="text" name="phone" value="<?php echo $dbpnumber; ?>" readonly></p>

		<p>Email: <input type="text" name="e_mail" value="<?php echo $dbemail; ?>" readonly></p>
 
        <input type='submit' name='submit' value='Activate'>
		</div>

	
		</form>
        </div>
        </body>
	</html>	