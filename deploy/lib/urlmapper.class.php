<?php

class urlmapper {

    /**
     * Returns the current full web path to the applicaiton init script..
     * @return type 
     */
    public static function GetFullWebPath() {
        global $app_config;
        return urlmapper::ProtocolType() . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] . "/";
    }

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

    /**
     * Returns and links all CSS files found in: app/assets/css/ 
     */
    public static function OutputAllCSSLinks() {
        global $app_config;
        $allfiles = filesystem::RetrieveAllFilesFromDirectory($app_config['system_path'] . "/app/assets/stylesheets/", "css");
        $retval = array();
        foreach ($allfiles as $cssfile) {
            $line = "<link rel=\"stylesheet\" href=\".." . str_replace($app_config['system_path'], "", $cssfile) . "\" type=\"text/css\" media=\"screen\">\r\n";
            array_push($retval, array("file" => $line));
        }
        return $retval;
    }

    /**
     * Returns and links all Javascript files found in: app/assets/javascripts/ 
     */
    public static function OutputAllJavascriptLinks() {
        global $app_config;
        $allfiles = filesystem::RetrieveAllFilesFromDirectory($app_config['system_path'] . "/app/assets/javascripts/", "js");
        $retval = array();
        foreach ($allfiles as $jsfile) {
            $line = "<script src=\".." . str_replace($app_config['system_path'], "", $jsfile) . "\" type=\"text/javascript\"></script>\r\n";
            array_push($retval, array("file" => $line));
        }
        return $retval;
    }

    /**
     * Does a controller redirect (Application redirect as opposed to a standard redirect.) 
     */
    public static function ApplicationRedirect($controller) {
        director::Redirect(self::GetFullWebPath() . $controller);
    }

}

?>
