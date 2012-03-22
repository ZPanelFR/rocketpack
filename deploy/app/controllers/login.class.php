<?php

class login extends controller {
    
    var $renderwith = 'login.html';

    function __construct() {
        parent::__construct();
    }
    
    public function WelcomeBlock(){
        return "Welcome to this test site, thanks for visiting!";
    }
    public function WelcomeBlock3(){
        return "Hi there, my name is boddty";
    }
    
    public function SomeHTML(){
        return "<h1>" .$this->WelcomeBlock(). "</h1>";
    }
    
    public function CheckThis(){
        return "something here";
    }

}

?>
