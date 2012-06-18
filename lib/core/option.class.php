<?php

class option extends rpdb {

    /**
     * Returns a value from the ZHM settings table.
     * @param string $name The setting name.
     * @return type 
     */
    public static function GetSetting($name) {
        $zhmdb = new db("mysql:host=" . zhm_db_host . ";dbname=" . zhm_db_name . "", "" . zhm_db_user . "", "" . zhm_db_pass . "");
        $setting = $zhmdb->select("t_setting", "so_name_vc=" . $name . "", "", "so_value_tx");
        return $setting[0]['so_value_tx'];
    }

    public static function SetSetting($name, $value) {
        $zhmdb = new db("mysql:host=" . zhm_db_host . ";dbname=" . zhm_db_name . "", "" . zhm_db_user . "", "" . zhm_db_pass . "");
        $setting = $zhmdb->update("t_settings", array(
            "so_value_tx" => $value,
                ), "so_name_vc = " . $name . "");
        return $setting;
    }

}

?>
