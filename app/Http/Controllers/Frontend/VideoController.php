<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\NewsDetails;
use App\Models\Product;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function videos(){
        $allvideo = Video::orderBy('created_at', 'desc')->paginate(12);
        $wheelervideo = Video::where('wheeler', 1)->orderBy('created_at', 'desc')->get();
        $Twowheelervideo = Video::where('wheeler', 2)->orderBy('created_at', 'desc')->get();
        $electricvideo = Video::where('wheeler', 3)->orderBy('created_at', 'desc')->get();
        $brandscar = Brands::get();
        $data = compact('allvideo','wheelervideo','Twowheelervideo','electricvideo', 'brandscar');
        // dd($data);
        return view('frontend.videos')->with($data);
    }
    public function videosDetail($slug){
        $video = Video::where('slug',$slug)->first();
        $brandscar = Brands::get();
        $product = Product::get();
        $newsalldata = NewsDetails::where('status', 1)->get(); 

        $data = compact('video','brandscar','product','newsalldata');
        // dd($data);
        return view('frontend.video_detail')->with($data);
    }
}
