<?php
require_once 'GitterClient.php';
require_once 'SettingsGitterApi.php';
require_once 'Storage.php';
require_once 'RenderLogin.php';
require_once 'UrlUtils.php';
require_once 'CurlRequests.php';
require_once 'TokenProvider.php';
require_once 'InfoProvider.php';
require_once 'GroupsProvider.php';


$gitterClient = new GitterClient(
    '2c8b2aab0797d7f67b0c763554ca047a8ec6827e',
    'http://php-sandbox.dev/authentication/main.php',
    'f382b4441bd54a6abdbe1f60a65eaf1282ad567f',
    'authorization_code',
    'code'
);

$gitterClient->authenticate();
//$gitterClient->getInfo();
$gitterClient->getGroupsList();














