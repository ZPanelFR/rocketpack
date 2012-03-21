<?php

class login extends controller {
    
    static $renderwith = 'login.phtml';

    function __construct() {
        parent::__construct();
        echo "It worked!<br>";
        echo "The controller request was: ".$this->controller_request;
    }
    
    function getDoesItWork(){
        return true;
    }
    
    function getExampleOutput(){
        return "some output here, this should be echo'd";
    }
    
    function doExampleOutput(){
        return "some output here, this should be echo'd";
    }

}

?>
