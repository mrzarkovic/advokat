<?php

namespace Lamework\Model;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client extends Repository {
	protected static $table_name = "clients";
	protected static $fields = array(
		"name_sr" => "string",
		"name_en" => "string",
		"logo_path" => "string",
		"date_created" => "date",
		"published" => "bool",
		"order" => "int",
	);

	public function __construct($row = array()) {
		parent::__construct($row);
	}

	public function get_language_name($lang = "") {
		$name_field = "name_" . $lang;
		return $this->$name_field;
	}
}