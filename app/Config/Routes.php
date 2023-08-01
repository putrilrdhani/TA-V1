<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
// $routes->get('/', 'Home::index', ['filter' => '/']);

$routes->get('/test', 'Home::village');
$routes->get('/', 'Home::landingPage');
$routes->get('/users', 'Users::index');
$routes->get('/villages', 'Villages::index', ['filter' => 'role:administrator']);
$routes->get('/villages/create', 'Villages::create', ['filter' => 'role:administrator']);
$routes->get('/villages/read/(:any)', 'Villages::read/$1', ['filter' => 'role:administrator']);
$routes->get('/villages/delete/(:any)', 'Villages::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/villages/update/(:any)', 'Villages::update/$1', ['filter' => 'role:administrator']);
$routes->post('/villages/update_action', 'Villages::update_action', ['filter' => 'role:administrator']);
$routes->post('/villages/create_action', 'Villages::create_action', ['filter' => 'role:administrator']);


// $routes->get('/village', 'Home::village', ['filter' => 'role:administrator'], ['filter' => 'role:administrator']);

$routes->get('/403', 'Home::error403', ['filter' => 'login']);
// $routes->get('users/update/(:num)', 'Users::update/$1', ['filter' => 'login']);
// $routes->post('/users/update_action', 'Users::update_action', ['filter' => 'login']);
// $routes->get('/users/create', 'Users::create', ['filter' => 'login']);
// $routes->get('/users/read/(:num)', 'Users::read/$1', ['filter' => 'login']);
// $routes->get('/users/delete/(:num)', 'Users::delete/$1', ['filter' => 'login']);
// $routes->post('index.php/Users/create_action', 'Users::create_action', ['filter' => 'login']);
$routes->get('/culinary', 'Culinary::index', ['filter' => 'role:administrator']);
$routes->get('/culinary/create', 'Culinary::create', ['filter' => 'role:administrator']);
$routes->get('/culinary/read/(:any)', 'Culinary::read/$1', ['filter' => 'role:administrator']);
$routes->get('/culinary/delete/(:any)', 'Culinary::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/culinary/update/(:any)', 'Culinary::update/$1', ['filter' => 'role:administrator']);
$routes->post('/culinary/update_action', 'Culinary::update_action', ['filter' => 'role:administrator']);
$routes->post('/culinary/create_action', 'Culinary::create_action', ['filter' => 'role:administrator']);
$routes->get('/culinary/delete_image/(:any)', 'Culinary::delete_image/$1', ['filter' => 'role:administrator']);
// $routes->get('/culinary/facility/(:any)', 'Culinary::facility/$1', ['filter' => 'role:administrator']);
// $routes->get('/culinary/add_facility/(:any)/(:any)', 'Culinary::add_facility/$1/$2', ['filter' => 'role:administrator']);

$routes->get('/homestay', 'Homestay::index', ['filter' => 'role:administrator']);
$routes->get('/homestay/create', 'Homestay::create', ['filter' => 'role:administrator']);
$routes->get('/homestay/read/(:any)', 'Homestay::read/$1', ['filter' => 'role:administrator']);
$routes->get('/homestay/delete/(:any)', 'Homestay::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/homestay/update/(:any)', 'Homestay::update/$1', ['filter' => 'role:administrator']);
$routes->post('/homestay/update_action', 'Homestay::update_action', ['filter' => 'role:administrator']);
$routes->post('/homestay/create_action', 'Homestay::create_action', ['filter' => 'role:administrator']);
$routes->get('/homestay/delete_image/(:any)', 'Homestay::delete_image/$1', ['filter' => 'role:administrator']);
$routes->get('/homestay/facility/(:any)', 'Homestay::facility/$1', ['filter' => 'role:administrator']);
$routes->get('/homestay/add_facility/(:any)/(:any)', 'Homestay::add_facility/$1/$2', ['filter' => 'role:administrator']);
$routes->get('/homestay/delete_facility/(:any)/(:any)', 'Homestay::delete_facility/$1/$2', ['filter' => 'role:administrator']);
$routes->get('/homestay_facility', 'Homestay_facility::index', ['filter' => 'role:administrator']);
$routes->get('/homestay_facility/create', 'Homestay_facility::create', ['filter' => 'role:administrator']);
$routes->get('/homestay_facility/read/(:any)', 'Homestay_facility::read/$1', ['filter' => 'role:administrator']);
$routes->get('/homestay_facility/delete/(:any)', 'Homestay_facility::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/homestay_facility/update/(:any)', 'Homestay_facility::update/$1', ['filter' => 'role:administrator']);
$routes->post('/homestay_facility/update_action', 'Homestay_facility::update_action', ['filter' => 'role:administrator']);
$routes->post('/homestay_facility/create_action', 'Homestay_facility::create_action', ['filter' => 'role:administrator']);


