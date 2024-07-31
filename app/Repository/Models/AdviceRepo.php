<?php

namespace App\Repository\Models;

use App\Models\Address;
use App\Models\Advice;
use App\Models\Like;
use App\Models\Report;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdviceRepo extends Reapository
{
    use ResponseTrait;
    public function __construct()
    {
        parent::__construct(Advice::class);
    }

    public function indexByLike()
    {
        $advices = Advice::with(['user.company', 'user.employee.image', 'user.auth_request'])
            ->get()
            ->sortByDesc(function ($advice) {
                return $advice->likes()->count();
            })
            ->values();

        $formattedAdvices = $this->formatResponses($advices);

        return $this->apiResponse('success', $formattedAdvices);
    }

    public function indexByDate()
    {
        $advices = Advice::with(['user.company', 'user.employee.image', 'user.auth_request'])
            ->get()
            ->sortByDesc('created_at')
            ->values();

        $formattedAdvices = $this->formatResponses($advices);

        return $this->apiResponse('success', $formattedAdvices);
    }

    public function like($id)
    {
        $advice = Advice::find($id);

        if (!$advice)
            return $this->apiResponse('Advice not found', null, false);


        $userId = Auth::id();


        $existingLike = $advice->likes()->where('user_id', $userId)->first();

        if ($existingLike) {
            $existingLike->delete();
            return $this->apiResponse('Unlike');
        } else {
            $like = new Like();
            $like->user_id = $userId;

            $advice->likes()->save($like);
            return $this->apiResponse('Liked', $like);
        }
    }

    public function report($request){
        $advice_id = $request->advice_id;
        $advice = Advice::find($advice_id);

        if (!$advice)
            return $this->apiResponse('Advice not found', null, false);

        $report = new Report();
        $report->user_id = Auth::id();
        $report->reason = $request->reason;

        $advice->reports()->save($report);
        return $this->apiResponse('success', $report);

    }


}
