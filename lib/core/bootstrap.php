<?php

/**
 * The class auto-loader.
 */
function __autoload($class_name) {
    if (isset($_GET['controller'])) {
        if (file_exists("controller/" . $_GET['controller'] . ".php")) {
            require_once "controller/" . $_GET['controller'] . ".php";
        }
    }
    $class_string = '';
    $class_paths = explode(",", app_classpath);
    foreach ($class_paths as $value) {
        $class_string = $value . '/' . $class_name . '.class.php';
        if (file_exists($class_string)) {
            require_once $class_string;
        }
    }
}



?>
