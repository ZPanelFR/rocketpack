<?php

class textvalidator {

    /**
     * Checks that a given email address is of a valid format.
     * @param string $email
     * @return boolean 
     */
    static function IsValidEmail($email) {
        if (!preg_match('/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i', $email))
            return false;
        return true;
    }

}

?>
