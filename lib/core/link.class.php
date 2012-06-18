<?php

class link {

    /**
     * Calculates and returns the web path of the application base folder.
     * @return str
     */
    public static function webfolder() {
        return str_replace('index.php', '', $_SERVER["SCRIPT_NAME"]);
    }

    /**
     * Correctly build application URL's
     * @param str $controller The controller to link too.
     * @param str $action Optional 'action' eg. view, delete, update
     * @param str $id Optional'ID' can be used in conjuction with 'view', 'delete' etc for DB ID's.
     * @param str $otherid Optional 'Other variable', just another one, just incase :)
     * @return str 
     */
    public static function build($controller, $action = null, $id = null, $otherid = null) {
        if (app_urlrewrite == true) {
            if ($action != null) {
                if ($id != null) {
                    if ($otherid != null) {
                        return self::webfolder() . $controller . "/" . $action . "/" . $id . "/" . $otherid . "";
                    }
                    return self::webfolder() . $controller . "/" . $action . "/" . $id . "";
                }
                return self::webfolder() . $controller . "/" . $action . "";
            }
            return self::webfolder() . $controller . "";
        } else {
            if ($action != null) {
                if ($id != null) {
                    if ($otherid != null) {
                        return self::webfolder() . "?controller=" . $controller . "&action=" . $action . "&id=" . $id . "&otherid=" . $id . "";
                    }
                    return self::webfolder() . "?controller=" . $controller . "&action=" . $action . "&id=" . $id . "";
                }
                return self::webfolder() . "?controller=" . $controller . "&action=" . $action . "";
            }
            return self::webfolder() . "?controller=" . $controller . "";
        }
    }

}

?>
