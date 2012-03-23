<?php

class error extends controller {
    
    var $renderwith = 'error.html';
    
    function __construct() {
        parent::__construct();
    }
    
    public function outTheRequestedControllerName(){
        return $this->controller_request;
    }

}

?>
