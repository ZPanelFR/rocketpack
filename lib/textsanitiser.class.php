<?php

class textsanitiser {

    /**
     * Returns a sanitised Email address.
     * @param string $email
     * @return type 
     */
    static function Email($email) {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Returns a sanitised URL.
     * @param string $email
     * @return type 
     */
    static function URL($url) {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    /**
     * Returns a sanitised String.
     * @param string $string
     * @return type 
     */
    static function String($string) {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    /**
     * Returns a sanitised Integer (number).
     * @param int $number
     * @return type 
     */
    static function Int($number) {
        return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Returns a sanitised Float (number).
     * @param type $number
     * @return type 
     */
    static function Float($number) {
        return filter_var($number, FILTER_SANITIZE_NUMBER_FLOAT);
    }

}

?>
