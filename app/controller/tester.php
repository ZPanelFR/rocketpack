<?php

class tester extends rocketpack {

    var $renderwith = "index";

    public function actionSayHello() {
        die("Hello user, your ID is" . $this->id . " and your other ID is " . $this->otherid . "");
    }

}

?>
