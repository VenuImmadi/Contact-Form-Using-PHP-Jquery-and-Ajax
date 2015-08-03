<?php 
// Creating a empty variables 
$email = '';
$name = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

// process.php

$errors         = array();      // array to hold validation errors

  // Checking if post valuses are empty

	if (empty($_POST['name']))
			$errors['name'] = 'Name is required.';

	 if (empty($_POST['email']))
		$errors['email'] = 'Email is required.';
		
		
	
	 if (empty($_POST['message']))
	$errors['message'] = 'Message is required.';

// Assigning feild valuses to a variable. 

	$email = $_POST['email'];
	
	$name = $_POST['name'];
	
	$message = $_POST['message'];
   
   // validationg email 
  if (!empty($_POST['email'])){
	   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  $errors['email'] = "Invalid email format"; 
	}
  }

// Preparing email message body content. 

	$email_message = "Name: $name\n";
	
	$email_message .= "email: $email\n";
	
	$email_message .= "message: $message\n";

     // create email from and email to 
	 
 $email_from = "info@authortuts.com";
 $email_to ='venu@authortuts.com';
 
     // create email Subject
 $email_subject = "New EMail From Hamasaki Contact Form";
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_to."\r\n" .
 
'X-Mailer: PHP/' . phpversion();

	if (empty($errors)) {
		if(@mail($email_to, $email_subject, $email_message, $headers)){
			$data['success'] = 'sent';
			echo json_encode($data);
		}
	
	}else{
	
	
	//echo $errors;
	echo json_encode($errors);
	
	}

}

    
?>