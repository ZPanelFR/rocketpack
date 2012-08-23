<?php

class combiner {

    var $type;
    var $minify;
    var $files;
    var $combinestore;

    /**
     * Configures options for the minifer.
     * @param type $options Options array('type' = ['css' or 'js'], 'minify' = ['true', 'false']).
     */
    public function __construct($options) {
        $this->files = array();
        $this->type = $options['type'];
        $this->minify = $options['minify'];
    }

    /**
     * Adds a file (referenced from the 'public/' folder to be 'combined'.)
     * @param string $file File name and path starting in the 'public' folder eg. 'assets/css/first.css'.
     * @param int $order The combined order (Lowest number are combined first.)
     */
    public function AddFile($file, $order = 10) {
        array_push($this->files, array('file' => $file, 'order' => $order));
    }

    /**
     * Function to order a multidimentional array.
     * @param array $a The array containing the filename and sort order.
     * @param string $subkey The 'key' to order by.
     * @return array The re-ordered array.
     */
    private function SortArray($a, $subkey) {
        foreach ($a as $k => $v) {
            $b[$k] = strtolower($v[$subkey]);
        }
        asort($b);
        foreach ($b as $k => $v) {
            $c[] = $a[$k];
        }
        return $c;
    }

    /**
     * Combines the CSS/JS (and minifies if requested) file content ready to be used.
     * @return string The combined content.
     */
    public function Combine() {

        /**
         * Here we will combine the files into a single object store...
         */
        foreach ($this->SortArray($this->files, 'order') as $files) {
            $this->combinestore .= "\r\n" . file::ReadFile(app_path . 'public/' . $files['file']);
        };

        /**
         * If the application has requested that the code is minified we do this now..
         */
        if ($this->minify == true) {
            if ($this->type == 'js') {
                $this->combinestore = jsmin::minify($this->combinestore);
            } else {
                $this->combinestore = cssmin::minify($this->combinestore);
            }
        }

        echo $this->combinestore;
    }

}

?>
