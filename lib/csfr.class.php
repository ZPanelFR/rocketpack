<?php

class csfr {

    /**
     * @param boolean $autokey Automatically generate a CSFR key upon class load.
     */
    public function __construct($autokey = false) {
        if ($autokey == true)
            $this->GenerateCSFRKey();
    }

    /**
     * Geneates a new CSFR key and stores it in a session to be validated later if required.
     * @return void 
     */
    public function GenerateCSFRKey() {
        return $this->CSFRKeyStore()->Write('csfr_key', md5(microtime()));
    }

    /**
     * Retrieve the session generated CSRF key to valiadate and protect against CSFR attacks. 
     * @return string The current stored CSFR key that has been generated. 
     */
    public function CurrentCSFRKey() {
        return $this->CSFRKeyStore()->Read('csfr_key');
    }

    /**
     * Validates the submittetd form's CSRF key to ensure it is corect.
     * @param string $submitted_key The submitted FORM CSFR key.
     * @return boolean 
     */
    public function ValidateCSFRKey($submitted_key) {
        if ($this->CSFRKeyStore()->Read('csfr_key') != $submitted_key)
            return false;
        $this->GenerateCSFRKey();
        return true;
    }

    /**
     * Handles the management and storage of CSFR keys in a session.
     * @return object An instance of the session library of which we use to store and retrieve the keys from. 
     */
    private function CSFRKeyStore() {
        return new session();
    }

    /**
     * Builds and returns a hidden HTML FORM tag of which can be used in forms to output the CSFR tag.
     * @return string The HTML hidden input tag complete with the correct CSFR tag. 
     */
    public function BuildCSFRFormTag() {
        return "<input id=\"csfr_key\" name=\"csfr_key\" type=\"hidden\" value=\"" . $this->CurrentCSFRKey() . "\" />";
    }

    /**
     * Validates a POST request which validates the 'csfr_key' hidden field automatically and returns if the key was successful or not!
     * @return boolean 
     */
    public function ValidateCSFRFormTag() {
        if (isset($_POST['csfr_key']) && ($this->ValidateCSFRKey($_POST['csfr_key'])))
            return true;
        return false;
    }

}

?>
