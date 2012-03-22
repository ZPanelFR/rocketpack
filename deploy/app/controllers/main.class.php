<?php

class main extends controller {

    var $renderwith = 'main.html';

    function __construct() {
        parent::__construct();
    }

    public function WelcomeToRocketPack() {
        return "RocketPack is now ready for lift-off!";
    }

    public function Names() {
        return array(array("firstname" => "Ian", "lastname" => "Smith", "mobile" => "04411145"), array("firstname" => "Peter", "lastname" => "Brown", "mobile" => "78944"));
    }

    public function ShowFooter() {
        // From the 'model' folder. - Shared across all controller!
        $footer_instance = new footerrandom();

        // You can also call static functions too...
        //return footerrandom::StaticFooter();

        return $footer_instance->ShowMe();
    }

    public function ShowCSSFiles() {
        return urlmapper::OutputAllCSSLinks();
    }

}

?>
