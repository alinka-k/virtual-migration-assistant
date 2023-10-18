<?php

namespace App\Services;

use Tymon\JWTAuth\JWT;
use \Tymon\JWTAuth\Contracts\JWTSubject;

class JwtTokenService
{
    private JWT $jwt;

    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    public function setTTL(string $ttl): self
    {
        $this->jwt->factory()->setTTL($ttl);
        return $this;
    }

    public function fromUser(JWTSubject $user): string
    {
        return $this->jwt->fromUser($user);
    }
}
