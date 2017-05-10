<?php

class InfoProvider
{
    private $urlUtils;
    private $curlRequests;

    /**
     * Info constructor.
     * @param UrlUtils $urlUtils
     * @param CurlRequests $curlRequest
     */
    public function __construct(UrlUtils $urlUtils, CurlRequests $curlRequest)
    {
        $this->urlUtils = $urlUtils;
        $this->curlRequest = $curlRequest;
    }

    /**
     * @param string $token
     * @return string
     */
    public function get(string $token)
    {
        $urlToAuthorisation = $this->urlUtils->decodeUrl(
            'https://api.gitter.im/v1/user/me',
            array(
                'access_token' => $token,
            )
        );
        print $this->curlRequest->get($urlToAuthorisation);

        return $this->curlRequest->get($urlToAuthorisation);
    }
}
