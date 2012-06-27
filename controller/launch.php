<?php

class launch extends rocketpack {

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

    public function outDatabaseName() {
        return app_db_name;
    }

    public function outCheckSaltIsNotSet() {
        if (app_salt == 'put your unique phrase/key here')
            return true;
        return false;
    }

}

?>
