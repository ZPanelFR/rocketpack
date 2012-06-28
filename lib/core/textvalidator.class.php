<?php

class textvalidator {

    /**
     * Checks that a given email address is of a valid format.
     * @param string $email
     * @return boolean 
     */
    static function IsEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            return true;
        return false;
    }

    static function IsURL($url) {
        if (filter_var($url, FILTER_VALIDATE_URL))
            return true;
        return false;
    }

    static function IsIPAddress($ipaddress) {
        if (filter_var($ipaddress, FILTER_VALIDATE_IP))
            return true;
        return false;
    }

    /**
     * Simply checks if a given value is 'blank' for example if a text box is emtpy.
     * @param string $string Check this string to see if it's 'empty'.
     * @return boolean 
     */
    static function IsBlank($string) {
        if (empty($string))
            return true;
        return false;
    }

    /**
     * Checks if the given value is numeric of not.
     * @param string $string The content to check if it is numeric.
     * @return boolean 
     */
    static function IsNumber($string) {
        if (is_numeric($string))
            return true;
        return false;
    }

    /**
     * Checks the given value is a string.
     * @param string $string The value to check if it is a string.
     * @return boolean 
     */
    static function IsString($string) {
        if (is_string($string))
            return true;
        return false;
    }

    /**
     * Returns the lenght of the given string.
     * @param string $string The string to count the lengh of.
     * @return int Number of characters in the string. 
     */
    static function Length($string) {
        return strlen($string);
    }

    /**
     * Returns the amount of words in a given string.
     * @param string $string The string to count the number of words in.
     * @return int The total number of words in the string. 
     */
    static function WordCount($string) {
        return str_word_count($string);
    }

}

?>
