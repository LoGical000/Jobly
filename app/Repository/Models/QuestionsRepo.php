<?php

namespace App\Repository\Models;



use App\Models\Answer;
use App\Models\Like;
use App\Models\Question;
use App\Models\Report;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;

class QuestionsRepo extends Reapository
{
    use ResponseTrait;
    public function __construct()
    {
        parent::__construct(Question::class);
    }

    public function indexByDate()
    {
        $questions = Question::with(['user.company', 'user.employee.image', 'user.auth_request'])
            ->get()
            ->sortByDesc('created_at')
            ->values();

        $formattedQuestions = $this->formatQuestionResponse($questions);

        return $this->apiResponse('success', $formattedQuestions);
    }

    public function indexBySection($id){
        $questions = Question::where('jops_category_id',$id)->with(['user.company', 'user.employee.image', 'user.auth_request'])
            ->get()
            ->sortByDesc('created_at')
            ->values();

        $formattedQuestions = $this->formatQuestionResponse($questions);

        return $this->apiResponse('success', $formattedQuestions);
    }

    public function like($id){
        $question = Question::find($id);

        if (!$question)
            return $this->apiResponse('Question not found', null, false);


        $userId = Auth::id();


        $existingLike = $question->likes()->where('user_id', $userId)->first();

        if ($existingLike) {
            $existingLike->delete();
            return $this->apiResponse('Unlike');
        } else {
            $like = new Like();
            $like->user_id = $userId;

            $question->likes()->save($like);
            return $this->apiResponse('Liked', $like);
        }

    }

    public function report($request){
        $question_id = $request->question_id;
        $question = Question::find($question_id);

        if (!$question)
            return $this->apiResponse('Question not found', null, false);

        $report = new Report();
        $report->user_id = Auth::id();
        $report->reason = $request->reason;

        $question->reports()->save($report);
        return $this->apiResponse('success', $report);

    }


}
