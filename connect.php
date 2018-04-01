<?php

$sunday = filter_input(INPUT_POST, 'sunday');
$monday = filter_input(INPUT_POST, 'monday');
$tuesday = filter_input(INPUT_POST, 'tuesday');
$wednesday = filter_input(INPUT_POST, 'wednesday');
$thursday = filter_input(INPUT_POST, 'thursday');
$friday = filter_input(INPUT_POST, 'friday');
$saturday = filter_input(INPUT_POST, 'saturday');
$sunday2 = filter_input(INPUT_POST, 'sunday2');
$monday2 = filter_input(INPUT_POST, 'monday2');
$tuesday2 = filter_input(INPUT_POST, 'tuesday2');
$wednesday2 = filter_input(INPUT_POST, 'wednesday2');
$thursday2 = filter_input(INPUT_POST, 'thursday2');
$friday2 = filter_input(INPUT_POST, 'friday2');
$saturday2 = filter_input(INPUT_POST, 'saturday2');

$servername = "localhost";!!!
$username = "username";!!!
$password = "password";!!!
$dbname = "myDB";!!!

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);!!!
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
$sql = "INSERT INTO !!!TABLE!!! (Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday2, Monday2, Tuesday2, Wednesday2, Thursday2, Friday2, Saturday2)
VALUES ('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday2', 'Monday2', 'Tuesday2', 'Wednesday2', 'Thursday2', 'Friday2', 'Saturday2')";




if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>