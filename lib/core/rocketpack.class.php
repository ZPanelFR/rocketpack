<?php

class rocketpack {

    /**
     * A very simple way to share the database handle across classes.
     */
    protected function Database() {
        return new db("mysql:host=" . app_db_host . ";dbname=" . app_db_name . "", "" . app_db_user . "", "" . app_db_pass . "");
    }

}

?>
