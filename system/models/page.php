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
		"date_created" => "date",
		"published" => "bool",
		"order" => "int",
	);

	public function __construct($row = array())
	{
		parent::__construct($row);
	}
}