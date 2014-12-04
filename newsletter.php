<?php
header('Content-Type: text/html; charset=utf-8');
	//require_once("mail/functions_mail.php");
require './PHPMailer/PHPMailerAutoload.php';
	
//If the form is submitted
if(isset($_POST['submit'])) {
//Check to make sure that the name field is not empty

//Check to make sure sure that a valid email address is submitted
if(trim($_POST['email']) == '') {
$hasError = true;
} else if (!filter_var( trim($_POST['email'], FILTER_VALIDATE_EMAIL ))) {
$hasError = true;
} else {
$email = trim($_POST['email']);
}

//If there is no error, send the email
if(!isset($hasError)) {

date_default_timezone_set('Europe/Paris');

	$mail = new PHPmailer;
	$mail->isSendmail();
	
	$mail->setFrom('contact@virtuor.fr', 'VirtuOR');
	//Set an alternative reply-to address
	$mail->addReplyTo($email, 'VirtuOR Newsletter');
	//Set who the message is to be sent to
	if (count($email) == 1)
	{
		$mail->AddAddress($email);
		$mail->addAddress('othmen.braham@virtuor.fr', 'VirtuOR Newsletter');
		$mail->IsHTML(true);	
			//Set the subject line
	 	$mail->Subject = 'VirtuOR Newsletter Registration';
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body

		$corpsHtml = file_get_contents('mailNewsletter.html');
		str_replace('XXXX',$email,$corpsHtml);
		$corps = '<html lang="en"><body>';
			$corps .= '<a href="http://www.virtuor.fr"><img src="images/LogoVirtuOR.png" style="width:150px; height=100px;"></img></a><br/>';
			$corps .= '<p>-----------------</p>';
			$corps .= '<p>This is an automated email</p>';
			$corps .= '<p>-----------------</p>';
			$corps .= '<p>Dear member,</p>';	
			$corps .= $email.'<p> has requested for VirtuOR Newsletter Registration </p>';
			$corps .= '<p>Thank you!</p>';	
			$corps .= '<p>Best regards,</p>';		
			$corps .= '<p>The VirtuOR Team</p>';
			$corps .= '<a href="http://www.virtuor.fr">http://www.virtuor.fr</a>';		
			$corps .= '<br/>';
	
			// Ajout du corps du message
			//$mail->Body = stripslashes($corps);
		
			//Replace the plain text body with one created manually
		$mail->AltBody = $email.' Your have requeted  a registration in  VirtuOR[Newsletter]';
			//Attach an image file
		$mail->addAttachment('images/LogoVirtuOR.png');

			//send the message, check for errors
		if (!$mail->send()) 
		{
			echo "Mailer Error: " . $mail->ErrorInfo;
		} 
	}
	else{
		for($i=0;$i<count($email);$i++){
			$mail->AddAddress($email[$i]);
			$mail->addAddress('othmen.braham@virtuor.fr', 'VirtuOR Newsletter');
			$mail->IsHTML(true);	
			//Set the subject line
	 		$mail->Subject = 'VirtuOR Newsletter Registration';
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body

			$corpsHtml = file_get_contents('mailNewsletter.html');
			str_replace('XXXX',$email[$i],$corpsHtml);
			$corps = '<html lang="en"><body>';
			$corps .= '<a href="http://www.virtuor.fr"><img src="images/LogoVirtuOR.png" style="width:150px; height=100px;"></img></a><br/>';
			$corps .= '<p>-----------------</p>';
			$corps .= '<p>This is an automated email</p>';
			$corps .= '<p>-----------------</p>';
			$corps .= '<p>Dear member,</p>';	
			$corps .= $email[$i].'<p> has requested for VirtuOR Newsletter Registration </p>';
			$corps .= '<p>Thank you!</p>';	
			$corps .= '<p>Best regards,</p>';		
			$corps .= '<p>The VirtuOR Team</p>';
			$corps .= '<a href="http://www.virtuor.fr">http://www.virtuor.fr</a>';		
			$corps .= '<br/>';

			// Ajout du corps du message
			//$mail->Body = stripslashes($corps);
		
			//Replace the plain text body with one created manually
			$mail->AltBody = $email[$i].' Your have requeted  a registration in  VirtuOR[Newsletter]';
			//Attach an image file
			$mail->addAttachment('images/LogoVirtuOR.png');

			//send the message, check for errors
			if (!$mail->send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} 
	}
	header('Location: index.html');
}
	 
?>
