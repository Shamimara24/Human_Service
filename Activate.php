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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation</title>
    <link rel="stylesheet" href="style.css"><div class='activate-box'>

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</head>

        <body>

                <form action='./Activate.php' method='post'>

                <div class='activate-box'>

                <div class='form'>

<?php
$form = "<img src = 'https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png' class='avatar' height='250'>
        <form class='activate-form'>
        <h1><center>Activate Account</center></h1>
        </div>";
?>

<?php

if ($_POST['submit']){
        $Username = $_POST['username'];
        if($Username)   {
        $update = "update users set active = 1 where username = '$Username'";                                           mysqli_query($dbh,$update);
header('Location: http://elvis.rowan.edu/~diamondj7/SeniorProject/login.php');
        }
        else
        echo "You must enter your username. $form";

}
        else
                echo $form;
?>

<form action='./Activate.php' method='post'>
         <form>
        <p><b>Username</b></p>
        <input type='text' name='username' placeholder='Enter Username Here'>
        <p><b>First Name:</b></p>
        <p><b>Last Name:</b></p>
        <p><b>Email:</b></p>

        <input type='submit' name='submit' value='Activate'>
		
		 </form>
        </div>
        </form>
        </body>

        <script src='https://code.jquery.com/jquery-3.3.1.min.js'>
        </script>

<script>

$('.message a').click(function(){

        $('form').animate({height:'toggle', opacity: 'toggle'}, 'slow');

                });

                </script>


