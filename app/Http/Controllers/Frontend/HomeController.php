<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brands;
use App\Models\Category;
use App\Models\NewsDetails;
use App\Models\Product;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage(){
        $categorys = Category::get();
        $brands = Brands::where('status', 1)->orderBy('created_at','desc')->get();
        $banner = Banner::where('status', 1)->orderBy('created_at','desc')->get();
        $newsalldata = NewsDetails::get(); 
        $product =  Product::get();
        $data = compact('banner','brands','newsalldata','product','categorys');
        // dd($categorys ,$product);
        return view('frontend.index')->with($data);
    }
    
    public function aboutUs(){
        return view('frontend.about');
    }
    
    public function autocomplete(Request $request)
    {
        $value = $request->get('query');
        $data = Product::select("id", "product_name")
            ->where("product_name", "LIKE", "%{$value}%")
            ->get();
        return response()->json($data);
    }
    
    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = Product::where('product_name', 'LIKE', "%{$query}%")->get();
        return view('frontend.search-results', compact('products', 'query'));
    }
    
    
    public function show($product_name){
        $formattedProductName = str_replace('-', ' ', strtolower($product_name));
        $product = Product::where('product_name', $formattedProductName)->firstOrFail();
        $newsalldata = NewsDetails::all(); 
        $allvideo = Video::orderBy('created_at', 'desc')->get();
        $brandscar = Brands::where('category', 'Cars')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $brandsbike = Brands::where('category', 'Bikes') 
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
    
        return view('frontend.product_detail', compact('product', 'newsalldata', 'allvideo', 'brandscar', 'brandsbike'));
    }
    

}
