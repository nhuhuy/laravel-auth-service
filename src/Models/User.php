<?php

namespace nhuhuy\AuthService\Models;

use App\User as ModelsUser;
use Illuminate\Support\Facades\Hash;

class User extends ModelsUser
{
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}