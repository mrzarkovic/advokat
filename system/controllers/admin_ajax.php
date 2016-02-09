<?php

namespace Lamework\Controller;


class Admin_ajax extends Core {

	public function __construct() {
		parent::__construct();
	}

	public function images_list() {
		$files = get_pages_images_list();
		$result = array();
		foreach ($files as $file) {
			$result[] = array('title' => $file, 'value' => '/images/pages/' . $file );
		}
		return $this->print_ajax(json_encode($result));
	}

	/**
	 * Load a page with ajax result
	 * @param string $result
	 */
	private function print_ajax($result = "")
	{
		$this->to_tpl['result'] = $result;
		$this->load_template("ajax-result");
		exit;
	}
}