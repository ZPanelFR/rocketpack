<?php

require_once 'lib/route.class.php';
$app_routes = new route();

/**
 * Add your application routes below!
 */
$app_routes->AddRoute('/example/testroute', array(
    'controller' => 'tester',
    'action' => 'Sayhello',
    'id' => '33',
    'otherid' => 'edit',
));


/**
 * End of application routes!
 */
$app_routes->ProcessRoutes();
?>
