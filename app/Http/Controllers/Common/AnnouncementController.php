<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Repository\Models\AnnouncementRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
