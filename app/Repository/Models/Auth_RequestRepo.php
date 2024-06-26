<?php

namespace App\Repository\Models;


use App\Models\Auth_Request;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;

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
}
