<?php

class hash {

    /**
     * Calcualates an MD5 string complete with the application salt.
     * @param string $string The string to hash.
     * @return string The output of the hash. 
     */
    public static function MD5($string) {
        return md5($string . app_salt);
    }

    /**
     * Calcualates a standard MD5 (un-salted) hash.
     * @param string $string The string to hash.
     * @return string The output of the hash. 
     */
    public static function MD5WithoutSalt($string) {
        return md5($string);
    }

    /**
     * Calculates a SHA1 (128 bit) hash complete with the application salt.
     * @param string $string The string to hash.
     * @return string The output of the hash. 
     */
    public static function SHA1($string) {
        return sha1($string . app_salt);
    }

    /**
     * Calculates a standard SHA1 (128 bit) un-salted hash.
     * @param string $string The string to hash.
     * @return string The output of the hash. 
     */
    public static function SHA1WithoutSalt($string) {
        return sha1($string);
    }

    /**
     * A quick and simple way of getting a random MD5 hash (based on microtime())
     * @return string A random MD5 hash. 
     */
    public static function RandomMD5Hash() {
        return md5(microtime());
    }

    /**
     * A quick and simple way of getting a random SHA1 hash (based on microtime())
     * @return string A random SHA1 (128bit) hash. 
     */
    public static function RandomSHA1Hash() {
        return sha1(microtime());
    }

}

?>
