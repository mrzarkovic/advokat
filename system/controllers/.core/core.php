<?php

namespace Lamework\Controller;

use Lamework\Model\Page;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Core controller
 */
class Core {
	/**
	 * Stores a message for the user
	 * @var string
	 */
	public $msg_to_user;

	/**
	 * Stores a template name
	 * @var string
	 */
	public $template;

	/**
	 * Stores the website name
	 * @var string
	 */
	public $site_name;

	/**
	 * Stores the page name
	 * @var string
	 */
	public $page_name;

	/**
	 * Stores the page name for menu
	 * @var string
	 */
	public static $current_menu;

	/**
	 * Stores template data
	 * @var array
	 */
	public $to_tpl;

	/**
	 * Stores an instance of the Route class
	 * @var object
	 */
	public $route;

	/**
	 * The website language
	 * @var string
	 */
	public static $language;

	/**
	 * Stores ahe main template name
	 * @var string
	 */
	public static $main_template;

	/**
	 * List of the available languages
	 * @var array
	 */
	public static $availableLanguages = array(
		"sr" => "Srpski",
		"en" => "English"
	);

	/**
	 * Clients page titles
	 * @var array
	 */
	public $clients_title = array(
		"sr" => "Klijenti",
		"en" => "Clients"
	);

	/**
	 * Clients page urls
	 * @var array
	 */
	public $clients_url = array(
		"sr" => "/sr/klijenti",
		"en" => "/en/clients"
	);

	/**
	 * Services page titles
	 * @var array
	 */
	public $services_title = array(
		"sr" => "Usluge",
		"en" => "Services"
	);

	/**
	 * Services page urls
	 * @var array
	 */
	public $services_url = array(
		"sr" => "/sr/usluge",
		"en" => "/en/services"
	);

	/**
	 * Services page titles
	 * @var array
	 */
	public $contact_title = array(
		"sr" => "Kontakt",
		"en" => "Contact"
	);

	/**
	 * Services page urls
	 * @var array
	 */
	public $contact_url = array(
		"sr" => "/sr/kontakt",
		"en" => "/en/contact"
	);

	public function __construct() {
		$this->route = new \Route();
		$this->to_tpl = array();
		$this->msg_to_user = "";
		$this->template = "";
		static::$main_template = "main";
		$this->site_name = "Advokat Marinković";
		$this->page_name = "";

		// Set the footer year
		$footer_year = new \DateTime("now");
		$this->to_tpl['footer_year'] = $footer_year->format('Y');

		// Get all the pages
		$pages = new Page();
		$pages->fetchAllByFieldValue("published", 1);
		$this->to_tpl['pages'] = $pages->list;

		// Set the default language
		$this->set_language("sr");

		// TODO: PHPMailer with Gmail
		// http://www.sitepoint.com/sending-emails-php-phpmailer/
	}

	/**
	 * Include a template file
	 * @param  string $filename
	 * @throws \Exception
	 */
	public function load_template($filename = "") {
		foreach ($this->to_tpl as $variable => $value) {
			$$variable = $value;
		}
		if (!file_exists(BASEPATH . "/views/" . $filename . ".php"))
			throw new \Exception('Template error. File `' . $filename . '` does not exist.');
		else
			require_once(BASEPATH . "/views/" . $filename . ".php");

	}

	/**
	 * Set the main template
	 * @param string $template_name
	 */
	public function set_main_template($template_name = "") {
		static::$main_template = $template_name;
	}

	/**
	 * Set the website language
	 * @param string $lang
	 */
	public function set_language($lang = "") {
		if (array_key_exists($lang, static::$availableLanguages))
			static::$language = $lang;
		else
			static::$language = "sr";
	}

	/**
	 * Get the current language
	 * @return string
	 */
	public function get_language() {
		return static::$language;
	}

	public function set_current_menu($current_menu = "") {
		static::$current_menu = $current_menu;
	}

	public function get_current_menu() {
		return static::$current_menu;
	}

	/**
	 * Add a route to the Route object
	 * @param string $route  URI
	 * @param string $action Controller and method
	 * @param array  $arguments
	 */
	public function add_route($route = "", $action = "", $arguments = array()) {
		$this->route->add($route, $action, $arguments);
	}

	/**
	 * Starts the application
	 */
	public function start() {
		// Find out which controller class and method to use
		$this->route->resolve();

		// Run the controller method with arguments
		$class = new $this->route->class();
		$method = $this->route->method;
		$args = $this->route->arguments;
		call_user_func_array(array($class, $method), $args);
		//$class->$method($args);

		// Set the variables to use in the template
		$this->to_tpl = $class->to_tpl;
		// Set the child template name
		if (!$class->template) {
			$this->to_tpl['error'] = "Nije definisan template.";
			$this->template = "404";
		} else {
			$this->template = $class->template;
		}
		// Set the page title
		$this->title = $this->site_name . " | " . $class->page_name;
		// Set the message for a user
		$this->msg_to_user = $class->msg_to_user;
		// Load the main template
		$this->load_template(static::$main_template);
	}
}
