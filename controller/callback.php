<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Dotenv\Dotenv;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

include './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');

$dotenv->load();

require_once("controller/jwtAuth.php");


function exchangeCode($data, $apiUrl)
{
    $client = new Client();

    try {
        $response = $client->post($apiUrl, [
            'form_params' => $data,
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        }
        return false;
    } catch (RequestException $e) {
        return false;
    }
}



function getUser($access_token)
{


    $apiUrl = "https://api.github.com/user";

    $client = new Client();

    try {
        $response = $client->get($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
                'Accept' => 'application/json',
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        }
        return false;
    } catch (RequestException $e) {
        return false;
    }
}

if (isset($_GET['error']) || !isset($_GET['code'])) {
    echo 'Some error occurred';
    exit();
}

$authCode = $_GET['code'];


$data = [
    'client_id' => $_ENV['GITHUB_CLIENT_ID'],
    'client_secret' => $_ENV['GITHUB_CLIENT_SECRET'],
    'code' => $authCode,
];

$apiUrl = "https://github.com/login/oauth/access_token";

$tokenData = exchangeCode($data, $apiUrl);

if ($tokenData === false) {
    exit('Error getting token');
}

if (!empty($tokenData->error)) {
    exit($tokenData->error);
}

$user = false;

if (!empty($tokenData->access_token)) {

    $user = getUser($tokenData->access_token);
    if (!$user) {
        echo "Login failed";
        exit();
    }

    $userData = array(
        "username" => $user->login
    );

    //log out existing user
    if (isset($_COOKIE['jwt'])) {
        setcookie("jwt", "",  time() - 86400, "/", "", false, true);
    }

    $token = generateToken($userData);
    setcookie("jwt", $token, time() + (86400 * 30), "/", "", false, true);

    require_once("model/User.php");

    if (!User::userExists($user->login)) {
        User::createUser($user->login, '', false);
    }

    if (isset($_GET['state'])) {
        header("Location: " . $_GET['state']);
    } else {
        header("Location: home");
    }
    exit();
}
