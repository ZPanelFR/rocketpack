<?php

class rocketpack {

    public $controller = null;
    public $action = null;
    public $id = null;
    public $otherid = null;

    function __construct() {
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
