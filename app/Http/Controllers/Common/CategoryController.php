<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Jops_category;
use App\Repository\Models\Jops_categoryRepo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $repo;
    public function __construct()
    {
        $this->repo = new Jops_categoryRepo();
    }


    public function index()
    {
        return $this->repo->index();
    }


    public function create(Request $request)
    {
        $atter = $request->validate([
            'category' => 'required',
        ]);
        $sectcategoryion = Jops_category::create($atter);

        return response()->json([
            'section' => $category,
        ]);
    }
}
