<?php

//pattern value object
class SettingsGitterApi
{
    private $clientId;
    private $appUrl;
    private $oauthSecret;
    private $grantType;
    private $responseType;
    private $domen;

    public function __construct(
        $clientId,
        $appUrl,
        $oauthSecret,
        $grantType,
        $responseType,
        $domen
    ) {
        $this->clientId = $clientId;
        $this->appUrl = $appUrl;
        $this->oauthSecret = $oauthSecret;
        $this->grantType = $grantType;
        $this->responseType = $responseType;
        $this->domen = $domen;
    }

    function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        throw new \Exception('Property does not exist');
    }

}