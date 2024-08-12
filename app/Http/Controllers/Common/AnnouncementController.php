<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Repository\Models\AnnouncementRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    private $AnnouncementRepository;

    public function __construct(AnnouncementRepo $AnnouncementRepository)
    {
        $this->AnnouncementRepository = $AnnouncementRepository;
    }

    public function index(){
        return $this->AnnouncementRepository->getAllAnnouncements();
    }

    public function create(AnnouncementRequest $request){
        $Data = $request->validated();
        $Data['user_id'] = Auth::id();

        return $this->AnnouncementRepository->create($Data);
    }
    public function delete($id){
        $announcement = Announcement::where('id',$id)->first();
        return response()->json([
            'data' => $announcement->delete(),
        ]);
    }
}
