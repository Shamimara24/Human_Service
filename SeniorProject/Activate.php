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

        <title> Account Activation </title>

        <link rel="stylesheet" type="text/css" href="index_style.css">

</head>

        <body>
		
		<form action='./Activate.php' method='post'>

                <div class='activate-box'>

                <div class='form'>





<?php
$form = "<img src = 'https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png' class='avatar'>
        <form class='activate-form'>
        <h1><center>Activate Account</center></h1>

        <form>

        <p>Username</p>

        <input type='text' name='username' placeholder='Enter Username Here'>


        <input type='submit' name='submit' value='Activate'>

        

        </form>



        </div>
        </div>";
                ?>

<?php
if ($_POST['submit']){
        $Username = $_POST['username'];
        if($Username){
         
							$update = "update users set active = 1 where username = '$Username'";
							mysqli_query($dbh,$update);
							header('Location: http://elvis.rowan.edu/~diamondj7/SeniorProject/login.php');
						

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
