<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brands;
use App\Models\Category;
use App\Models\NewsDetails;
use App\Models\Pages;
use App\Models\Product;

class CategoryController extends Controller
{
    public function CategoryPage($slug){
        $brands = Brands::where('status', 1)->orderBy('created_at','desc')->get();
        $banner = Banner::where('status', 1)->orderBy('created_at', 'desc')->get();
        $categorys = Category::where('slug', $slug)->where('page_type', 1)->firstOrFail();
        $subcategories = Category::where('id', $categorys->id)->get();
        $pages = Pages::where('slug', $slug)->first();
        $categoryid = Category::where('parent_id', 0)->get();
        $newsalldata = NewsDetails::get(); 
        $product =  Product::get();
        $allcategory = Category::get();
        // dd($product,$allcategory);
        return view('frontend.categorypage', compact('categorys', 'banner', 'subcategories','pages','brands','categoryid','newsalldata','product','allcategory'),);
    }
}
