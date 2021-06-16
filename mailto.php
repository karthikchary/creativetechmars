<?php
// Contact subject
$username = $_REQUEST['username'];
$phone=$_REQUEST['phone'];
$subject =$_REQUEST['subject'];

// Details
$message=$_REQUEST['message'];
//echo $subject;
// Mail of sender
$mail_from = 'aravind.mummoju25@gmail.com';
// $name=$_REQUEST['name'];
// From
$header="from: $username <$mail_from>";
// Enter your email address
$to = $_REQUEST['email'];
//echo $username.' '.$phone.' '.$subject.' '.$message.' '.$mail_from.' '.$header.' '.$to; exit;
// $headers = "From: " . $userName . "";
$msgBody = " Name: ". $username .  " Email: ". $to . " Phone: ". $phone . " Subject: ". $subject . " Message: " . $message . "";
$send_contact=mail($to,$header,$msgBody);
// Check, if message sent to your email
if($send_contact){
echo "Your Message has been sent";
}
else {
echo "ERROR";
}
?>