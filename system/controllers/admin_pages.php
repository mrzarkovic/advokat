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
		$this->template = "admin/pages-list";

		return;
	}

	/**
	 * Show a form for adding a new page
	 * @throws \Exception
	 */
	public function add_page() {
		$this->to_tpl['success'] = false;
		$this->to_tpl['id'] = 0;
		$this->to_tpl['title'] = "";
		$this->to_tpl['errors'] = false;
		$this->template = "admin/add-page";
		// TODO: https://css-tricks.com/serious-form-security/
		if (isset($_POST['submit'])) {
			$errors = $this->check_input();
			if (is_array($errors) && !empty($errors)) {
				$this->to_tpl['errors'] = $errors;
			} else {
				$page = new Page();
				$page->title_sr = post_string('title_sr');
				$page->body_sr = post_string('body_sr');
				$page->title_en = post_string('title_en');
				$page->body_en = post_string('body_en');
				$page->permalink_sr = $page->check_permalink(generate_permalink($page->title_sr), "sr");
				$page->permalink_en = $page->check_permalink(generate_permalink($page->title_en), "en");
				$page->date_created = new \DateTime("now");
				$page->published = post_bool('published');
				if ($id = $page->saveToDb()) {
					$this->to_tpl['success'] = true;
					$this->to_tpl['id'] = $id;
					$this->to_tpl['title'] = $page->title_sr;
					$_POST = array();
				}
			}
		}

		return;
	}

	/**
	 * Edit a page
	 * @param int $id
	 * @throws \Exception
	 */
	public function edit_page($id = 0) {
		$this->to_tpl['success'] = false;
		$this->to_tpl['errors'] = false;
		$page = new Page();
		if ($page = $page->getById($id)) {
			$this->to_tpl['page'] = $page;
			$this->template = "admin/edit-page";

			if (isset($_POST['submit'])) {
				$errors = $this->check_input();
				if (is_array($errors) && !empty($errors)) {
					$this->to_tpl['errors'] = $errors;
				} else {
					$page->title_sr = post_string('title_sr');
					$page->body_sr = post_string('body_sr');
					$page->title_en = post_string('title_en');
					$page->body_en = post_string('body_en');
					$page->permalink_sr = $page->check_permalink(generate_permalink($page->title_sr), "sr");
					$page->permalink_en = $page->check_permalink(generate_permalink($page->title_en), "en");
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

		$this->pages();
		$this->to_tpl['page_deleted'] = true;
		return;
		//header('Location: /admin/manage-pages');
	}

	/**
	 * Check the submitted input
	 * @return array
	 */
	private function check_input() {
		$error_array = array();
		if (!isset($_POST['title_sr']) || empty($_POST['title_sr'])) {
			$error_array['title_sr'] = "Morate uneti naslov stranice.";
		}
		if (!isset($_POST['body_sr']) || empty($_POST['body_sr'])) {
			$error_array['body_sr'] = "Morate uneti sadržaj stranice.";
		}

		return $error_array;
	}
}