// $routes->get('/culinary/delete_facility/(:any)/(:any)', 'Culinary::delete_facility/$1/$2', ['filter' => 'role:administrator']);
// $routes->get('/culinary_detail_facility', 'Culinary_detail_facility::index', ['filter' => 'role:administrator']);
// $routes->get('/culinary_detail_facility/create', 'Culinary_detail_facility::create', ['filter' => 'role:administrator']);
// $routes->get('/culinary_detail_facility/read/(:any)', 'Culinary_detail_facility::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/culinary_detail_facility/delete/(:any)', 'Culinary_detail_facility::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/culinary_detail_facility/update/(:any)', 'Culinary_detail_facility::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/culinary_detail_facility/update_action', 'Culinary_detail_facility::update_action', ['filter' => 'role:administrator']);
// $routes->get('/culinary_facility', 'Culinary_facility::index', ['filter' => 'role:administrator']);
// $routes->get('/culinary_facility/create', 'Culinary_facility::create', ['filter' => 'role:administrator']);
// $routes->get('/culinary_facility/read/(:any)', 'Culinary_facility::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/culinary_facility/delete/(:any)', 'Culinary_facility::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/culinary_facility/update/(:any)', 'Culinary_facility::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/culinary_facility/update_action', 'Culinary_facility::update_action', ['filter' => 'role:administrator']);
// $routes->post('/culinary_facility/create_action', 'Culinary_facility::create_action', ['filter' => 'role:administrator']);

