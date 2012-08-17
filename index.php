<?php

require 'app/config/app.php';

if (!defined('app_path'))
    define('app_path', dirname(__FILE__) . '/');

require 'routes.php';
require 'lib/bootstrap.php';

$session = new sessionmanager();
session_start();

require 'lib/dispatcher.php';
?>