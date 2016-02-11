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
		$this->page_name = $this->contact_title[$lang];
		$this->set_language($lang);
		if ($lang == "sr") {
			$this->template = "contact-sr";
		} else {
			$this->template = "contact-en";
		}
		$this->set_current_menu("contact");

		return;
	}

}
