<?php
// Connect to the database
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
?>


<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timesheet</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <meta charset="utf-8">
    <title>Time Sheet</title>
	 <style>
      form {
        /* Just to center the form on the page */
        margin: 0 auto;
        width: 400px;
        /* To see the outline of the form */
        padding: 1em;
        border: 1px solid #CCC;
        border-radius: 1em;
      }
      form div + div {
        margin-top: 1em;
      }
      label {
        /* To make sure that all labels have the same size and are properly aligned */
        display: inline-block;
        width: 90px;
        text-align: right;
      }
      input, textarea {
        /* To make sure that all text fields have the same font settings By default, textareas have a monospace font */
        font: 1em sans-serif;
        /* To give the same size to all text fields */
        width: 300px;
        box-sizing: border-box; /* To harmonize the look & feel of text field border */
        border: 1px solid #999;
      }
      input:focus, textarea:focus {
        /* To give a little highlight on active elements */
        border-color: #000;
      }
      textarea {
        /* To properly align multiline text fields with their labels */
        vertical-align: top;
        /* To give enough room to type some text */
        height: 5em;
      }
      .button {
        /* To position the buttons to the same position of the text fields */
        padding-left: 90px;
        /* same size as the label elements */
      }
      button {
        /* This extra margin represent roughly the same space as the space between the labels and their text fields */
        margin-left: .5em;
      }
    </style>
</head>


<body>
    <div class="nav">
        <img src="https://www.prepsportswear.com/media/images/college_logos/300x300/2126241_mktg_logo.png" class="mainavatar">
            <label for="toggle">&#9776;</label>
        <input type="checkbox" id="toggle"/>
        <div class="menu">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="timesheet.php"><i class="fas fa-clock"></i> Timesheet</a>
                <a href="connections.php"><i class="fas fa-users"></i> Connections</a>
                <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="login.php" style="float:right"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
         <form action="/my-handling-form-page" method="post">
    <div>
        <label for="name">Sunday:</label>
        <input type="number" value="0" /> 
    </div>
    <div>
        <label for="name">Monday:</label>
        <input type="number" value="0" /> 
    </div>
    <div>
        <label for="name">Tuesday:</label>
        <input type="number" value="0" /> 
    </div>
	<div>
        <label for="name">Wednesday:</label>
        <input type="number" value="0" /> 
    </div>
	<div>
        <label for="name">Thursday:</label>
        <input type="number" value="0" /> 
    </div>
	<div>
        <label for="name">Friday:</label>
        <input type="number" value="0" /> 
    </div>
	<div>
        <label for="name">Saturday:</label>
        <input type="number" value="0" /> 
    </div>
	 <div>
        <label for="name">Sunday:</label>
        <input type="number" value="0" /> 
    </div>
    <div>
        <label for="name">Monday:</label>
        <input type="number" value="0" />
    </div>
    <div>
        <label for="name">Tuesday:</label>
        <input type="number" value="0" /> 
    </div>
	<div>
        <label for="name">Wednesday:</label>
        <input type="number" value="0" /> 
    </div>
	<div>
        <label for="name">Thursday:</label>
        <input type="number" value="0" /> 
    </div>
	<div>
        <label for="name">Friday:</label>
        <input type="number" value="0" /> 
    </div>
	<div>
        <label for="name">Saturday:</label>
        <input type="number" value="0" /> 
    </div>
	
	<div class="button">
  <button type="submit">Submit</button>
</div>
<div class="button">
  <button type="submit">Save</button>
</div>
</form>
</body>
</html>