// $routes->get('/culinary_gallery', 'Culinary_gallery::index', ['filter' => 'role:administrator']);
// $routes->get('/culinary_gallery/create', 'Culinary_gallery::create', ['filter' => 'role:administrator']);
// $routes->get('/culinary_gallery/read/(:any)', 'Culinary_gallery::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/culinary_gallery/delete/(:any)', 'Culinary_gallery::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/culinary_gallery/update/(:any)', 'Culinary_gallery::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/culinary_gallery/update_action', 'Culinary_gallery::update_action', ['filter' => 'role:administrator']);
$routes->get('/event', 'Event::index', ['filter' => 'role:administrator']);
$routes->get('/event/create', 'Event::create', ['filter' => 'role:administrator']);
$routes->get('/event/read/(:any)', 'Event::read/$1', ['filter' => 'role:administrator']);
$routes->get('/event/delete/(:any)', 'Event::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/event/update/(:any)', 'Event::update/$1', ['filter' => 'role:administrator']);
$routes->post('/event/update_action', 'Event::update_action', ['filter' => 'role:administrator']);
$routes->post('/event/create_action', 'Event::create_action', ['filter' => 'role:administrator']);
$routes->get('/event/delete_image/(:any)', 'Event::delete_image/$1', ['filter' => 'role:administrator']);
$routes->get('/event_category', 'Event_category::index', ['filter' => 'role:administrator']);
$routes->get('/event_category/create', 'Event_category::create', ['filter' => 'role:administrator']);
$routes->post('/event_category/create_action', 'Event_category::create_action', ['filter' => 'role:administrator']);
$routes->get('/event_category/read/(:any)', 'Event_category::read/$1', ['filter' => 'role:administrator']);
$routes->get('/event_category/delete/(:any)', 'Event_category::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/event_category/update/(:any)', 'Event_category::update/$1', ['filter' => 'role:administrator']);
$routes->post('/event_category/update_action', 'Event_category::update_action', ['filter' => 'role:administrator']);
$routes->get('/event/delete_video/(:any)', 'Event::delete_video/$1', ['filter' => 'role:administrator']);
// $routes->get('/event_gallery', 'Event_gallery::index', ['filter' => 'role:administrator']);
// $routes->get('/event_gallery/create', 'Event_gallery::create', ['filter' => 'role:administrator']);
// $routes->post('/event_gallery/create_action', 'Event_gallery::create_action', ['filter' => 'role:administrator']);
// $routes->get('/event_gallery/read/(:any)', 'Event_gallery::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/event_gallery/delete/(:any)', 'Event_gallery::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/event_gallery/update/(:any)', 'Event_gallery::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/event_gallery/update_action', 'Event_gallery::update_action', ['filter' => 'role:administrator']);
// $routes->get('/event_video', 'Event_video::index', ['filter' => 'role:administrator']);
// $routes->get('/event_video/create', 'Event_video::create', ['filter' => 'role:administrator']);
// $routes->post('/event_video/create_action', 'Event_video::create_action', ['filter' => 'role:administrator']);
// $routes->get('/event_video/read/(:any)', 'Event_video::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/event_video/delete/(:any)', 'Event_video::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/event_video/update/(:any)', 'Event_video::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/event_video/update_action', 'Event_video::update_action', ['filter' => 'role:administrator']);
// $routes->get('/souvenir_facility', 'Souvenir_facility::index', ['filter' => 'role:administrator']);
// $routes->get('/souvenir_facility/create', 'Souvenir_facility::create', ['filter' => 'role:administrator']);
// $routes->post('/souvenir_facility/create_action', 'Souvenir_facility::create_action', ['filter' => 'role:administrator']);
// $routes->get('/souvenir_facility/read/(:any)', 'Souvenir_facility::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/souvenir_facility/delete/(:any)', 'Souvenir_facility::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/souvenir_facility/update/(:any)', 'Souvenir_facility::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/souvenir_facility/update_action', 'Souvenir_facility::update_action', ['filter' => 'role:administrator']);
// $routes->get('/souvenir_gallery', 'Souvenir_gallery::index', ['filter' => 'role:administrator']);
// $routes->get('/souvenir_gallery/create', 'Souvenir_gallery::create', ['filter' => 'role:administrator']);
// $routes->post('/souvenir_gallery/update_action', 'Souvenir_gallery::update_action', ['filter' => 'role:administrator']);
// $routes->get('/souvenir_gallery/read/(:any)', 'Souvenir_gallery::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/souvenir_gallery/delete/(:any)', 'Souvenir_gallery::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/souvenir_gallery/update/(:any)', 'Souvenir_gallery::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/souvenir_gallery/update_action', 'Souvenir_gallery::update_action', ['filter' => 'role:administrator']);

$routes->get('/souvenir_place', 'Souvenir_place::index', ['filter' => 'role:administrator']);
$routes->get('/souvenir_place/create', 'Souvenir_place::create', ['filter' => 'role:administrator']);
$routes->post('/souvenir_place/create_action', 'Souvenir_place::create_action', ['filter' => 'role:administrator']);
$routes->get('/souvenir_place/read/(:any)', 'Souvenir_place::read/$1', ['filter' => 'role:administrator']);
$routes->get('/souvenir_place/delete/(:any)', 'Souvenir_place::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/souvenir_place/update/(:any)', 'Souvenir_place::update/$1', ['filter' => 'role:administrator']);
$routes->post('/souvenir_place/update_action', 'Souvenir_place::update_action', ['filter' => 'role:administrator']);
$routes->get('/souvenir_place/delete_image/(:any)', 'Souvenir_place::delete_image/$1', ['filter' => 'role:administrator']);

