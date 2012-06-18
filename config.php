<?php

/**
 * RocketPack Configuration File
 */

// Redirect on a non-specific controller request
define('zhm_std_ctrlr', 'index');

// The theme to use (name of the theme folder ins '/style/')
define('zhm_style', 'default');

// MySQL database settings for the ZHM databse 
define('zhm_db_host', 'localhost');
define('zhm_db_name', 'DBNAME');
define('zhm_db_user', 'USERNAME');
define('zhm_db_pass', 'PASSWORD');


define('app_salt', 'put your unique phrase/key here');
define('app_urlrewrite', true);
define('app_classpath', 'lib/core/,lib/model/,lib/vendor/'); // Comma seperated class folders.

// Set the application absolute path..
if (!defined('app_path'))
    define('app_path', dirname(__FILE__) . '/');
?>