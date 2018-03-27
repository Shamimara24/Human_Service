<?php

$name = $_POST['name'];
$request = $_POST['request'];

$to = "rodrigueb6@students.rowan.edu";
$subject = "Notification";
$body = "This is an automated email. Please don't reply to this email. \n\n $request";

mail($to, $subject, $body);

echo "Message Sent! <a href = 'email.html'>Click here</a> to send another email\n";
echo $request;
?>
