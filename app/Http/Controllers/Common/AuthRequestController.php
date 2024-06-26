<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Repository\Models\Auth_RequestRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRequestController extends Controller
{
    private $AuthRequestRepository;

    public function __construct(Auth_RequestRepo $AuthRequestRepository)
    {
        $this->AuthRequestRepository = $AuthRequestRepository;
    }

    public function create(){
        return $this->AuthRequestRepository->store();
    }

    public function delete(){
        return $this->AuthRequestRepository->delete_request();
    }
}
