<?php

namespace App\Services\Contracts;

use App\Dto\UserDto;
use App\Models\User;
use Illuminate\Http\Request;

interface UserInterface
{
    public function register(UserDto $userDto): User;

    public function login(UserDto $userDto): User|bool;

    public function userProfile(): User;
}
