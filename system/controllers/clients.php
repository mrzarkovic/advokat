<?php

namespace Lamework\Controller;

use Lamework\Model\Client;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clients controller
 */
class Clients extends Core {
	public function __construct() {
		parent::__construct();

	}

	/**
	 * List all clients
	 * @param string $lang
	 */
	public function listAll($lang = "") {
		$this->set_page_name($this->language_titles["clients"][$lang]);
		if (isset($lang) && array_key_exists($lang, self::$availableLanguages)) {
			$this->set_language($lang);
			$this->template = "clients";
			$clients = new Client();
			$clients->fetchAllByFieldValue("published", 1);
			$this->to_tpl['lang'] = $lang;
			$this->to_tpl['clients'] = $clients->list;
		} else {
			$this->to_tpl['error'] = "Stranica ne postoji.";
			$this->template = "404";
		}
		return;
	}

}
