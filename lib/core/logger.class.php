<?php

class logger {

    var $log_folder;

    /**
     * Sets the folder path to where the log files will reside.
     * @param string $path The path to the loggging folder.
     */
    public function setLogPath($path) {
        $this->log_folder = $path;
    }

    /**
     * Logs an given error message to a text file.
     * @param string $message The error message to add to the log file.
     */
    public function LogToFile($message) {
        if (empty($log_folder)) {
            file::AppendFile(app_logpath . '' . date("log-d-m-Y") . '.log', time::FormatTimestamp(time::CurrentTimestamp(), DATE_ATOM) . " - " . $message . "\r\n");
        } else {
            file::AppendFile($file, time::FormatTimestamp(time::CurrentTimestamp(), DATE_ATOM) . " - " . $message . "\r\n");
        }
    }

}
?>
