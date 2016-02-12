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
	 * Get the next available permalink
	 * @param $permalink
	 * @param $lang
	 * @param $i
	 * @return string
	 */
	public function check_permalink($permalink = "", $lang = "", $i = 0) {
		if ($i != 0) {
			$new_permalink = $permalink . "-" . $i;
		} else {
			$new_permalink = $permalink;
		}
		$check = $this->getByPermalink($new_permalink, $lang);
		if ($check->id && $check->id != $this->id) {
			$i++;
			return $this->check_permalink($permalink, $lang, $i);
		} else {
			return $new_permalink;
		}
	}
}