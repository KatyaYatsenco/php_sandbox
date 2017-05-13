<?php

class InfoProvider
{
    private $urlUtils;
    private $curlRequests;
    private $settingsGitterApi;

    /**
     * Info constructor.
     * @param UrlUtils $urlUtils
     * @param CurlRequests $curlRequest
     * @param SettingsGitterApi $settingsGitterApi
     */
    public function __construct(UrlUtils $urlUtils, CurlRequests $curlRequest, SettingsGitterApi $settingsGitterApi)
    {
        $this->urlUtils = $urlUtils;
        $this->curlRequest = $curlRequest;
        $this->settingsGitterApi = $settingsGitterApi;
    }

    /**
     * @param string $token
     * @return string
     */
    public function get(string $token)
    {
        $urlToAuthorisation = $this->urlUtils->decodeUrl(
            $this->settingsGitterApi->__get('domen').'/v1/user/me',
            array(
                'access_token' => $token,
            )
        );
        print $this->curlRequest->get($urlToAuthorisation);

        return $this->curlRequest->get($urlToAuthorisation);
    }
}
