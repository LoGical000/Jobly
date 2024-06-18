<?php

namespace App\Class;

use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Request;

class HelperFunction
{

    public static function Image_Upload(ImageRequest $request)
    {
        $validated = $request->validated();

        // // Get the original file extension
        // $extension = $request->image->extension();

        // // Construct the file name with the correct extension
        // $imageName = time() . '-' . auth()->user()->name . '.' . $extension;

        // Move the file to the public/images directory
        $imagePath = $request->file('image')->move(public_path('images'), $validated['name']);

        return [
            'message' => true,
            'image_path' => $validated['name'],
        ];
    }
    public function storeImage($image)
    {
        $imgName = time() . '-' . auth()->user()->name . '.' . $image->extension();
        $ImagePath = $image->move(public_path('images'), $imgName);
        return $imgName;
    }
}
