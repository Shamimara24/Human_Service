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
                <form action='./login.php' name='loginform' method='post'>
                <div class="login-form">
                <h1><center>Login</center></h1>
                        <form>
                        <p>Username</p>
                        <input type="text" name="username" placeholder="Enter Username Here">

                        <p>Password</p>
                        <input type="password" name="password" placeholder="Enter Password Here">
                        <input type="submit" name="login" value="Login">
                        <p class="message"><a href='./register.php'>Sign up for an account<br><br></a></p>
                        <a href="#">Forget your password?</a>
        </div>
                </div>
                <?php
if ($_POST['login']){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username){
                if($password){
                        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                        echo $passwordhash . "\n";
                        $sql = "SELECT u.*, a.adminid FROM users u ";
                        $sql .= "LEFT JOIN administrators a ON (u.userid = a.userid) ";
                        $sql .= "WHERE username='$username'";
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
                                                $dbrole = $row[roleID];


                                                        if($dbrole == 1){
                                                                header('Location: http://elvis.rowan.edu/~rodrigueb6/SeniorProject/admindashboard.php');
                                                                }
                                                        else if($dbrole ==2){

                                                header('Location: http://elvis.rowan.edu/~rodrigueb6/SeniorProject/dashboard.php');
                                                                        }
                                                exit();

                                                echo "You have logged in as <b>$username</b>";


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
        </body>
</html>
