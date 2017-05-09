<?php

require_once 'storage.php';
require_once 'render_login.php';
require_once 'url_utils.php';
require_once 'curl_requests.php';
require_once 'get_token.php';
require_once 'get_info.php';


//Define constant data
define('CLIENT_ID', '2c8b2aab0797d7f67b0c763554ca047a8ec6827e');
define('APP_URL', 'http://php-sandbox.dev/authentication/main.php');

define('OAUTH_SECRET', 'f382b4441bd54a6abdbe1f60a65eaf1282ad567f');
define("GET_GITTER_TOKEN_URL", 'https://gitter.im/login/oauth/token');
define('GRANT_TYPE', 'authorization_code');
define("RESPONSE_TYPE", 'code');


//Send authentication request to gitter.im
renderLoginLink();
$token = getToken();
if ($token !== null) {
    getInfo($token);
}















