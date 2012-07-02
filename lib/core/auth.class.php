<?php

class auth extends rocketpack {

    /**
     * Does a login request to the database.
     * @param string $user The username to authenticate with.
     * @param string $pass The password to authenticate with.
     * @return boolean 
     */
    public function Login($user, $pass) {
        $bind = array(
            ":username" => $user,
            ":password" => $pass,
        );
        $authenticate = $this->Database()->select('t_user', 'us_user_vc= :username AND us_pass_vc= :password', $bind, 'us_id_pk');
        if (count($authenticate) < 1)
            return false;
        return true;
    }

    /**
     * Logs the current user out.
     * @return boolean 
     */
    public function Logout() {
        if (!user::GetIsLoggedIn())
            return false;
        user::DestroySesion();
        return true;
    }

}

?>
