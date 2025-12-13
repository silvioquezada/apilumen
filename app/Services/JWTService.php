<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Carbon\Carbon;

class JWTService
{
    private $key;
    private $issuer;

    public function __construct()
    {
        $this->key = env('JWT_SECRET');
        $this->issuer = env('APP_URL', 'lumen-api');
    }

    public function crearToken($data)
    {
        $payload = [
            'iss' => $this->issuer, // quién emite el token
            'iat' => Carbon::now()->timestamp,
            'nbf' => Carbon::now()->timestamp, // no válido antes de...
            'exp' => Carbon::now()->addHours(12)->timestamp,
            'data' => $data,
        ];

        return JWT::encode($payload, $this->key, 'HS256');
    }

    public function validarToken($token)
    {
        return JWT::decode($token, new Key($this->key, 'HS256'));
    }
}
