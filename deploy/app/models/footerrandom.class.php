<?php

class footerrandom extends controller {
    
    function __construct() {
        parent::__construct();
    }


    public function ShowMe() {
        return "This is your new footer, sweet huh?, Your controller request was: " . $this->controller_request ."";
    }

    static function StaticFooter(){
        return "This is a static fotoer!";
    }
}

?>
