<?php

namespace App\Repository\Models;


use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class AnswerRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Answer::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Answer::all();
    }
}
