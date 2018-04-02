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
                <form action='./login.php' method='post'>
                <form class="login-form">
                <h1><center>Login</center></h1>
                        <form>
                        <p>Username</p>
                        <input type="text" name="username" placeholder="Enter Username Here">

                        <p>Password</p>
                        <input type="password" name="password" placeholder="Enter Password Here">
                        <input type="submit" name="login" value="Login">
                        <p class="message"><a href='#'>Sign up for an account<br><br></a></p>
                        <a href="#">Forget your password?</a>

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
                                                                header('Location: http://elvis.rowan.edu/~diamondj7/SeniorProject/admindashboard.php');
                                                                }
                                                        else if($dbrole ==2){

                                                header('Location: http://elvis.rowan.edu/~diamondj7/SeniorProject/dashboard.php');
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



if ($_POST['register']){
        $rusername = $_POST['rusername'];
        $rpassword = $_POST['rpassword'];
        $rpassword2 = $_POST['rpassword2'];
        $remail = $_POST['remail'];
        $rphone = $_POST['rphone'];
        if(!$rusername==""){
        if($rphone){
        if($remail){
        if($rpassword){
        if($rpassword2){
                if ($rpassword === $rpassword2 ){
                        if ( (strlen($remail) > 6) && (strstr($remail, "@")) && (strstr($remail, "."))){
                                $sql = "SELECT * FROM users WHERE username='$rusername'";
                                $query = mysqli_query($dbh, $sql);
                                $numrows = mysqli_num_rows($query);
                                if($numrows == 0){
                                        $sql = "SELECT * FROM users WHERE email='$remail'";
                                $query = mysqli_query($dbh, $sql);
                                $numrows = mysqli_num_rows($query);
                                if($numrows == 0){




                                        $password = password_hash($rpassword, PASSWORD_DEFAULT);

                                        $code = mt_rand(1000,9999);



                                        $insert =  "INSERT INTO users (username, email, semester, phone_number, password, ";

                                        $insert .= "firstname, lastname, active, code, roleID) VALUES ";

                                        $insert .= "('$rusername', '$remail', 'spring2018', '$rphone', '$rpassword', ";

                                        $insert .= "'fname', 'lname', '0', '$code', '2')";



                                        $insertquery = mysqli_query($dbh, $insert);

                                        if(!$insertquery){

                                        $iresult = "query returned false." . mysqli_error($dbh);

                                        }



                                        $query = mysqli_query($dbh, "SELECT * FROM users WHERE username='$rusername'");

                                        $numrows = mysqli_num_rows($query);

                                        if($numrows == 1){

                                                $site = "http://elvis.rowan.edu/~rodrigueb6/SeniorProject";

                                                $webmaster = "rodrigueb6@students.rowan.edu";



                                                $subject = "New User Account Request (HSFE)";

                                                $message = "A new user has requested an account.\n";

                                                $message .= "Click the link below to activate the account.\n";

                                                $message .= "$site/activate.php?user=$rusername&code=$code\n";






                                                if(mail($webmaster, $subject, $message)){

                                                        echo "You have been registered. Activation email has been successfully sent.";

                                                }else

                                                        echo "An error has occured. Your activation email was not sent.";

                                        }else

                                                echo "An error has occured. Your account was not created. $iresult";



                                }else

                                echo "That email is currently being used for another account.";

                                }else

                                echo "That username has already been taken.";



                                }


                        else

                        echo "You must enter a valid email address to register. $remail";

                }

                else

                echo "Your passwords did not match.";

                                }else

                                echo "You must retype your password to register.";

                        }else

                        echo "You must enter your password to register.";

                }else

                echo "You must enter your email to register.";
                }else
                echo "You must enter your phone number to register";
        }else
                echo "You must enter your username to register.";

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
