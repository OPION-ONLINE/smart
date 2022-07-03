<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/hcube/smart/templates/configuration.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/me/newscratch/templates/configuration.php';

// $environment_link = str_replace('/opt/lampp/htdocs/', '', $environment_link);

$pages = $environment_link . 'templates/pages/';

// PHP_URL_SCHEME, PHP_URL_HOST, PHP_URL_PORT, PHP_URL_USER, PHP_URL_PASS, PHP_URL_PATH, PHP_URL_QUERY or PHP_URL_FRAGMENT 

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = 'https://';
else $url = 'http://';

$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];

$path = parse_url($url, PHP_URL_PATH);
$path = str_replace('/me/newscratch', '', $path);



$hander = [];

$handler['home_page'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'home_page/index.php';
    echo 'i am fine';
};

$handler['signup_page'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'signup_page/index.php';
};

$handler['login_page'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'login_page/index.php';
};

$handler['facility_page'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'facility_page/index.php';
};

$handler['booking_page'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'booking_page/index.php';
};

$handler['leasing_page'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'leasing_page/index.php';
};

$handler['verification'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'verification/index.php';
};

$handler['newpassword'] = function() {
    global $pages, $environment_link;

    require_once $pages . 'newpassword/index.php';
};



$router = [
    '/'              => $handler['home_page'],
    '/signup'              => $handler['signup_page'],
    '/login'              => $handler['login_page'],
    '/facilities'    => $handler['facility_page'],
    '/booking'       => $handler['booking_page'],
    '/leasing'       => $handler['leasing_page'],
    '/verification'       => $handler['verification'],
    '/newpassword'       => $handler['newpassword'],

];

isset($router[$path])? $router[$path]() : $router['/']();

//https://dribbble.com/shots/15761617-Fleet-Travel-Shopping-UI-Kit/attachments/7567388?mode=media