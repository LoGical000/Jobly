<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

trait UploadTrait
{
    public function UploadImage(Request $request, $inputname , $foldername , $disk, $imageable_id, $imageable_type) {

        ///if( $request->hasFile( $inputname ) ) {

        $photo = $request->file($inputname);
        $name = \Str::slug($request->input('name'));
        $filename = time() . '-' .$name.  '.' . $photo->getClientOriginalExtension();


        // insert Image
        $Image = new Image();
        $Image->filename = $filename;
        $Image->imageable_id = $imageable_id;
        $Image->imageable_type = $imageable_type;
        $Image->save();
        $request->file($inputname)->storeAs($foldername, $filename, $disk);

        ///}




    }

    public function Delete_file($disk,$path,$filename){

        Storage::disk($disk)->delete($path);
        Image::where('filename',$filename)->delete();

    }
}
