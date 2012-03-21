<?php

/**
 * Include configuration settings. 
 */
global $app_config;
require_once 'config/rocket.conf.php';
require_once 'config/app.conf.php';
require_once 'lib/_bootstrap.php';

/**
 * Create a new controller object. 
 */
$controller = new Controller;
$controller->GetMainRequest();
$controller->GetModelInstance($controller->controller_request);



?>
