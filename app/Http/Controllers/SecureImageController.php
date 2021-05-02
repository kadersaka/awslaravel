<?php

namespace App\Http\Controllers;

use App\Models\SecureImage;
use Illuminate\Http\Request;

class SecureImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $logo = $request->file('logo');
        $upload_file = $request->file('image');
        $path = $upload_file->store('images', 's3');

        // open an image file
        $img = Image::make($upload_file);
        // resize image instance
        $height = Image::make($upload_file)->height();
        $width = Image::make($upload_file)->width();
        $img->resize($width/10, $height/10);
        // insert a watermark
        $img->insert($logo);

        // save image in desired format
        //  $img->save('public/bar.jpg');
        $fakepath = $img->store('secureimages', 's3');

        $image = new SecureImage();
        $image->name = basename($path);
        $image->fakename = basename($fakepath);
        $image->fakepath = $fakepath;
        $image->path = $path;
        $image->url = Storage::disk('s3')->url($path);
        $image->fakeurl = Storage::disk('s3')->url($fakepath);
        $image->save();

        return $video;    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SecureImage  $secureImage
     * @return \Illuminate\Http\Response
     */
    public function show(SecureImage $secureImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SecureImage  $secureImage
     * @return \Illuminate\Http\Response
     */
    public function edit(SecureImage $secureImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SecureImage  $secureImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SecureImage $secureImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SecureImage  $secureImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(SecureImage $secureImage)
    {
        //
    }
}
