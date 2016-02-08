<?php

namespace Lamework\Controller;
use Lamework\Model\Log;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Page controller
 */
class Pages extends Core {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Show the homepage
	 * @throws \Exception
	 */
	public function home() {
		$this->template = "home";

		return;
	}

}
