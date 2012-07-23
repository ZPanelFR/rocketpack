<?php

class rocketpack {

    /**
     * The name of the current requested controller, if no controller reuested it will return null.
     * @var string The name of the requested controller. 
     */
    public $controller = null;
    
    /**
     * The name of the current requested action (method), if no method is reuested it will return null.
     * @var string The name of the requested action (method). 
     */
    public $action = null;
    
    
    /**
     * The current 'ID' paramenter, if no ID parameter is reuested it will return null.
     * @var string The request 'ID' (optional). 
     */
    public $id = null;
    
    /**
     * The current 'otherid' paramenter, if no OtherID parameter is reuested it will return null.
     * @var string The request 'other ID' (optional). 
     */
    public $otherid = null;

    
    function __construct() {
        if (isset($_GET['controller'])) {
            $this->controller = $_GET['controller'];
        }
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        }
        if (isset($_GET['id'])) {
            $this->id = $_GET['id'];
        }
        if (isset($_GET['otherid'])) {
            $this->otherid = $_GET['otherid'];
        }
    }

    /**
     * A very simple way to share the database handle across classes.
     */
    protected function Database() {
        $obj = new db("" . app_db_driver . ":host=" . app_db_host . ";dbname=" . app_db_name . "", "" . app_db_user . "", "" . app_db_pass . "");
        $obj->setErrorCallbackFunction('echo');
        if (!$obj)
            return false;
        return $obj;
    }

    /**
     * A very simple way to write and access RocketPack system options.
     */
    protected function Option() {
        return new option();
    }

    /**
     * A very simple way to read and write session variables.
     */
    protected function Session() {
        return new session();
    }

    /**
     * A very simple way to log errors etc. 
     */
    protected function Log() {
        $logger = new logger();
        return $logger;
    }

    /**
     * A very simple way to access User details and options for user athentication. 
     */
    protected function User() {
        $user = new user();
        return $user;
    }

}

?>
