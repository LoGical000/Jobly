<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Repository\Models\CompanyRepo;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $repo;
    public function __construct()
    {
        $this->repo = new CompanyRepo();
    }
    public function index(){
        return $this->repo->index();
    }

    public function createComp(CompanyRequest $request)
    {
        $compData = $request->validated();

        return $this->repo->create($compData);
    }

    public function updateComp(CompanyRequest $request,int $id)
    {
        $compData = $request->validated();

        return $this->repo->update($compData, $id);
    }

    public function deleteComp(int $id)
    {
        return $this->repo->delete($id);
    }


}
