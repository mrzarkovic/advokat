<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Get excerpt from string
 *
 * @param string $str String to get an excerpt from
 * @param int $startPos Position int string to start excerpt from
 * @param int $maxLength Maximum length the excerpt may be
 * @return string excerpt
 */
function get_excerpt($str, $startPos = 0, $maxLength = 100) {
	if (strlen($str) > $maxLength) {
		$excerpt = substr($str, $startPos, $maxLength - 3);
		$lastSpace = strrpos($excerpt, ' ');
		$excerpt = substr($excerpt, 0, $lastSpace);
		$excerpt .= '...';
	} else {
		$excerpt = $str;
	}

	return $excerpt;
}

/**
 * Send an email message from the contact form
 * @return string Message to user
 */
function send_contact_message() {
	$name = $_POST['name'];
	$message = $_POST['message'];
	$email = $_POST['email'];

	if (($message != "") && ($email != "")) {
		$message = wordwrap($message, 70, "\r\n");

		// To send HTML mail, the Content-type header must be set
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'To: Kontakt <kontakt@tourizm.rs>' . "\r\n";
		$headers .= 'From: ' . $name . ' <' . $email . '>' . "\r\n";

		$send_email = mail('kontakt@tourizm.rs', 'Poruka sa sajta', $message, $headers);

		if ($send_email) {
			$msg_to_user = "Poruka je poslata! Hvala.";
		} else {
			$msg_to_user = "Došlo je do greške pri slanju poruke.";
		}
	} else {
		$msg_to_user = "Molimo napišite poruku i Vašu email adresu. Hvala.";
	}

	return $msg_to_user;
}

/**
 * Check to see if user is logged in
 * @return string Username
 */
function user_logged_in() {
	if (isset($_SESSION['username'])) {
		return $_SESSION['username'];
	}

	return false;
}

/**
 * Load files from directory $path
 * @param $path Path to the directory
 * @return bool
 */
function load_files($path) {
	$files = scandir($path);
	array_shift($files); // remove "."
	array_shift($files); // remove ".."
	foreach ($files as $file) {
		if (is_dir($path . '/' . $file)) {
			load_files($path . '/' . $file);
		} else {
			$file_name = $path . '/' . $file;
			require_once($file_name);
		}
	}
	return true;
}

/**
 * Get the string value from the $_POST array
 * @param $string_name
 * @return mixed
 */
function post_string($string_name) {
	$string = $_POST[$string_name];
	settype($string, "string");
	return $string;
}

/**
 * Get the integer value from the $_POST array
 * @param $integer_name
 * @return mixed
 */
function post_int($integer_name) {
	$integer = $_POST[$integer_name];
	settype($integer, "integer");
	return $integer;
}

/**
 * Get the bool value from the $_POST array
 * @param $boolean_name
 * @return mixed
 */
function post_bool($boolean_name) {
	$boolean = $_POST[$boolean_name];
	if ($boolean == "true")
		return true;

	return false;
}

/**
 * Get JSON list of images in pages directory
 * @return array
 */
function get_pages_images_list() {
	$files = scandir(BASEPATH . "/../public/images/pages");
	array_shift($files); // remove "."
	array_shift($files); // remove ".."
	return $files;
}

/**
 * Generate a form field
 * @param string $type
 * @param string $field_name
 * @param string $label_text
 * @param string $value
 * @param array  $errors
 * @param string $placeholder
 */
function generate_form_field($type = "text", $field_name = "name", $label_text = "", $value = "", $errors = array(), $placeholder = "", $css_class = "") {
	if (isset($_POST[$field_name])) {
		$value = $_POST[$field_name];
	}
	if (isset($errors[$field_name])) {
		echo "<div class=\"form-error\">";
		if (is_array($errors[$field_name])) {
			foreach ($errors[$field_name] as $field_error) {
				echo $field_error . "<br>";
			}
		} else {
			echo $errors[$field_name];
		}
		echo "</div>";
	}
	echo "<div class=\"form-field\">";
	echo "<label for=\"" . $field_name . "\">" . $label_text . ":</label>";
	if ($type == "text") {
		echo "<input type=\"text\" name=\"" . $field_name . "\" id=\"" . $field_name . "\" placeholder=\"" . $placeholder . "\" value=\"" . htmlentities($value) . "\" class=\"" . $css_class . "\">";
	} elseif ($type == "textarea") {
		echo "<textarea name=\"" . $field_name . "\" id=\"" . $field_name . "\" class=\"" . $css_class . "\">" . ($value) . "</textarea>";
	} elseif ($type == "file") {
		if ($value) echo "<img src=\"/$value\" width=\"200\"><br>";
		echo "<input type=\"file\" name=\"" . $field_name . "\" id=\"" . $field_name . "\">";
	}
	echo "</div>";
}

