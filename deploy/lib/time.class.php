<?php

class time {

    static function CurrentTimestamp() {
        return time();
    }

    static function FormatTimestamp($timestamp, $format = null) {
        global $app_config;
        if ($format)
            return date($format, $timestamp);
        return date($app_config['default_time_format'], $timestamp);
    }

}

?>
