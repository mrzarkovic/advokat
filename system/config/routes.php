<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Show Home
$core->add_route('/', 'home@Pages');
// Admin
$core->add_route('/login', 'login@Logger');
$core->add_route('/logout', 'logout@Logger');
// Admin pages
$core->add_route('/admin/manage-pages', 'pages@Admin_controller');