/**
 * Generate a permalink from the string
 * @param string $string
 * @return string
 */
function generate_permalink($string = "") {
	$string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
	// Replace non letter or digits by -
	$string = preg_replace('~[^\\pL\d.]+~u', '-', $string);
	// Replace dots
	$string = str_replace(".", "_", $string);
	// Trim
	$string = trim($string, '-');
	// Transliterate
	if (function_exists('iconv')) {
		$string = iconv('UTF-8', 'us-ascii//TRANSLIT//IGNORE', $string);
	}
	// Lowercase
	$string = strtolower($string);
	// Remove unwanted characters
	$string = preg_replace('~[^-\w.]+~', '', $string);

	return $string;
}

/**
 * Return css class current if active page
 * @param $page_name
 * @param $current_page
 * @return string
 */
function check_current_menu($page_name, $current_page) {
	if ($page_name === $current_page) return "current";
	else return "";
}

/**
 * Generate a form token
 * @param $form
 * @return string
 */
function generate_form_token($form) {
	// Generate a token from an unique value
	$token = md5(uniqid(microtime(), true));

	// Write the generated token to the session variable
	// to check it against the hidden field when the form is sent
	$_SESSION[$form . '_token'] = $token;

	return $token;
}

/**
 * Verify the form token
 * @param $form
 * @return bool
 */
function verify_form_token($form) {
	// Check if a session is started and a token is transmitted,
	// if not return an error
	if(!isset($_SESSION[$form.'_token'])) {
		return false;
	}

	// Check if the form is sent with token in it
	if(!isset($_POST['token'])) {
		return false;
	}

	// Compare the tokens against each other if they are still the same
	if ($_SESSION[$form . '_token'] !== $_POST['token']) {
		return false;
	}

	return true;
}

/**
 * Use: Anything that shouldn't contain html
 * (pretty much everything that is not a textarea)
 * @param $s
 * @return string
 */
function stripcleantohtml($s){
	// Restores the added slashes (ie.: " I\'m John "
	// for security in output, and escapes them in htmlentities(ie.:  &quot; etc.)
	// Also strips any <html> tags it may encounter
	return htmlentities(trim(strip_tags(stripslashes($s))), ENT_NOQUOTES, "UTF-8");
}

/**
 * Use: For input fields that may contain html, like a textarea
 * @param $s
 * @return string
 */
function cleantohtml($s){
	// Restores the added slashes (ie.: " I\'m John "
	// for security in output, and escapes them in htmlentities(ie.:  &quot; etc.)
	// It preserves any <html> tags in that they are encoded aswell (like &lt;html&gt;)
	// As an extra security, if people would try to inject tags that would become tags
	// after stripping away bad characters, we do still strip tags but only after htmlentities,
	// so any genuine code examples will stay
	return strip_tags(htmlentities(trim(stripslashes($s)), ENT_NOQUOTES, "UTF-8"));
}

/**
 * Write to log file
 * @param $where
 */
function write_log($where) {

	$ip = $_SERVER["REMOTE_ADDR"]; // Get the IP from superglobal
	$host = gethostbyaddr($ip);    // Try to locate the host of the attack
	$date = date("d M Y");

	// create a logging message with php heredoc syntax
	$logging = <<<LOG
		\n
		<< Start of Message >>
		There was a hacking attempt on your form. \n
		Date of Attack: {$date}
		IP-Adress: {$ip} \n
		Host of Attacker: {$host}
		Point of Attack: {$where}
		<< End of Message >>
LOG;

	// open log file
	if($handle = fopen(BASEPATH . '/hacklog.log', 'a')) {

		fputs($handle, $logging);  // write the Data to file
		fclose($handle);           // close the file

	} else {  // if first method is not working, for example because of wrong file permissions, email the data

		$to = 'ADMIN@gmail.com';
		$subject = 'HACK ATTEMPT';
		$header = 'From: ADMIN@gmail.com';
		if (mail($to, $subject, $logging, $header)) {
			echo "Sent notice to admin.";
		}

	}
}