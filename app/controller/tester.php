<?php

/**
 * Just an example controller to demonstate the example application routes as configured in /app/config/routes.php.
 */
class tester extends rocketpack {

    public function actionSayHello() {
        die("Hello user, your ID is '" . $this->id . "' and your other ID is '" . $this->otherid . "'.");
    }

    public function actionSayGoodbye() {
        die("This is an example of an application route... Goodbye!");
    }

}

?>
