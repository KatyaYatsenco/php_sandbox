<?php
/**
 * @param string $url
 * @param string $data
 * @return string
 */
function sendPostRequest(string $url, string $data)
{
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    return curlRequest($url, $curl);
}

/**
 * @param string $url
 * @return string
 */
function sendGetRequest(string $url)
{
    $curl = curl_init();

    return curlRequest($url, $curl);
}

/**
 * @param string $url
 * @param resource|false $curl
 * @return string
 */
function curlRequest(string $url, $curl)
{
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
}

