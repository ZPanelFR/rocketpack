<?php

class Controller {

    /**
     * Stores the current controller request.
     * @var string The name of the controller request. 
     */
    var $controller_request;

    /**
     * Stores any additonal requests which are passed on to the model.
     * @var type 
     */
    var $sub_requests;

    /**
     * Stores the POST variables. 
     */
    var $postvars;

    /**
     * Stores the GET variables. 
     */
    var $getvars;

    function __construct() {
        $this->postvars = $_POST;
        $this->getvars = $_GET;
    }

    public function GetMainRequest() {
        $this->controller_request = urlmapper::ControllerRequestFromRequestURI();
        $this->sub_requests = urlmapper::ModelRequestsFromRequestURI();
    }

    public function GetModelInstance($model) {
        if (class_exists($model, true)) {
            return new $model();
        } else {
            return false;
        }
    }

}

?>
