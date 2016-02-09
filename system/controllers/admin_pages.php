<?php

namespace Lamework\Controller;

use Lamework\Model\Page;

class Admin_pages extends Admin_controller {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Show the pages
	 * @throws \Exception
	 */
	public function pages() {
		$pages = new Page();
		$pages->fetchAll();
		$this->to_tpl['pages'] = $pages->list;
		$this->template = "pages/pages-list";

		return;
	}

	/**
	 * Show a form for adding a new page
	 * @throws \Exception
	 */
	public function add_page() {
		$this->to_tpl['success'] = false;
		$this->to_tpl['errors'] = false;
		$this->template = "pages/add-page";

		if (isset($_POST['submit'])) {
			if ($errors = $this->check_input()) {
				$this->to_tpl['errors'] = $errors;
			} else {
				$page = new Page();
				$page->title_sr = post_string('title_sr');
				$page->body_sr = post_string('body_sr');
				$page->title_en = post_string('title_en');
				$page->body_en = post_string('body_en');
				$page->date_created = new \DateTime("now");
				$page->published = post_bool('published');
				if ($page->saveToDb()) {
					$this->to_tpl['success'] = true;
				}
			}
		}

		return;
	}

	public function edit_page($id = 0) {
		$this->to_tpl['success'] = false;
		$this->to_tpl['errors'] = false;
		$page = new Page();
		if ($page = $page->getById($id)) {
			$this->to_tpl['page'] = $page;
			$this->template = "pages/edit-page";

			if (isset($_POST['submit'])) {
				if ($errors = $this->check_input()) {
					$this->to_tpl['errors'] = $errors;
				} else {
					$page->title_sr = post_string('title_sr');
					$page->body_sr = post_string('body_sr');
					$page->title_en = post_string('title_en');
					$page->body_en = post_string('body_en');
					$page->date_created = new \DateTime("now");
					$page->published = post_bool('published');
					if ($page->updateInDb()) {
						$this->to_tpl['success'] = true;
					}
				}
			}
		} else {
			header('Location: /admin/manage-pages');
		}

		return;
	}

	/**
	 * Delete a page
	 * @param int $id
	 * @throws \Exception
	 */
	public function delete_page($id = 0) {
		$page = new Page();
		if ($page = $page->getById($id))
			$page->deleteFromDb();

		header('Location: /admin/manage-pages');
	}

	/**
	 * Check the submited input
	 * @return array
	 */
	private function check_input() {
		$error_array = array();
		if (!isset($_POST['title_sr'])) {
			$error_array['title_sr'] = "Morate uneti naslov stranice.";
		}
		if (!isset($_POST['body_sr'])) {
			$error_array['body_sr'] = "Morate uneti sadržaj stranice.";
		}

		return $error_array;
	}
}