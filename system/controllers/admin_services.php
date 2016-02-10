<?php

namespace Lamework\Controller;

use Lamework\Model\Service;

class Admin_services extends Admin_controller {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Show the services
	 * @throws \Exception
	 */
	public function services() {
		$services = new Service();
		$services->fetchAll();
		$this->to_tpl['services'] = $services->list;
		$this->template = "admin/services-list";

		return;
	}

	/**
	 * Show a form for adding a new service
	 * @throws \Exception
	 */
	public function add_service() {
		$this->to_tpl['success'] = false;
		$this->to_tpl['errors'] = false;
		$this->to_tpl['id'] = 0;
		$this->to_tpl['title'] = "";
		$this->template = "admin/add-service";

		if (isset($_POST['submit'])) {
			$errors = $this->check_input();
			if (is_array($errors) && !empty($errors)) {
				$this->to_tpl['errors'] = $errors;
			} else {
				$service = new Service();
				$service->title_sr = post_string('title_sr');
				$service->body_sr = post_string('body_sr');
				$service->title_en = post_string('title_en');
				$service->body_en = post_string('body_en');
				$service->date_created = new \DateTime("now");
				$service->published = post_bool('published');
				if ($id = $service->saveToDb()) {
					$this->to_tpl['success'] = true;
					$this->to_tpl['id'] = $id;
					$this->to_tpl['title'] = $service->title_sr;
					$_POST = array();
				}
			}
		}

		return;
	}

	/**
	 * Edit a service
	 * @param int $id
	 */
	public function edit_service($id = 0) {
		$this->to_tpl['success'] = false;
		$this->to_tpl['errors'] = false;
		$service = new Service();
		if ($service = $service->getById($id)) {
			$this->to_tpl['service'] = $service;
			$this->template = "admin/edit-service";

			if (isset($_POST['submit'])) {
				$errors = $this->check_input();
				if (is_array($errors) && !empty($errors)) {
					$this->to_tpl['errors'] = $errors;
				} else {
					$service->title_sr = post_string('title_sr');
					$service->body_sr = post_string('body_sr');
					$service->title_en = post_string('title_en');
					$service->body_en = post_string('body_en');
					$service->date_created = new \DateTime("now");
					$service->published = post_bool('published');
					if ($service->updateInDb()) {
						$this->to_tpl['success'] = true;
					}
				}
			}
		} else {
			header('Location: /admin/manage-services');
		}

		return;
	}

	/**
	 * Delete a service
	 * @param int $id
	 * @throws \Exception
	 */
	public function delete_service($id = 0) {
		$service = new Service();
		if ($service = $service->getById($id))
			$service->deleteFromDb();

		$this->services();
		$this->to_tpl['service_deleted'] = true;
		return;
		//header('Location: /admin/manage-pages');
	}

	/**
	 * Check the submited input
	 * @return array
	 */
	private function check_input() {
		$error_array = array();
		if (!isset($_POST['title_sr']) || empty($_POST['title_sr'])) {
			$error_array['title_sr'] = "Morate uneti naslov usluge.";
		}
		if (!isset($_POST['body_sr']) || empty($_POST['body_sr'])) {
			$error_array['body_sr'] = "Morate uneti opis usluge.";
		}

		return $error_array;
	}
}