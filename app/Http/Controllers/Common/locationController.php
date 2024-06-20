<?php

namespace App\Http\Controllers\common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Repository\Models\LocationRepo;

class locationController extends Controller
{
    private $repo;
    public function __construct()
    {
        $this->repo = new LocationRepo();
    }

    public function create(AddressRequest $request, int $vacancy_id)
    {
        $atter = $request->validated();
        $atter['vacancy_id'] = $vacancy_id;
        return $this->repo->create($atter);
    }

    public function update(Request $request, int $id)
    {
        $atter = $request->validate([
            'county' => 'required',
            'city' => 'required',
            'Governorate' => 'required',
        ]);

        return $this->repo->update($atter, $id);
    }

    public function delete(int $id)
    {
        return $this->repo->delete($id);
    }
}
