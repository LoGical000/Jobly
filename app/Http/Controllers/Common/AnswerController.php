<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdviceRequest;
use App\Http\Requests\ReportAnswerRequest;
use App\Repository\Models\AnswerRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    private $AnswerRepository;

    public function __construct(AnswerRepo $AnswerRepository)
    {
        $this->AnswerRepository = $AnswerRepository;
    }

    public function create($id,AdviceRequest $request){
        $Data = $request->validated();
        $Data['user_id'] = Auth::id();
        $Data['question_id'] = $id;
        return $this->AnswerRepository->create($Data);

    }

    public function getAnswers($id){
        return $this->AnswerRepository->getAnswers($id);

    }

    public function like($id){
        return $this->AnswerRepository->like($id);
    }

    public function update($id,AdviceRequest $request){
        $Data = $request->validated();
        return $this->AnswerRepository->update($Data,$id);
    }

    public function delete($id){
        return $this->AnswerRepository->delete($id);
    }

    public function report(ReportAnswerRequest $request){
        return $this->AnswerRepository->report($request);

    }
}
