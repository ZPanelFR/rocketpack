<?php

class json {

    /**
     * Converts a JSON string to a PHP array.
     * @param type $json_string
     * @return type 
     */
    public function JSONToArray($json_string) {
        return json_decode($json_string, true);
    }

    /**
     * Converts an array to a JSON string.
     * @param type $array_data
     * @return type 
     */
    public function ArrayToJSON($array_data) {
        return json_encode($array_data);
    }

}

?>
