<?php

require 'config.php';
require 'lib/bootstrap.php';

$session = new sessionmanager();
session_start();

require 'lib/dispatcher.php';
?>