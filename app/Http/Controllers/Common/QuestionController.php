<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdviceRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\ReportAdviceRequest;
use App\Http\Requests\ReportQuestionRequest;
use App\Repository\Models\QuestionsRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    private $QuestionRepository;

    public function __construct(QuestionsRepo $QuestionRepository)
    {
        $this->QuestionRepository = $QuestionRepository;
    }

    public function create(QuestionRequest $request){
        $Data = $request->validated();
        $Data['user_id'] = Auth::id();
        return $this->QuestionRepository->create($Data);
    }

    public function indexByDate(){
        return $this->QuestionRepository->indexByDate();
    }

    public function indexBySection($id){
        return$this->QuestionRepository->indexBySection($id);
    }

    public function like($id){
        return $this->QuestionRepository->like($id);
    }

    public function delete($id){
        return $this->QuestionRepository->delete($id);

    }

    public function report(ReportQuestionRequest $request){
        return $this->QuestionRepository->report($request);
    }

}
