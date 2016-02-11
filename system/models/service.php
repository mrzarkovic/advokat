<?php

namespace Lamework\Model;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service extends Repository {
	protected static $table_name = "services";
	protected static $fields = array(
		"title_sr" => "string",
		"body_sr" => "string",
		"title_en" => "string",
		"body_en" => "string",
		"date_created" => "date",
		"published" => "bool",
		"order" => "int",
	);

	public function __construct($row = array()) {
		parent::__construct($row);
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
		$body_field = "body_" . $lang;
		return $this->$body_field;
	}
}