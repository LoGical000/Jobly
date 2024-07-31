<?php

namespace App\Repository\Models;


use App\Models\Answer;
use App\Models\Like;
use App\Models\Report;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;

class AnswerRepo extends Reapository
{
    use ResponseTrait;
    public function __construct()
    {
        parent::__construct(Answer::class);
    }

    public function getAnswers($id){
        $answers = Answer::where('question_id',$id)->with(['user.company', 'user.employee.image', 'user.auth_request'])
            ->get()
            ->sortByDesc(function ($advice) {
                return $advice->likes()->count();
            })
            ->values();

        $formattedAdvices = $this->formatResponses($answers);

        return $this->apiResponse('success', $formattedAdvices);
    }

    public function like($id){
        $answer = Answer::find($id);

        if (!$answer)
            return $this->apiResponse('Answer not found', null, false);


        $userId = Auth::id();


        $existingLike = $answer->likes()->where('user_id', $userId)->first();

        if ($existingLike) {
            $existingLike->delete();
            return $this->apiResponse('Unlike');
        } else {
            $like = new Like();
            $like->user_id = $userId;

            $answer->likes()->save($like);
            return $this->apiResponse('Liked', $like);
        }
    }

    public function report($request){
        $answer_id = $request->answer_id;
        $answer = Answer::find($answer_id);

        if (!$answer)
            return $this->apiResponse('Answer not found', null, false);

        $report = new Report();
        $report->user_id = Auth::id();
        $report->reason = $request->reason;

        $answer->reports()->save($report);
        return $this->apiResponse('success', $report);
    }

}
