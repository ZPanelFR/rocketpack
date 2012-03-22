<?php

/**
 * The autoloader function used in RocketPack.
 */
function __autoload($class_name) {
    global $app_config;
    $class_string = '';
    $class_folders = $app_config['class_folders'];
    foreach ($class_folders as $value) {
        $class_string = $value . '/' . $class_name . '.class.php';
        if (file_exists($class_string)) {
            require_once $class_string;
        }
    }
}

/**
 * Lets load the controller and boot the application. 
 */
$controller = new Controller;
$controller->GetControllerInstance($controller->controller_request);
?>
