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
	 * @param string $lang
	 */
	public function index($lang = "") {
		// https://css-tricks.com/serious-form-security/
		$this->to_tpl['errors'] = array();
		$this->to_tpl['success'] = false;
		$this->set_language($lang);

		if ($lang == "sr") {
			$this->template = "contact-sr";
		} else {
			$this->template = "contact-en";
		}
		$this->set_page_name($this->language_titles["contact"][$lang]);

		if (isset($_POST['submit'])) {
			if (verify_form_token('contact')) {
				// Building a whitelist array with keys which will send through the form,
				// no others would be accepted later on
				$whitelist = array('token', 'name', 'email', 'message', 'submit');

				// Building an array with the $_POST-superglobal
				foreach ($_POST as $key => $item) {
					// Check if the value $key (fieldname from $_POST)
					// can be found in the whitelisting array,
					// if not, die with a short message to the hacker
					if (!in_array($key, $whitelist)) {
						write_log('Unknown form fields');
						die("Hack-Attempt detected. Please use only the fields in the form.");
					}
				}
				// if pass, send email
				$from_name = stripcleantohtml($_POST['name']);
				$from_email = stripcleantohtml($_POST['email']);
				$message = cleantohtml($_POST['message']);
				$errors = $this->check_input($from_name, $from_email, $message);
				if (!empty($errors)) {
					$this->to_tpl['errors'] = $errors;
					$this->to_tpl['token'] = $_POST['token'];
					return;
				}
				$send = $this->phpmailer($from_name, $from_email, $message);
				if ( $send === true){
					$this->to_tpl['success'] = true;
				} else {
					var_dump($send);die();
					//write_log('PHP Mailer error: ' . $send);
				}
			} else {
				write_log('Formtoken');
				die("Hack-Attempt detected.");
			}
			return;
		}

		// Generate a new token for the $_SESSION superglobal
		// and put them in a hidden field
		$this->to_tpl['token'] = generate_form_token('contact');

		return;
	}

	/**
	 * Check input fields
	 * @param string $from_name
	 * @param string $from_email
	 * @param string $message
	 * @return array
	 */
	private function check_input($from_name = "", $from_email = "", $message = "") {
		$errors = array();
		if ($from_name == "") {
			$errors['name'] = "Morate uneti ime.";
		}
		if ($from_email == "") {
			$errors['email'] = "Morate uneti email.";
		}
		if ($message == "") {
			$errors['message'] = "Morate napisati poruku.";
		}
		return $errors;
	}

	/**
	 * Send an email via PHPMailer
	 * @param string $from_name
	 * @param string $from_email
	 * @param string $message
	 * @return bool|string
	 * @throws \phpmailerException
	 */
	private function phpmailer($from_name = "", $from_email = "", $message = "" ) {
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
		$mail->Username = EMAILa;
		//Password to use for SMTP authentication
		$mail->Password = EMAIL_PASSWORD;
		//Set who the message is to be sent from
		$mail->setFrom('contact@advokat.dev', 'Sajt kontakt');
		//Set an alternative reply-to address
		$mail->addReplyTo($from_name, $from_email);
		//Set who the message is to be sent to
		$mail->addAddress(EMAIL, 'Advokat Kontakt');
		//Set the subject line
		$mail->Subject = 'Poruka sa sajta';
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		$mail->Body = "Ime: " . $from_name . "<br>Email: " . $from_email . "<br>Poruka: " . $message;
		//Replace the plain text body with one created manually
		$mail->AltBody = "Ime: " . $from_name . ", email: " . $from_email . ", poruka: " . $message;
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
		//send the message, check for errors
		if (!$mail->send()) {
			return "Došlo je do greške: " . $mail->ErrorInfo;
		} else {
			return true;
		}
	}

}
