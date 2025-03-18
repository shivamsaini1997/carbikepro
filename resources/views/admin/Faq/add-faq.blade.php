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
                                    <div class="row justify-content-end">
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
                                        <div class="col-lg-6" style="text-align: end">
                                            <div class="mb-3">
                                                <a href="#" class="btn btn-primary add-faq">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach (old('faq_questions', ['']) as $index => $question)
                                    <div class="row group-boy-faq">
                                        <div class="col-lg-12 form-group group-row-question">
                                            <div class="mb-3">
                                                <label class="form-label">{{ $index + 1 }}. FAQ Questions</label>
                                                <input type="text" name="faq_questions[{{ $index }}]" class="form-control faq-questions" value="{{isset( $faq->faq_questions) ? $faq->faq_questions : ''}}" />
                                                @if ($errors->has('faq_questions.' . $index))
                                                    <div class="text-danger">{{ $errors->first('faq_questions.' . $index) }}</div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ $index + 1 }}. FAQ Answer</label>
                                                <input type="text" name="faq_answer[{{ $index }}]" class="form-control faq-answer" value="{{isset( $faq->faq_answer) ? $faq->faq_answer : ''}}" />
                                                @if ($errors->has('faq_answer.' . $index))
                                                    <div class="text-danger">{{ $errors->first('faq_answer.' . $index) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach                           
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
