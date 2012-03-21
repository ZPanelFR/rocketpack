<?php

class login extends Controller {
    
    static $renderwith = 'login.phtml';

    function __construct() {
        echo "It worked!";
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