$routes->get('/tourism_object/delete_video/(:any)', 'Tourism_object::delete_video/$1', ['filter' => 'role:administrator']);
$routes->get('/souvenir_place/add_facility/(:any)/(:any)', 'Souvenir_place::add_facility/$1/$2', ['filter' => 'role:administrator']);
$routes->get('/souvenir_place/delete_facility/(:any)/(:any)', 'Souvenir_place::delete_facility/$1/$2', ['filter' => 'role:administrator']);
$routes->get('/tourism_facility', 'tourism_facility::index', ['filter' => 'role:administrator']);
$routes->get('/tourism_facility/create', 'Tourism_facility::create', ['filter' => 'role:administrator']);
$routes->post('/tourism_facility/create_action', 'Tourism_facility::create_action', ['filter' => 'role:administrator']);
$routes->get('/tourism_facility/read/(:any)', 'Tourism_facility::read/$1', ['filter' => 'role:administrator']);
$routes->get('/tourism_facility/delete/(:any)', 'Tourism_facility::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/tourism_facility/update/(:any)', 'Tourism_facility::update/$1', ['filter' => 'role:administrator']);
$routes->post('/tourism_facility/update_action', 'Tourism_facility::update_action', ['filter' => 'role:administrator']);
// $routes->get('/tourism_gallery', 'Tourism_gallery::index', ['filter' => 'role:administrator']);
// $routes->get('/tourism_gallery/create', 'Tourism_gallery::create', ['filter' => 'role:administrator']);
// $routes->post('/tourism_gallery/create_action', 'Tourism_gallery::update_action', ['filter' => 'role:administrator']);
// $routes->get('/tourism_gallery/read/(:any)', 'Tourism_gallery::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/tourism_gallery/delete/(:any)', 'Tourism_gallery::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/tourism_gallery/update/(:any)', 'Tourism_gallery::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/tourism_gallery/update_action', 'Tourism_gallery::update_action', ['filter' => 'role:administrator']);
$routes->get('/tourism_object', 'Tourism_object::index', ['filter' => 'role:administrator']);
$routes->get('/tourism_object/create', 'Tourism_object::create', ['filter' => 'role:administrator']);
$routes->get('/tourism_object/read/(:any)', 'Tourism_object::read/$1', ['filter' => 'role:administrator']);
$routes->get('/tourism_object/delete/(:any)', 'Tourism_object::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/tourism_object/update/(:any)', 'Tourism_object::update/$1', ['filter' => 'role:administrator']);
$routes->post('/tourism_object/update_action', 'Tourism_object::update_action', ['filter' => 'role:administrator']);
$routes->post('/tourism_object/create_action', 'Tourism_object::create_action', ['filter' => 'role:administrator']);
$routes->get('/tourism_object/delete_image/(:any)', 'Tourism_object::delete_image/$1', ['filter' => 'role:administrator']);
$routes->get('/tourism_object/add_facility/(:any)/(:any)', 'Tourism_object::add_facility/$1/$2', ['filter' => 'role:administrator']);
$routes->get('/tourism_object/delete_facility/(:any)/(:any)', 'Tourism_object::delete_facility/$1/$2', ['filter' => 'role:administrator']);
// $routes->get('/tourism_video', 'Tourism_video::index', ['filter' => 'role:administrator']);
// $routes->get('/tourism_video/create', 'Tourism_video::create', ['filter' => 'role:administrator']);
// $routes->post('/tourism_video/create_action', 'Tourism_video::create_action', ['filter' => 'role:administrator']);
// $routes->get('/tourism_video/read/(:any)', 'Tourism_video::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/tourism_video/delete/(:any)', 'Tourism_video::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/tourism_video/update/(:any)', 'Tourism_video::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/tourism_video/update_action', 'Tourism_video::update_action', ['filter' => 'role:administrator']);

