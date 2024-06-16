<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use App\Repository\Models\UserRepo;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

    function update(Request $request)
    {

        $user = User::where('id', '=', auth()->user()->id)->first();

        $user->update([
            'name' => $request->input('name') ?? $user['name'],
            'email' => $request->input('email') ?? $user['email'],
        ]);

        return response()->json([
            'user' => $user
        ]);
    }

    function index()
    {
        return $this->repo->index();
    }


    public function delete(int $id)
    {
        return $this->repo->delete($id);
    }
}
