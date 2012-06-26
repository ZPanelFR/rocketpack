<?php

require 'config.php';
require 'lib/core/bootstrap.php';
$session = new sessionmanager();
session_start();
require 'lib/core/dispatcher.php';
$_SESSION['example'] = "Hello this is my example session stuff right here!";
?>