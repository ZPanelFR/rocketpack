<?php

class rpdb {

    /**
     * A very simple way to share the database handle across classes.
     */
    protected function Database() {
        return new db("mysql:host=" . zhm_db_host . ";dbname=" . zhm_db_name . "", "" . zhm_db_user . "", "" . zhm_db_pass . "");
    }

}

?>
