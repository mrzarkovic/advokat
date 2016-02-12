<?php

namespace Lamework\Controller;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Contact controller
 */
class Contact extends Core {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Show the contact page
	 * @throws \Exception
	 */
	public function index($lang = "") {
		$this->to_tpl['errors'] = array();
		$this->to_tpl['msg'] = "";
		$this->set_language($lang);
		if ($lang == "sr") {
			$this->template = "contact-sr";
		} else {
			$this->template = "contact-en";
		}
		$this->set_page_name($this->language_titles["contact"][$lang]);

		if (isset($_POST['submit'])) {
			$this->to_tpl['msg'] = $this->phpmailer();
		}

		return;
	}

	private function phpmailer() {
		//SMTP needs accurate times, and the PHP time zone MUST be set
		//This should be done in your php.ini, but this is how to do it if you don't have access to that
		date_default_timezone_set('Etc/UTC');
		require BASEPATH . '/includes/libraries/phpmailer/PHPMailerAutoload.php';
		//Create a new PHPMailer instance
		$mail = new \PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = EMAIL;
		//Password to use for SMTP authentication
		$mail->Password = EMAIL_PASSWORD;
		//Set who the message is to be sent from
		$mail->setFrom('from@advokat.dev', 'Advokat Dev');
		//Set an alternative reply-to address
		$mail->addReplyTo('replyto@advokat.dev', 'Advokat Dev');
		//Set who the message is to be sent to
		$mail->addAddress('mzarkovicm@gmail.com', 'Milos Zarkovic');
		//Set the subject line
		$mail->Subject = 'PHPMailer GMail SMTP test';
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		$mail->Body = "<i>Mail body in HTML</i>";
		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
		//send the message, check for errors
		if (!$mail->send()) {
			return "Mailer Error: " . $mail->ErrorInfo;
		} else {
			return "Message sent!";
		}
	}

}
