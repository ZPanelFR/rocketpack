<?php

class json {

    /**
     * Converts a JSON string to a PHP array.
     * @param string $json_string The JSON string to generate the PHP array from.
     * @return array 
     */
    public function JSONToArray($json_string) {
        return json_decode($json_string, true);
    }

    /**
     * Converts an array to a JSON string.
     * @param array $array_data The PHP Array to generate the JSON string from.
     * @return string 
     */
    public function ArrayToJSON($array_data) {
        return json_encode($array_data);
    }

}

?>
