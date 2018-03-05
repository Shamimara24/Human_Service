<?php
// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);	
include('connect.php');

$dbh = ConnectDB();
?>

<html>
<head>
  <title>Find Users</title>
</head>
<body>
<?php
if ($_POST['submit']){
	$username = $_POST['username'];
	//mysql_connect("localhost","root","") or die ("Could not connect to the server");
	//mysql_select_db("users") or die ("That database could not be found!");
	$sql = "SELECT * FROM users WHERE username='$username'";
	$userquery = mysqli_query($dbh, $sql) or die ("The query could not be completed. Please try again");
	if(mysqli_num_rows($userquery) != 1){
	  die ("That username could not be found!");
	}
	$row = mysqli_fetch_assoc($userquery);
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$email = $row['email'];
		$dbusername = $row['username'];
		$active = $row['active'];
	
	if($username != $dbusername){
		die ("There has been a fatal error, Please try again.")
	}

	if($active == 0){
		$active = "The account has not yet been activated.";
	} else {
		$active = "The account has not yet been activated.";
	}
}
?>
<h2><?php echo $firstname: ?> <?php echo $lastname: ?>s profile</h2><br />
	<table>
		<tr><td>Firstname:</td><td><?php echo $firstname ?></td></tr>
		<tr><td>Lastname:</td><td><?php echo $lastname ?></td></tr>
		<tr><td>Email:</td><td><?php echo $email ?></td></tr>
		<tr><td>Username:</td><td><?php echo $dbusername ?></td></tr>
		<tr><td>Activated:</td><td><?php echo $active ?></td></tr>
		<tr><td>Access:</td><td><?php echo $admin ?></td></tr>
	</table>

<?php
} else die ("You need to specify a username!");

?>

</body>
</html>

