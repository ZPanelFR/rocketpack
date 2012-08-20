<?php

class launch extends rocketpack {

    //var $renderwith = "mytpl" // An example way to customise what template file (.html) to render the controller with (in this case mytpl.html), if not set it will look for a template with the same name as the class eg. launch.html 
    //var $minifycode = true;   // Removes tab characters, whitespace and new lines from the generated page source code for performance reasons.
    //var $cache = true;        // Enable page caching? - Great for CMSes as it caches the entire page, on my dynamic pages we recommend data caching instead of full page cache, use the datacache() class instead.
    //var $cache_life = 30;     // Total amount of time (seconds) to keep a full cahced version of this file.

    public function outPathLogs() {
        return app_logpath;
    }

    public function outPathTemp() {
        return app_tmppath;
    }

    public function outPathCache() {
        return app_cachepath;
    }

    public function outIsWritableLogs() {
        return is_writable(app_logpath);
    }

    public function outIsWritableCache() {
        return is_writable(app_cachepath);
    }

    public function outIsWritableTemp() {
        return is_writable(app_tmppath);
    }

    public function outIsExistLogs() {
        return file_exists(app_logpath);
    }

    public function outIsExistCache() {
        return file_exists(app_cachepath);
    }

    public function outIsExistTemp() {
        return file_exists(app_tmppath);
    }

    public function outIsPDO() {
        if (class_exists("PDO"))
            return true;
        return false;
    }

    public function outApacheModules() {
        if (in_array("mod_rewrite", apache_get_modules()))
            return true;
        return false;
    }

    public function outGetAvailableDatabaseDrivers() {
        $loop = array();
        foreach ($this->Database()->getAvailableDrivers() as $driver) {
            array_push($loop, array("driver" => $driver));
        }
        if (count($loop) > 0) {
            return $loop;
        } else {
            return array(array("driver" => "none found"));
        }
    }

    public function outCheckDatabaseConnect() {
        if ($this->Database())
            return true;
        return false;
    }

    public function outCheckStandardTables() {
        if ($this->Database()->select("t_session"))
            return true;
        return false;
    }

    public function outDatabaseName() {
        return app_db_name;
    }

    public function outCheckSaltIsNotSet() {
        if (app_salt == 'put your unique phrase/key here')
            return true;
        return false;
    }

    public function outPHPVersion() {
        return PHP_VERSION;
    }

}

?>
