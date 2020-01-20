<?php

namespace nhuhuy\AuthService;

use Exception;
use nhuhuy\AuthService\Dtos\LoginDto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use nhuhuy\AuthService\Models\User;

class AuthService implements AuthServiceInterface
{
    protected User $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Undocumented function
     *
     * @param string $identifier
     * @return User
     */
    public function getOne(string $identifier): User
    {
        $user = $this->model
            ->where('is_active', true)
            ->where('phone', $identifier)
            ->orWhere('username', $identifier)
            ->orWhere('email', $identifier)
            ->first();
        
        if (!isset($user)) {
            throw new Exception('User not found');
        }

        return $user;
    }

    /**
     * Undocumented function
     *
     * @param LoginDto $dto
     * @return string
     */
    public function getAccessToken(LoginDto $dto): string
    {
        $user = $this->getOne($dto->identifier);
    
        if (Hash::check($dto->password, $user->password)) {

            return $this->createOneToken($user);
        }

        throw new Exception('Password not match');
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @return string
     */
    protected function createOneToken(User $user): string
    {
        return DB::transaction(function () use ($user) {
            $token = $user->createToken('Personal Access Client')->accessToken;
            return $token;
        });  
    }
}