<?php

namespace App\Repository\Models;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;


class UserRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }
    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return User::all();
    }

    public function createUser(array $request): Response
    {
        $user = User::create($request);
        if (!$user) {
            return response()->json([
                'message' => 'user not created',
            ], 404);
        }
        return Response()->json([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken,
        ]);
    }

    public function loginUser(array $request): Response
    {
        if (!Auth::attempt($request)) {
            return response([
                'message' => 'Inavild Crdenatail'
            ], 403);
        }

        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    public function logoutUser(): Response
    {
        return response()->json([
            'user' => auth()->user()->tokens()->delete(),
            'message' => 'user logout success'
        ], 200);
    }

}
