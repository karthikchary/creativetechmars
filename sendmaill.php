<?php
 
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
 
require '/PHPMailerAutoload.php';


// Read the form values
$success = false;
$userName = isset( $_POST['username'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['username'] ) : "";
//echo $userName.'<br>';exit;
$senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";

$senderPhone = isset( $_POST['phone'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['phone'] ) : "";

$userSubject = isset( $_POST['subject'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['subject'] ) : "";

$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";


// If all values exist, send the email
if ( $userName && $senderEmail && $senderPhone && $userSubject && $message) {
  
  //$recipient =  RECIPIENT_EMAIL;
  $recipient ="to: $recName";
  // echo $recipient.'<br>';exit;
  $headers = "From: " . $userName . "";
  $msgBody = " Name: ". $userName .  " Email: ". $senderEmail . " Phone: ". $senderPhone . " Subject: ". $userSubject . " Message: " . $message . "";

  //$success = mail( $recipient, $headers, $msgBody );
  //echo $success;exit;
  //Set Location After Successsfull Submission

  //Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug   = 2;
$mail->DKIM_domain = '127.0.0.1';
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
// $mail->Host        = "smtpout.secureserver.net"
$mail->Host        = "https://sg2plcpnl0203.prod.sin2.secureserver.net:2096/";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port        = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth    = true;
//Username to use for SMTP authentication
$mail->Username    = "karthikchary.k@creativetechmars.com";
//Password to use for SMTP authentication
$mail->Password    = "cre@tive123";
$mail->SMTPSecure  = 'ssl';
//Set who the message is to be sent from
$mail->setFrom('info@creativetechmars.com', 'CreativeTechMars');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('info@creativetechmars.com', 'info');
$mail->AddAddress($senderEmail, $userName);
$mail->SetFrom($senderEmail, $userName);
$mail->Subject = $userSubject;
$content = $msgBody;
$mail->MsgHTML($content);
//Set the subject line
//$mail->Subject = 'PHPMailer SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
// $mail->AltBody = 'This is a plain-text message body';
//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');
 
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}


  
}


?>