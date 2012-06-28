<?php

class system {

    /**
     * Returns the server OS platform (eg. Windows, Linux or FreeBSD.)
     * @return string The human readable OS platform name.
     */
    static function OSType() {
        $os_abbr = strtoupper(substr(PHP_OS, 0, 3));
        if ($os_abbr == "WIN") {
            $retval = "Windows";
        } elseif ($os_abbr == "LIN") {
            $retval = "Linux";
        } elseif ($os_abbr == "FRE") {
            $retval = "FreeBSD";
        } else {
            $retval = "Other";
            logger::LogToFile("[system::OSType] - Unable to determine the server OS type.");
        }
        return $retval;
    }

    /**
     *
     * Implements a universal way of running an application on the server and retuurning the result. 
     * @param string $command The full path to the command to execute.
     * @return array The return value (normally 0 = ok, 1= error) and output (which is an array of the output lines)). 
     */
    static function ExecuteCommand($command) {
        $retval = null;
        $output = null;
        $handle = @exec($command, $output, $retval); //If $retval[0] == 1 then an error occured, the command is invalid etc.
        return array($retval, $output); // Iterate over $retval[1][x] to get the output values.
    }

}

?>
