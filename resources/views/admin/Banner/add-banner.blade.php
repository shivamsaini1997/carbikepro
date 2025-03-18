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
                                                <label for="">Pages</label>
                                                <select class="form-control select2bs4" name="pages_name" style="width: 100%">
                                                    <option value="">Select</option>
                                                    <option value="Home Page" {{ isset($banner->pages_name) && $banner->pages_name == 'Home Page' ? 'selected' : '' }}>Home Page</option>

                                                    @foreach ($category as $item)

                                                        @foreach ($category as $subcategory)

                                                            @if ($subcategory->parent_id == $item->id)

                                                                <option value="{{ $subcategory->category }}" {{ isset($banner->pages_name) && $banner->pages_name == $subcategory->category ? 'selected' : '' }}>
                                                                    {{ $subcategory->category }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    {{-- <option value="2" {{ isset ($banner->pages_name ) && $banner->pages_name == 2 ? 'selected' : '' }}>New Cars</option>
                                                    <option value="3" {{ isset ($banner->pages_name ) &&  $banner->pages_name == 3 ? 'selected' : '' }}>New Bikes</option>
                                                    <option value="4" {{ isset ($banner->pages_name ) && $banner->pages_name == 4 ? 'selected' : '' }}>New Scooters</option> --}}

                                                    {{-- <option value="5" {{ isset ($banner->pages_name ) && $banner->pages_name == 5 ? 'selected' : '' }}>Electric Cars</option>
                                                    --}}
                                                </select>

                                                @error('pages_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Banner URL</label>
                                                <input type="url" name="banner_url" id="" class="form-control"
                                                    value="{{isset($banner)? $banner->banner_url : ' '}}" />
                                                @error('banner_url')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Banner</label>
                                                <input type="file" name="banner" id="" class="form-control"
                                                    value="" accept="image/*" />
                                                @error('banner')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                @if (isset($banner))
                                                    <img src="{{ asset($banner->banner) }}" alt="" style="width: 250px;height: 120px;object-fit: contain;">
                                                @endif
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
