@extends('admin.layout.main')
@push('title')
<title>{{ $title }}</title>
@endpush
@section('content')
<div class="content-wrapper" style="min-height: 339px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> {{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $title }}</h3>
                        </div>
                        <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card card-default" style="width: 100%;">
                                            <div class="card-header">
                                                <h3 class="card-title"><b>Basic</b></h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="">Category</label>
                                                    <select class="form-control select2bs4 categoryselect" name="category" style="width: 100%">
                                                        <option value="">Select</option>
                                                        @foreach ($category as $item)
                                                            @if ($item->parent_id == 0)
                                                                <option value="{{ $item->category }}"
                                                                    {{ old('category', isset($product->category) ? $product->category : '') == $item->category ? 'selected' : '' }}>
                                                                    {{ $item->category }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    
                                                    @error('category')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group ev-sub-category" style="display: none">
                                            
                                                    <div class="form-group">
                                                        <label for="electric_sub_category">Electric Sub Category</label>
                                                        <select class="form-control select2bs4" name="electric_sub_category" id="electric_sub_category" style="width: 100%;">
                                                            <option value="">Select</option>
                                                            <option value="Latest Cars" 
                                                                {{ old('electric_sub_category', isset($product->ev_sub_category) ? $product->ev_sub_category : '') == 'Latest Cars' ? 'selected' : '' }}>
                                                                Latest Cars
                                                            </option>
                                                            <option value="Latest Bikes" 
                                                                {{ old('electric_sub_category', isset($product->ev_sub_category) ? $product->ev_sub_category : '') == 'Latest Bikes' ? 'selected' : '' }}>
                                                                Latest Bikes
                                                            </option>
                                                            <option value="Latest Scooters" 
                                                                {{ old('electric_sub_category', isset($product->ev_sub_category) ? $product->ev_sub_category : '') == 'Latest Scooters' ? 'selected' : '' }}>
                                                                Latest Scooters
                                                            </option>
                                                            <option value="Upcoming Cars" 
                                                                {{ old('electric_sub_category', isset($product->ev_sub_category) ? $product->ev_sub_category : '') == 'Upcoming Cars' ? 'selected' : '' }}>
                                                                Upcoming Cars
                                                            </option>
                                                            <option value="Upcoming Bikes" 
                                                                {{ old('electric_sub_category', isset($product->ev_sub_category) ? $product->ev_sub_category : '') == 'Upcoming Bikes' ? 'selected' : '' }}>
                                                                Upcoming Bikes
                                                            </option>
                                                            <option value="Upcoming Scooters" 
                                                                {{ old('electric_sub_category', isset($product->ev_sub_category) ? $product->ev_sub_category : '') == 'Upcoming Scooters' ? 'selected' : '' }}>
                                                                Upcoming Scooters
                                                            </option>
                                                            <option value="Popular Cars" 
                                                                {{ old('electric_sub_category', isset($product->ev_sub_category) ? $product->ev_sub_category : '') == 'Popular Cars' ? 'selected' : '' }}>
                                                                Popular Cars
                                                            </option>
                                                            <option value="Popular Bikes" 
                                                                {{ old('electric_sub_category', isset($product->ev_sub_category) ? $product->ev_sub_category : '') == 'Popular Bikes' ? 'selected' : '' }}>
                                                                Popular Bikes
                                                            </option>
                                                            <option value="Popular Scooters" 
                                                                {{ old('electric_sub_category', isset($product->ev_sub_category) ? $product->ev_sub_category : '') == 'Popular Scooters' ? 'selected' : '' }}>
                                                                Popular Scooters
                                                            </option>
                                                        </select>
                                                        @error('electric_sub_category')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="brands">Brands</label>
                                                    <select class="form-control select2bs4" name="brands" id="brands" style="width: 100%;">
                                                        <option value="">Select</option>
                                                        @foreach ($brands as $item)
                                                            <option value="{{ $item->brands_name }}"
                                                                {{ old('brands', isset($product->brands) ? $product->brands : '') == $item->brands_name ? 'selected' : '' }}>
                                                                {{ $item->brands_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('brands')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="pages_name">Pages</label>
                                                    <select class="form-control select2bs4 slug-create" name="pages_name" id="pages_name" style="width: 100%;">
                                                        <option value="">Select</option>
                                                        @foreach ($category as $item)
                                                            @foreach ($category as $subcategory)
                                                                @if ($subcategory->parent_id == $item->id)
                                                                    <option value="{{ $subcategory->category }}"
                                                                        {{ old('pages_name', isset($product->pages_name) ? $product->pages_name : '') == $subcategory->category ? 'selected' : '' }}>
                                                                        {{ $subcategory->category }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                    @error('pages_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="product_label">Product Label</label>
                                                    <select class="form-control select2bs4 slug-create" name="product_label" id="product_label" style="width: 100%;">
                                                        <option value="">Select</option>
                                                        <option value="1" {{ old('product_label', isset($product->product_label) ? $product->product_label : '') == '1' ? 'selected' : '' }}>Just Launched</option>
                                                        <option value="2" {{ old('product_label', isset($product->product_label) ? $product->product_label : '') == '2' ? 'selected' : '' }}>Electric</option>
                                                        <option value="3" {{ old('product_label', isset($product->product_label) ? $product->product_label : '') == '3' ? 'selected' : '' }}>Popular Cars</option>
                                                        <option value="4" {{ old('product_label', isset($product->product_label) ? $product->product_label : '') == '4' ? 'selected' : '' }}>Upcoming Cars</option>
                                                        <option value="5" {{ old('product_label', isset($product->product_label) ? $product->product_label : '') == '5' ? 'selected' : '' }}>Latest Bike</option>
                                                        <option value="6" {{ old('product_label', isset($product->product_label) ? $product->product_label : '') == '6' ? 'selected' : '' }}>Popular Bike</option>
                                                        <option value="7" {{ old('product_label', isset($product->product_label) ? $product->product_label : '') == '7' ? 'selected' : '' }}>Upcoming Bike</option>
                                                        <option value="8" {{ old('product_label', isset($product->product_label) ? $product->product_label : '') == '8' ? 'selected' : '' }}>Latest Scooter</option>
                                                        <option value="9" {{ old('product_label', isset($product->product_label) ? $product->product_label : '') == '9' ? 'selected' : '' }}>Popular Scooter</option>
                                                        <option value="10" {{ old('product_label', isset($product->product_label) ? $product->product_label : '') == '10' ? 'selected' : '' }}>Upcoming Scooter</option>
                                                    </select>
                                                    @error('product_label')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="product_name" class="form-label">Product Name</label>
                                                        <input type="text" name="product_name" id="product_name"
                                                            class="form-control slug-create"
                                                            value="{{ old('product_name', isset($product) ? $product->product_name : '') }}" />
                                                        @error('product_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="product_url" class="form-label">Product URL</label>
                                                        <input type="text" name="product_url" id="product_url"
                                                            class="form-control slug1"
                                                            value="{{ old('product_url', isset($product) ? $product->product_url : '') }}" />
                                                        @error('product_url')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="showroom_price" class="form-label">Ex-Showroom Price</label>
                                                        <input type="text" name="showroom_price" id="showroom_price"
                                                            class="form-control"
                                                            value="{{ old('showroom_price', isset($product) ? $product->showroom_price : '') }}" />
                                                        @error('showroom_price')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="on_road_price" class="form-label">On Road Price</label>
                                                        <input type="text" name="on_road_price" id="on_road_price"
                                                            class="form-control"
                                                            value="{{ old('on_road_price', isset($product) ? $product->on_road_price : '') }}" />
                                                        @error('on_road_price')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="emi" class="form-label">EMI</label>
                                                        <input type="text" name="emi" id="emi"
                                                            class="form-control"
                                                            value="{{ old('emi', isset($product) ? $product->emi : '') }}" />
                                                        @error('emi')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card card-default" style="width: 100%;">
                                            <div class="card-header">
                                                <h3 class="card-title"><b>Product Image</b></h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-10">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">1. Product Image</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="productimage1" class="custom-file-input" id="exampleInputFile1">
                                                                    <label class="custom-file-label" for="exampleInputFile1">{{isset($product)? basename($product->productimage1) : 'Choose file'}}</label>
                                                                </div>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                            @error('productimage1')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                               
                                                    <div class="col-lg-2">
                                                        <div class="mb-3">
                                                            @if (isset($product))
                                                            <img src="{{ asset($product->productimage1) }}" alt="" style="width: 110px;height: 70px;object-fit: contain;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="row">                                                   
                                                    <div class="col-lg-10">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">2. Product Image</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="productimage2" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">{{isset($product)? basename($product->productimage2) : 'Choose file'}}</label>
                                                                </div>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                            @error('productimage2')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="mb-3">
                                                            @if (isset($product))
                                                            <img src="{{ asset($product->productimage2) }}" alt="" style="width: 110px;height: 70px;object-fit: contain;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="row">  
                                                    <div class="col-lg-10">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">3. Product Image</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="productimage3" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">{{isset($product)? basename($product->productimage3) : 'Choose file'}}</label>
                                                                </div>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                            @error('productimage3')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="mb-3">
                                                            @if (isset($product))
                                                            <img src="{{ asset($product->productimage3) }}" alt="" style="width: 110px;height: 70px;object-fit: contain;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">  
                                                    <div class="col-lg-10">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">4. Product Image</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="productimage4" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">{{isset($product)? basename($product->productimage4) : 'Choose file'}}</label>
                                                                </div>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                            @error('productimage4')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="mb-3">
                                                            @if (isset($product))
                                                                <img src="{{ asset($product->productimage3) }}" alt="" style="width: 110px;height: 70px;object-fit: contain;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">  
                                                    <div class="col-lg-10">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">5. Product Image</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="productimage5" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">{{isset($product)? basename($product->productimage5) : 'Choose file'}}</label>
                                                                </div>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                            @error('productimage5')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="mb-3">
                                                            @if (isset($product))
                                                            <img src="{{ asset($product->productimage5) }}" alt="" style="width: 110px;height: 70px;object-fit: contain;">
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">  
                                                    <div class="col-lg-10">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">6. Product Image</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="productimage6" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">{{isset($product)? basename($product->productimage6) : 'Choose file'}}</label>
                                                                </div>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                            @error('productimage6')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="mb-3">
                                                            @if (isset($product))
                                                            <img src="{{ asset($product->productimage6) }}" alt="" style="width: 110px;height: 70px;object-fit: contain;">
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">  
                                                    <div class="col-lg-10">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">7. Product Image</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="productimage7" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">{{isset($product)? basename($product->productimage7) : 'Choose file'}}</label>
                                                                </div>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                            @error('productimage7')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="mb-3">
                                                            @if (isset($product))
                                                            <img src="{{ asset($product->productimage7) }}" alt="" style="width: 110px;height: 70px;object-fit: contain;">
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">  
                                                    <div class="col-lg-10">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">8. Product Image</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="productimage8" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">{{isset($product)? basename($product->productimage8) : 'Choose file'}}</label>
                                                                </div>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                            @error('productimage8')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="mb-3">
                                                            @if (isset($product))
                                                            <img src="{{ asset($product->productimage8) }}" alt="" style="width: 110px;height: 70px;object-fit: contain;">
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-default" style="width: 100%;">
                                            <div class="card-header">
                                                <h3 class="card-title"><b>Key Specifications</b></h3>
                                                
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Body Types</label>
                                                            <select class="form-control select2bs4 slug-create" name="body_types" style="width: 100%">
                                                                <option value="">Select</option>
                                                                <option value="Hatchback" {{ isset($product->body_types) && $product->body_types == "Hatchback" ? 'selected' : '' }}>Hatchback</option>
                                                                <option value="Sedan" {{ isset($product->body_types) && $product->body_types == "Sedan" ? 'selected' : '' }}>Sedan</option>
                                                                <option value="SUV" {{ isset($product->body_types) && $product->body_types == "SUV" ? 'selected' : '' }}>SUV</option>
                                                                <option value="Station Wagon" {{ isset($product->body_types) && $product->body_types == "Station Wagon" ? 'selected' : '' }}>Station Wagon</option>
                                                                <option value="Coupe" {{ isset($product->body_types) && $product->body_types == "Coupe" ? 'selected' : '' }}>Coupe</option>
                                                                <option value="Convertible" {{ isset($product->body_types) && $product->body_types == "Convertible" ? 'selected' : '' }}>Convertible</option>
                                                                <option value="MUV" {{ isset($product->body_types) && $product->body_types == "MUV" ? 'selected' : '' }}>MUV</option>
                                                                <option value="MPV" {{ isset($product->body_types) && $product->body_types == "MPV" ? 'selected' : '' }}>MPV</option>
                                                                <option value="Crossover" {{ isset($product->body_types) && $product->body_types == "Crossover" ? 'selected' : '' }}>Crossover</option>
                                                                <option value="Minivan" {{ isset($product->body_types) && $product->body_types == "Minivan" ? 'selected' : '' }}>Minivan</option>
                                                            </select>
                                                            @error('body_types')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Color</label>
                                                                <input type="text" name="color" id=""
                                                                    class="form-control" value="{{isset($product)? $product->color : ''}}" />
                                                                @error('color')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Mileage</label>
                                                                <input type="text" name="mileage" id=""
                                                                    class="form-control" value="{{isset($product)? $product->mileage : ''}}" />
                                                                @error('mileage')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Displacement</label>
                                                                <input type="text" name="displacement" id=""
                                                                    class="form-control" value="{{isset($product)? $product->displacement : ''}}" />
                                                                @error('displacement')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Fule Tank Capacity</label>
                                                                <input type="text" name="fule-tank-capacity" id=""
                                                                    class="form-control" value="{{isset($product)? $product->fule_tank_capacity : ''}}" />
                                                                @error('fule-tank-capacity')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Kerb Weight</label>
                                                                <input type="text" name="kerb-weight" id=""
                                                                    class="form-control" value="{{isset($product)? $product->kerb_weight : ''}}" />
                                                                @error('kerb-weight')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Height</label>
                                                                <input type="text" name="height" id=""
                                                                    class="form-control" value="{{isset($product)? $product->height : ''}}" />
                                                                @error('height')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Top Speed</label>
                                                                <input type="text" name="top-speed" id=""
                                                                    class="form-control" value="{{isset($product)? $product->top_speed : ''}}" />
                                                                @error('top-speed')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Engine</label>
                                                                <input type="text" name="engine" id=""
                                                                    class="form-control" value="{{isset($product)? $product->engine : ''}}" />
                                                                @error('engine')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Fuel Type
                                                                </label>
                                                                <input type="text" name="fuel-type" id=""
                                                                    class="form-control" value="{{isset($product)? $product->fuel_type : ''}}" />
                                                                @error('fuel-type')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Transmission Type
                                                                </label>
                                                                <input type="text" name="transmission-type" id=""
                                                                    class="form-control" value="{{isset($product)? $product->transmission_type : ''}}" />
                                                                @error('transmission-type')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Seating Capacity
                                                                </label>
                                                                <input type="text" name="seating-capacity" id=""
                                                                    class="form-control" value="{{isset($product)? $product->seating_capacity : ''}}" />
                                                                @error('seating-capacity')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Safety
                                                                </label>
                                                                <input type="text" name="safety" id=""
                                                                    class="form-control " value="{{isset($product)? $product->safety : ''}}" />
                                                                @error('safety')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Driving Range
                                                                </label>
                                                                <input type="text" name="driving-range" id=""
                                                                    class="form-control" value="{{isset($product)? $product->driving_range : ''}}" />
                                                                @error('driving-range')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Charging Time
                                                                </label>
                                                                <input type="text" name="charging-time" id=""
                                                                    class="form-control" value="{{isset($product)? $product->charging_time : ''}}" />
                                                                @error('charging-time')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                               
                                                    
                                                </div> 

                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-default" style="width: 100%;">
                                            <div class="card-header">
                                                <h3 class="card-title"><b>Meta</b></h3>
                                            </div>
                                            <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Meta Description</label>
                                                                <input type="text" name="meta_description" id="" class="form-control meta_description" maxlength="160" value="{{ old('meta_description',isset( $product)?  $product->meta_description: '') }}"/>
                                                                <p>Characters left: <span class="text-count">160</span></p>
                                                                @error('meta_description')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Meta Tags</label>
                                                                <input type="text" name="meta_tags" id="" class="form-control" value="{{ old('meta_tags', isset($product)? $product->meta_tags : '') }}"/>
                                                                @error('meta_tags')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-default" style="width: 100%;">
                                            <div class="card-header">
                                                <h3 class="card-title"><b>Highlights</b></h3>
                                            </div>
                                            <div class="card-body">
                                    
                                                    <div class="mb-3">
                                                        {{-- <label for="" class="form-label">Highlights</label> --}}
                                                        <textarea id="summernote" name="highlights">{{isset($product)? $product->highlights : ''}}</textarea>
                                                        @error('highlights')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').text(fileName);
    });

    $('.categoryselect').on('change', function() {
        var categoryValue = $(this).val();
        if (categoryValue === 'Electric') {
            $('.ev-sub-category').show();
        } else {
            $('.ev-sub-category').hide();
        }
    });

    if ($('.categoryselect').val() === 'Electric' || $('select[name="electric_sub_category"]').val()) {
        $('.ev-sub-category').show();
    }
});


</script>