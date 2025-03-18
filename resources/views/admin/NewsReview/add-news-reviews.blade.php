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
                                            <div class="form-group">
                                                <label for="">News Page*</label>
                                                <select class="form-control select2bs4 news_pageselect" name="news_page" style="width: 100%">
                                                    <option value="">Select</option>
                                                    @foreach ($newspages as $item)
                                                        <option value="{{ $item->news_page }}"  {{ old('news_page', isset($newsreview->news_page) ? $newsreview->news_page : '') == $item->news_page ? 'selected' : '' }}>
                                                            {{ $item->news_page }}
                                                        </option>
                                                           
                                                    @endforeach
                                                </select>
                                                @error('news_page')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 newspageselect" style="display: none">
                                            <div class="form-group mb-3">
                                                <label for="">Category</label>
                                                <select class="form-control select2bs4 categoryselect" name="category"
                                                    style="width: 100%">
                                                    <option value="">Select</option>
                                                    @foreach ($category as $item)
                                                    @if ($item->parent_id == 0)
                                                    <option value="{{ $item->category }}"
                                                        {{ old('category', isset($item->category) ? $item->category : '') == isset($newsreview->category) ? 'selected' : '' }}>
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
                                        <div class="col-lg-6 newspageselect" style="display: none">
                                            <div class="form-group mb-3">
                                                <label for="">Brands</label>
                                                <select class="form-control select2bs4" name="brands"
                                                    style="width: 100%">
                                                    <option value="">Select</option>
                                                    @foreach ($brands as $item)
                                                    <option value="{{ $item->brands_name }}"
                                                        {{ old('brands', isset($item->brands_name) ? $item->brands_name : '') == isset($newsreview->brands) ? 'selected' : '' }}>
                                                    {{ $item->brands_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('brands')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 newspageselect" style="display: none">
                                            <div class="form-group mb-3">
                                                <label for="">Product Name</label>
                                                <select class="form-control select2 product_name"  name="product_name"
                                                    style="width: 100%">
                                                    <option value="">Select</option>
                                                    @foreach ($product as $item)
                                                    <option value="{{ $item->product_name }}" {{ old('product_name', isset($item->product_name) ? $item->product_name : '') == isset($newsreview->product_name) ? 'selected' : '' }}>
                                                            {{ $item->product_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('brands')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">News Image*</label>
                                                <input type="file" name="news_image" id="" class="form-control"
                                                    value="" accept="image/*" />
                                                @error('news_image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                @if (old('news_image', isset($newsreview) ?  $newsreview : ''))
                                                    <img src="{{ asset($newsreview->news_image) }}" alt="" style="width: 150px;height: 80px;object-fit: contain;">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Meta Description</label>
                                                <input type="text" name="meta_description" id="" class="form-control meta_description" maxlength="160" value="{{isset($newsreview)? $newsreview->meta_description : ''}}"/>
                                                <p>Characters left: <span class="text-count">160</span></p>
                                                @error('meta_description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Meta Tags</label>
                                                <input type="text" name="meta_tags" id="" class="form-control" value="{{isset($newsreview)? $newsreview->meta_tags : ''}}"/>
                                                @error('meta_tags')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Title*</label>
                                                <input type="text" name="title" id="" class="form-control slug-create" value="{{isset($newsreview)? $newsreview->title : ''}}"/>
                                                @error('title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 form-group">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Slug*</label>
                                                <input type="text" name="slug" id="" class="form-control slug1"
                                                    value="{{isset($newsreview)? $newsreview->slug : ' '}}" />
                                                @error('slug')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">News Detail*</label>
                                                <textarea id="summernote" name="news_details">{!!isset($newsreview)?$newsreview->news_details: ''!!}</textarea>
                                                @error('news_details')
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
