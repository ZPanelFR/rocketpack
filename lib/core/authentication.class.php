<?php

class authentication extends rocketpack {

    /**
     * Checks to see if the current session is a logged in user.
     * @return boolean 
     */
    public static function UserLoggedIn() {
        if (isset($_SESSION['zhm_uid']) && $_SESSION['zhm_uid'] != '')
            return true;
        return false;
    }

    public static function RequireUser() {
        if (self::UserLoggedIn())
            return true;
        notice::ResetNotice();
        notice::StoreNotice("You are required to login to access that area, please login to continue..");
        header("location: " .link::build('login'). "");
        exit;
    }

    public static function RegisterUserSesion($uid) {
        $_SESSION['zhm_uid'] = $uid;
        return;
    }

    public static function DestroyUserSesion() {
        $_SESSION['zhm_uid'] = null;
        return;
    }

    public static function GetLoggedInUserDetails() {
        $user = $this->Database()->select("t_user", "in_us_fk = " . self::GetLoggedInUserID() . "");
        return $user;
    }

    public static function GetLoggedInUserID() {
        return $_SESSION['zhm_uid'];
    }

}

?>
