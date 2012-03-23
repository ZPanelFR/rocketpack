<?php

/**
 * A static class to help with tag linking. 
 */
class taglib {

    static function link_all_css() {
        foreach (urlmapper::OutputAllCSSLinks() as $file) {
            echo $file['file'];
        }
        return;
    }

    static function link_all_js() {
        foreach (urlmapper::OutputAllJavascriptLinks() as $file) {
            echo $file['file'];
        }
        return;
    }

}

?>
