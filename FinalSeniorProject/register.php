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
                <form action='./register.php' method='post'>
                <form class="register-form">
                <h1><center>Register</center></h1>
				<p>Are you a Student or a Supervisor?</p>
				<br>
				<select name="usertype">
					<option value="student">Student</option>
					<option value="supervisor">Supervisor</option>
				</select>
				<br><br>
                <p>First Name</p>
                <input type="text" name="rfname" placeholder="Enter Your First Name">
				<p>Last Name</p>
                <input type="text" name="rlname" placeholder="Enter Your Last Name">
                <p>Password</p>
                <input type="password" name="rpassword" placeholder="Enter Desired Password">
                <input type="password" name="rpassword2" placeholder="Re-enter Password">
                <p>Email</p>
                <input type="text" name="remail" placeholder="Enter email">
                <p>Phone</p>
                <input type="text" name="rphone" placeholder="Enter phone number">
                <p>Semester</p>
                <select name="semesterform">
                        <option value="spring2018">Spring 2018</option>
                        <option value="fall2018">Fall 2018</option>
                        <option value="spring2019">Spring 2019</option>
                        <option value="fall2019">Fall 2019</option>
                        <option value="spring2020">Spring 2020</option>
                        <option value="fall2020">Fall 2020</option>
                </select>
				<br><br>
<center>
                <input type="submit" name="register" value="Register">
</center>
        </form>
        </div>
                </div>
                <?php

if ($_POST['register']){
        $rfname = $_POST['rfname'];
		$rlname = $_POST['rlname'];
        $rpassword = $_POST['rpassword'];
        $rpassword2 = $_POST['rpassword2'];
        $remail = $_POST['remail'];
        $rphone = $_POST['rphone'];
		$type = $_POST['usertype'];
		$semester = $_POST['semesterform'];
        if(!$rfname=="" || !$rlname==""){
        if($rphone){
        if($remail){
        if($rpassword){
        if($rpassword2){
                if ($rpassword === $rpassword2 ){
                        if ( (strlen($remail) > 6) && (strstr($remail, "@")) && (strstr($remail, "."))){
							
								$rfname = trim($rfname);
								$rfname = strtolower($rfname);
								$rlname = trim($rlname);
								$rlname = strtolower($rlname);
								$namecounter = 1;
							
							
                                $sql = "SELECT * FROM users WHERE firstname LIKE '$rfname' AND lastname LIKE '$rlname'";
                                $query = mysqli_query($dbh, $sql);
                                $numrows = mysqli_num_rows($query);
								$namecounter += $numrows;
								$rusername = $rusername = $rfname[0] . $rlname . $namecounter;
                                
                                $sql = "SELECT * FROM users WHERE email='$remail'";
                                $query = mysqli_query($dbh, $sql);
                                $numrows = mysqli_num_rows($query);
                                if($numrows == 0){

                                        $hashedpassword = password_hash($rpassword, PASSWORD_DEFAULT);
                                        $code = mt_rand(1000,9999);
										if($type == "supervisor"){
											$roleID = 3;
										}else{
											$roleID = 2;
										}
                                        $insert =  "INSERT INTO users (username, email, semester, phone_number, password, ";
                                        $insert .= "firstname, lastname, active, code, roleID) VALUES ";
                                        $insert .= "('$rusername', '$remail', '$semester', '$rphone', '$hashedpassword', ";
                                        $insert .= "'$rfname', '$rlname', '0', '$code', '$roleID')";
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
                                                        echo "You have been registered. Activation email has been succesfully sent.\n";
														echo $rfname . " " . $rlname . " " . $rusername;
                                                }else
                                                        echo "An error has occured. Your activation email was not sent.";
                                        }else
                                                echo "An error has occured. Your account was not created. $iresult";
                                }else
                                echo "That email is currently being used for another account.";
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
                echo "You must enter your first and last name to register.";
}
?>

                <script src='https://code.jquery.com/jquery-3.3.1.min.js'>
                </script>
        </body>
</html>