<?php

namespace Lamework\Model;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends Repository {
	protected static $table_name = "pages";
	protected static $fields = array(
		"title_sr" => "string",
		"body_sr" => "string",
		"title_en" => "string",
		"body_en" => "string",
		"permalink_sr" => "string",
		"permalink_en" => "string",
		"date_created" => "date",
		"published" => "bool",
		"order" => "int",
	);

	public function __construct($row = array()) {
		parent::__construct($row);
	}

	/**
	 * @param $permalink
	 * @param $lang
	 * @return bool
	 * @throws \Exception
	 */
	public function getByPermalink($permalink, $lang) {
		return $this->getByFieldValue("permalink_" . $lang, $permalink);
	}

	/**
	 * Get the URL for a language
	 * @param string $lang
	 * @return string
	 */
	public function get_language_url($lang = "") {
		$permalink_field = "permalink_" . $lang;
		return "/" . $lang . "/" . $this->$permalink_field;
	}

	/**
	 * Get the title for a language
	 * @param string $lang
	 * @return string
	 */
	public function get_language_title($lang = "") {
		$title_field = "title_" . $lang;
		return $this->$title_field;
	}

	/**
	 * Get the body for a language
	 * @param string $lang
	 * @return string
	 */
	public function get_language_body($lang = "") {
		$title_field = "body_" . $lang;
		return $this->$title_field;
	}
}