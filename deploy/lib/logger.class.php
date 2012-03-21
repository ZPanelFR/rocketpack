<?php

class logger {

    /**
     * Logs an given error message to a text file.
     * @param string $message The error message to add to the log file.
     * @param string $file The full path and file name to the log file.
     */
    static function LogToFile($message, $file = null) {
        global $app_config;
        if (empty($file)) {
            file::AppendFile($app_config['default_log_file'], time::FormatTimestamp(time::CurrentTimestamp(), DATE_ATOM) . " - " . $message . "\r\n");
        } else {
            file::AppendFile($file, time::FormatTimestamp(time::CurrentTimestamp(), DATE_ATOM) . " - " . $message . "\r\n");
        }
    }

}

?>
