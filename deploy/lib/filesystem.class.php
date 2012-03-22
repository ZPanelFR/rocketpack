<?php

class filesystem {

    static function SetPermissions() {
        
    }

    /**
     * REturns an array of all filename in a directory, if the 'extention' is specified will filter on those only.
     * @param type $path The full system path to check.
     * @param type $extention A particular file extenstion to only show?
     * @return array
     */
    static function RetrieveAllFilesFromDirectory($path, $extention = null) {
        $the_files = array();
        foreach (glob($path . "*.css") as $file) {
            array_push($the_files, $file);
        }
        return $the_files;
    }

}

?>
