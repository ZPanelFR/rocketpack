<?php

class test extends controller {

    var $renderwith = 'test.html';

    function __construct() {
        parent::__construct();
        $this->Session()->Write("hello", "bobby");
    }

    public function outTest() {
        return "Controller Request: " . $this->controller_request . "<br>Sub-requests: " . var_dump($this->sub_requests) . "<br><br>You said your name was: " . $this->Session()->Read('hello') . ".";
    }

}

?>
