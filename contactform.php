<?php
require 'PHPMailerAutoload.php';

function died($error) {
    // your error code can go here
    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    echo "These errors appear below.<br /><br />";
    echo $error."<br /><br />";
    echo "Please go back and fix these errors.<br /><br />";
    die();
}

// validation expected data exists
if(!isset($_POST['contact_first_name']) ||
   !isset($_POST['contact_last_name']) ||
   !isset($_POST['contact_phone']) ||
   !isset($_POST['contact_email']) ||
   !isset($_POST['contact_message'])) {
    died('We are sorry, but there appears to be a problem with the form you submitted.');       
}

$first_name = $_POST['contact_first_name']; // required
$last_name = $_POST['contact_last_name']; // required
$email_from = $_POST['contact_email']; // required
$telephone = $_POST['contact_phone']; // not required
$comments = $_POST['contact_message']; // required

$error_message = "";
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
}

$string_exp = "/^[A-Za-z .'-]+$/";

if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
}

if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
}

if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
}

if(strlen($error_message) > 0) {
    died($error_message);
}

$email_message = "Form details below.\n\n<br><br>";


function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
}

$email_message .= "First Name: ".clean_string($first_name)."\n<br>";
$email_message .= "Last Name: ".clean_string($last_name)."\n<br>";
$email_message .= "Email: ".clean_string($email_from)."\n<br>";
$email_message .= "Telephone: ".clean_string($telephone)."\n<br>";
$email_message .= "Comments: ".clean_string($comments)."\n<br>";

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp-mail.outlook.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mys_zhou@live.com';                 // SMTP username
$mail->Password = 'Simple@0213';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('mys_zhou@live.com', 'Y Z');
$mail->addAddress('mys_zhou@live.com', 'Yun Zhou');     // Add a recipient Name is optional
$mail->addReplyTo('mys_zhou@live.com', 'Thank you for contacting us. We will be in touch with you very soon.');
$mail->addCC('');
$mail->addBCC('');
$mail->addAttachment('');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Sessage from Pizza.com';
$mail->Body    = $email_message;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//echo $email_message;
if(!$mail->send()) {
    echo '<script>alert("Message could not be sent. Mailer Error:  '.$mail->ErrorInfo.'"); </script>';
} else {
    echo '<script>alert("Thank you for contacting us. We will be in touch with you very soon. '.$first_name." ".$last_name.'"); window.location.href="index.php"; </script>';
}

?>