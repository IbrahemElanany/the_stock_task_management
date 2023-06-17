<?php

namespace App\Http\Controllers\Api;

use App\Dto\UserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Facades\UserFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = UserFacade::register(UserDto::register($request));
        return callbackData("User registered successfully",new UserResource($user));
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = UserFacade::login(UserDto::login($request));
        if (!$user){
            return callbackData( "Credentials didn't match",(object)[]);
        }
        return callbackData("User login successfully",[
            'user'  => new UserResource($user),
            'token' => $user->createToken($user->name)->plainTextToken
        ]);
    }

    public function profile(): JsonResponse
    {
        $user = UserFacade::userProfile();
        return callbackData("User profile",new UserResource($user));
    }
}
