<?php

class option extends rocketpack {

    /**
     * Gets a system option from the database and returns the value.
     * @param string $name The name of the system option to return the value of.
     * @return type 
     */
    public function GetSetting($name) {
        $setting = $this->Database()->select("t_setting", "so_name_vc='" . $name . "'", "", "so_value_tx");
        return $setting[0]['so_value_tx'];
    }

    /**
     * Sets a new value of a system option.
     * @param string $name The name of the system option to set the value of.
     * @param string $value The new value of the system option.
     * @return type 
     */
    public function SetSetting($name, $value) {
        $setting = $this->Database()->update("t_setting", array(
            "so_value_tx" => $value,
                ), "so_name_vc = '" . $name . "'");
        return $setting;
    }

}

?>
