<?php

class error extends controller {
    
    var $renderwith = 'error.html';
    
    function __construct() {
        parent::__construct();
    }
    
    public function title(){
        return "No model (" .$this->controller_request. ") found!";
    }

}

?>
