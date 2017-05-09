<?php

// get my info
/**
 * @param string $token
 * @return string
 */
function getInfo(string $token)
{
    $urlToAuthorisation = decodeUrl(
        'https://api.gitter.im/v1/user/me',
        array(
            'access_token' => $token,
        )
    );
    print sendGetRequest($urlToAuthorisation);

    return sendGetRequest($urlToAuthorisation);
}