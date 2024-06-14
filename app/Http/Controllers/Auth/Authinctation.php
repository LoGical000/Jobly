<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\UserRepo;
use Illuminate\Support\Facades\Auth;

class Authinctation extends Controller
{
    private $repo;
    public function __construct(){
        $this->repo = new UserRepo();
        $this->repo->add
    }
    function register(Request $request){
            $atter = $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:'. User::class],
                'email' => ['required', 'string', 'email', 'unique:' . User::class],
                'password' => ['required', 'min:8'],
                'role' => ['required', 'string'],
            ]);


            $user = User::create($atter);
            if(!$user){
                return response()->json([
                    'message' => 'user not create',
                ], 404);
            }
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('secret')->plainTextToken,
            ],200); 
    }

    function login(Request $request){
        $atter = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($atter)) {
            return response([
                'message' => 'Inavild Crdenatail'
            ], 403);
        }
        
        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);

        
    }

    function logout(){
        return response()->json([
            'user' => auth()->user()->tokens()->delete(),
            'message' => 'user logout success'
        ],200);
    }
}
