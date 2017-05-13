<?php


class GroupsProvider
{
    private $curlRequests;
    private $urlUtils;
    private $settingsGitterApi;

    /**
     * GroupsProvider constructor.
     * @param CurlRequests $curlRequests
     * @param UrlUtils $urlUtils
     * @param SettingsGitterApi $settingsGitterApi
     */
    public function __construct(
        CurlRequests $curlRequests,
        UrlUtils $urlUtils,
        SettingsGitterApi $settingsGitterApi
    ) {
        $this->curlRequests = $curlRequests;
        $this->urlUtils = $urlUtils;
        $this->settingsGitterApi = $settingsGitterApi;
    }

    public function getList(string $token)
    {
        $urlToGetGroupsList = $this->urlUtils->decodeUrl(
            $this->settingsGitterApi->__get('domen').'/v1/groups',
            array(
                'access_token' => $token,
            )
        );
        var_dump($this->curlRequests->get($urlToGetGroupsList));

        return $this->curlRequests->get($urlToGetGroupsList);
    }
}

