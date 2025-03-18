@extends('frontend.layouts.main')
@push('title')
    <title>Compare - Price & Specs</title>
@endpush
@section('main')
    <section class="b-pageHeader">
        <div class="container">
            <h1 class=" wow zoomInLeft" data-wow-delay="0.3s">{{ $compareproduct->product_name }} vs
                {{ $product->product_name }}</h1>

        </div>
    </section>
    <!--b-pageHeader-->

    <div class="b-breadCumbs s-shadow">
        <div class="container wow zoomInUp" data-wow-delay="0.3s">
            <a href="{{ url('/') }}" class="b-breadCumbs__page">Home</a><span class="fa fa-angle-right"></span><a
                href="" class="b-breadCumbs__page m-active">{{ $compareproduct->product_name }} vs
                {{ $product->product_name }}</a>
        </div>
    </div>
    <!--b-breadCumbs-->

    <div class="b-infoBar">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-xs-12 wow zoomInUp" data-wow-delay="0.3s">
                    <h5>QUESTIONS? CALL US : <span> {{ $global->phone }}</span></h5>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <div class="b-infoBar__btns wow zoomInUp" data-wow-delay="0.3s">
                        {{-- <a href="#" class="btn m-btn m-infoBtn">SHARE THIS COMPARISON<span class="fa fa-angle-right"></span></a>
                        <a href="#" class="btn m-btn m-infoBtn">ADD A VEHICLE<span class="fa fa-angle-right"></span></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--b-infoBar-->

    <section class="b-compare s-shadow">
        <div class="container">
            <div class="b-compare__images">
                <div class="row">
                    <div class="col-md-5 col-sm-4 col-xs-12 col-md-offset-2">
                        <div class="b-compare__images-item s-lineDownCenter wow zoomInUp" data-wow-delay="0.3s"
                            data-id="{{ $product->id }}">
                            <h3>{{ $compareproduct->product_name }}</h3>
                            <img class="img-responsive center-block" src="{{ asset($compareproduct->productimage1) }}"
                                alt="{{ $compareproduct->product_name }}" />
                            <div class="b-compare__images-item-price m-right m-left">
                                <div class="b-compare__images-item-price-vs">vs</div>{{ $compareproduct->showroom_price }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-4 col-xs-12 ">
                        <div class="b-compare__images-item s-lineDownCenter wow zoomInUp" data-wow-delay="0.3s"
                            data-id="{{ $product->id }}">
                            <h3>{{ $product->product_name }}</h3>
                            <img class="img-responsive center-block" src="{{ asset($product->productimage1) }}"
                                alt="{{ $product->product_name }}" />
                            <div class="b-compare__images-item-price m-right m-left">
                                {{-- <div class="b-compare__images-item-price-vs">vs</div> --}}
                                {{ $product->showroom_price }}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="b-compare__images-item s-lineDownCenter wow zoomInUp" data-wow-delay="0.3s" data-id="{{ $product->id }}">
                            <h3>{{$product->product_name}}</h3>
                            <img class="img-responsive center-block" src="{{asset($product->productimage1)}}" alt="{{$product->product_name}}" />
                            <div class="b-compare__images-item-price m-right m-left">
                                {{$product->showroom_price}}
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="b-compare__block wow zoomInUp" data-wow-delay="0.3s">
                <div class="b-compare__block-title s-whiteShadow">
                    <h3 class="s-titleDet">BASIC INFO</h3>
                    <a class="j-more" href="#"><span class="fa fa-angle-left"></span></a>
                </div>
                <div class="b-compare__block-inside j-inside">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Color
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->color)
                                    {{ $compareproduct->color }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->color)
                                    {{ $product->color }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Mileage
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->mileage)
                                    {{ $compareproduct->mileage }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->mileage)
                                    {{ $product->mileage }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Fule Tank Capacity
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->fule_tank_capacity)
                                    {{ $compareproduct->fule_tank_capacity }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->fule_tank_capacity)
                                    {{ $product->fule_tank_capacity }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Kerb Weight

                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->kerb_weight)
                                    {{ $compareproduct->kerb_weight }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->kerb_weight)
                                    {{ $product->kerb_weight }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Height
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->height)
                                    {{ $compareproduct->height }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->height)
                                    {{ $product->height }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Top Speed

                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->top_speed)
                                    {{ $compareproduct->top_speed }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->top_speed)
                                    {{ $product->top_speed }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Engine

                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->engine)
                                    {{ $compareproduct->engine }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->engine)
                                    {{ $product->engine }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Fuel Type


                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->fuel_type)
                                    {{ $compareproduct->transmission_type }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->fuel_type)
                                    {{ $product->fuel_type }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Transmission Type
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->transmission_type)
                                    {{ $compareproduct->transmission_type }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->transmission_type)
                                    {{ $product->transmission_type }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Seating Capacity

                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->seating_capacity)
                                    {{ $compareproduct->seating_capacity }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->seating_capacity)
                                    {{ $product->seating_capacity }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Driving Range


                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->driving_range)
                                    {{ $compareproduct->driving_range }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->driving_range)
                                    {{ $product->driving_range }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Charging Time



                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->charging_time)
                                    {{ $compareproduct->charging_time }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($product->charging_time)
                                    {{ $product->charging_time }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Safety
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->safety)
                                    {{ $compareproduct->safety }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">

                                @if ($product->safety)
                                    {{ $product->safety }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="b-compare__block-inside-title">
                                Displacement



                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                @if ($compareproduct->displacement)
                                    {{ $compareproduct->displacement }}
                                @else
                                    N/A
                                @endif

                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-compare__block-inside-value">
                                {{-- @php
                                    dd($product);
                                @endphp --}}
                                @if ($product->displacement)
                                    {{ $product->displacement }}
                                @else
                                    N/A
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="b-compare__links wow zoomInUp" data-wow-delay="0.3s">
                <div class="row">
                    <div class="col-sm-3 col-xs-12 col-sm-offset-3">
                        <a href="{{ url(strtolower($compareproduct->category) . '/' . strtolower($compareproduct->brands) . '/' . $compareproduct->product_url) }}"
                            class="btn m-btn">VIEW LISTINGS<span class="fa fa-angle-right"></span></a>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <a href="{{ url(strtolower($product->category) . '/' . strtolower($product->brands) . '/' . $product->product_url) }}"
                            class="btn m-btn">VIEW LISTINGS<span class="fa fa-angle-right"></span></a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="b-world">
        <div class="container">
            <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s" data-wow-offset="100">Latest News And Articles</h2>

            <div class="row">
                @php
                    $newsalldata = $newsalldata->sortByDesc('created_at')->take(3);
                    use Illuminate\Support\Str;
                @endphp
                @foreach ($newsalldata as $item)
                    <div class="col-sm-4 col-xs-12">
                        <div class="b-world__item wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                            <img class="img-responsive" src="{{ asset($item->news_image) }}" alt="{{ $item->title }}">
                            <h2>{{ $item->title }}</h2>
                            <div class="ss-titleDet" style="text-transform: lowercase;">
                                {!! $item->news_details !!}
                            </div>
                            <div class="b-blog__posts-one-body-head-notes" style="margin-bottom: 10px">
                                <span class="b-blog__posts-one-body-head-notes-note"><span
                                        class="fa fa-calendar-o"></span>{{ $item->created_at->format('d-m-Y') }}</span>
                            </div>
                            <a href="{{ url('news/' . Str::slug($item->news_page) . '/' . $item->slug) }}"
                                class="btn m-btn">READ MORE<span class="fa fa-angle-right"></span></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ url('/news/latest-news') }}" class="btn m-btn btn-primarynew newbtnall btn mt-5">More
                    News</a>
            </div>
        </div>
    </section>
    <!--b-compare-->
@endsection
