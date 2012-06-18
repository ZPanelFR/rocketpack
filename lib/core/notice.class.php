<?php

class notice {

    /**
     * Stores a new 'notice' message that will appear on the screen.
     * @param string $message The text message to show.
     * @return boolean 
     */
    public static function StoreNotice($message) {
        $_SESSION['msg_notice'] .= "<p>" . $message . "</p>";
        return true;
    }

    /**
     * Retrieves the 'notice' message contents.
     * @return string 
     */
    public static function RetrieveNotice() {
        return $_SESSION['msg_notice'];
    }

    /**
     * Checks to see if a 'notice' is held in the server.
     * @return boolean 
     */
    public static function CheckHasNotice() {
        if (isset($_SESSION['msg_notice']) && !empty($_SESSION['msg_notice']))
            return true;
        return false;
    }

    /**
     * Removes the current 'notice' text to disable it showing on the next page view. 
     */
    public static function ResetNotice() {
        $_SESSION['msg_notice'] = '';
    }

    public static function StoreWarning($message) {
        $_SESSION['msg_warning'] .= "<p>" . $message . "</p>";
        return true;
    }

    public static function RetrieveWarning() {
        return $_SESSION['msg_warning'];
    }

    public static function CheckHasWarning() {
        if (isset($_SESSION['msg_warning']) && !empty($_SESSION['msg_warning']))
            return true;
        return false;
    }

    public static function ResetWarning() {
        $_SESSION['msg_warning'] = '';
    }

}

?>
