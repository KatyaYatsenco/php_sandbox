<?php

//class Authentication
//{
//    public const client_id = '74fc22955439d7999d4e650a30ca209016498844';
//    public const app_url = 'http://php-sandbox.dev/main.php';
//    public const oauth_secret = '5deed2b933ac272204501ffdf1afb56f300e269f';
//    public const get_gitter_token_url = 'https://gitter.im/login/oauth/token';
//    public const grant_type = 'authorization_code';
//    public const response_type = 'code';
//
//}


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