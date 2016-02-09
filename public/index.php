<?php

/**
 * LameWork is a PHP Framework that uses MVC design pattern
 * Version: 0.02
 * Author: Milos Zarkovic (mzarkovicm@gmail.com)
 */

define('BASEPATH', str_replace("\\", "/", "../system"));

// Include startup scripts
require_once(BASEPATH . '/includes/start-up.php');
// Include routes
require_once(BASEPATH . '/config/routes.php');

// Exception handling
set_exception_handler('exception_handler');
function exception_handler(Exception $exception) {
	echo $msg = $exception->getMessage();
}

$core->start();

?>
