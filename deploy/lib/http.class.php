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