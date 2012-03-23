<?php

/**
 * A static class to help with tag linking. 
 */
class taglib {

    /**
     * Returns the web path to the 'assets' folder. 
     */
    static function assets_path() {
        echo dirname(urlmapper::GetFullWebPath()) . "/app/assets/";
    }

    /**
     * Returns all CSS files.
     * @return type 
     */
    static function link_all_css() {
        foreach (urlmapper::OutputAllCSSLinks() as $file) {
            echo $file['file'];
        }
        return;
    }

    /**
     * Returns all Javascript files.
     * @return type 
     */
    static function link_all_js() {
        foreach (urlmapper::OutputAllJavascriptLinks() as $file) {
            echo $file['file'];
        }
        return;
    }

    /**
     * Returns selected CSS files.
     * @return type 
     */
    static function link_css($list) {
        $requested = explode(",", $list);
        foreach ($requested as $file) {
            echo "\n\r<link rel=\"stylesheet\" href=\"app/assets/css/" . $file . ".css\" type=\"text/css\" media=\"screen\">";
        }
        return;
    }

    /**
     * Returns selected Javascript files.
     * @return type 
     */
    static function link_js($list) {
        $requested = explode(",", $list);
        foreach ($requested as $file) {
            echo "\n\r<script src=\"app/assets/javascripts/" . $file . ".js\" type=\"text/javascript\"></script>";
        }
        return;
    }

}

?>
