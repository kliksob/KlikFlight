<?php
/**
 * This is Index.php File If you Use public directory
 */
define('APPROOT', dirname(__DIR__));
define('APPPATH', APPROOT. '/app');
/**
 * Uncomment If You Do not Use Composer Autoloader
 * This is Alternative For Small Website
 */
// require_once APPPATH .'/src/vendor/autoload.php';

/**
 * We Recommended You To Use Composer
 * Comment This If You Do not Use Composer Autoloader
 */
require_once APPROOT. '/vendor/autoload.php';

/**
 * Stating The KlikFlight App
 * KlikFLight The Flight MicroFramework MVC Application
 */
$app = new KlikFlight\App();
$app->start();