<?php

namespace App\Repository\Models;



use App\Models\Questions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class QuestionsRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Questions::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Questions::all();
    }
}
