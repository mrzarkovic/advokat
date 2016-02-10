<?php

namespace Lamework\Controller;

use Lamework\Model\Service;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Services controller
 */
class Services extends Core {
	public function __construct() {
		parent::__construct();

	}

	/**
	 * List all services
	 * @param string $lang
	 */
	public function listAll($lang = "") {
		$this->page_name = "Usluge";
		$this->set_current_menu("services");
		if (isset($lang) && array_key_exists($lang, self::$availableLanguages)) {
			$this->set_language($lang);
			$this->template = "services";
			$services = new Service();
			$services->fetchAllByFieldValue("published", 1);
			$this->to_tpl['lang'] = $lang;
			$this->to_tpl['services'] = $services->list;
		} else {
			$this->to_tpl['error'] = "Stranica ne postoji.";
			$this->template = "404";
		}
		return;
	}

}
