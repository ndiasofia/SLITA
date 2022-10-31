<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($authHeader)
{
    if (is_null($authHeader)) {
        throw new Exception("Authentikasi JWT Gagal");
    }
    return explode(" ", $authHeader)[1];
}

function validateJWT($encodedToken)
{
    $session = \Config\Services::session();
    $key = getenv('JWT_SECRET_KEY');
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
    $data = [
        'codeBank' => $decodedToken->codeBank,
        'nameBank' => $decodedToken->nameBank,
    ];
    $session->set($data);
}

function createJWT($codeBank, $nameBank)
{
    $timeRequest = time();
    $payload = [
        'codeBank' => $codeBank,
        'nameBank' => $nameBank,
        'iat' => $timeRequest,
    ];

    $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');
    return $jwt;
}
