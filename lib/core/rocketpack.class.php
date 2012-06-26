<?php

class rocketpack {

    /**
     * A very simple way to share the database handle across classes.
     */
    protected function Database() {
        return new db("mysql:host=" . app_db_host . ";dbname=" . app_db_name . "", "" . app_db_user . "", "" . app_db_pass . "");
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

}

?>
