<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Brands;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\NewsDetails;
use App\Models\NewsReviewPages;
use App\Models\Pages;
use App\Models\Product;
use Illuminate\Http\Request;

class NewsReviewController extends Controller
{
    public function newsReviewPage($slug){
        $brandscar = Brands::where('category', 'Cars')->where('status', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $brandsbike = Brands::where('category', 'bikes')->where('status', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $newsreviewpage = NewsReviewPages::where('slug', $slug)->first();
        $newsdetails = collect();
        if ($newsreviewpage) {
            $newsdetails = NewsDetails::where('status', 1)->where('news_page', $newsreviewpage->news_page)->orderBy('created_at', 'desc')->paginate(5); 
        }
        $data = compact('brandscar', 'brandsbike', 'newsreviewpage', 'newsdetails');
        return view('frontend.news_reviews')->with($data);
    }

    
    public function newsDetails($page_name,$slug){
        $brandscar = Brands::where('category', 'Cars')->where('status', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $brandsbike = Brands::where('category', 'bikes')->where('status', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $newsreviewpage = NewsReviewPages::get();
        $newsdetails = NewsDetails::where('status', 1)->where('slug', $slug)->first(); 
        $newsalldata = NewsDetails::where('status', 1)->get(); 
        $product =  Product::get();
        $pages = Pages::get();
        $allcategory = Category::get();

        $data = compact('newsdetails','brandscar','brandsbike','newsreviewpage','newsalldata','product','pages','allcategory');
        // dd($data);
        return view('frontend.news_detail')->with($data);;
    }
}

