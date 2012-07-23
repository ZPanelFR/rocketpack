<?php

class director {

    /**
     * A standard web redirect (requires full website/site path.)
     * @param string $url The URL of the site to redirect to.
     * @return void 
     */
    static function Redirect($url) {
        return header("Location: " . $url . "");
    }

}

?>
