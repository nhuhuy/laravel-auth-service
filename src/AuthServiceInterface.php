<?php

namespace nhuhuy\AuthService;
use nhuhuy\AuthService\Dtos\LoginDto;

interface AuthServiceInterface
{
    public function getAccessToken(LoginDto $dto): string;
}