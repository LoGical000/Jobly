<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\Models\UserRepo;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait;
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

        if($user->ban == 1)
            return $this->apiResponse('User already banned',null,false);

        $user->update([
            'ban' => 1,
        ]);
        return response()->json([
            'data' => $user
        ]);
    }

    public function usereBan()
    {
        $user = User::where('ban', 1)->all();
        return response()->json([
            'data' => $user,
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

    // public function getCompany(){
    //     return $this->repo->getCompany();
    // }

    // public function getUser()
    // {
    //     return $this->repo->getUser();
    // }

    public function delete($user_id)
    {
        return $this->repo->delete($user_id);
    }
    public function company()
    {
        return $this->repo->company();
    }
}
