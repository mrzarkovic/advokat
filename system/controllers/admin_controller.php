<?php

namespace Lamework\Controller;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin controller
 */
class Admin_controller extends Core {
	public function __construct() {
		parent::__construct();
		$this->set_main_template("admin-main");
	}

}
