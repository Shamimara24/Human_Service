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

        <form action='./login.php' method='post'>

                <div class='login-box'>

                <div class='form'>



<?php
$form = "<img src = 'https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png' class='avatar'>
        <form class='login-form'>
        <h1><center>Login</center></h1>

        <form>

        <p>Username</p>

        <input type='text' name='username' placeholder='Enter Username Here'>

        <p>Password</p>

        <input type='password' name='password' placeholder='Enter Password Here'>

        <input type='submit' name='submit' value='Login'>

        <p class='message'><a href='#'>Sign up for an account<br><br></a></p>

        <a href='#'>Forget your password?</a>

        </form>



        <form class='register-form'>

        <h1>Register</h1>

        <input type='text' placeholder='Enter Desired Username'>

        <input type='password' placeholder='Enter Desired Password'>

        <input type='password' placeholder='Re-enter Password'>

        <input type='submit' name='register' value='Register'>

        <p class='message'><a href='#'>Already have an account?</a></p>

        </form>
        </div>
        </div>";
                ?>

<?php
if ($_POST['submit']){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username){
                if($password){
                        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                //      echo $passwordhash . "\n";
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
                                                $dbrole = $row[roleID];
												if($dbrole == 2){
													header('Location: http://elvis.rowan.edu/~diamondj7/SeniorProject/dashboard.php');
												}
												else if($dbrole ==1){
                                                header('Location: http://elvis.rowan.edu/~diamondj7/SeniorProject/AdminDashboard.php');
												}
                                                exit();
                                        }
                                        else
                                                echo "You must activate your account to login. $form";
                                }

                                else

                                        echo "You did not enter the correct password. $form";

                        }

                        else

                                echo "The username you've entered was not found. $form";







                }

                else

                        echo "You must enter your password. $form";

        }

        else

                echo "You must enter your username. $form";

}

else

        echo $form;



?>



        </body>

        <script src='https://code.jquery.com/jquery-3.3.1.min.js'>

                </script>



<script>

$('.message a').click(function(){

        $('form').animate({height:'toggle', opacity: 'toggle'}, 'slow');

                });

                </script>



</html>
