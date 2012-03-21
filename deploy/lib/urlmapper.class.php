<?php

class urlmapper {

    /**
     * Returns an array of all the request parameters.
     * @return array Array of all the request paths/parameters.
     */
    public static function AllSegmentsFromRequestURI() {
        global $app_config;
        $fullrequest = urlmapper::ProtocolType() . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $fullwebpath = urlmapper::ProtocolType() . $app_config['web_path'] . '/';
        $clean = str_replace($fullwebpath, '', $fullrequest);
        $values = explode("/", $clean);
        return $values;
    }

    /**
     * Returns the requested controller.
     * @return string The named controller. 
     */
    public static function ControllerRequestFromRequestURI() {
        $allmappings = self::AllSegmentsFromRequestURI();
        if (!empty($allmappings[1]))
            return $allmappings[1];
        return false;
    }

    /**
     * Returns all model requests. 
     * @ return array All other requests.
     */
    public static function ModelRequestsFromRequestURI() {
        return array_slice(self::AllSegmentsFromRequestURI(), 2);
    }

    /**
     * Returns the protocol type used for the connection.
     * @return string Returns the connection protocol type (http:// or https://)
     */
    public static function ProtocolType() {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
            return 'https://';
        return 'http://';
    }

}

?>
