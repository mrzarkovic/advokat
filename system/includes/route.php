<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Routing engine 1.0
 * developed for LameWork
 * by Milos Zarkovic mzarkovicm@gmail.com
 */
class Route {
	/**
	 * Stores all defined URI's
	 * @var array
	 */
	private $_uri = array();
	/**
	 * Stores all the functions or the class methods defined
	 * for the URI's
	 * @var array
	 */
	private $_function = array();

	/**
	 * Stores all the arguments for the class method
	 * @var array
	 */
	private $_arguments = array();

	public $class;
	public $method;
	public $arguments;

	/**
	 * Builds a collection of internal URL's to look for
	 * @param string $uri
	 * @param string $function
	 * @param array  $arguments
	 */
	public function add($uri = '', $function = '', $arguments = array()) {
		$this->_uri[] = $uri;

		$this->_arguments[] = $arguments;

		if ($function != '') {
			$this->_function[] = $function;
		}
	}

	/**
	 * Makes the thing run
	 * @return bool
	 * @throws Exception
	 */
	public function resolve() {
		//$uri = isset($_REQUEST['uri']) ? '/' .$_REQUEST['uri'] : '/';
		if (isset($_SERVER['REQUEST_URI'])) {
			$uri = ($_SERVER['REQUEST_URI'] != "/") ? rtrim($_SERVER['REQUEST_URI'], '/') : $_SERVER['REQUEST_URI'];
		} else {
			$uri = '/';
		}

		//$uri_segments = $this->_explode_segments($uri);
		$function_arguments = array();

		foreach ($this->_uri as $key => $value) {
			// Replace any wild-cards with RegEx
			// and get the arguments from the URI
			if (strstr($value, "(:")) {
				$value = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $value));
				//$function_arguments = $this->_get_argument($uri_segments);
			}

			if (preg_match("#^$value$#", $uri, $matches)) {
				// Remove the whole match
				array_shift($matches);
				foreach ($matches as $match) {
					$function_arguments[] = $match;
				}
				$use_function = $this->_function[$key];

				/* If $use_function is a class name, instantiate it. */
				if (is_string($use_function)) {
					$args = explode("@", $use_function);

					if (!isset($args[1])) {
						//throw new Exception( 'Invalid route: No function defined' );
						// Set the default class method if not specified.
						$class = $args[0];
						$func = "index";
					} else {
						$class = $args[1];
						$func = $args[0];
					}

					// Add a namespace to the class name
					$class = "\\Lamework\\Controller\\" . $class;


					if (!class_exists($class))
						throw new Exception('Invalid route: Class "' . $class . '" does not exist.');

					//$call = new $class();
					$this->class = $class;
					$this->method = $func;
					$this->arguments = array_merge($this->_arguments[$key], $function_arguments);
					return;
					//return $call->$func( $function_arguments );
				} /* else, presume it is an anonymous function */
				else {
					return call_user_func($use_function);
				}
			}
		}

		$call = new \Lamework\Controller\Error_404();
		$this->class = $call;
		$this->method = "index";
		$this->arguments = $function_arguments;
		return;
		//throw new Exception( 'Error 404: Page not found.' );
	}

	/**
	 * Return an array of URI segments
	 * @param  string $uri_string [description]
	 * @return array $uri_segments [description]
	 */
	private function _explode_segments($uri_string) {
		$uri_segments = array();

		foreach (explode("/", preg_replace("|/*(.+?)/*$|", "\\1", $uri_string)) as $val) {
			if ($val != '') {
				$uri_segments[] = $val;
			} else {
				$uri_segments[0] = "";
			}
		}
		return $uri_segments;
	}

	/**
	 * Return a string of arguments from URI
	 *
	 * @param  array $uri_segments [description]
	 * @return string               [description]
	 */
	private function _get_argument($uri_segments = array()) {
		return $uri_arguments = array_pop($uri_segments);
		/*
	   $uri_arguments = "";
	   array_shift($uri_segments);

	   foreach ($uri_segments as $segment)
	   {
		 $uri_arguments .= $segment;
	   }

	   return $uri_arguments;
	   */
	}
}
