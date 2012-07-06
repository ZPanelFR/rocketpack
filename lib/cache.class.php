<?php

class cache {

    var $cache_dir;
    var $cache_time;

    public function set_cache_dir($var = "cache/") {
        $this->cache_dir = $var;
    }

    public function set_cache_life($var = null) {
        if ($var == null) {
            $this->cache_time = 86400; // Lets default it to 24 hours if no cache_life has been specified!
        } else {
            $this->cache_time = $var;
        }
    }

    private function cache_key() {
        $keys = array();
        foreach ($_GET as $key => $value) {
            $keys[] = $key . "=" . $value;
        }
        sort($keys);
        return md5(implode('&', $keys));
    }

    private function cache_filename() {
        return $this->cache_dir . $this->cache_key() . '.cache';
    }

    private function cache_exists() {

        if (@file_exists($this->cache_filename()) && time() - $this->cache_time < @filemtime($this->cache_filename())) {
            return true;
        } else {
            return false;
        }
    }

    private function read_cache() {
        return file_get_contents($this->cache_filename());
    }

    private function save_cache($value) {
        $fp = @fopen($this->cache_filename(), 'w');
        @fwrite($fp, $value);
        @fclose($fp);
    }

    public function start_cache() {
        if ($this->cache_exists()) {
            echo $this->read_cache();
            exit();
        } else {
            ob_start();
        }
    }

    public function stop_cache() {
        $data = ob_get_clean();
        $this->save_cache($data . "<!-- Page served from rpCache, cache generated " . date("r") . " -->\n");
        echo $data;
    }

}

?>
