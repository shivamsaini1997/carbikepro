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
                            <form action="{{url($url)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Pages</label>
                                                <select class="form-control select2bs4 slug-create" name="pages_name" style="width: 100%">
                                                    <option value="">Select</option>
                                                    <option value="Home Page" {{ isset($pages->pages_name) && $pages->pages_name == 'Home Page' ? 'selected' : '' }}>Home Page</option>
                                                    @foreach ($category as $item)
                                                        @foreach ($category as $subcategory)
                                                            @if ($subcategory->parent_id == $item->id)
                                                                <option value="{{ $subcategory->category }}" {{ isset($pages->pages_name) && $pages->pages_name == $subcategory->category ? 'selected' : '' }}>
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
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="slug">Slug</label>
                                                <input type="text" name="slug" class="form-control slug1" id="slug" value="{{isset($pages)?$pages->slug: ''}}" readonly>
                                                @error('slug')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Page Detail</label>
                                                <textarea id="summernote" name="page_detail">{{isset($pages)?$pages->page_detail: ''}}</textarea>
                                                @error('page_detail')
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Function to generate slug from text
    function generateSlug(text) {
        return text
            .toString()                      // Convert to string
            .toLowerCase()                   // Convert to lowercase
            .replace(/\s+/g, '-')            // Replace spaces with -
            .replace(/[^\w\-]+/g, '')        // Remove all non-word chars
            .replace(/\-\-+/g, '-')          // Replace multiple - with single -
            .replace(/^-+/, '')              // Trim - from start of text
            .replace(/-+$/, '');             // Trim - from end of text
    }

    // When the dropdown selection changes, generate a slug
    $('.slug-create').on('change', function() {
        let selectedValue = $(this).val(); // Get the selected option value
        if (selectedValue) {
            let slug = generateSlug(selectedValue); // Generate slug
            $('#slug').val(slug); // Set slug input value
        } else {
            $('#slug').val(''); // Clear slug if no selection
        }
    });
</script>
@endsection
