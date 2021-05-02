<?php
//https://www.larashout.com/using-uuids-in-laravel-models
//https://stackoverflow.com/questions/65980097/laravel-ffmpeg-unable-to-load-ffmpeg-in-file-error
//https://protone.media/en/blog/how-to-use-ffmpeg-in-your-laravel-projects
//https://packagist.org/packages/pbmedia/laravel-ffmpeg
//https://github.com/protonemedia/laravel-ffmpeg
namespace App\Http\Controllers;
/*
use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\CopyFormat;
use FFMpeg\Filters\AdvancedMedia\ComplexFilters;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSExporter;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use FFMpeg\Filters\Video\VideoFilters;
*/
use Illuminate\Support\Facades\Storage;

use App\Models\VideoImage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use FFMpeg;
use Illuminate\Support\Str;
//use FFMpeg\FFMpeg;
class VideoImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Str::uuid()->toString();
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
        $video = $request->file('video');
        $fakepath = Str::uuid()->toString()+".mp4";
        $path = $request->file('video')->store('videos', 's3');

        try {

            FFMpeg::open($request->file('video'))
            ->resize(320, 240)
            ->addWatermark(function(WatermarkFactory $watermark) {
                $watermark->open($logo)
                    ->right(25)
                    ->bottom(25)
                    ->width(100)
                    ->height(100)
                    ->greyscale();
            })
            ->export()
            ->toDisk('s3')
            ->inFormat(new \FFMpeg\Format\Video\X264)
            ->save($fakepath);
        } catch (EncodingException $exception) {
            return "an exception occur";
        }
 
            $video = new VideoImage();
            $video->name = basename($path);
            $video->fakename = $fakepath;
            $video->path = $path;
            $video->fakepath = $fakepath;
            $video->url = Storage::disk('s3')->url($path);
            $video->fakeurl = Storage::disk('s3')->url($fakepath);
            $video->save();
            return $video;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoImage  $videoImage
     * @return \Illuminate\Http\Response
     */
    public function show(VideoImage $videoImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoImage  $videoImage
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoImage $videoImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoImage  $videoImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoImage $videoImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoImage  $videoImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoImage $videoImage)
    {
        //
    }
}
