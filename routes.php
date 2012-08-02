<?php

require_once 'lib/route.class.php';
$app_routes = new route();

/**
 * Add your application routes below!
 */
$app_routes->AddRoute('/example/hello', array(
    'controller' => 'tester',
    'action' => 'SayHello',
    'id' => '33',
    'otherid' => 'edit',
));

$app_routes->AddRoute('/example/goodbye', array(
    'controller' => 'tester',
    'action' => 'SayGoodbye',
    'id' => '',
    'otherid' => '',
));


/**
 * End of application routes!
 */
$app_routes->ProcessRoutes();
?>
