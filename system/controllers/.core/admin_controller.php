<?php

namespace Lamework\Controller;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin controller
 */
class Admin_controller extends Core {
	public function __construct() {
		parent::__construct();
		$logger = new Logger();
		if (!$logger->user_logged_in()) {
			header('Location: /login');
		}
		$this->set_main_template("admin-main");
	}

}
