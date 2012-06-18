<?php

class index extends rpdb {
    
    //var $cache = true; // Enable page caching? - Not recommended on dynamic (constantly changing) pages.
    //var $cahce_life = 60; // Total amount of time (seconds) to keep a cahced version of this file.
    
    
    /**
     * Just an example method to demonstrate RocketPack.
     * @return type 
     */
    public function outTestMethod(){
        return $_SERVER['REMOTE_ADDR'];
    }
    
    /**
     * Another example of a method.
     * @return type 
     */
    public function outServerSoftwareIs(){
        return $_SERVER[SERVER_SOFTWARE];
    }
    
}

?>
