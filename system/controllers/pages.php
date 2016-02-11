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
	 * Show a page for the language
	 * @param string $lang
	 * @param string $permalink
	 */
	public function show($lang = "", $permalink = "") {
		if (isset($lang) && array_key_exists($lang, self::$availableLanguages)) {
			$this->set_language($lang);
			$page = new Page();
			$page = $page->getByPermalink($permalink, $lang);
			if ($page->id != 0) {
				$this->template = "single-page";
				$this->page_name = $page->get_language_title($lang);
				$this->set_current_menu($page->id);
				$this->to_tpl['lang'] = $lang;
				$this->to_tpl['page'] = $page;
				return;
			}
		}

		$this->to_tpl['error'] = "Stranica ne postoji.";
		$this->template = "404";
		return;
	}

}
