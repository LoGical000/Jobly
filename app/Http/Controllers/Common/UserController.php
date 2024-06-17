<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\Models\UserRepo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repo;
    public function __construct()
    {
        $this->repo = new UserRepo();
    }
    public function index(int $id)
    {
        $user = User::with('address', 'vacancy')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $relations = [];

        switch ($user->role) {
            case 1:
                $relations = ['employee'];
                break;
            case 2:
                $relations = ['company'];
                break;
        }

        if ($relations) {
            $user->load($relations);
        }

        return response()->json(['data' => $user]);
    }

    public function BanUser(int $id)
    {
        $user = User::where('id', $id)->first();
        $user->update([
            'ban' => 1,
        ]);
        return response()->json([
            'data' => $user
        ]);
    }

    public function UnBanUser(int $id)
    {
        $user = User::where('id', $id)->first();
        $user->update([
            'ban' => 0,
        ]);
        return response()->json([
            'data' => $user
        ]);
    }

    public function delete($user_id)
    {
        return $this->repo->delete($user_id);
    }
}
