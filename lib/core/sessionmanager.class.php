<?php

/**
 * A class to handle the selected session storage medium, either DB or standard PHP file storage. 
 */
class sessionmanager extends rocketpack {

    protected $dbstorage;
    protected $savePath;
    protected $sessionName;

    public function __construct() {
        $this->dbstorage = app_dbsessions;
        if ($this->dbstorage) {
            session_set_save_handler(
                    array($this, "open"), array($this, "close"), array($this, "read"), array($this, "write"), array($this, "destroy"), array($this, "gc"));
        } else {
            // Do nothing, we simply use the standard PHP session handler.
        }
    }

    public function open($savePath, $sessionName) {
        $this->savePath = $savePath;
        $this->sessionName = $sessionName;
        return true;
    }

    public function close() {
        // Nothing required to do here!
        return true;
    }

    public function read($id) {
        $result = $this->Database()->select("t_session", "WHERE se_hash_vc = '$id'");
        return $result[0]['se_data_tx'];
    }

    public function write($id, $data) {
        $access = time();
        $this->Database()->query("REPLACE INTO t_session VALUES ('$id', '$data','$access');");
        return true;
    }

    public function destroy($id) {
        $this->Database()->query("DELETE FROM t_session WHERE se_hash_vc = '$id'");
        return true;
    }

    public function gc($maxlifetime) {
        $this->Database()->query("DELETE FROM t_session WHERE se_expires_ts < " . $maxlifetime . ";");
        return true;
    }

}

?>