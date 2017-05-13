<?php


class GitterClient
{
    private $settingsGitterApi;

    private $urlUtils;
    private $curlRequest;
    private $storage;


    /**
     * GitterClient constructor.
     * @param string $clientId
     * @param string $appUrl
     * @param string $oauthSecret
     * @param string $grantType
     * @param string $responseType
     * @param string $domen
     */
    public function __construct(
        string $clientId,
        string $appUrl,
        string $oauthSecret,
        string $grantType,
        string $responseType,
        string $domen
    ) {
        $this->settingsGitterApi = new SettingsGitterApi(
            $clientId,
            $appUrl,
            $oauthSecret,
            $grantType,
            $responseType,
            $domen
        );
        $this->urlUtils = new UrlUtils();
        $this->curlRequest = new CurlRequests();
        $this->storage = new Storage();

    }

    public function authenticate()
    {
        /** @var RenderLogin $authentication */
        $authentication = new RenderLogin($this->settingsGitterApi, $this->urlUtils);
        $authentication->renderLink();
    }

    private function token()
    {
        $tokenProvider = new TokenProvider(
            $this->settingsGitterApi, $this->urlUtils, $this->curlRequest, $this->storage
        );
        $token = $tokenProvider->get();

        return $token;
    }

    public function getInfo()
    {
        $token = $this->token();

        $info = new InfoProvider($this->urlUtils, $this->curlRequest, $this->settingsGitterApi);

        if ($token !== null) {
            $getInfo = $info->get($token);
        } else {
            print_r('Exception: Please authorise');
        }
    }


    public function getGroupsList()
    {
        if (self::token() !== null) {
            $list = new GroupsProvider($this->curlRequest, $this->urlUtils, $this->settingsGitterApi);

            $list->getList($this->token());
        }
    }

}