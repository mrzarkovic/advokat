<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Get excerpt from string
*
* @param string $str String to get an excerpt from
* @param int $startPos Position int string to start excerpt from
* @param int $maxLength Maximum length the excerpt may be
* @return string excerpt
*/
function get_excerpt( $str, $startPos=0, $maxLength=100 ) {
   if( strlen( $str ) > $maxLength ) {
      $excerpt   = substr( $str, $startPos, $maxLength-3 );
      $lastSpace = strrpos( $excerpt, ' ' );
      $excerpt   = substr( $excerpt, 0, $lastSpace );
      $excerpt  .= '...';
   } else {
      $excerpt = $str;
   }

   return $excerpt;
}

/**
 * Send an email message from the contact form
 * @return string Message to user
 */
function send_contact_message()
{
   $name = $_POST['name'];
   $message = $_POST['message'];
   $email = $_POST['email'];

   if (($message != "")&&($email != ""))
   {
      $message = wordwrap($message, 70, "\r\n");

      // To send HTML mail, the Content-type header must be set
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      // Additional headers
      $headers .= 'To: Kontakt <kontakt@tourizm.rs>' . "\r\n";
      $headers .= 'From: '.$name.' <'.$email.'>' . "\r\n";

      $send_email = mail('kontakt@tourizm.rs', 'Poruka sa sajta', $message, $headers);

      if ($send_email)
      {
         $msg_to_user = "Poruka je poslata! Hvala.";
      }
      else
      {
         $msg_to_user = "Došlo je do greške pri slanju poruke.";
      }
   }
   else
   {
      $msg_to_user = "Molimo napišite poruku i Vašu email adresu. Hvala.";
   }

   return $msg_to_user;
}

/**
* Check to see if user is logged in
* @return string Username
*/
function user_logged_in()
{
  if ( isset( $_SESSION['username'] ) )
  {
      return $_SESSION['username'];
  }

  return false;
}

/**
 * Load files from directory $path
 * @param $path Path to the directory
 * @return bool
 */
function load_files( $path ) {
	$files = scandir($path);
	array_shift($files); // remove "."
	array_shift($files); // remove ".."
	foreach ($files as $file) {
		if (is_dir($path . '/' . $file)) {
			load_files($path . '/' . $file);
		}
		else {
			$file_name = $path . '/' . $file;
			require_once($file_name);
		}
	}
	return true;
}
