<?php

//pattern value object
class SettingsGitterApi
{
    private $clientId;
    private $appUrl;
    private $oauthSecret;
    private $grantType;
    private $responseType;

    public function __construct(
        $clientId,
        $appUrl,
        $oauthSecret,
        $grantType,
        $responseType
    ) {
        $this->clientId = $clientId;
        $this->appUrl = $appUrl;
        $this->oauthSecret = $oauthSecret;
        $this->grantType = $grantType;
        $this->responseType = $responseType;
    }

    function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        throw new \Exception('Property does not exist');
    }

}