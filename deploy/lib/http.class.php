<?php

class http {

    /**
     * A simple remote file reader.
     * @param string $url The URL to read and return the data from.
     * @return mixed  
     */
    public function ReadDataFromURL($url) {
        if (@file_get_contents($url)) {
            return file_get_contents($url);
        } else {
            logger::LogToFile("[http::ReadDataFromURL] Unable to read from URL: " . $url . "");
            return false;
        }
    }

    /**
     *
     * A CURL implementation of reading a remote file (great for SSL) 
     * @param string $url The URL to read and return the data from.
     * @param bool $verifycert If set to 'false' on an SSL request it will bypass checking if the certificate is valid.
     * @return mixed  
     */
    public function ReadDataFromSSLURL($url, $verifycert = true) {
        if (!@curl_init()) {
            logger::LogToFile("[http::ReadDataFromSSLURL] The PHP cURL extentsion is not avaliable!");
            return false;
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verifycert);
            $response = curl_exec($ch);
            curl_close($ch);
        }
        return $response;
    }

    /**
     * A simple POST class that attempts to POST data simply without the need for cURL.
     * @param string $url URL to post the content too.
     * @param string $data The data to post.
     * @param string $optional_headers Optional if you need to send additonal headers.
     * @return string The repsonse. 
     */
    public function SendPostRequest($url, $data, $optional_headers = null) {
        $params = array('http' => array(
                'method' => 'POST',
                'content' => $data
                ));
        if ($optional_headers != null) {
            $params['http']['header'] = $optional_headers;
        }
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if (!$fp) {
            logger::LogToFile("[http::SendPostRequest] Problem reading data from " . $url . "");
        }
        $response = @stream_get_contents($fp);
        if ($response == false) {
            logger::LogToFile("Problem reading data from " . $url . "");
        }
        return $response;
    }

}

?>