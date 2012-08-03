<?php

class util {

    /**
     * A utility method to convert an array or multidimensional array to an Object.
     * @param array $array The array of data to convert to an object.
     * @return oject
     */
    static function ArrayToObject($array) {
        if (!is_array($array)) {
            return $array;
        }

        $object = new stdClass();
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $name => $value) {
                $name = strtolower(trim($name));
                if (!empty($name)) {
                    $object->$name = self::ArrayToObject($value);
                }
            }
            return $object;
        } else {
            return false;
        }
    }

    /**
     * A utility method to convert an object to a multi-dimensional array.
     * @param object $obj The data object of which to convert to an array.
     * @return array
     */
    static function ObjectToArray($obj) {
        $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
        foreach ($_arr as $key => $val) {
            $val = (is_array($val) || is_object($val)) ? self::ObjectToArray($val) : $val;
            $arr[$key] = $val;
        }
        return $arr;
    }

}

?>
