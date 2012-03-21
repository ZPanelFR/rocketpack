<?php

class logger {

    /**
     * Logs an given error message to a text file.
     * @param type $message
     * @param type $file 
     */
    static function LogToFile($message, $file = null) {
        if (empty($file)) {
            echo "No log file specificed! - Will log to the default!";
        } else {
            echo "I will log to he specific log file (" . $file . ")";
        }
    }

}

?>
