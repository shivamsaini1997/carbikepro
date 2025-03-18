<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\NewsDetails;
use App\Models\Pages;
use App\Models\Product;

class Brandscontroller extends Controller
{
    public function brands($category){
        $catparentid = Category::where('parent_id', 0)->get();
        $brands = Brands::where('category', $category)->where('status', 1)->orderBy('created_at','desc')->get();
        $data = compact('brands','catparentid');
        // dd($data);
        return view('frontend.brands')->with($data);
    }
    public function brandsProduct($category, $slug)
    {
        $product = Product::get();
        $newsalldata = NewsDetails::all();
        $brands = Brands::where('category', $category)
                        ->where('brands_url', $slug)
                        ->where('status', 1)
                        ->firstOrFail();
        $brandsname = Brands::orderBy('created_at', 'desc')->get();
        
        // Pass all required data to the view
        return view('frontend.brandprodect', compact('product', 'brandsname', 'brands', 'newsalldata'));
    }


    
    
}


