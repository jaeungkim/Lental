<?php
//NOT LOG'D IN EMAIL SENDING PROCESS
require (dirname(__DIR__).'/script/sendEmail.php');
require (dirname(__DIR__).'/database/databaseAPI.php');

$webmaster_email = "lentalwebsite@gmail.com";
$confirmation_email = $_POST['email'];
$feedback_page = "../emailSent.php";
$error_page = "../contactus.php";

$email_address = $_POST['email'];
$comments = $_POST['message'];
$first_name = $_POST['name'];
$last_name = $_POST['surname'];
$subject = "Contact Us Form Submission Request";
$msg =
"First Name: " . $first_name . "\r\n". 
"Last Name: " . $last_name . "\r\n" .
"Email: " . $email_address . "\r\n" .
"Comments: " . $comments ;

// Confirmation Email
$confirm = "Thank you for your email, we will contact you ASAP.";
$subject_confirm = "Hello This is Lental!";

// If we passed all previous tests, send the email then redirect to the thank you page.
	sendmail($webmaster_email, $subject, $msg, $first_name);
	sendmail($confirmation_email, $subject_confirm, $confirm, $first_name);
	header("Location: $feedback_page");

?>
