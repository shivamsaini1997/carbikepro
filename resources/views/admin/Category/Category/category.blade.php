@extends('admin.layout.main')
@push('title')
    <title> Category</title>
@endpush

@section('content')
<style>
    .headtable thead tr:nth-child(1) th {
        box-shadow: none !important;
        border: 0;
    }
</style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{$title}}</h3>
                            </div>
                            <form action="{{url($url1)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <input type="text" name="category"  class="slug-create form-control" id="category" value="{{isset($singelcategoryes)? $singelcategoryes->category : ''}}">
                                                @error('category')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-lg-12">
                                         
                                            <div class="form-group">
                                                <label for="slug">Slug</label>
                                                <input type="text" name="slug" class="form-control slug1" id="slug" value="{{isset($singelcategoryes)? $singelcategoryes->slug : ''}}">
                                                @error('slug')
                                                <div class="text-danger">{{ $message }}</div>

                                                @enderror
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
                    <div class="col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Sab Category</h3>
                            </div>
                            <form action="{{url($url2)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="parent_id">Select Category</label>
                                                <select class="form-control select2bs4" name="parent_id" style="width: 100%">
                                                    <option value="">Select</option>
                                                    @foreach ($category as $item)
                                                        @if ($item->parent_id == 0)
                                                            <option value="{{ $item->id }}" 
                                                                {{ old('parent_id', isset($singelcategoryes->parent_id) == $item->id ? 'selected' : '') }}>
                                                                {{ $item->category }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('parent_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="page_type">Page Type</label>
                                                <select class="form-control select2bs4" name="page_type" style="width: 100%">
                                                    <option value="">Select</option>
                                                    <option value="1" 
                                                        {{ old('page_type', isset($singelcategoryes->page_type) == '1' ? 'selected' : '' )}}>
                                                        Category Page
                                                    </option>
                                                    <option value="2" 
                                                        {{ old('page_type', isset($singelcategoryes->page_type) == '2' ? 'selected' : '' )}}>
                                                        Sub Category Page
                                                    </option>
                                                </select>
                                                @error('page_type')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="scategory">Sub Category</label>
                                                <input type="text" class="form-control slug-create2" name="scategory" 
                                                    value="{{ old('scategory', isset($singelcategoryes)? $singelcategoryes->category :'') }}">
                                                @error('scategory')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="sub_category_slug">Slug</label>
                                                <input type="text" name="sub_category_slug" class="form-control slug2" 
                                                    value="{{ old('sub_category_slug', isset($singelcategoryes)? $singelcategoryes->slug : '') }}">
                                                @error('sub_category_slug')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Meta Description</label>
                                                <input type="text" name="meta_description" id="" class="form-control meta_description" maxlength="160" value="{{ old('meta_description',isset( $singelcategoryes)?  $singelcategoryes->meta_description: '') }}"/>
                                                <p>Characters left: <span class="text-count">160</span></p>
                                                @error('meta_description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Meta Tags</label>
                                                <input type="text" name="meta_tags" id="" class="form-control" value="{{ old('meta_tags', isset($singelcategoryes)? $singelcategoryes->meta_tags : '') }}"/>
                                                @error('meta_tags')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
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
                

        </section>
    </div>
@endsection
