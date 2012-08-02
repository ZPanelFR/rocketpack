<?php

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
        $count = 0;
        RecurseClassDirectories($value, $class_name, $count);
    }
}

/**
 * Iterates through the class directories to enable cleaner storage of classes.
 */
function RecurseClassDirectories($main, $class_name, $count) {
    $directoryhandle = opendir($main);
    while ($file = readdir($directoryhandle)) {
        if (is_dir($file) && $file != '.' && $file != '..') {
            recurseDirs($file);
        } else {
            $count++;
            if (file_exists($main . $class_name . '.class.php')) {
                require_once $main . $class_name . '.class.php';
            }
        }
    }
}

?>
