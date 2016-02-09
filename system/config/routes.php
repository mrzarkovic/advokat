<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Show Home
$core->add_route('/', 'home@Pages');
// Admin
$core->add_route('/login', 'login@Logger');
$core->add_route('/logout', 'logout@Logger');
// Admin pages
$core->add_route('/list-of-images', 'images_list@Admin_ajax');
$core->add_route('/admin/manage-pages', 'pages@Admin_pages');
$core->add_route('/admin/add-page', 'add_page@Admin_pages');
$core->add_route('/admin/edit-page/(:num)', 'edit_page@Admin_pages');
$core->add_route('/admin/delete-page/(:num)', 'delete_page@Admin_pages');
// Pages language routes
$core->add_route('/(:any)/(:any)', 'show@Pages');
