<?php
use Dotenv\Dotenv;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

include './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

function validateToken($token)
    {
        try {
            $publicKey =  base64_decode($_ENV['JWT_PUBLIC_KEY']);
            $decoded =  JWT::decode($token, new Key($publicKey, 'RS256'));
            return $decoded;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    function generateToken($payload)
    {
        $token = JWT::encode($payload,  base64_decode($_ENV['JWT_PRIVATE_KEY']), 'RS256');
        return $token;
    }

    