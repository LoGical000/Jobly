<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdviceRequest;
use App\Http\Requests\ReportAdviceRequest;
use App\Models\Advice;
use App\Repository\Models\AdviceRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdviceController extends Controller
{
    private $AdviceRepository;

    public function __construct(AdviceRepo $AdviceRepository)
    {
        $this->AdviceRepository = $AdviceRepository;
    }

    public function create(AdviceRequest $request){
        $Data = $request->validated();
        $Data['user_id'] = Auth::id();
        return $this->AdviceRepository->create($Data);
    }

    public function index(){
        return $this->AdviceRepository->index();

    }

    public function like($id){
        return $this->AdviceRepository->like($id);

    }

    public function report(ReportAdviceRequest $request){
        return $this->AdviceRepository->report($request);

    }

    public function delete($id){
        return $this->AdviceRepository->delete($id);

    }
}
