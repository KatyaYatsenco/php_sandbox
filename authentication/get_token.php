<?php

//If we get callback 'code', we can send request to get token
function getToken()
{
    if (isset($_GET['code'])) { // need to refresh token

        try {
            $token = sendPostRequestToGetToken();
        } catch (\Exception $e) {
            print ($e->getMessage());
            exit();
        }
        saveToStorage('token', $token);
    } else { // use old token
        $token = getFromStorage('token');
    }

    return $token;
}


/**
 * @return string
 * @throws Exception
 */
function sendPostRequestToGetToken()
{
    $data = buildQueryString(
        array(
            "client_id" => CLIENT_ID,
            'client_secret' => OAUTH_SECRET,
            'code' => $_GET['code'],
            'redirect_uri' => APP_URL,
            'grant_type' => GRANT_TYPE,
        )
    );

    $response = sendPostRequest(GET_GITTER_TOKEN_URL, $data);
    $json_result = json_decode($response, true);

    if (isset($json_result['access_token'])) {
        return $json_result['access_token'];
    }

    throw new \Exception($json_result['error_message']);
}