$routes->get('/worship_category', 'Worship_category::index', ['filter' => 'role:administrator']);
$routes->get('/worship_category/create', 'Worship_category::create', ['filter' => 'role:administrator']);
$routes->post('/worship_category/create_action', 'Worship_category::create_action', ['filter' => 'role:administrator']);
$routes->get('/worship_category/read/(:any)', 'Worship_category::read/$1', ['filter' => 'role:administrator']);
$routes->get('/worship_category/delete/(:any)', 'Worship_category::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/worship_category/update/(:any)', 'Worship_category::update/$1', ['filter' => 'role:administrator']);
$routes->post('/worship_category/update_action', 'Worship_category::update_action', ['filter' => 'role:administrator']);
// $routes->get('/worship_facility', 'Worship_facility::index', ['filter' => 'role:administrator']);
// $routes->get('/worship_facility/create', 'Worship_facility::create', ['filter' => 'role:administrator']);
// $routes->post('/worship_facility/create_action', 'Worship_facility::create_action', ['filter' => 'role:administrator']);
// $routes->get('/worship_facility/read/(:any)', 'Worship_facility::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/worship_facility/delete/(:any)', 'Worship_facility::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/worship_facility/update/(:any)', 'Worship_facility::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/worship_facility/update_action', 'Worship_facility::update_action', ['filter' => 'role:administrator']);
// $routes->get('/worship_gallery', 'Worship_gallery::index', ['filter' => 'role:administrator']);
// $routes->get('/worship_gallery/create', 'Worship_gallery::create', ['filter' => 'role:administrator']);
// $routes->post('/worship_gallery/create_action', 'Worship_gallery::update_action', ['filter' => 'role:administrator']);
// $routes->get('/worship_gallery/read/(:any)', 'Worship_gallery::read/$1', ['filter' => 'role:administrator']);
// $routes->get('/worship_gallery/delete/(:any)', 'Worship_gallery::delete/$1', ['filter' => 'role:administrator']);
// $routes->get('/worship_gallery/update/(:any)', 'Worship_gallery::update/$1', ['filter' => 'role:administrator']);
// $routes->post('/worship_gallery/update_action', 'Worship_gallery::update_action', ['filter' => 'role:administrator']);
$routes->get('/worship_place', 'Worship_place::index', ['filter' => 'role:administrator']);
$routes->get('/worship_place/create', 'Worship_place::create', ['filter' => 'role:administrator']);
$routes->get('/worship_place/read/(:any)', 'Worship_place::read/$1', ['filter' => 'role:administrator']);
$routes->get('/worship_place/delete/(:any)', 'Worship_place::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/worship_place/update/(:any)', 'Worship_place::update/$1', ['filter' => 'role:administrator']);
$routes->post('/worship_place/update_action', 'Worship_place::update_action', ['filter' => 'role:administrator']);
$routes->post('/worship_place/create_action', 'Worship_place::create_action', ['filter' => 'role:administrator']);
$routes->get('/worship_place/delete_image/(:any)', 'Worship_place::delete_image/$1', ['filter' => 'role:administrator']);
// $routes->get('/worship_place/add_facility/(:any)/(:any)', 'Worship_place::add_facility/$1/$2', ['filter' => 'role:administrator']);
// $routes->get('/worship_place/delete_facility/(:any)/(:any)', 'Worship_place::delete_facility/$1/$2', ['filter' => 'role:administrator']);
$routes->get('/package', 'Package::index', ['filter' => 'role:administrator']);
$routes->get('/package/create', 'Package::create', ['filter' => 'role:administrator']);
$routes->get('/package/read/(:any)', 'Package::read/$1', ['filter' => 'role:administrator']);
$routes->get('/package/booking_read/(:any)', 'Package::booking_read/$1', ['filter' => 'role:administrator']);
$routes->get('/package/delete/(:any)', 'Package::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/package/update/(:any)', 'Package::update/$1', ['filter' => 'role:administrator']);
$routes->post('/package/update_action', 'Package::update_action', ['filter' => 'role:administrator']);
$routes->post('/package/create_action', 'Package::create_action', ['filter' => 'role:administrator']);
$routes->get('/detail_package', 'Detail_package::index', ['filter' => 'role:administrator']);
$routes->get('/detail_package/create', 'Detail_package::create', ['filter' => 'role:administrator']);
// $routes->get('/detail_package/read/(:any)', 'Detail_package::read/$1', ['filter' => 'role:administrator']);
$routes->get('/detail_package/delete/(:any)/(:any)/(:any)', 'Detail_package::delete/$1/$2/$3', ['filter' => 'role:administrator']);
$routes->get('/detail_package/update/(:any)/(:any)/(:any)', 'Detail_package::update/$1/$2/$3', ['filter' => 'role:administrator']);
$routes->post('/detail_package/update_action', 'Detail_package::update_action', ['filter' => 'role:administrator']);
$routes->post('/detail_package/create_action', 'Detail_package::create_action', ['filter' => 'role:administrator']);
$routes->get('/package_day', 'Package_day::index', ['filter' => 'role:administrator']);
$routes->get('/package_day/create', 'Package_day::create', ['filter' => 'role:administrator']);
// $routes->get('/package_day/read/(:any)', 'Package_day::read/$1', ['filter' => 'role:administrator']);
$routes->get('/package_day/delete/(:any)/(:any)', 'Package_day::delete/$1/$2', ['filter' => 'role:administrator']);
$routes->get('/package_day/update/(:any)', 'Package_day::update/$1', ['filter' => 'role:administrator']);
$routes->post('/package_day/update_action', 'Package_day::update_action', ['filter' => 'role:administrator']);
$routes->post('/package_day/create_action', 'Package_day::create_action', ['filter' => 'role:administrator']);
$routes->get('/service_package', 'Service_package::index', ['filter' => 'role:administrator']);
$routes->get('/service_package/create', 'Service_package::create', ['filter' => 'role:administrator']);
$routes->get('/service_package/read/(:any)', 'Service_package::read/$1', ['filter' => 'role:administrator']);
$routes->get('/service_package/delete/(:any)', 'Service_package::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/service_package/update/(:any)', 'Service_package::update/$1', ['filter' => 'role:administrator']);
$routes->post('/service_package/update_action', 'Service_package::update_action', ['filter' => 'role:administrator']);
$routes->post('/service_package/create_action', 'Service_package::create_action', ['filter' => 'role:administrator']);
// $routes->get('/detail_service_package', 'Service_package::index', ['filter' => 'role:administrator']);
$routes->get('/detail_service_package/create', 'Detail_service_package::create', ['filter' => 'role:administrator']);
// $routes->get('/detail_service_package/read/(:any)', 'Detail_service_package::read/$1', ['filter' => 'role:administrator']);
$routes->get('/detail_service_package/delete/(:any)', 'Detail_service_package::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/detail_service_package/update/(:any)', 'Detail_service_package::update/$1', ['filter' => 'role:administrator']);
$routes->post('/detail_service_package/update_action', 'Detail_service_package::update_action', ['filter' => 'role:administrator']);
$routes->post('/detail_service_package/create_action', 'Detail_service_package::create_action', ['filter' => 'role:administrator']);
$routes->get('/package/create_all', 'Package::create_all', ['filter' => 'role:administrator']);
$routes->get('/package/get_object', 'Package::get_object');
$routes->post('/package/create_action_all', 'Package::create_action_all', ['filter' => 'role:administrator']);
$routes->get('/booking', 'Booking::index', ['filter' => 'role:administrator']);
$routes->get('/booking/create', 'Booking::create', ['filter' => 'role:administrator']);
$routes->get('/booking/read/(:any)/(:any)/(:any)', 'Booking::read/$1/$2/$3', ['filter' => 'role:administrator']);
$routes->get('/booking/delete/(:any)', 'Booking::delete/$1', ['filter' => 'role:administrator']);
$routes->get('/booking/update/(:any)', 'Booking::update/$1', ['filter' => 'role:administrator']);
$routes->post('/booking/update_action', 'Booking::update_action', ['filter' => 'role:administrator']);
$routes->post('/booking/create_action', 'Booking::create_action', ['filter' => 'role:administrator']);
$routes->get('/booking/confirm_booking/(:any)/(:any)/(:any)', 'Booking::confirm_booking/$1/$2/$3', ['filter' => 'role:administrator']);
$routes->get('/booking/decline_booking/(:any)/(:any)/(:any)', 'Booking::decline_booking/$1/$2/$3', ['filter' => 'role:administrator']);

