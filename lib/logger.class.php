<?php

class logger {

    /**
     * Stores the path and filename to use for the log file.
     * @var string
     */
    var $log_file;

    /**
     * Sets the path and filename to write the logs too.
     * @param string $path The path to the loggging folder.
     */
    public function setLogFile($filename) {
        $this->log_file = $filename;
    }

    /**
     * Logs an given error message to a text file. - If no path is specified with use the 'app_logpath' plus the current date for the log file.
     * @param string $message The error message to add to the log file.
     * @param boolean $showpostdata If set to true, this will display the POST data for the request.
     */
    public function LogToFile($message, $showpostdata = false) {
        $postdata = null;
        if ($showpostdata)
            $postdata = " - POST DATA: " . print_r($_POST, true);
        $request = $_SERVER['REQUEST_URI'];
        if (empty($this->log_file)) {
            file::AppendFile(app_logpath . '' . date("Y-m-d") . '.log', time::FormatTimestamp(time::CurrentTimestamp(), DATE_ATOM) . " - " . $request . " - " . $message . "" . $postdata . "\r\n");
        } else {
            file::AppendFile($this->log_file, time::FormatTimestamp(time::CurrentTimestamp(), DATE_ATOM) . " - " . $request . " - " . $message . "" . $postdata . "\r\n");
        }
    }

}

?>
