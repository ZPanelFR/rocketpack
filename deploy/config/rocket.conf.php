<?php
/**
 * This file contains the default framework configuration settings.
 * these settings should be overridden in app.conf.php!
 */
$app_config = array();

$app_config['app_name'] = "new_rocket_app"; // The name of the applicaiton.
$app_config['app_version'] = null; // The application version number
$app_config['system_path'] = dirname(__FILE__); // The system path to the root of this application, including the trailing slash.
$app_config['web_path'] = $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']); // The web path to the root of this applicaiton, including the trailing slash.
$app_config['class_folders'] = array('lib', 'app/models'); // Folders which should autoload classes from.
$app_config['temp_directory'] = "tmp/"; // The default temporary folder (Where temporary files will be stored by the framework).
$app_config['default_time_format'] = "d/m/Y"; // The default PHP date() format to use when a format isn't specified in the static function time::FormatTimestamp().
$app_config['default_log_file'] = "log/application.log.txt"; // The default log file that the application will write too if one is not specified.
?>
