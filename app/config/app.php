<?php

/**
 * RocketPack Configuration File
 */
// Default application controller
define('app_defaultcontroller', 'launch');

// Default application controller upon requesting an non-existent controller (basically a 404 error)
// Be aware that setting this to a non-existent controller WILL cause a constant application loop!
// If this is not set, a default HTML message will be shown instead of redirecting the user to a custom
// error controller.
define('app_defaultcontrollernotfound', '');

// Application mode, If set to 'prod' no PHP errors will be shown and only non certain errors/notices will be logged to the Log directory (app_logpath)
define('app_debugmode', 'dev');

// Database connection settings (PDO)
define('app_db_driver', 'mysql');
define('app_db_host', 'localhost');
define('app_db_name', 'rocketpack');
define('app_db_user', 'root');
define('app_db_pass', '');

define('app_urlrewrite', false); // If not used, URL parameters will be used instead.
define('app_dbsessions', false); // Use the rocketpack database for storage of session infomation?
define('app_cdnpath', ''); // Instead of using public/* you can enable an external CDN instead eg. http://cdn.yoursite.com/folder/ this will then serve content from this location instead.
define('app_salt', 'put your unique phrase/key here'); // Any hashing done by the framwork will automatically 'salt' with this key to protect against md5 dictionary attacks etc.

define('app_cachepath', 'cache/');
define('app_logpath', 'log/');
define('app_tmppath', 'tmp/');

// The full CLASSPATH, Comma seperated class folders, the classes in these folder will be automatically loaded.
define('app_classpath', 'app/helper/,app/model/,vendor/,vendor/phpMailer/,lib/');
?>