<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Repository\Models\AddressRepo;

class AddressController extends Controller
{
    private $repo;
    public function __construct()
    {
        $this->repo = new AddressRepo();
    }

    public function create(AddressRequest $request)
    {
        $atter = $request->validated();
        $atter['user_id'] = auth()->user()->id;
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
