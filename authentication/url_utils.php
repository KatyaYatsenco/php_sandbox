<?php
/**
 * @param string $url
 * @param array $urlParams
 *
 * @return string
 */
function decodeUrl($url, array $urlParams)
{
    return $url.'?'.buildQueryString($urlParams);

}

/**
 * @param $urlParams
 */
function buildQueryString($urlParams)
{
    return urldecode(http_build_query($urlParams));
}