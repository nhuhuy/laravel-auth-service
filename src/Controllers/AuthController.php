<?php

namespace nhuhuy\AuthService\Controllers;

use nhuhuy\AuthService\Dtos\LoginDto;
use App\Http\Controllers\Controller;
use nhuhuy\AuthService\Requests\LoginRequest;
use nhuhuy\AuthService\AuthServiceInterface;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthServiceInterface $service)
    {
        $this->service = $service;
    }

    public function store(LoginRequest $request)
    {
        $dto = new LoginDto([
            'identifier' => $request->input('username'),
            'password' => $request->input('password'),
        ]);

        return [
            'access_token' => $this->service->getAccessToken($dto)
        ];
    }
}
