<?php

//composer require phpmailer/phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
  
//Define some constants
define( "RECIPIENT_NAME", "aravindh" );
define( "RECIPIENT_EMAIL", "karthik.chary138@gmail.com" );
$recName='karthik < karthik.chary138@gmail.com >';

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
  
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->Mailer = "smtp";
  $mail->SMTPDebug  = 1;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "karthik.chary138@gmail.com";
  $mail->Password   = "Naveen73187";
  $mail->IsHTML(true);
  $mail->AddAddress($senderEmail, $userName);
  $mail->SetFrom($senderEmail, $userName);
  // $mail->AddReplyTo("reply-to-email@domain", "reply-to-name");
  // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
  $mail->Subject = $userSubject;
  $content = $msgBody;
  //print_r($mail);exit;
  $mail->MsgHTML($content); 
  if(!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
    //header('Location: contact.html?message=Failed');	
    //var_dump($mail);
  } else {
    header('Location: contact.html?message=Successfull');
  }



  //$success = mail( $recipient, $headers, $msgBody );
  //echo $success;exit;
  //Set Location After Successsfull Submission
  
}
/*
<?php

// Define some constants
define( "RECIPIENT_NAME", "Karthik" );
define( "RECIPIENT_EMAIL", "karthik.chary138@gmail.com" );

// Read the form values
$success = false;
$userName = isset( $_POST['username'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['username'] ) : "";
$senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
$senderPhone = isset( $_POST['phone'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['phone'] ) : "";
$userSubject = isset( $_POST['subject'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['subject'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// If all values exist, send the email
if ( $userName && $senderEmail && $senderPhone && $userSubject && $message) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $userName . "";
  $msgBody = " Name: ". $userName .  " Email: ". $senderEmail . " Phone: ". $senderPhone . " Subject: ". $userSubject . " Message: " . $message . "";
  $success = mail( $recipient, $headers, $msgBody );

  //Set Location After Successsfull Submission
  header('Location: contact.html?message=Successfull');
}

else{
	//Set Location After Unsuccesssfull Submission
  	header('Location: contact.html?message=Failed');	
}

?>
*/