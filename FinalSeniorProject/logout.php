<?php
// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();

session_start();

session_destroy();

header('Location: http://elvis.rowan.edu/~rodrigueb6/SeniorProject/login.php');
?>