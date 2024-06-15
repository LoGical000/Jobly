<?php

namespace App\Http\Controllers\Common;

use App\Class\HelperFunction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;

class HeplerController extends Controller
{
    public function StoreImg(ImageRequest $request)
    {
        return HelperFunction::Image_Upload($request);
    }

    
}
