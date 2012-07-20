<?php

class partialcache {

    private $sector;
    private $cache_dir = 'cache/';
    private $cache_life;

    /**
     * Registers a 'sector' of which is cached, this is the name of the cached file.
     * @param string $name The unique name to store the sector as.
     */
    public function register_sector($name) {
        $this->sector = $name;
    }

    /**
     * Returns the cache file name (sector name including the cache directory path and file extentsion.).
     * @return string The cache file name. 
     */
    public function cache_filename() {
        return $this->cache_dir . $this->sector . '.partcache';
    }

    /**
     * Confifgures the directory of where to store the cachefiles, if left default will use 'cache/' by default.
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
     * Checks if a valid cache file exists.
     * @return boolean 
     */
    protected function cache_exists() {
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
    protected function read_cache() {
        return file_get_contents($this->cache_filename());
    }

    /**
     * Saves data to a cache file.
     * @param string $value The data to save to the cache file.
     */
    protected function save_cache($value) {
        $fp = @fopen($this->cache_filename(), 'w');
        @fwrite($fp, $value);
        @fclose($fp);
    }

    /**
     * Processes the data, if a valid cache exists it'll serve it up if not it will generate and output the code.
     * @param string $data The string data (HTML or plaintext) of the content to cache.
     * @return string 
     */
    public function data_cache($data) {
        if ($this->cache_exists()) {
            return stripslashes($this->read_cache());
            exit();
        } else {
            $this->save_cache(addslashes($data));
            return $data;
        }
    }

}

?>
