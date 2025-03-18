<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\NewsDetails;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function compare($product_url1 ,$product_url2){
        $compareproduct =  Product::where('product_url' , $product_url1)->first();
        $newsalldata = NewsDetails::where('status', 1)->get(); 
        $product = Product::where('product_url',$product_url2)->first();
        $data = compact('product','compareproduct','newsalldata');
        // dd($data);
        return view('frontend.compare')->with($data);
    }
}
