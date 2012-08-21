<?php

/**
 * Builds a valid sitemap.xml content as described here: http://www.sitemaps.org/protocol.html
 */
class sitemap {

    private $urls = array();

    /**
     * Add a new URL to the sitemap object.
     * @param string $loc URL of the page. This URL must begin with the protocol (such as http) and end with a trailing slash, if your web server requires it. This value must be less than 2,048 characters.
     * @param string $lastmod OPTIONAL The date of last modification of the file. This date should be in W3C Datetime format. This format allows you to omit the time portion, if desired, and use YYYY-MM-DD.
     * @param type $changefreq OPTIONAL How frequently the page is likely to change. This value provides general information to search engines and may not correlate exactly to how often they crawl the page. Valid values are: always, hourly, daily, weekly, monthly, yearly, never
     * @param type $priority OPTIONAL The priority of this URL relative to other URLs on your site. Valid values range from 0.0 to 1.0. This value does not affect how your pages are compared to pages on other sites—it only lets the search engines know which pages you deem most important for the crawlers. 
     * @return boolean
     */
    public function AddURL($loc, $lastmod = '', $changefreq = '', $priority = 0.5) {
        return array_push($this->urls, array(
                    'loc' => $loc,
                    'lastmod' => $lastmod,
                    'changefreq' => $changefreq,
                    'priority' => $priority,
                ));
    }

    /**
     * Retireve the stored URLs.
     * @return object List of previously added URLs.
     */
    public function RetrieveURLS() {
        return util::ArrayToObject($this->urls);
    }

    /**
     * Generate and return the XML sitemap content.
     * @return string The XML file content.
     */
    public function Build() {
        $xml = "";
        $xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r";
        foreach ($this->RetrieveURLS() as $url) {
            $xml .= "<url>\r";
            $xml .= "<loc>" . $url->loc . "</loc>\r";
            if ($url->lastmod != '') {
                $xml .= "<lastmod>" . $url->lastmod . "</lastmod>\r";
            };
            if ($url->changefreq != '') {
                $xml .= "<changefreq>" . $url->changefreq . "</changefreq>\r";
            }
            if ($url->priority != '') {
                $xml .= "<priority>" . $url->priority . "</priority>\r";
            }
            $xml .= "</url>\r";
        }
        $xml .= "</urlset>";
        return $xml;
    }

}

?>
