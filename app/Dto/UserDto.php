<?php

namespace App\Dto;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;

class UserDto
{

    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $name = '',
    )
    {
        //
    }

    public static function register(RegisterRequest $request): UserDto
    {
        return new self(
            name: $request->name,
            email: $request->email,
            password: $request->password
        );
    }

    public static function login(LoginRequest $request): UserDto
    {
        return new self(
            email: $request->email,
            password: $request->password
        );
    }
}
