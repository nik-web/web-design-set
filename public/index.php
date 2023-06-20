<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * index.php
 * Rewrite all request to this file.
 * 
 * @package    web-design-set
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

use Laminas\Mvc\Application;

/**
 * Define application environment to production, to change needs to be set 
 * within virtual host or in the .htaccess file.
 * 
 */
if (! defined('APPLICATION_ENV')) {
    define(
        'APPLICATION_ENV', (getenv('APPLICATION_ENV')
        ? getenv('APPLICATION_ENV')
        : 'production')
    );
}

// Display all errors and xdebug when APPLICATION_ENV is development.
if (APPLICATION_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", '1');
    ini_set('xdebug.var_display_max_depth', '10');
    ini_set('xdebug.var_display_max_children', '256');
    ini_set('xdebug.var_display_max_data', '1024');
}

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (is_string($path) && __FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Composer autoloading
include __DIR__ . '/../vendor/autoload.php';

if (! class_exists(Application::class)) {
    throw new RuntimeException(
        "Unable to load application.\n"
        . "- Type `composer install` if you are developing locally.\n"
        . "- Type `docker-compose run laminas composer install` if you are using Docker.\n"
    );
}

$container = require __DIR__ . '/../config/container.php';
// Run the application!
$container->get('Application')->run();
