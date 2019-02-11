<?php
require_once 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

if (getenv('APP_DEBUG')) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

/**
 * Get the given path appended with the resources path.
 *
 * @param string $path
 * @return void
 */
function resources_path($path = '') {
    return __DIR__.'/resources/'.$path;
}

/**
 * Get the given title appended with the app name.
 *
 * @param string $title
 * @return void
 */
function get_title($title) {
    return getenv('APP_TITLE').' - '.$title;
}

/**
 * Get html lang tag with the app lang.
 *
 * @return void
 */
function get_lang() {
    return 'lang="'.getenv('APP_LANG').'"';
}

/**
 * Determinate if the give route is the active page.
 *
 * @param string $route
 * @return void
 */
function get_active($route) {
    if (($route === '/') && (($_SERVER['REQUEST_URI'] == '/') || ($_SERVER['REQUEST_URI'] == '/index.php')))
    {
        return 'active';
    }
    else if ($route === $_SERVER['REQUEST_URI'])
    {
        return 'active';
    }
    else
    {
        return '';
    }
}

/**
 * Debug helper function.
 *
 * @param mixed $obj
 * @return void
 */
function dump($obj) {
    var_dump($obj);
}

/**
 * Undocumented function
 *
 * @param mixed $obj
 * @return void
 */
function dd($obj) {
    dump($obj);
    die();
}

/**
 * Redirect to the route.
 *
 * @param string $route
 * @return void
 */
function redirect($route) {
    header('Location: '.$route);
    die();
}

function root_path($path = '') {
    return __DIR__.'/'.$path;
}

function public_path($path = '') {
    return $_SERVER['DOCUMENT_ROOT'].'/'.$path;
}