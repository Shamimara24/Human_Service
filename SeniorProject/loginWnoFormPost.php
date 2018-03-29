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
	<img src="rowan logo 2.png" class="avatar">
		<form action='./login.php' method='post'>
		<div class="login-form">
		<h1><center>Login</center></h1>
			<form>
			<p>Username</p>
			<input type="text" name="username" placeholder="Enter Username Here">
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password Here">
			<input type="submit" name="login" value="Login">
			<p class="message"><a href='#'>Sign up for an account<br><br></a></p>
			<a href="#">Forget your password?</a>
		</form>
		
		
		<form class="register-form">
		<h1><center>Register</center></h1>
		
		<p>Username</p>
		<input type="text" name="rusername" placeholder="Enter Desired Username">
		<p>Password</p>
		<input type="password" name="rpassword" placeholder="Enter Desired Password">
		<input type="password" name="rpassword2" placeholder="Re-enter Password">
		<p>Email</p>
		<input type="text" name="remail" placeholder="Enter email">
		<p>Phone</p>
		<input type="text" name="rphone" placeholder="Enter phone number">
		<p>Semester</p><br>
		<select>
			<option value="spring2018">Spring 2018</option>
			<option value="fall2018">Fall 2018</option>
		</select><br>
		<input type="submit" name="register" value="Register">
		<p class="message"><a href="#">Already have an account?</a></p>
		</form>
		
        </div>	
		</div>
		
		<?php
if ($_POST['submit']){
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username){
		if($password){
			$passwordhash = password_hash($password, PASSWORD_DEFAULT);
		//	echo $passwordhash . "\n";
			$sql = "SELECT * FROM users WHERE ";
			$sql .= "username='$username'";
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

						echo "You have been logged in as <b>$dbuser</b>";
						header('Location: http://elvis.rowan.edu/~rodrigueb6/SeniorProject/index.php');
						exit();

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
		<script src='https://code.jquery.com/jquery-3.3.1.min.js'>
		</script>
		
		<script>
		$('.message a').click(function(){
		$('form').animate({height:"toggle", opacity: "toggle"}, "slow");
		});
		</script>

		
	</body>
</html>
