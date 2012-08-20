<?php

require 'app/config/app.php';

if (!defined('app_path'))
    define('app_path', dirname(__FILE__) . '/');


ini_set('error_log', app_logpath . 'php_errors.log');
if (app_debugmode != 'prod') {
    error_reporting(E_ALL);
    ini_set('log_errors', 0);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    ini_set('log_errors', 1);
    ini_set('display_errors', 0);
}

require 'app/config/routes.php';
require 'lib/bootstrap.php';

$session = new sessionmanager();
session_start();

require 'lib/dispatcher.php';
?>