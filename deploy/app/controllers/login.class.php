<?php

class login extends controller {
    
    var $renderwith = 'login.html';

    function __construct() {
        parent::__construct();
    }
    
    public function outWelcomeBlock(){
        return "Welcome to this test site, thanks for visiting!";
    }
    public function outWelcomeBlock3(){
        return "Hi there, my name is boddty";
    }
    
    public function outSomeHTML(){
        return "<h1>" .$this->outWelcomeBlock(). "</h1>";
    }
    
    public function outCheckThis(){
        return "something here";
    }

}

?>
