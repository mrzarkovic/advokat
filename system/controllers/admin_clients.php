<?php

namespace Lamework\Controller;

use Lamework\Model\Client;

class Admin_clients extends Admin_controller {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Show the clients
	 * @throws \Exception
	 */
	public function clients() {
		$clients = new Client();
		$clients->fetchAll();
		$this->to_tpl['clients'] = $clients->list;
		$this->template = "admin/clients-list";

		return;
	}

	/**
	 * Show a form for adding a new client
	 * @throws \Exception
	 */
	public function add_client() {
		$this->to_tpl['success'] = false;
		$this->to_tpl['errors'] = false;
		$this->to_tpl['id'] = 0;
		$this->to_tpl['title'] = "";
		$this->template = "admin/add-client";

		if (isset($_POST['submit'])) {
			$errors = $this->check_input();
			$logo_path = $this->upload_image('logo_path');
			if (is_array($errors) && !empty($errors)) {
				$this->to_tpl['errors'] = $errors;
			} else if (is_array($logo_path) && !empty($logo_path)) {
				$this->to_tpl['errors']['logo_path'] = $logo_path;
			} else {
				$client = new Client();
				$client->name_sr = post_string('name_sr');
				$client->name_en = post_string('name_en');
				$client->logo_path = $logo_path;
				$client->date_created = new \DateTime("now");
				$client->published = post_bool('published');
				if ($id = $client->saveToDb()) {
					$this->to_tpl['success'] = true;
					$this->to_tpl['id'] = $id;
					$this->to_tpl['name'] = $client->name_sr;
					$_POST = array();
				}
			}
		}

		return;
	}

	/**
	 * Edit a client
	 * @param int $id
	 */
	public function edit_client($id = 0) {
		$this->to_tpl['success'] = false;
		$this->to_tpl['errors'] = false;
		$client = new Client();
		if ($client = $client->getById($id)) {
			$this->to_tpl['client'] = $client;
			$this->template = "admin/edit-client";

			if (isset($_POST['submit'])) {
				$errors = $this->check_input();
				if (!empty($_FILES['logo_path']["tmp_name"]) ) {
					$logo_path = $this->upload_image('logo_path');
				} else {
					$logo_path = $client->logo_path;
				}
				if (is_array($errors) && !empty($errors)) {
					$this->to_tpl['errors'] = $errors;
				} else if (is_array($logo_path) && !empty($logo_path)) {
					$this->to_tpl['errors']['logo_path'] = $logo_path;
				} else {
					$client->name_sr = post_string('name_sr');
					$client->name_en = post_string('name_en');
					$client->logo_path = $logo_path;
					$client->date_created = new \DateTime("now");
					$client->published = post_bool('published');
					if ($client->updateInDb()) {
						$this->to_tpl['success'] = true;
					}
				}
			}
		} else {
			header('Location: /admin/manage-clients');
		}

		return;
	}

	/**
	 * Delete a client
	 * @param int $id
	 * @throws \Exception
	 */
	public function delete_client($id = 0) {
		$client = new Client();
		if ($client = $client->getById($id))
			$client->deleteFromDb();

		$this->clients();
		$this->to_tpl['client_deleted'] = true;
		return;
		//header('Location: /admin/manage-pages');
	}

	/**
	 * Check the submitted input
	 * @return array
	 */
	private function check_input() {
		$error_array = array();
		if (!isset($_POST['name_sr']) || empty($_POST['name_sr'])) {
			$error_array['name_sr'] = "Morate uneti naziv klijenta.";
		}

		return $error_array;
	}

	/**
	 * Upload an image and return file path
	 * @param $field_name [Form input name]
	 * @return array|string
	 */
	private function upload_image($field_name) {
		$errors = array();

		if (empty($_FILES[$field_name]["tmp_name"])) {
			$errors['no_file'] = "Niste odabrali sliku.";
			return $errors;
		}

		$target_dir = "images/clients/";
		$target_file = $target_dir . basename($_FILES[$field_name]["name"]);
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

		// Check if file already exists
		if (file_exists($target_file))
			return $target_file;

		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES[$field_name]["tmp_name"]);
		if ($check == false) {
			$errors['type'] = "Ovaj fajl nije slika.";
			return $errors;
		}

		// Check file size 500kb
		if ($_FILES[$field_name]["size"] > 500000) {
			$errors['size'] = "Maksimalna veličina slike je 500kb. Ovaj fajl je " . ceil($_FILES[$field_name]["size"] / 1000) . "kb";
			return $errors;
		}

		// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			$errors['type'] = "Dozvoljeni tipovi slika su: jpg, jpeg, png i gif.";
			return $errors;
		}

		if (move_uploaded_file($_FILES[$field_name]["tmp_name"], $target_file)) {
			return $target_file;
		} else {
			$errors['upload'] = "Greška prilikom snimanja slike na server.";
			return $errors;
		}
	}
}