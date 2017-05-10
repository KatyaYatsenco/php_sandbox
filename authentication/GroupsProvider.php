<?php


class GroupsProvider
{
    private $curlRequests;
    private $urlUtils;
    private const domen = 'https://api.gitter.im';

    /**
     * GroupsProvider constructor.
     * @param CurlRequests $curlRequests
     * @param UrlUtils $urlUtils
     */
    public function __construct(
        CurlRequests $curlRequests,
        UrlUtils $urlUtils
    ) {
        $this->curlRequests = $curlRequests;
        $this->urlUtils = $urlUtils;
    }

    public function getList(string $token)
    {
        $urlToGetGroupsList = $this->urlUtils->decodeUrl(
            self::domen.'/v1/groups',
            array(
                'access_token' => $token,
            )
        );
        var_dump( $this->curlRequests->get($urlToGetGroupsList));

        return $this->curlRequests->get($urlToGetGroupsList);
    }
}

