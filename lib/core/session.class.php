<?php

/**
 * A simple class to read and write session data. 
 */
class session {

    public function Write($session_var_name, $session_var_value) {
        $_SESSION[$session_var_name] = $session_var_value;
    }

    public function Read($session_var_name) {
        return $_SESSION[$session_var_name];
    }

}

?>