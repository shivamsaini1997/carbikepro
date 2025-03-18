<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Pages;
use App\Models\Brands;
use App\Models\NewsDetails;
use App\Models\Product;
use App\Models\Video;

class SubCategoryController extends Controller
{
    public function subCategoryPage($slug)
    {
        $subcategory = Category::where('slug', $slug)->where('page_type', 2)->firstOrFail();
        $electric = Category::where('category', 'Electric')->first();
        $pages = Pages::where('slug', $slug)->first();
        $categorys = Category::where('slug', $slug)->where('page_type', 2)->get();
        $brands = Brands::where('status', 1)->orderBy('created_at','desc')->get();
        $newsalldata = NewsDetails::get(); 
        $product =  Product::get();
        $allcategory = Category::get();



        if($electric->category = 'Electric'){
            if($electric->id == $subcategory->parent_id){
                $pages = Pages::where('slug', $slug)->first();
                $subcategories = Category::where('id', $subcategory->id)->get();
                $categorys = Category::where('slug', $slug)->where('page_type', 2)->get();
                $banner = Banner::where('status', 1)->orderBy('created_at', 'desc')->get();
                $brands = Brands::where('status', 1)->orderBy('created_at','desc')->get();
                $product =  Product::get();
                $allcategory = Category::get();
                $allvideo = Video::orderBy('created_at', 'desc')->get();
                return view('frontend.electric', compact('subcategory', 'banner', 'subcategories','pages','categorys','brands','newsalldata','product','allcategory','allvideo'));
            }
        }
        return view('frontend.subcategorypage', compact('subcategory','pages','categorys','brands','newsalldata','product','allcategory'));
    }
}

