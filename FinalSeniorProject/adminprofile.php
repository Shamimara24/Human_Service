<?php

// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$sql = "SELECT firstname, lastname, email, concat('(', substring(phone_number, 1, 3), ') ',
substring(phone_number, 4, 3), '-',  substring(phone_number, 7, 9)) AS phone_number
FROM users";


//$sql = "SELECT * FROM users";

$result = mysqli_query($dbh,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporting</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>
    <div class="nav">
                <img src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" class="mainavatar">
            <label for="toggle">&#9776;</label>
                        <br>
                <b><center><font size="6" color="white">Rowan University Field Experience System</font></center></b>
    </div>

<div class="navbar">
  <a href="admindashboard.php">Dashboard</a>
        <a href="adminreporting.php">Reporting</a>
 <div class="dropdown">
    <button class="dropbtn" onclick="myFunction()">Connections
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" id="myDropdown">
        <a href="adminconnections.php">Users</a>
        <a href="adminfieldsites.php">Field Sites</a>
    </div>
  </div>

        <a href="adminprofile.php">Profile</a>
        <a href="logout.php" align="right">Logout</a>
</div>


<center><h1>Profile</h1></center>

</br>
<center><img width="150" height"150" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg"></center>



<form action='./profile.php' method='post'>
    <h2><center>Change Password</center></h2>
        <form>
        <p>Old Password</p>
        <input type='password' name='password' placeholder='Enter old password'>
        <p>New Password</p>
        <input type='password' name='updatepassword' placeholder='Enter new password'>
		 <p>Retype New Password</p>
        <input type='password' name='updatepassword2' placeholder='Retype new password'>
        <br></br>
        <input type='submit' name='submit' value='Change Password'>
        </form>
<?php


if ($_POST['submit']){
        $password = $_POST['password'];
        $updatepassword = $_POST['updatepassword'];
		$updatepassword2 = $_POST['updatepassword2'];
        if($password){
                if($updatepassword){
					if($updatepassword2){
						if(strlen($updatepassword)>4){
							if($updatepassword == $updatepassword2){
								$getpass = "SELECT * FROM users WHERE username = '$username' AND userid = $userid";
								$result = mysqli_query($dbh, $getpass);
								if($result){
									$row = mysqli_fetch_assoc($result);
									$dbpassword = $row['password'];
									if(password_verify($password, $dbpassword)){
										$hashedpassword = password_hash($updatepassword, PASSWORD_DEFAULT);
										 $sql = "UPDATE users SET password='$hashedpassword' WHERE
											userid = $userid";
										if(mysqli_query($dbh, $sql)){
											echo "Password has been updated successfully!\n";
										}else{
											echo "Error updating password: " . mysqli_error($dbh);
										}
									}else{
										echo "You did not enter the correct password for your account.";
									}
								}else{
									echo "Error: getpass query failed. Error: " . mysqli_error($dbh);
								}
						}else{
							echo "You must retype your password correctly to change it.";
						}
						}else{
							echo "Please make sure your new password is atleast 4 characters long.";
						}
						
					}else{
						echo "You must re-enter your new password first.";
					}
                }else
                        echo "You must enter your new password first.\n";
        }else
                echo "You must enter your password first.\n";
}

?>
<script>

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
  }
}

</script>
</form>
</div>
</body>
</html>
