<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Jops_category;
use App\Models\Jops_section;
use App\Repository\Models\Jops_sectionRepo;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private $repo;
    public function __construct()
    {
        $this->repo = new Jops_sectionRepo();
    }

    public function index(){
        return $this->repo->index();
    }

    public function getSectionByCaateogry(int $category_id)
    {
        $sections = Jops_category::where('id', $category_id)->with('Jops_section')->get();

        return response()->json([
            'data' => $sections,
        ]);
    }

    public function create(Request $request, int $category_id){
        $atter = $request->validate([
            'section' => 'required',
        ]);
        $atter['jops_category_id'] = $category_id;
        $section = Jops_section::create($atter);

        return response()->json([
            'section' => $section,
        ]);
    }

}
