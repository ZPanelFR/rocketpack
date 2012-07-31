<?php

class rocketpack {

    /**
     * Stores the name of the current requested controller.
     * @var string The name of the current controller.
     */
    public $controller = null;

    /**
     * Stores the name of the requested 'action' (optional).
     * @var string The name of the current 'action'. 
     */
    public $action = null;

    /**
     * Stores an optional 'id', as either a string or int.
     * @var string Value of the 'id' URL parameter. 
     */
    public $id = null;

    /**
     * Stores an optional 'otherid', as either a string or int.
     * @var string Value of the 'otherid' URL parameter. 
     */
    public $otherid = null;

    public function __construct() {
        if (isset($_GET['controller'])) {
            $this->controller = $_GET['controller'];
        }
        if (isset($_REQUEST['action'])) {
            $this->action = $_REQUEST['action'];
        }
        if (isset($_GET['id'])) {
            $this->id = $_GET['id'];
        }
        if (isset($_GET['otherid'])) {
            $this->otherid = $_GET['otherid'];
        }
    }

    /**
     * A very simple way to access the configured RocketPack database.
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
