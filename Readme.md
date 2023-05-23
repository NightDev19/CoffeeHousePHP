# Tutorial For Email Verification

## 1. Create a Database "form" in localhost/phpmyadmin

---

## 2. Import "users.sql" from database "form" file given in database folder

---

## 3. Make sure your xampp config in mail function if not so follow these steps so you can send the mail.
	
	Go to the (C:xampp\php) and open the PHP configuration setting file
 	then find the [mail function] by scrolling down or simply press ctrl+f
	to search it directly then find the following lines and pass these values.
	Remember, there may be a semicolon ; at the starting of each line, simply
	remove the semicolon from each line which is given below.

	[mail function]
	For Win32 only.
	http://php.net/smtp
	SMTP=smtp.gmail.com
	http://php.net/smtp-port
	smtp_port=587
	sendmail_from = your_email_address_here
	sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"

	**** That’s all for this file, press ctrl+s to save this file and then close it. ****

	Now, go the (C:\xampp\sendmail) and open the sendmail configuration setting file then find sendmail
	by scrolling down or press ctrl+f to search it directly then find the following lines and pass these values.
	Remember, there may be a semicolon ; at the starting of each line, simply remove the semicolon from each line
	which is given below.

	smtp_server=smtp.gmail.com
	smtp_port=587
	error_logfile=error.log
	debug_logfile=debug.log
	auth_username=your_email_address_here
	auth_password=your_password_here

	to get the password go to your gmail acc and go to  2-Step Verification	then after you fix the 2-step verification go to the App Password And Create or Generate A Password to work


	force_sender=your_email_address_here (it's optional)
	
	**** That’s all for this file, press ctrl+s to save this file and then close it. ****

	Now, you’re done with the required changes in these files. To check the changes you’ve made
	are correct or not. First, create a PHP file with the .php extension and paste the following
	codes into your PHP file. After pasting the codes, put your details to the given variables
	– In the $receiver variable put the receiver email address,
	in the $subject variable put the email subject and do respectively.

---

## Note:	If your mail isn’t sent after the correct changes and you got a warning or error.(Cant be accessed now T_T)
	Please configure your google account security as “Less secure apps”. To configure it:
	– Go to your Google account then click on the Security tab and scroll down, there you
	can see the Less secure app access panel, Simply turn on that. This panel only shows,
	if you haven’t enabled 2-Step Verification.

## Library For The Email Verification 

First Download The Composer 
Then after downloading the composer go to your project and type in terminal "composer require phpmailer/phpmailer" go to this link for more info [here.](https://github.com/PHPMailer/PHPMailer)

### The sample code is here
	<?php
		//Import PHPMailer classes into the global namespace
		//These must be at the top of your script, not inside a function
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;

		//Load Composer's autoloader
		require 'vendor/autoload.php';

		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'user@example.com';                     //SMTP username
			$mail->Password   = 'secret';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('from@example.com', 'Mailer');
			$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
			$mail->addAddress('ellen@example.com');               //Name is optional
			$mail->addReplyTo('info@example.com', 'Information');
			$mail->addCC('cc@example.com');
			$mail->addBCC('bcc@example.com');

			//Attachments
			$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	?>

to get the the SMTP password go [here,](https://myaccount.google.com/signinoptions/two-step-verification?rapt=AEjHL4O-6gfSQsr58xkXxUrbQT_v6EpwZECPLBwmEfwxBP1QP5KAQY9QGHIjoZxON1WJFqyutRiLzpbAKX_7XwR2nAaqz8Smvg) then update the App Password so that the SMTP password can recognized by your gmail that your using that password to generate an email.



