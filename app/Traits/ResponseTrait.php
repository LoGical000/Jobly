<?php

namespace App\Traits;

trait ResponseTrait
{
    public function apiResponse($message=null,$data=null,$status=true,$statuscode=200){

        return response()->json([
            'status'=>$status,
            'message' => $message,
            'data'=> $data
        ], $statuscode);
    }

}
