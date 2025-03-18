<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Faq;
use App\Models\NewsDetails;
use App\Models\Product;
use App\Models\Video;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetail($slug, $brands_url, $product_url){
        $brandscar = Brands::where('category', 'Cars')->where('status', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $brandsbike = Brands::where('category', 'bikes')->where('status', 1)->orderBy('created_at', 'desc')->take(10)->get();
        $newsalldata = NewsDetails::get(); 
        $categorys =  Category::where('slug', $slug)->first();
        $brands = Brands::where('brands_url', $brands_url)->first();
        $product =  Product::where('product_url', $product_url)->first();
        $allproducts =  Product::get();
        $faq = Faq::get();
        $allvideo = Video::orderBy('created_at', 'desc')->get();

        $data = compact('newsalldata','brandscar','brandsbike','product','categorys','brands','allproducts','faq','allvideo');
        // dd($product,$allvideo);
        return view('frontend.product_detail')->with($data);
    }

    public function findProduct(Request $request, $category)
    {
        $categorys = Category::where('slug', $category)->first();
        if (!$categorys) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    
        $secondWord = explode(' ', $categorys->category)[1] ?? null;
    
        if ($request->ajax()) {
            $selectedBrands = $request->input('brands', []);
            $selectedFuels = $request->input('fuels', []);
            $selectedTransmission = $request->input('transmission', []);
            $selectedMileage = $request->input('mileage', []);
            $selectedBodyType = $request->input('body_types', []);
    
            $query = Product::where('category', $secondWord);
    
            // Filter by brands
            if (!empty($selectedBrands)) {
                $query->whereIn('brands', $selectedBrands);
            }
    
            // Filter by fuel types
            if (!empty($selectedFuels)) {
                $query->whereIn('fuel_type', $selectedFuels);
            }
    
            // Filter by transmission types
            if (!empty($selectedTransmission)) {
                $query->whereIn('transmission_type', $selectedTransmission);
            }
    
            // Filter by mileage
            if (!empty($selectedMileage)) {
                $query->whereIn('mileage', $selectedMileage);
            }
    
            // Filter by body type
            if (!empty($selectedBodyType)) {
                $query->whereIn('body_types', $selectedBodyType);
            }
    
            // Include Electric products if "Electric" is selected
            if (in_array('Electric', $selectedFuels)) {
                $query->orWhere('category', 'Electric');
            }
    
            $products = $query->get();
    
            return response()->json(['product' => $products]);
        }
    
        $evproduct = Product::where('category', 'Electric')->get();
        $product = Product::where('category', $secondWord)->get();
        $brands = Brands::where('category', $secondWord)->get();
    
        return view('frontend.find_product', compact('categorys', 'product', 'brands', 'evproduct'));
    }
    
    
}
