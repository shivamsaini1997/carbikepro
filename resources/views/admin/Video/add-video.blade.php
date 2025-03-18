@extends('admin.layout.main')
@push('title')
    <title>{{ $title }}</title>
@endpush
@section('content')
<style>
    .select2-selection {
    height: 38px !important;
}
</style>
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
                                            <div class="mb-3">
                                                <label for="" class="form-label">Product</label>
                                                <select name="product" class="form-control select2" id="">
                                                    <option value="">Select</option>
                                                    @foreach ($product as $item)
                                                        <option value="{{ $item->id }}" 
                                                            {{ (isset($faq->product) && $faq->product == $item->id) ? 'selected' : '' }}>
                                                            {{ $item->product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('product')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Wheeler</label>
                                                <select class="form-control select2bs4" name="wheeler" style="width: 100%">
                                                    <option value="">Select</option>
                                                    <option value="1">Four Wheeler</option>
                                                    <option value="2">Two Wheeler</option>
                                                    <option value="3">Electric</option>
                                                </select>
                                                @error('wheeler')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Video Thambnail</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="video_thanmbnail" class="custom-file-input" id="exampleInputFile1"  accept="image/*" >
                                                        <label class="custom-file-label" for="exampleInputFile1">{{isset($video)? basename($video->video_thanmbnail) : 'Choose file'}}</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
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
                                                <label for="" class="form-label">Video Url</label>
                                                <input type="text" name="video_url" id="" class="form-control"
                                                    value="" />
                                                @error('video_url')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Video Title</label>
                                                <input type="text" name="video_title" id="" class="form-control slug-create" value="{{isset($brands)? $brands->video_title : ''}}"  accept="image/*" />
                                                @error('video_title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 form-group">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Slug</label>
                                                <input type="text" name="slug" id="" class="form-control slug1"
                                                    value="{{isset($brands)? $brands->brands_url : ' '}}" />
                                                @error('slug')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Channel Url</label>
                                                <input type="text" name="channelslug" id="" class="form-control"
                                                    value="{{isset($brands)? $brands->brands_url : ' '}}" />
                                                @error('channelslug')
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').text(fileName);
    });
});
</script>