<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/hcube/smart/templates/configuration.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/hcube/smart/templates/configuration.php';

$pages = $environment_link . 'templates/pages/';




// PHP_URL_SCHEME, PHP_URL_HOST, PHP_URL_PORT, PHP_URL_USER, PHP_URL_PASS, PHP_URL_PATH, PHP_URL_QUERY or PHP_URL_FRAGMENT 

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = 'https://';
else $url = 'http://';

$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];

$path = parse_url($url, PHP_URL_PATH);
$path = str_replace('/projects/hcube/smart', '', $path);
echo $environment_link;


$hander = [];

$handler['home_page'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'home_page/index.php';
    echo 'i am fine';
};

$handler['facility_page'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'facility_page/index.php';
};

$handler['booking_page'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'booking_page/index.php';
};

$router = [
    '/'              => $handler['home_page'],
    '/facilities'    => $handler['facility_page'],
    '/booking'       => $handler['booking_page'],
];

isset($router[$path])? $router[$path]() : $router['/']();

//https://dribbble.com/shots/15761617-Fleet-Travel-Shopping-UI-Kit/attachments/7567388?mode=media