<?php

//Define constant data
define('CLIENT_ID', '74fc22955439d7999d4e650a30ca209016498844');
define('APP_URL', 'http://php-sandbox.dev/authentication.php');

define('OAUTH_SECRET', '5deed2b933ac272204501ffdf1afb56f300e269f');
define("GET_GITTER_TOKEN_URL", 'https://gitter.im/login/oauth/token');
define('GRANT_TYPE', 'authorization_code');
define("RESPONSE_TYPE", 'code');


//Send authentication request to gitter.im
renderLoginLink();
$token = getToken();
getInfo($token);

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

function renderLoginLink()
{
    $url = decodeUrl(
        "https://gitter.im/login/oauth/authorize",
        array(
            'client_id' => CLIENT_ID,
            'response_type' => RESPONSE_TYPE,
            'redirect_uri' => APP_URL,
        )
    );

    print "<a href=\"".$url."\">Authentication</a><br/>";
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

/**
 * @param string $url
 * @param string $data
 * @return string
 */
function sendPostRequest(string $url, string $data)
{
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    return curlRequest($url, $curl);
}

/**
 * @param string $url
 * @return string
 */
function sendGetRequest(string $url)
{
    $curl = curl_init();

    return curlRequest($url, $curl);
}

/**
 * @param string $url
 * @param resource|false $curl
 * @return string
 */
function curlRequest(string $url, $curl)
{
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
}

/**
 * @param string $key
 * @param integer|float|string|boolean|array $value
 */
function saveToStorage($key, $value)
{
    $_SESSION[$key] = $value;
}


/**
 * @param string $key
 * @return integer|float|string|boolean|array
 */
function getFromStorage($key)
{
    return $_SESSION[$key];
}

/**
 * @param string $url
 * @param array $urlParams
 *
 * @return string
 */
function decodeUrl($url, array $urlParams)
{
    return $url.'?'.buildQueryString($urlParams);

}

/**
 * @param $urlParams
 */
function buildQueryString($urlParams)
{
    return urldecode(http_build_query($urlParams));
}
