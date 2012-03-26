<?php

class test extends controller {
    
    var $renderwith = 'test.html';
    
    public function outTest(){
        return "Controller Request: " .$this->controller_request. "<br>Sub-requests: " .  var_dump($this->sub_requests). "<br>";
    }
    
}

?>
