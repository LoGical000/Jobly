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

    public function index(): Response
    {

        $advices = Advice::with(['user.company', 'user.employee.image', 'user.auth_request'])
            ->get()
            ->sortByDesc(function ($advice) {
                return $advice->likes()->count();
            });


        $formattedAdvices = $advices->map(function ($advice) {
            $user = $advice->user;
            $isCompany = $user->role == 2;
            $company = $user->company;
            $employee = $user->employee;
            $authRequest = $user->auth_request;

            return [
                'name' => $isCompany ? $company->company_name : $user->name,
                'image' => $isCompany && $company ? $company->Commercial_Record : ($employee && $employee->image ? '/Employees/' . $employee->image->filename : null),
                'is_auth' => $authRequest && $authRequest->status == 'accepted',
                'time' => Carbon::parse($advice->created_at)->diffForHumans(),
                'likes_count' => $advice->likes()->count(),
                'content' => $advice->content,
            ];
        });

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
