<?php

class sitemap {

    private $urls = array();

    public function AddURL($loc, $lastmod = '', $changefreq = '', $priority = '') {
        return array_push($this->urls, array(
                    'loc' => $loc,
                    'lastmod' => $lastmod,
                    'changefreq' => $changefreq,
                    'priority' => $priority,
                ));
    }

    public function RetrieveURLS() {
        return util::ArrayToObject($this->urls);
    }

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
