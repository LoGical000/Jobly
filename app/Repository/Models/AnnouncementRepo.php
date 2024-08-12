<?php

namespace App\Repository\Models;

use App\Models\Announcement;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class AnnouncementRepo extends Reapository
{
    use ResponseTrait;

    public function __construct()
    {
        parent::__construct(Announcement::class);
    }

    public function getAllAnnouncements() {
        $announcements = Announcement::with(['user.company', 'user.auth_request'])
            ->orderBy('created_at', 'desc')
            ->get();

        $formattedAnnouncements = $this->formatAnnouncementsResponse($announcements);

        return $this->apiResponse('success', $formattedAnnouncements);
    }

}
