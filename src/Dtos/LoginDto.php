<?php

namespace nhuhuy\AuthService\Dtos;

use Spatie\DataTransferObject\DataTransferObject;

class LoginDto extends DataTransferObject
{
    /** @var string*/
    public $identifier;

    /** @var string*/
    public $password;
}