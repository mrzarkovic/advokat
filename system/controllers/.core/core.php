<?php

namespace Lamework\Controller;

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
	 * Stores ahe main template name
	 * @var string
	 */
	public static $main_template;

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
	 * Stores template data
	 * @var array
	 */
	public $to_tpl;

	/**
	 * Stores an instance of the Route class
	 * @var object
	 */
	public $route;

	public function __construct() {
		$this->route = new \Route();
		$this->to_tpl = array();
		$this->msg_to_user = "";
		static::$main_template = "main";
		$this->template = "";
		$this->site_name = "Attorney";
		$this->page_name = "at Law";
		$footer_year = new \DateTime("now");
		$this->to_tpl['footer_year'] = $footer_year->format('Y');
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
	 * Add a route to the Route object
	 * @param string $route  URI
	 * @param string $action Controller and method
	 */
	public function add_route($route = "", $action = "") {
		$this->route->add($route, $action);
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
		$class->$method($args);

		// Set the variables to use in the template
		$this->to_tpl = $class->to_tpl;
		// Set the child template name
		$this->template = ($class->template) ? $class->template : "404";
		// Set the page title
		$this->title = $this->site_name . " | " . $class->page_name;
		// Set the message for a user
		$this->msg_to_user = $class->msg_to_user;
		// Load the main template
		$this->load_template(static::$main_template);
	}
}
