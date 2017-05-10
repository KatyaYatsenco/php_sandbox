<?php

class UrlUtils
{
    /**
     * @param string $url
     * @param array $urlParams
     * @return string
     */
    public function decodeUrl($url, $urlParams)
    {
        return $url.'?'.$this->buildQueryString($urlParams);
    }


    /**
     * @param array $urlParams
     * @return string
     */
    public function buildQueryString($urlParams)
    {
        return urldecode(http_build_query($urlParams));
    }
}

