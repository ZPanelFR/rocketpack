<?php

/**
 * This file is the global 'common' controller for ALL template includes.
 * Only the use of 'outClassName()' functions will work here, controller actions (actionDoSomething()) are disabled.
 */
class _viewinclude extends rocketpack {

    var $minifycode = false;

    public function outServerTime() {
        return date('d/m/Y');
    }

}

?>
