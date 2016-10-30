<?php 
/* 	
If you see this text in your browser, PHP is not configured correctly on this webhost. 
Contact your hosting provider regarding PHP configuration for your site.
*/

require_once('form_throttle.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	if (formthrottle_too_many_submissions($_SERVER["REMOTE_ADDR"]))
	{
		echo '{"MusePHPFormResponse": { "success": false,"error": "Too many recent submissions from this IP"}}';
	} 
	else 
	{
		emailFormSubmission();
	}
} 

function emailFormSubmission()
{
	$to = 'arefyev.studio@gmail.com';
	$subject = 'Заказ с сайта (ru мастеринг, поп-ап)';
	
	$message = htmlentities($subject,ENT_COMPAT,'UTF-8').  "\r\n";
	
	$message .= 'Информацию прислал: '.  "\r\n"; 
	$message .= 'Имя:' . htmlentities($_REQUEST["name"],ENT_COMPAT,'UTF-8').  "\r\n";

	$message .= 'Email:' . htmlentities($_REQUEST["email"],ENT_COMPAT,'UTF-8').  "\r\n";
	$message .= 'Сообщение:' . htmlentities($_REQUEST["message"],ENT_COMPAT,'UTF-8').  "\r\n";

	
	$message .= 'Сайт: ' . htmlentities($_SERVER["SERVER_NAME"],ENT_COMPAT,'UTF-8').  "\r\n";
	$message .= 'IP отправителя: ' . htmlentities($_SERVER["REMOTE_ADDR"],ENT_COMPAT,'UTF-8').  "\r\n";
	
	$message = cleanupMessage($message);
	
	$formEmail = cleanupEmail($_REQUEST['Email']);
	$headers = "\r\n" . '' . $formEmail .  "\r\n" .'' . phpversion() . "\r\n" . '' . "\r\n";
	
	$sent = @mail($to, $subject, $message, $headers);
	
	if($sent)
	{
		echo '{"FormResponse": { "success": true}}';

	}
	else
	{
		echo '{"MusePHPFormResponse": { "success": false,"error": "Failed to send email"}}';
	}
}

function cleanupEmail($email)
{
	$email = htmlentities($email,ENT_COMPAT,'UTF-8');
	$email = preg_replace('=((<CR>|<LF>|0x0A/%0A|0x0D/%0D|\\n|\\r)\S).*=i', null, $email);
	return $email;
}

function cleanupMessage($message)
{
	$message = wordwrap($message, 70, "\r\n");
	return $message;
}
?>
