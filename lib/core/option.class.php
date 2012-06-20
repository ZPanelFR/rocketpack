<?php

class option extends rocketpack {

    /**
     * Returns a value from the ZHM settings table.
     * @param string $name The setting name.
     * @return type 
     */
    public static function GetSetting($name) {
        $setting = $this->Database()->select("t_setting", "so_name_vc=" . $name . "", "", "so_value_tx");
        return $setting[0]['so_value_tx'];
    }

    public static function SetSetting($name, $value) {
        $setting = $this->Database()->update("t_settings", array(
            "so_value_tx" => $value,
                ), "so_name_vc = " . $name . "");
        return $setting;
    }

}

?>
