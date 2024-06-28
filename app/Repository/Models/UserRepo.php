<?php

namespace App\Repository\Models;

use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class UserRepo extends Reapository
{
    use ResponseTrait;
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function index(): Response
    {
        return response()->json([
            'model' => auth()->user(),
        ]);
    }


    public function profile(): Response
    {
        $user = auth()->user();

        if ($user) {
            if ($user->role === 2) {
                $user->load(['Company', 'address']);
            } else if ($user->role === 1) {
                $user->load(['employee', 'address']);
            }
        }

        // Return the user data as a JSON response
        return response()->json([
            'data' => $user,
        ]);
    }




    public function createUser(array $request): Response
    {
        $request['password'] = Hash::make($request['password']);
        $request['ban'] = 0;
        $request['authentication'] = 0;
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

    public function createUser_app(array $request): Response
    {
        $request['password'] = Hash::make($request['password']);
        $request['ban'] = 0;
        $request['authentication'] = 0;
        $user = User::create($request);
        if (!$user)
            return $this->apiResponse('User not created', null, false);

        $user->token = $user->createToken('secret')->plainTextToken;

        return $this->apiResponse('success', $user);
    }

    public function loginUser_app(array $request): Response
    {
        if (!Auth::attempt($request))
            return $this->apiResponse('Inavild Crdenatail', null, false);

        $user = Auth::user();
        $user->token = $user->createToken('secret')->plainTextToken;

        return $this->apiResponse('success', $user);
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
