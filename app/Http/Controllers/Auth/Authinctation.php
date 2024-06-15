<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use App\Repository\Models\UserRepo;
use App\Http\Controllers\Controller;

class Authinctation extends Controller
{
    private $repo;
    public function __construct()
    {
        $this->repo = new UserRepo();
    }
    function register(RegisterRequest $request)
    {
        $userData = $request->validated();
        return $this->repo->createUser($userData);
    }

    function login(LoginRequest $request)
    {
        $userData = $request->validated();
        return $this->repo->loginUser($userData);
    }

    function logout()
    {
        return $this->repo->logoutUser();
    }
}
