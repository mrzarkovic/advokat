<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();
// Config
require_once(dirname(dirname(__FILE__)) . '/config.php');
// Engines
require_once(dirname(dirname(__FILE__)) . '/includes/route.php');
// Helpers
require_once(dirname(dirname(__FILE__)) . '/includes/helpers.php');
// Models
$models_dir = BASEPATH . "/models";
load_files($models_dir);
// Controllers
require_once(dirname(dirname(__FILE__)) . '/controllers/.core/core.php');
require_once(dirname(dirname(__FILE__)) . '/controllers/.core/admin_controller.php');
$controllers_dir = BASEPATH . "/controllers";
load_files($controllers_dir);
// Initialize the Core controller
$core = new \Lamework\Controller\Core();