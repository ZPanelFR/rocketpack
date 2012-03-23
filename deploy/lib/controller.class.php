<?php

class controller {

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

    /**
     * Stores application settings. 
     */
    var $settings;

    /**
     * Constructs the Controller class and grabs all the request types. 
     */
    function __construct() {
        global $app_config;
        $this->settings = $app_config;
        $this->controller_request = urlmapper::ControllerRequestFromRequestURI();
        $this->sub_requests = urlmapper::ModelRequestsFromRequestURI();
        $this->postvars = $_POST;
        $this->getvars = $_GET;
    }

    /**
     * Creates an instance for the requested model.
     * @param type $model
     * @return object 
     */
    public function GetControllerInstance($model) {
        if (!$model == "") {
            if (class_exists($model, true)) {
                return new $model;
            } else {
                director::Redirect(urlmapper::GetFullWebPath() . $this->settings['no_controller_error']);
            }
        } else {
            director::Redirect(urlmapper::GetFullWebPath() . $this->settings['main_controller']);
        }
    }

    /**
     * Processes any specific controller action requests (FORM POST actions etc.)
     * @return object 
     */
    public function ProcessControllerActionRequests() {
        if (isset($_GET['action'])) {
            $class = $this->controller_request;
            $this_object = new $class();
            if (class_exists('' . $class . '')) {
                if (method_exists($class, "do" . $_GET['action'])) {
                    call_user_func(array($this_object, "do" . $_GET['action']));
                }
            }
        }
        return;
    }

}

?>
