<?php

class index extends rocketpack {
    
    //var $minifycode = true; // Removes tab characters, new lines and caridge from the generated page source code for performance reasons.
    //var $cache = true; // Enable page caching? - Not recommended on dynamic (constantly changing) pages.
    //var $cache_life = 30; // Total amount of time (seconds) to keep a cahced version of this file.

    /**
     * Just an example method to demonstrate RocketPack.
     * @return type 
     */
    public function outTestMethod() {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Another example of a method.
     * @return type 
     */
    public function outServerSoftwareIs() {
        return $_SERVER['SERVER_SOFTWARE'];
    }

}

?>
