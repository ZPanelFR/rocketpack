<?php

require 'config.php';
require 'lib/core/bootstrap.php';

$session = new sessionmanager();
session_start();

require 'lib/core/dispatcher.php';
?>