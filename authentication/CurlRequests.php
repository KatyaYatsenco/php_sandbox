<?php

class CurlRequests
{
    public function post(string $url, string $data)
    {
        return $this->sendPostRequest($url, $data);
    }

    public function get(string $url)
    {
        return $this->sendGetRequest($url);
    }

    /**
     * @param string $url
     * @param resource|false $curl
     * @return string
     */
    private function curlRequest(string $url, $curl)
    {
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    /**
     * @param string $url
     * @param string $data
     * @return string
     */
    private function sendPostRequest(string $url, string $data)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        return $this->curlRequest($url, $curl);
    }

    /**
     * @param string $url
     * @return string
     */
    private function sendGetRequest(string $url)
    {
        $curl = curl_init();

        return $this->curlRequest($url, $curl);
    }


}





