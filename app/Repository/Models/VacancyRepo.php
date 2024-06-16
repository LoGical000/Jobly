<?php

namespace App\Repository\Models;

use App\Repository\Reapository;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class VacancyRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Vacancy::class);
    }

    public function create(array $atter): Response
    {

        $vacancy = Vacancy::create($atter);
        return response()->json([
            'data' => $vacancy,
        ]);
    }
}
