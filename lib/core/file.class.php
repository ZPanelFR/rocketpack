<?php

class file {

    /**
     * Reads the contents of a file.
     * @param type $file The full path to the file to read.
     * @return boolean 
     */
    static function ReadFile($file) {
        if (@file_get_contents($file)) {
            return file_get_contents($file);
        } else {
            return false;
        }
    }

    /**
     * Creates a new file if it doesn't exist.
     * @param string $file The full path and file name to the file.
     * @param string $string Any content you want to add intially to the file.
     */
    static function CreateFile($file, $string = "") {
        if (!is_file($file)) {
            $fp = @fopen($file, 'w');
            @fwrite($fp, $string);
            @fclose($fp);
        }
    }

    /**
     * Updates an existing file (resets it).
     * @param string $file The full path and file name to the file.
     * @param string $string The new content to add to the file.
     * @return boolean 
     */
    static function UpdateFile($path, $string = "") {
        if (!file_exists($path))
            file::CreateFile($path);
        $fp = @fopen($path, 'w');
        @fwrite($fp, $string);
        @fclose($fp);
        return true;
    }

    /**
     * Updates a text file (appends it)
     * @param string $file The full path and file name to the file.
     * @param string $string The new content to 'append' to the file.
     * @param int $pos The position at which to add the new content (0 = start of the file, 1 = end of the file)
     * @return boolean 
     */
    static function AppendFile($file, $string, $pos = 1) {
        if (!file_exists($file))
            file::CreateFile($file);
        $current_version = file::ReadFile($file);
        if ($pos == 0) {
            $new_version = $string . $current_version;
        } else {
            $new_version = $current_version . $string;
        }
        file::UpdateFile($file, $new_version);
    }

    /**
     * Check to see if a file is wriable.
     * @param string $file The filename and path of the file to check.
     * @return boolean 
     */
    static function IsWritable($file) {
        if (is_writable($file))
            return true;
        return false;
    }

    /**
     * Check to see if a file is readable.
     * @param string $file The filename and path of the file to check.
     * @return boolean 
     */
    static function IsReadable($file) {
        if (is_readable($file))
            return true;
        return false;
    }

    /**
     * Check to see if a file is executable.
     * @param string $file The filename and path of the file to check.
     * @return boolean 
     */
    static function IsExecutable($file) {
        if (is_executable($file))
            return true;
        return false;
    }

}

?>
