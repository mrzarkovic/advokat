<?php

namespace Lamework\Controller;

use Lamework\Model\Client;
use Lamework\Model\Page;
use Lamework\Model\Service;

class Admin_ajax extends Admin_controller {

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

	public function save_order($objectName) {
		if (isset($_POST['order']) && !empty($_POST['order'])) {
			switch($objectName) {
				case 'client':
					$item = new Client();
					break;
				case 'service':
					$item = new Service();
					break;
				case 'page':
					$item = new Page();
					break;
			}
			foreach ($_POST['order'] as $itemId => $order) {
				$item = $item->getById($itemId);
				$item->order = (int) $order;
				if (!$item->updateInDb()) {
					$this->print_ajax(json_encode(false));
				}
			}
			$this->print_ajax(json_encode(true));
		}
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