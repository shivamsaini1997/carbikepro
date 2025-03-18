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
                            <form action="{{$url}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Category</label>
                                                <select class="form-control select2bs4" name="category" style="width: 100%">
                                                    <option value="">Select</option>
                                                    @foreach ($category as $item)
                                                            @if ($item->parent_id == 0)
                                                                <option value="{{ $item->category }}" {{ isset($brands->category) && $brands->category == $item->category ? 'selected' : '' }}>
                                                                    {{ $item->category }}
                                                                </option>
                                                            @endif
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Brands Image</label>
                                                <input type="file" name="brands_image" id="" class="form-control"
                                                    value="" accept="image/*" />
                                                @error('brands_image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                @if (isset($brands))
                                                    <img src="{{ asset($brands->brands_image) }}" alt="" style="width: 150px;height: 80px;object-fit: contain;">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Brands Name</label>
                                                <input type="text" name="brands_name" id="" class="form-control slug-create" value="{{isset($brands)? $brands->brands_name : ''}}"  accept="image/*" />
                                                @error('brands_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 form-group">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Brands URL</label>
                                                <input type="text" name="brands_url" id="" class="form-control slug1"
                                                    value="{{isset($brands)? $brands->brands_url : ' '}}" />
                                                @error('brands_url')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Meta Description</label>
                                                <input type="text" name="meta_description" id="" class="form-control meta_description" maxlength="160" value="{{ old('meta_description',isset( $brands)?  $brands->meta_description: '') }}"/>
                                                <p>Characters left: <span class="text-count">160</span></p>
                                                @error('meta_description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Meta Tags</label>
                                                <input type="text" name="meta_tags" id="" class="form-control" value="{{ old('meta_tags', isset($brands)? $brands->meta_tags : '') }}"/>
                                                @error('meta_tags')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Brand Page Detail</label>
                                                <textarea id="summernote" name="brand_page_detail">{{isset($brands)?$brands->brands_details: ''}}</textarea>
                                                @error('brand_page_detail')
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

            </div>
        </section>
    </div>

@endsection
