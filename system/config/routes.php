<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Serbian routes
$core->add_route('/', 'show@Pages', array('sr', 'biografija'));
$core->add_route('/sr', 'show@Pages', array('sr', 'biografija'));
// English routes
$core->add_route('/en', 'show@Pages', array('en', 'biography'));
// Admin
$core->add_route('/login', 'login@Logger');
$core->add_route('/logout', 'logout@Logger');
$core->add_route('/list-of-images', 'images_list@Admin_ajax');
$core->add_route('/admin', 'pages@Admin_pages');
// Admin pages
$core->add_route('/admin/manage-pages', 'pages@Admin_pages');
$core->add_route('/admin/add-page', 'add_page@Admin_pages');
$core->add_route('/admin/edit-page/(:num)', 'edit_page@Admin_pages');
$core->add_route('/admin/delete-page/(:num)', 'delete_page@Admin_pages');
// Admin services
$core->add_route('/admin/manage-services', 'services@Admin_services');
$core->add_route('/admin/add-service', 'add_service@Admin_services');
$core->add_route('/admin/edit-service/(:num)', 'edit_service@Admin_services');
$core->add_route('/admin/delete-service/(:num)', 'delete_service@Admin_services');
// Pages language routes
$core->add_route('/(:any)/(:any)', 'show@Pages');