$routes->get('/web/detail_booking_read/(:any)', 'Package::detail_booking_read/$1');



// $routes->get('/login', 'Home::login');
// $routes->get('/register', 'Home::register');

// $routes->get('/', 'Tourism::web');

$routes->group('web', ['namespace' => 'App\Controllers\Web'], function ($routes) {
    $routes->get('/', 'Tourism::web');
    $routes->get('list_agro', 'Tourism::list_agro');
    $routes->get('radius_agro', 'Tourism::radius');
    $routes->get('day_route/(:any)/(:any)', 'Tourism::day_route/$1/$2');
    $routes->get('search_agro', 'Tourism::search');
    $routes->get('search_all/(:any)', 'Tourism::search_all/$1');
    $routes->get('search_name_menu/(:any)', 'Tourism::search_name_menu/$1');
    $routes->get('search_facility_menu/(:any)', 'Tourism::search_facility_menu/$1');
    $routes->get('buy_package/(:any)/(:any)/(:any)/(:any)', 'Tourism::buy_package/$1/$2/$3/$4');
    $routes->get('detail_booking/', 'Tourism::detail_booking/');
    $routes->get('select_selected', 'Tourism::select_selected');
    $routes->get('search_name_part/(:any)', 'Tourism::search_name_part/$1');
    $routes->get('detail_booking/(:any)', 'Booking::delete/$1');
    $routes->get('search_facility_part/(:any)', 'Tourism::search_facility_part/$1');
    $routes->get('search_facility_part_all/(:any)', 'Tourism::search_facility_part_all/$1');
    $routes->get('search_tourism', 'Tourism::search_tourism');
    $routes->get('search_name/(:any)', 'Tourism::search_name/$1');
    $routes->get('search_name_all/(:any)', 'Tourism::search_name_all/$1');
    $routes->get('detail/(:any)', 'Tourism::detail/$1');
    $routes->get('detail_type/(:any)/(:any)', 'Tourism::detail_type/$1/$2');
    $routes->get('select_facility/(:any)/(:any)/(:any)', 'Tourism::select_facility/$1/$2/$3');
    $routes->get('select_facility_all/(:any)/(:any)/(:any)', 'Tourism::select_facility_all/$1/$2/$3');
    $routes->get('select_facility_agro/(:any)/(:any)/(:any)', 'Tourism::select_facility_agro/$1/$2/$3');
    $routes->get('search_name_only/(:any)', 'Tourism::search_name_only/$1');
    $routes->get('search_name_only_all/(:any)', 'Tourism::search_name_only_all/$1');
    $routes->get('search_name_tourism/(:any)', 'Tourism::search_name_tourism/$1');
    $routes->get('search_name_only_tourism/(:any)', 'Tourism::search_name_only_tourism/$1');
    $routes->get('list_package_read/(:any)', 'Tourism::read_list_package/$1');
    $routes->get('select_package_read/(:any)', 'Tourism::select_package_read/$1');

    $routes->get('list_tourism', 'Tourism::list_tourism');
    $routes->post('custom_order', 'Tourism::custom_order');
    $routes->get('list_package', 'Tourism::list_package');
    $routes->get('detail_package/(:any)', 'Tourism::detail_package/$1');
    $routes->get('radius_tourism', 'Tourism::radius_tourism');
    $routes->get('select_id_tourism/(:any)', 'Tourism::select_tourism/$1');
    $routes->get('radius_data/(:any)/(:any)', 'Tourism::radius_data/$1/$2');
    $routes->get('radius_data_tourism/(:any)/(:any)', 'Tourism::radius_data_tourism/$1/$2');
    $routes->get('object', 'Home::object');
    $routes->get('object/detail', 'Home::objectDetail');
    $routes->get('cancel_booking/(:any)', 'Tourism::cancel_booking/$1');




    // $routes->get('prediction', 'Home::prediction');

    $routes->group('profile', function ($routes) {
        $routes->get('/', 'Home::profile');
        $routes->get('update', 'Home::update');
        $routes->get('changePassword', 'Home::changePassword');
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
