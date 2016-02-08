<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();
// Engines
require_once(dirname(dirname(__FILE__)) . '/includes/route.php');
// Helpers
require_once(dirname(dirname(__FILE__)) . '/includes/helpers.php');
// Models
$models_dir = BASEPATH . "/models";
load_files($models_dir);
// Controllers
$controllers_dir = BASEPATH . "/controllers";
load_files($controllers_dir);
// Initialize the Core controller
$core = new \Lamework\Controller\Core();