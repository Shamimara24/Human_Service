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

<html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Fieldsite</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>   		
</head>

<body style = "background: url(https://www.rowanblog.com/wp-content/uploads/2018/04/Holly-Pointe-roommates-710x335.jpg); background-size: 100% 100%;"

	<div class="activate-box">
	<div class="form">
	<form action=<?php echo "'". $link. "'" ?> method='post'>

	<br></br>	

	
<?php		
if (!isset($_GET["fieldsiteid"]) && !$userid == 1){
	echo "Error: This page is for administrators only. Click <a href='login.php'>here</a> to login.\n";
}else{
	echo $form;
	$link = "./admineditfieldsite.php?fieldsiteid=" . $fieldsiteid;
	$fieldsiteid = $_GET["fieldsiteid"];
	$query = "select * from fieldsites where fieldsiteid = '$fieldsiteid'";
	$result = mysqli_query($dbh, $query);
	$numrows = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		$fsname = $row['name'];
		$fsaddress = $row['address'];
		$fstype = $row['type'];
	
}
?>

		<h1><center>Edit Fieldsite</center></h1>
		<p>Site Name: <input type="text" name="sname" value="<?php echo $fsname; ?>" ></p>
        
		<p>Site Address: <input type="text" name="saddress" value="<?php echo $fsaddress; ?>" ></p>
       
		<p>Site Type: <input type="text" name="stype" value="<?php echo $fstype; ?>" ></p>
       
        <input type='submit' name='submit' value='Update'>
		<input type='submit' name='delete' value='Delete'>

<?php
if ($_POST['submit']){
		$fsname = $_POST['sname'];
        $fsaddress = $_POST['saddress'];
        $fstype = $_POST['stype'];
        $updateQ = "UPDATE fieldsites SET name = '$fsname', address = '$fsaddress', type = '$fstype' WHERE fieldsiteid= '$fieldsiteid';";
		$updateresult = mysqli_query($dbh,$updateQ);
		if($updateresult){
			echo "<br/>";
			echo "Fieldsite Updated! Click <a href='admindashboard.php'>here</a> to return to dashboard.\n";
		}else{
			echo "Fieldsite update failed. Error: " . mysqli_error($dbh) . "\n";
		}
}

if ($_POST['delete']){
	$deleteQ = "Delete from fieldsites where fieldsiteid = '$fieldsiteid';";
	$updateDelete = mysqli_query($dbh,$deleteQ);
	if($updateDelete){
			echo "Fieldsite Deleted! Click <a href='admindashboard.php'>here</a> to return to dashboard.\n";
		}else{
			echo "Fieldsite update failed. Error: " . mysqli_error($dbh) . "\n";
		}
}
?>

		</div>

	
		</form>
        </div>
        </body>
	</html>	