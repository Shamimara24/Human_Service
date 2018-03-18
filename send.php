<?php

$name = $_post['name'];
$request = $_post['request'];

$to = "sharifs3@students.rowan.edu";
$subject = "Notification";
$body = "This is an automated email. Please don't reply to this email. \n\n $request";

mail($to, $subject, $body);

echo "Message Sent! <a href = 'index.html'>Click here</a> to send another email";
?>