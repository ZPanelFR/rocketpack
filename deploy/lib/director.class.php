<?php

class director {

    static function Redirect($url) {
        return header("Location: " . $url . "");
    }

}

?>
