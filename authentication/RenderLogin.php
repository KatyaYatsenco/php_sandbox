<?php

class RenderLogin
{
    private $settingsGitterApi;
    private $urlUtils;

    private const authoriseUrl = 'https://gitter.im/login/oauth/authorize';

    /**
     * RenderLogin constructor.
     * @param SettingsGitterApi $settingsGitterApi
     * @param UrlUtils $urlUtils
     */
    public function __construct(SettingsGitterApi $settingsGitterApi, UrlUtils $urlUtils)
    {
        $this->settingsGitterApi = $settingsGitterApi;
        $this->urlUtils = $urlUtils;
    }

    private function getUrl()
    {
        return $this->urlUtils->decodeUrl(
            self::authoriseUrl,
            array(
                'client_id' => $this->settingsGitterApi->__get('clientId'),
                'response_type' => $this->settingsGitterApi->__get('responseType'),
                'redirect_uri' => $this->settingsGitterApi->__get('appUrl'),
            )
        );
    }

    public function renderLink()
    {
        return print "<a href=\"".$this->getUrl()."\">Authentication</a><br/>";
    }

    /**
     * @param UrlUtils $urlUtils
     * @return RenderLogin
     */
    public function setUrlUtils(UrlUtils $urlUtils): RenderLogin
    {
        $this->urlUtils = $urlUtils;

        return $this;
    }

    /**
     * @return UrlUtils
     */
    public function getUrlUtils(): UrlUtils
    {
        return $this->urlUtils;
    }

}

