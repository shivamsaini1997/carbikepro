<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function searchProduct(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'vehicle' => 'required|string',
            'brands' => 'nullable|string',
            'min' => 'nullable|numeric',
            'max' => 'nullable|numeric',
        ]);
    
        $category = $validatedData['vehicle'];
        $brands = $validatedData['brands'];
        // $minPrice = $validatedData['min'] ;
        // $maxPrice = $validatedData['max'];
    
        // Base query to fetch vehicles
        $query = Product::query();
    
        if (!empty($category)) {
            $query->where('category', $category);
        }
    
        if (!empty($brands)) {
            $query->where('brands', $brands);
        }
    
        if (!empty($minPrice) && !empty($maxPrice)) {
            $query->whereBetween('showroom_price', [$minPrice, $maxPrice]);
        } 
    
        // Execute the query and get results
        $vehicles = $query->get();
    
        // Return view with search results
        return view('frontend.search-results', compact('vehicles'));
    }
    
}
