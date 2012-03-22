<?php

/**
 * Include configuration settings and then bootstraps the application.
 */
global $app_config;
require_once 'config/rocket.conf.php';
require_once 'app/app.conf.php';
require_once 'lib/_bootstrap.php';

$mvc = new mvc();
$mvc->ParseTemplate();
?>
