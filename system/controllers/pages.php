<?php

namespace Lamework\Controller;

use Lamework\Model\Page;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Pages controller
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

	/**
	 * Show a page for the language
	 * @param string $lang
	 * @param string $permalink
	 */
	public function show($lang = "", $permalink = "") {
		if (isset($lang) && array_key_exists($lang, self::$availableLanguages)) {
			// TODO: Resolve the requested page by permalink
			$this->set_language($lang);
			$this->template = "single-page";
			$page = new Page();
			$page = $page->getById($permalink);
			$this->to_tpl['lang'] = $lang;
			$this->to_tpl['page'] = $page;
		} else {
			$this->to_tpl['error'] = "Stranica ne postoji.";
			$this->template = "404";
		}
		return;
	}

}
