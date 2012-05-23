<?php

class form {

    /**
     * @var string The HTML form name. 
     */
    var $formname;

    /**
     * @var string The HTML class of the form.
     */
    var $formclass;

    /**
     * @var string HTML data for the form. 
     */
    var $formdata;
    
    /**
     * @var string The action to run against the controller (for POST requests) 
     */
    var $actiondo;

    function __construct() {
        $this->actiondo = null;
    }
    
    /**
     * Start a new HTML FORM tag.
     * @param string $name The name of the form.
     * @param string $controller The controller of which to handle the form data upon submission.
     * @param string $class The CSS class name for the form tag.
     * @param string $method Sets the submit method either 'post' or 'get' (is 'post' by default).
     * @return boolean 
     */
    public function FormStart($name, $controller = 'not-set', $class = null, $method = 'post') {
        $this->formname = $name;
        $this->formclass = $class; 
        if($this->actiondo){
            $this->formdata = $this->formdata . "<form name=\"" . $this->formname . "\" class=\"" . $this->formclass . "\" action=\"" . urlmapper::GetFullWebPath() . "?controller=" . $controller . "&action=" .$this->actiondo. "\" method=\"" . $method . "\">";
        } else {
            $this->formdata = $this->formdata . "<form name=\"" . $this->formname . "\" class=\"" . $this->formclass . "\" action=\"" . urlmapper::GetFullWebPath() . "?controller=" . $controller . "\" method=\"" . $method . "\">";
        }
        
            
        return true;
    }

    /**
     * Adds a standard 'input' field.
     * @param string $name The name of the HTML field.
     * @param string $class The CSS class name.
     * @return boolean 
     */
    public function AddTextbox($name, $class = null) {
        $this->formdata = $this->formdata . "<input type=\"text\" name=\"" . $name . "\" />";
        return true;
    }

    /**
     * Adds a password 'input' field.
     * @param string $name The name of the HTML field.
     * @param string $class The CSS class name.
     * @return boolean 
     */
    public function AddPasswordbox($name, $class = null) {
        $this->formdata = $this->formdata . "<input type=\"password\" name=\"" . $name . "\" />";
        return true;
    }
    

    /**
     * Adds s 'submit' button to enable sending the form data.
     * @param string $text Label to appear on the button.
     * @return boolean 
     */
    public function AddSubmitbutton($text = 'Submit'){
       $this->formdata = $this->formdata . "<input type=\"submit\" value=\"" .$text. "\" />";
       return true;
    }

    /**
     * Adds an '</form>' tag.
     * @return boolean 
     */
    public function FormEnd() {
        $this->formdata = $this->formdata . "</form>";
        return true;
    }
    
    /**
     * For POST requests, this registers the controller action to carry out upon form submission.
     * @param string $action The name of the controller 'do' request, eg. do{NameHere}
     * @return boolean 
     */
    public function RegisterControllerAction($action){
        $this->actiondo = $action;
        return true;
    }

    /**
     * Places the generated HTML form into the page.
     * @return type 
     */
    public function FormWrite() {
        return $this->formdata;
    }

}

?>
