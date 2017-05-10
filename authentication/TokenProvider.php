<?php

class TokenProvider
{
    private $settingsGitterApi;
    private $urlUtils;
    private $curlRequest;
    private $storage;

    private const gitterTokenUrl = 'https://gitter.im/login/oauth/token';


    /**
     * TokenProvider constructor.
     * @param SettingsGitterApi $settingsGitterApi
     * @param UrlUtils $urlUtils
     * @param CurlRequests $curlRequests
     * @param Storage $storage
     * @internal param SettingsGitterApi $parameters
     */
    public function __construct(
        SettingsGitterApi $settingsGitterApi,
        UrlUtils $urlUtils,
        CurlRequests $curlRequests,
        Storage $storage
    ) {
        $this->settingsGitterApi = $settingsGitterApi;
        $this->urlUtils = $urlUtils;
        $this->curlRequest = $curlRequests;
        $this->storage = $storage;
    }

    //If we get callback 'code', we can send request to get token
    public function get()
    {
        if (isset($_GET['code'])) { // need to refresh token

            try {
                $token = $this->sendPostRequestToGetToken();
            } catch (\Exception $e) {
                print ($e->getMessage());
                exit();
            }
            $this->storage->set('TokenProvider', $token);
        } else { // use old token
            $token = $this->storage->get('TokenProvider');
        }

        return $token;
    }

    /**
     * @return string
     * @throws Exception
     */
    private function sendPostRequestToGetToken()
    {
        $data = $this->urlUtils->buildQueryString(
            array(
                "client_id" => $this->settingsGitterApi->__get('clientId'),
                'client_secret' => $this->settingsGitterApi->__get('oauthSecret'),
                'code' => $_GET['code'],
                'redirect_uri' => $this->settingsGitterApi->__get('appUrl'),
                'grant_type' => $this->settingsGitterApi->__get('grantType'),
            )
        );

        $response = $this->curlRequest->post(self::gitterTokenUrl, $data);
        $json_result = json_decode($response, true);

        if (isset($json_result['access_token'])) {
            return $json_result['access_token'];
        }

        throw new \Exception($json_result['error_message']);
    }
}



