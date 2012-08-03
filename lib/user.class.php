<?php

class user extends rocketpack {

    /**
     * Checks to see if the user is logged in by checking if the 'rpuid' session is set.
     * @return boolean 
     */
    public function IsLoggedIn() {
        if (isset($_SESSION['rpuid']) && $_SESSION['rpuid'] != null)
            return true;
        return false;
    }

    /**
     * This static function should be used to 'require' access to a page, if the user is not logged in they will be redirected to the specified controller with a 'notice' message set.
     * @param string $redirectcontroller The name of the 'login' or 'login required' controller to redirect the user too on a failed login attempt.
     * @return boolean 
     */
    public function IsRequired($redirectcontroller, $notice = null) {
        if ($this->IsLoggedIn())
            return true;
        notification::ResetNotice();
        if ($notice != null)
            notification::StoreNotice($notice);
        header("location: " . link::build($redirectcontroller) . "");
        exit;
    }

    /**
     * A static function to 'register' the user's session.
     * @param int $uid The user ID to set the logged in user as.
     * @return boolean 
     */
    public function RegisterSession($uid) {
        $_SESSION['rpuid'] = $uid;
        return true;
    }

    /**
     * Destory the user's session.
     * @return boolean 
     */
    public function DestroySession() {
        $_SESSION['rpuid'] = null;
        return true;
    }

    /**
     * Return the details of the logged in user.
     * @return array Table data from the t_user table for the current logged-in user. 
     */
    public function Details() {
        $bind = array(
            ":uid" => $this->ID(),
        );
        $user = $this->Database()->select('t_user', 'us_id_pk = :uid',$bind);
        return $user[0];
    }

    /**
     * Returns the current UID of the logged-in user.
     * @return int 
     */
    public function ID() {
        return $_SESSION['rpuid'];
    }

}

?>
