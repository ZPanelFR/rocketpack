<?php

/**
 * This is the default 404 error that is shown when no model controller matches the URL request.
 */
class error_404 {

    function __construct($model) {
        echo "No controller for (<strong>" . $model . "</strong>) was found!";
    }

}

?>
