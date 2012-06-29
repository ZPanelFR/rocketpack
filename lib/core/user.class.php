<?php

class user extends rocketpack {

    /**
     * Checks to see if the user is logged in by checking if the 'rpuid' session is set.
     * @return boolean 
     */
    public static function GetIsLoggedIn() {
        if (isset($_SESSION['rpuid']) && $_SESSION['rpuid'] != '')
            return true;
        return false;
    }

    /**
     * This static function should be used to 'require' access to a page, if the user is not logged in they will be redirected to the specified controller with a 'notice' message set.
     * @param string $redirectcontroller The name of the 'login' or 'login required' controller to redirect the user too on a failed login attempt.
     * @return boolean 
     */
    public static function SetIsRequired($redirectcontroller) {
        if (self::IsLoggedIn())
            return true;
        notice::ResetNotice();
        notice::StoreNotice("You are required to login to access that area, please login to continue..");
        header("location: " . link::build($redirectcontroller) . "");
        exit;
    }

    /**
     * A static function to 'register' the user's session.
     * @param int $uid The user ID to set the logged in user as.
     * @return boolean 
     */
    public static function RegisterSesion($uid) {
        $_SESSION['rpuid'] = $uid;
        return true;
    }

    /**
     * A static function to 'destory' the user's session.
     * @return boolean 
     */
    public static function DestroySesion() {
        $_SESSION['rpuid'] = null;
        return true;
    }

    /**
     * A static function to return the details of the logged in user.
     * @return array Table data from the t_user table for the current logged-in user. 
     */
    public static function GetDetails() {
        $user = $this->Database()->select("t_user", "us_id_pk = " . self::GetLoggedInUserID() . "");
        return $user;
    }

    /**
     * Returns the current UID of the logged-in user.
     * @return int 
     */
    public static function GetID() {
        return $_SESSION['rpuid'];
    }

}

?>
