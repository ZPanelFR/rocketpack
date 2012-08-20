<?php

/**
 * Forces the server to use UTC time if the server hasn't had its timezone set, PHP 5.3 is fussy like that!
 */
if (@date_default_timezone_set(date_default_timezone_get()) === false) {
    date_default_timezone_set('UTC');
}

/**
 * The class auto-loader.
 */
function __autoload($class_name) {
    if (isset($_GET['controller'])) {
        if (file_exists("app/controller/" . $_GET['controller'] . ".php")) {
            require_once "app/controller/" . $_GET['controller'] . ".php";
        }
    }
    $class_paths = explode(",", app_classpath);
    foreach ($class_paths as $value) {
        IterateClassDirs($value, $class_name);
    }
}

/**
 * Iterates through the class directories to enable cleaner storage of classes by enabling nesting class folders.
 */
function IterateClassDirs($main, $class_name) {
    $di = new RecursiveDirectoryIterator($main);
    foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
        if ($class_name == str_replace('.class.php', '', basename($file))) {
            require_once $file;
            break;
        }
    }
}

?>
