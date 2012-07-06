<?php

/**
 * RocketPack Configuration File
 */

// Default application controller
define('app_defaultcontroller', 'index');

// Database connection settings (PDO)
define('app_db_driver','mysql');
define('app_db_host', 'localhost');
define('app_db_name', 'rocketpack');
define('app_db_user', 'root');
define('app_db_pass', '');

define('app_urlrewrite', false); // If not used, URL parameters will be used instead.
define('app_dbsessions', false); // Use the rocketpack database for storage of session infomation?
define('app_salt', 'put your unique phrase/key here'); // Any hashing done by the framwork will automatically 'salt' with this key to protect against md5 dictionary attacks etc.

define('app_cachepath', 'cache/');
define('app_logpath', 'log/');
define('app_tmppath', 'tmp/');

// The full CLASSPATH, Comma seperated class folders, the classes in these folder will be automatically loaded.
define('app_classpath', 'app/model/,vendor/,vendor/phpMailer/,lib/');

// Set the application absolute path
if (!defined('app_path'))
    define('app_path', dirname(__FILE__) . '/');
?>