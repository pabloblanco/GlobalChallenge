<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //
    public function __construct()
    {
        app('debugbar')->disable();
    }

    public function delete(Request $request)
    {
        $path = $request->getContent(); 
        $directory = '/tmp/'.dirname($path);
        
        Storage::deleteDirectory($directory);           
    }

    public static function store(Request $request)
    {        
        return 'imageDefault.jpg';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('tmp/'.$folder , $filename);
            $path = $folder."/".$filename;    
            return $path;
        }
        return 'imageDefault.jpg';
    }

    public function upload(Request $request)
    {
        if($request->hasFile('imageFilepond'))
        {
            return $request->file('imageFilepond')->store('uploads/movies', 'public');
        }
        return '';
    }

    public function uploadRevert(Request $request)
    {
        if($image = $request->get('image')) {
            $path = storage_path('app/public/' . $image);
            if(file_exists($path)){
                unlink($path);
            }
        }
        return '';
    }

    protected function processImage(Request $request, Movies $movies = null)
    {

        $images = $request->get('image') ? explode('|', $request->get('image')) : [];

        foreach($images as $image)
        {
            if(!$movies->hasImage($image)){
                $path = storage_path('app/public/' . $image);
                if(file_exists($path)){
                    copy($path, public_path($image));
                    unlink($path);
                }
            }
        }

        foreach($movies->findMissingImages($images) as $img)
        {
            if(file_exists(public_path($img))){
                unlink(public_path($img));
            }
        }

        $movies->update([
            'image' => $request->get('image')
        ]);
    }

}
