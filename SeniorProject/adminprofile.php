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
        <input type="checkbox" id="toggle"/>
        <div class="menu">
                <a href="admindashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="adminreporting.php"><i class="fas fa-clipboard"></i> Reporting</a>
                <a href="adminconnections.php"><i class="fas fa-users"></i> Connections</a>
                <a href="adminprofile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="login.php" style="float:right;font-size:20px;color:white" ><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>


<div  class="heading">
<br>
 <h2 align="center">Profile</h2>
</div>

<center><img width="100" height"100" src="https://www.isbmsot.org/storage/app/media/profile/user-placeholder.jpg"></center>

<form action='./profile.php' method='post'>
    <h2><center>Change Password</center></h2>
        <form>
        <p>Old Password</p>
        <input type='password' name='password' placeholder='Enter old password'>
        <p>New Password</p>
        <input type='password' name='updatepassword' placeholder='Enter new password'>
        <br></br>
                <input type='submit' name='submit' value='Change Password'>
        </form>
<?php

if ($_POST['submit']){
        $password = $_POST['password'];
        $updatepassword = $_POST['updatepassword'];

        if($password){
                if($updatepassword){
                        $check = "SELECT * FROM users WHERE password = '$password' ";
                        $check .= "AND userid = '$userid'";
                $result = mysqli_query($dbh, $check);
                $numrows = mysqli_num_rows($result);
                if($numrows == 1){
                $sql = "UPDATE users SET password='$updatepassword' WHERE
                        userid = $userid";
                if(mysqli_query($dbh, $sql)){
                        echo "Password has been updated successfully!\n";
                }else
                        echo "Error updating password: " . mysqli_error($dbh);

                }else
                        echo "You did not enter the correct password for your account.\n $numrows $userid";


                }else
                        echo "You must enter your new password first.\n";
        }else
                echo "You must enter your password first.\n";
}



?>

</script>
</form>
</div>
</body>
</html>