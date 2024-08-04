<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Repository\Models\AnnouncementRepo;
use Illuminate\Http\Request;

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
}
