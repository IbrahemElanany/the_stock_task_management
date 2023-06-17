<?php

namespace App\Services\Services;

use App\Dto\UserDto;
use App\Models\User;
use App\Services\Contracts\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService implements UserInterface
{
    public function register(UserDto $userDto): User
    {
        return User::create([
            'name' => $userDto->name,
            'email' => $userDto->email,
            'password' => $userDto->password,
        ]);
    }

    public function login(UserDto $userDto): User|bool
    {
        $credentials = [
            'email'    => $userDto->email,
            'password' => $userDto->password,
        ];

        if(!Auth::attempt($credentials)){
            return false;
        }
        return User::where('email', $userDto->email)->first();

    }

    public function userProfile(): User
    {
        return \request()->user();
    }
}
