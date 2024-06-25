<?php

namespace App\Traits;

use App\Models\Image;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;

trait UploadTrait
{
    public function UploadImage(Request $request, $inputname , $foldername , $disk, $imageable_id, $imageable_type) {

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

    }

    public function UploadEmployeeImage($Data, $inputname , $foldername , $disk, $imageable_id, $imageable_type) {

        $photo = $Data[$inputname];
        $name = \Str::slug('Employee');
        $filename = time() . '-' . $name . '.' . $photo->getClientOriginalExtension();

        // insert Image
        $Image = new Image();
        $Image->filename = $filename;
        $Image->imageable_id = $imageable_id;
        $Image->imageable_type = $imageable_type;
        $Image->save();

        // Store the file
        $photo->storeAs($foldername, $filename, $disk);

    }

    public function UploadPDF(Request $request, $inputname , $foldername , $disk,$filename) {

        $request->file($inputname)->storeAs($foldername, $filename, $disk);

    }

    public function UploadVid(Request $request, $inputname , $foldername , $disk, $videaoble_id, $videoable_type) {

        $photo = $request->file($inputname);
        $name = \Str::slug($request->input('name'));
        $filename = time() . '-' .$name.  '.' . $photo->getClientOriginalExtension();

        $video = new Video();
        $video->filename = $filename;
        $video->videoable_id = $videaoble_id;
        $video->videoable_type = $videoable_type;
        $video->save();
        $request->file($inputname)->storeAs($foldername, $filename, $disk);

    }

    public function Delete_file($disk,$path){
        Storage::disk($disk)->delete($path);

    }

    public function Delete_Image($disk,$path,$filename){

        Storage::disk($disk)->delete($path);
        Image::where('filename',$filename)->delete();

    }

    public function Delete_Video($disk,$path,$filename){

        Storage::disk($disk)->delete($path);
        Video::where('filename',$filename)->delete();

    }
}
