<?php

session_start();

require 'config.php';
require 'lib/core/bootstrap.php';

$simplecache = new cache();
$timer = new iotimer();
$simplecache->set_cache_dir(app_cachepath);
$timer->start_watch();

require 'lib/core/tplparser.php';

if (isset($this_object->cache) && $this_object->cache == TRUE) {
    $simplecache->stop_cache();
}
$timer->stop_watch();

?>