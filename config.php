<?php

/**
 * RocketPack Configuration File
 */
// Redirect on a non-specific controller request
define('app_defaultcontroller', 'index');

// MySQL database settings for the ZHM databse 
define('app_db_host', 'localhost');
define('app_db_name', 'rocketpack');
define('app_db_user', 'root');
define('app_db_pass', '');

define('app_sessionhandle', 'file'); // What session storage medium do you want to use? ('file' or 'db')
define('app_salt', 'put your unique phrase/key here');
define('app_cachepath', 'cache/');
define('app_logpath', 'log/');
define('app_tmppath', 'tmp/');
define('app_urlrewrite', true);
define('app_classpath', 'model/,lib/core/,lib/vendor/'); // Comma seperated class folders, the classes in these folder will be automatically loaded.
// Set the application absolute path..
if (!defined('app_path'))
    define('app_path', dirname(__FILE__) . '/');
?>