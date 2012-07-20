<?php

class cache {

    var $cache_dir;
    var $cache_time;

    /**
     * Confifgures the directory of where to store the cache files, if left default will use 'cache/' by default.
     * @param string $var The full path including a trailing slash to the cache folder.
     */
    public function set_cache_dir($var = "cache/") {
        $this->cache_dir = $var;
    }

    /**
     * Sets a cache timeout value.
     * @param int $var No of seconds that the partial cache content can live for.
     */
    public function set_cache_life($var = null) {
        if ($var == null) {
            $this->cache_time = 86400; // Lets default it to 24 hours if no cache_life has been specified!
        } else {
            $this->cache_time = $var;
        }
    }

    /**
     * Generates the dynamic cache file.
     * @return string The dynamic cache file name.
     */
    private function cache_key() {
        $keys = array();
        foreach ($_GET as $key => $value) {
            $keys[] = $key . "=" . $value;
        }
        sort($keys);
        return md5(implode('&', $keys));
    }

    /**
     * Returns the cache file name (sector name including the cache directory path and file extentsion.).
     * @return string The cache file name. 
     */
    private function cache_filename() {
        return $this->cache_dir . $this->cache_key() . '.cache';
    }

    /**
     * Checks if a valid cache file exists.
     * @return boolean 
     */
    private function cache_exists() {

        if (@file_exists($this->cache_filename()) && time() - $this->cache_time < @filemtime($this->cache_filename())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Read data from a cache file.
     * @return sring The data read from the cache file. 
     */
    private function read_cache() {
        return file_get_contents($this->cache_filename());
    }

    /**
     * Saves data to a cache file.
     * @param string $value The data to save to the cache file.
     */
    private function save_cache($value) {
        $fp = @fopen($this->cache_filename(), 'w');
        @fwrite($fp, $value);
        @fclose($fp);
    }

    /**
     * Enables the caching engine to collect the data. 
     */
    public function start_cache() {
        if ($this->cache_exists()) {
            echo $this->read_cache();
            exit();
        } else {
            ob_start();
        }
    }

    /**
     * Stops the caching engine. 
     */
    public function stop_cache() {
        $data = ob_get_clean();
        $this->save_cache($data . "<!-- Page served from rpCache, cache generated " . date("r") . " -->\n");
        echo $data;
    }

}

?>
