<?php

namespace App\Repository\Models;


use App\Models\User;
use App\Models\Auth_Request;
use App\Traits\ResponseTrait;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Auth_RequestRepo extends Reapository
{
    use ResponseTrait;
    public function __construct()
    {
        parent::__construct(Auth_Request::class);
    }


    public function store() {
        $user = Auth::user();
        if($user->auth_request){
            return $this->apiResponse('User already has an auth request',null,false);
        }
        $Data['user_id'] = $user->id;
        $Data['status'] = 'pending';
        $auth_request = Auth_Request::create($Data);

        if($auth_request)
            return $this->apiResponse('success',$auth_request);

        return $this->apiResponse('failed to create auth request');

    }

    public function delete_request()
    {
        $user = Auth::user();
        $authRequest = Auth_Request::where('user_id', $user->id)->first();

        if (!$authRequest) {
            return $this->apiResponse('No previous auth request');
        }
        $authRequest->delete();

        return $this->apiResponse('success');
    }


    public function accept(){
        $authRequest = Auth_Request::where('id', $id)->first();
        $authRequest->update([
            'status' => 'Accepted'
        ]);
        $user = User::where('id', $authRequest->user_id)->first();
        $user->update([
            'authentication' => 1,
        ]);
        return response()->json([
            'data' => $authRequest,
        ]);
    }

    public function reject($id)
    {
        $authRequest = Auth_Request::where('user_id', $id)->first();
        $authRequest->update([
            'status' => 'rejected'
        ]);
        $user = User::where('id', $authRequest->user_id)->first();
        $user->update([
            'authentication' => 0,
        ]);
        return response()->json([
            'data' => $authRequest,
        ]);
    }


    public function getRequest()
    {
        $user = Auth_Request::where('status', 'pending')->with('user')->get();
        return response()->json([
            'data' => $user,
        ]);
    }
}
