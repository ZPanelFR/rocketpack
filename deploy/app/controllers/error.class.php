<?php

class error extends controller {
    
    var $renderwith = 'error.html';
    
    function __construct() {
        parent::__construct();
    }
    
    public function outTitle(){
        return "No model (" .$this->controller_request. ") found!";
    }
    
    public function doAction(){
        die("Its good, I was executed!");
    }

}

?>
