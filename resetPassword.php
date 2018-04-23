<?php
	if (isset($_GET["email"]) && isset($_GET["token"])) {
	$connection = new mysqli("localhost", "root", "", "memebershipSystem");
	
	$email = $connection->real_escape_string($_GET["email"]);
	$token = $connection->real_escape_string($_GET["token"]);
	
	$data = $connection->query("SELECT id FROM users WHERE email='$email' AND token='$token'");

	if($data->num_rows > 0){
		$str = "0123456789qwertzujoplkjhgfdsayxcvbnm";
		$str = str_shuffle($str);
		$str = substr($str, 0, 15);
		
		$password = shal($str);
		
		$connection->query("UPDATE users SET password = '$password', token = '' WHERE email='$email'");
		
		echo "Your new password is: $str";
	}
	else {
		echo "Please check your link!";
	}
} else {
	header("Location: http://elvis.rowan.edu/~sharifs3/4_18_2018_Ver_5/login.php");
	exit();
}
?>