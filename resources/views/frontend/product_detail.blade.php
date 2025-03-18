@extends('frontend.layouts.main')
@push('title')
    <title>{{ $product->product_name }}</title>
@endpush
@push('meta')
    <meta name="description" content="{{ $product->meta_description }}">
    <meta name="keywords" content="{{ $product->meta_tags }}">
@endpush
@section('main')
    <style>
        /* plus glyph for showing collapsible panels */
        .panel-heading .accordion-plus-toggle:before {
            font-family: FontAwesome;
            content: "\f068";
            float: right;
            color: silver;
        }

        .panel-heading .accordion-plus-toggle.collapsed:before {
            content: "\f067";
            color: silver;
        }

        /* arrow glyph for showing collapsible panels */
        .panel-heading .accordion-arrow-toggle:before {
            font-family: FontAwesome;
            content: "\f078";
            float: right;
            color: silver;
        }

        .panel-heading .accordion-arrow-toggle.collapsed:before {
            content: "\f054";
            color: silver;
        }

        /* sets the link to the width of the entire panel title */
        .panel-title>a {
            display: block;
        }
    </style>
    <section class="b-pageHeader" style="background-image: url({{ asset($product->productimage1) }});">
        <div class="container">
            <h1 class="wow zoomInLeft" data-wow-delay="0.5s">{{ $product->product_name }}</h1>
        </div>
    </section>
    <!--b-pageHeader-->

    <div class="b-breadCumbs s-shadow wow zoomInUp" data-wow-delay="0.5s">
        <div class="container">
            <a href="{{ url('/') }}" class="b-breadCumbs__page">Home</a><span class="fa fa-angle-right"></span><a
                href="" class="b-breadCumbs__page">{{ $product->brands }}</a><span
                class="fa fa-angle-right"></span><a href=""
                class="b-breadCumbs__page m-active">{{ $product->product_name }}</a>
        </div>
    </div>
    <!--b-breadCumbs-->

    <div class="b-infoBar">
        <div class="container">
            <div class="row wow zoomInUp" data-wow-delay="0.5s">

                <div class="col-xs-12">
                    <div class="b-infoBar__btns">
                        <a href="#Overview" id="" class="btn m-btn m-infoBtn">Overview<span
                                class="fa fa-angle-right"></span></a>
                        <a href="#Specifications" class="btn m-btn m-infoBtn">Key Specifications<span
                                class="fa fa-angle-right"></span></a>
                        <a href="#Specifications" class="btn m-btn m-infoBtn">Key Highlights<span
                                class="fa fa-angle-right"></span></a>
                        <a href="#compare" class="btn m-btn m-infoBtn">Compare<span class="fa fa-angle-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--b-infoBar-->

    <section class="b-detail s-shadow" id="Overview">
        <div class="container">
            <header class="b-detail__head s-lineDownLeft wow zoomInUp" style="border: 0; margin: 0;" data-wow-delay="0.5s">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="b-detail__main-info-images wow zoomInUp" data-wow-delay="0.5s">
                            <div class="row m-smallPadding">
                                <div class="col-sm-12 col-lg-10 bx-pager-box">
                                    @if (isset($product->product_name) && !empty($product->product_name))
                                        <ul class="b-detail__main-info-images-big bxslider enable-bx-slider"
                                            data-pager-custom="#bx-pager" data-mode="horizontal" data-pager-slide="true"
                                            data-mode-pager="vertical" data-pager-qty="5">
                                            @for ($i = 1; $i <= 8; $i++)
                                                @php
                                                    $image = "productimage{$i}";
                                                @endphp
                                                @if (!empty($product->$image))
                                                    <li class="s-relative">
                                                        <img class="img-responsive center-block"
                                                            src="{{ asset($product->$image) }}"
                                                            alt="{{ $product->product_name }}" />
                                                    </li>
                                                @endif
                                            @endfor
                                        </ul>
                                    @else
                                        <p>No product images available.</p>
                                    @endif
                                </div>

                                <div class="col-xs-2 pagerSlider pagerVertical allslidephoto">
                                    <div class="b-detail__main-info-images-small" id="bx-pager">
                                        @if (isset($product->product_name) && !empty($product->product_name))
                                            @for ($i = 1; $i <= 8; $i++)
                                                @php
                                                    $image = "productimage{$i}";
                                                @endphp
                                                @if (!empty($product->$image))
                                                    <a href="#" data-slide-index="{{ $i - 1 }}"
                                                        class="b-detail__main-info-images-small-one">
                                                        <img class="img-responsive" src="{{ asset($product->$image) }}"
                                                            alt="{{ $product->product_name }}" />
                                                    </a>
                                                @endif
                                            @endfor
                                        @else
                                            <p>No product images available.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5" style="padding-top: 40px">
                        <div class="b-detail__head-title">
                            <h1>{{ $product->brands }} {{ $product->product_name }}</h1>

                        </div>
                        <div class="bottom-box">
                            <div class="b-detail__head-price price-title">
                                <p class="price-loction">Ex-showroom Price* <span class="locetion-delhi"></span></p>
                                <h4 class="" style="margin: 0"><b>Rs {{ $product->showroom_price }}*</b></h4>
                            </div>
                            <div class="b-detail__head-price price-title">
                                <p class="price-loction">On Road Price* <span class="locetion-delhi"></span></p>
                                <h4 class="" style="margin-top: 0"><b>Rs {{ $product->showroom_price }}*</b></h4>
                            </div>
                            <div class="emi-calculate">
                                <p class="price-loction">
                                    <span>EMI Rs {{ $product->emi }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z">
                                        </path>
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z">
                                        </path>
                                    </svg>
                                    <span>For 5 years</span>
                                </p>
                            </div>
                            {{-- <p><a href="javascript:void(0)" class="emi-cal-btn">EMI Calculator</a></p> --}}
                            <div class="b-btn">
                                <a href="javascript:void(0)" class="btn m-btn btn-primarynew newbtnall"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor"
                                        class="bi bi-gift" viewBox="0 0 16 17">
                                        <path
                                            d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z">
                                        </path>
                                    </svg>Get November Offer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="b-detail__main" id="Specifications">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <div class="b-detail__main-info">
                            <div class="b-detail__main-info-text wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-detail__main-aside-about-form-links">
                                    <h2 class="s-titleDet">Key Specifications</h2>

                                </div>
                                <div id="info1">
                                    {!! $product->highlights !!}
                                </div>
                            </div>
                        </div>

                        @foreach ($newsalldata as $item)
                            @if ($item->news_page == 'Product News')
                                @if ($item->product_name == $product->product_name)
                                    <div class="row mt-5" style="padding-top: 40px">
                                        <div class="text-center">
                                            <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s"
                                                data-wow-offset="100">
                                                {{ $product->brands }} {{ $product->product_name }} News</h2>
                                        </div>
                                        <div class="col-sm-12">
                                            <div id="carousel-small" class="owl-carousel enable-owl-carousel"
                                                data-items="4" data-navigation="true" data-auto-play="true"
                                                data-stop-on-hover="true" data-items-desktop="3"
                                                data-items-desktop-small="3" data-items-tablet="3"
                                                data-items-tablet-small="1">
                                                @foreach ($newsalldata as $item)
                                                    @if ($item->news_page == 'Product News')
                                                        @if ($item->product_name == $product->product_name)
                                                            <div class="b-featured__item wow rotateIn">
                                                                <div class="b-world__item wow zoomInLeft"
                                                                    data-wow-delay="0.3s" data-wow-offset="100">
                                                                    <img class="img-responsive"
                                                                        src="{{ asset($item->news_image) }}"
                                                                        alt="{{ $item->title }}">
                                                                    <h2>{{ $item->title }}</h2>
                                                                    <div class="ss-titleDet"
                                                                        style="text-transform: lowercase;">
                                                                        {!! $item->news_details !!}
                                                                    </div>
                                                                    <div class="b-blog__posts-one-body-head-notes"
                                                                        style="margin-bottom: 10px">
                                                                        <span
                                                                            class="b-blog__posts-one-body-head-notes-note"><span
                                                                                class="fa fa-calendar-o"></span>{{ $item->created_at->format('d-m-Y') }}</span>
                                                                    </div>
                                                                    <a href="{{ url('news/' . Str::slug($item->news_page) . '/' . $item->slug) }}"
                                                                        class="btn m-btn">READ MORE<span
                                                                            class="fa fa-angle-right"></span></a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @break
                            @endif
                        @endif
                    @endforeach

                    @if (!empty($allproducts))
                        @foreach ($allproducts as $items)
                            <div class="carousel-three mt-5"style="padding-top: 40px">
                                @php
                                    $categore = '';
                                    if (!empty($categorys->category)) {
                                        $categore = strtolower($categorys->category);
                                    }

                                @endphp
                                <div class="text-center mt-5">

                                    <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Recently Viewed
                                        {{ $categore }}</h2>
                                </div>
                                <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4"
                                    data-navigation="true" data-auto-play="true" data-stop-on-hover="true"
                                    data-items-desktop="3" data-items-desktop-small="3" data-items-tablet="3"
                                    data-items-tablet-small="1">
                                    @foreach ($allproducts as $items)
                                        @if (strtolower($items->category) == $categore)
                                            <div>
                                                <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s"
                                                    data-wow-offset="150">
                                                    <a
                                                        href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
                                                        <img src="{{ asset($items->productimage1) }}"
                                                            alt="{{ $items->product_name }}" />
                                                        @if ($items->product_label == '1')
                                                            <span class="m-premium">Just Launched</span>
                                                        @endif
                                                        @if ($items->product_label == '2')
                                                            <span class="m-leasing">Electric</span>
                                                        @endif
                                                    </a>
                                                    <h5><a
                                                            href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                                    </h5>
                                                    <div class="b-featured__item-prices">
                                                        Rs {{ $items->showroom_price }}
                                                    </div>
                                                    <div class="b-featured__item-count"><span
                                                            class="fa fa-tachometer"></span>{{ $items->top_speed }}
                                                    </div>
                                                    <div class="b-featured__item-links">
                                                        <a
                                                            href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                                        <a
                                                            href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                                        <a
                                                            href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                                    </div>
                                                    <a href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                                        class="btn m-btn newcardbtn">Get on road price</a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @break
                    @endforeach
                @endif




                @foreach ($allvideo as $item)
                    @if ($item->product == $product->id)
                        <div class="carousel-three mt-5"style="padding-top: 40px">
                            <div class="text-center mt-5">
                                <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">
                                    {{ $product->product_name }}
                                    Videos</h2>
                            </div>
                            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4"
                                data-navigation="true" data-auto-play="true" data-stop-on-hover="true"
                                data-items-desktop="3" data-items-desktop-small="3" data-items-tablet="3"
                                data-items-tablet-small="1">
                                @foreach ($allvideo as $item)
                                    @if ($item->product == $product->id)
                                        <div class="col-sm-12">
                                            <a href="{{ route('videos-detail', $item->slug) }}">
                                                <div class="b-world__item wow zoomInLeft" data-wow-delay="0.3s"
                                                    data-wow-offset="100">
                                                    <img class="img-responsive"
                                                        src="{{ asset($item->video_thanmbnail) }}"
                                                        alt="{{ $item->video_title }}">
                                                    <h2>{{ $item->video_title }}</h2>
                                                    <span><b>{{ $item->created_at->format('d-M-Y h:i A') }}
                                                        </b></span>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @break
                @endif
            @endforeach


            <div class="row mt-5" style="padding-top: 40px">
                <div class="text-center">
                    <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s" data-wow-offset="100">Latest
                        News And Articles</h2>
                </div>
                <div class="">
                    @php
                        $newsalldata = $newsalldata->sortByDesc('created_at')->take(3);
                        use Illuminate\Support\Str;
                    @endphp

                    @foreach ($newsalldata as $item)
                        <div class="col-sm-4 col-xs-12">
                            <div class="b-world__item wow zoomInLeft" data-wow-delay="0.3s"
                                data-wow-offset="100">
                                <img class="img-responsive" src="{{ asset($item->news_image) }}"
                                    alt="{{ $item->title }}">
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
                <div class="text-center b-btn">
                    <a href="{{ url('/news/latest-news') }}"
                        class="btn m-btn btn-primarynew newbtnall btn mt-5">More News</a>
                </div>
            </div>
            {{-- compare  --}}
            <div class="row mt-5" id="compare">
                @if (!empty($allproducts))
                    @foreach ($allproducts as $items)
                        <div class="carousel-three"style="padding-top: 40px">
                            @php
                                $categore = '';
                                if (!empty($categorys->category)) {
                                    $categore = strtolower($categorys->category);
                                }
                            @endphp
                            <div class="text-center mt-5">
                                <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Comparison </h2>
                            </div>
                            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4"
                                data-navigation="true" data-auto-play="true" data-stop-on-hover="true"
                                data-items-desktop="3" data-items-desktop-small="3" data-items-tablet="3"
                                data-items-tablet-small="1">
                                @foreach ($allproducts as $items)
                                    @if (strtolower($items->category) == $categore)
                                        <div>
                                            <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s"
                                                data-wow-offset="150">
                                                <a
                                                    href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
                                                    <img src="{{ asset($items->productimage1) }}"
                                                        alt="{{ $items->product_name }}" />
                                                    @if ($items->product_label == '1')
                                                        <span class="m-premium">Just Launched</span>
                                                    @endif
                                                    @if ($items->product_label == '2')
                                                        <span class="m-leasing">Electric</span>
                                                    @endif
                                                </a>
                                                <h5><a
                                                        href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                                </h5>
                                                <div class="b-featured__item-prices">
                                                    Rs {{ $items->showroom_price }}
                                                </div>
                                                <div class="b-featured__item-count"><span
                                                        class="fa fa-tachometer"></span>{{ $items->top_speed }}
                                                </div>
                                                <div class="b-featured__item-links">
                                                    <a
                                                        href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                                    <a
                                                        href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                                    <a
                                                        href="{{ url($categore . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                                </div>
                                                <a href="{{ url('/compare' . '/' . $product->product_url . '/' . $items->product_url) }}"
                                                    class="btn m-btn newcardbtn compare">Comparison </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @break
                    @endforeach
                @endif
            </div>
        {{-- compare  --}}
        <div class="row mt-5" style="padding-top: 40px">
            <div class="col-12" style="text-align: center">
                @if (!empty($faq))

                    @foreach ($faq as $item)
                        @if ($item->product == $product->id)
                            <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s"
                                data-wow-offset="100">
                                {{ $product->product_name }} Questions & Answers</h2>
                            @break
                        @endif
                    @endforeach
                @else
                @endif
            </div>

            <div class="col-sm-12">
                <div class="panel-group" id="accordion-8023664" role="tablist"
                    aria-multiselectable="false">
                    <div class="panel-group" id="accordion-4260996" role="tablist"
                        aria-multiselectable="false">
                        @if (!empty($faq))
                            @foreach ($faq as $item)
                                @if ($item->product == $product->id)
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab"
                                            id="heading-{{ $item->id }}">
                                            <h5 class="panel-title">
                                                <a role="button" data-toggle="collapse"
                                                    class="accordion-toggle accordion-arrow-toggle collapsed"
                                                    data-parent="#accordion-4260996"
                                                    href="#collapse-{{ $item->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapse-{{ $item->id }}">{{ $item->faq_questions }}</a>
                                            </h5>
                                        </div>
                                        <div id="collapse-{{ $item->id }}"
                                            class="panel-collapse collapse" role="tabpanel"
                                            aria-labelledby="heading-{{ $item->id }}">
                                            <div class="panel-body">{{ $item->faq_answer }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

<div class="col-md-4 col-xs-12 sticky-bar">
    <aside class="b-detail__main-aside">
        <div class="b-detail__main-aside-desc wow zoomInUp" data-wow-delay="0.5s">
            <h2 class="s-titleDet">Key Specifications</h2>
            @if ($product->color)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Color</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->color }}</p>
                    </div>
                </div>
            @endif
            @if ($product->mileage)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Mileage</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->mileage }}</p>
                    </div>
                </div>
            @endif
            @if ($product->displacement)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Displacement</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->displacement }}</p>
                    </div>
                </div>
            @endif
            @if ($product->fule_tank_capacity)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Fule Tank Capacity</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->fule_tank_capacity }}
                        </p>
                    </div>
                </div>
            @endif
            @if ($product->kerb_weight)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Kerb Weight</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->kerb_weight }}</p>
                    </div>
                </div>
            @endif
            @if ($product->height)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Height</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->height }}</p>
                    </div>
                </div>
            @endif
            @if ($product->top_speed)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Top Speed</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->top_speed }}</p>
                    </div>
                </div>
            @endif
            @if ($product->engine)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Engine</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->engine }}</p>
                    </div>
                </div>
            @endif
            @if ($product->fuel_type)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Fuel Type</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->fuel_type }}</p>
                    </div>
                </div>
            @endif
            @if ($product->transmission_type)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Transmission Type</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->transmission_type }}
                        </p>
                    </div>
                </div>
            @endif
            @if ($product->seating_capacity)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Seating Capacity</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->seating_capacity }}
                        </p>
                    </div>
                </div>
            @endif
            @if ($product->safety)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Safety</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->safety }}</p>
                    </div>
                </div>
            @endif
            @if ($product->driving_range)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Driving Range</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->driving_range }}</p>
                    </div>
                </div>
            @endif
            @if ($product->charging_time)
                <div class="row">
                    <div class="col-xs-5">
                        <h4 class="b-detail__main-aside-desc-title">Charging Time</h4>
                    </div>
                    <div class="col-xs-7">
                        <p class="b-detail__main-aside-desc-value">{{ $product->charging_time }}</p>
                    </div>
                </div>
            @endif
        </div>

    </aside>
    <aside class="b-blog__aside d-none">
        <div class="b-blog__aside-categories wow zoomInUp" data-wow-delay="0.3s">
            <header class="s-lineDownLeft">
                <h2 class="s-titleDet">Explore Other Cars Brands</h2>
            </header>
            <nav>
                <ul class="b-blog__aside-categories-list">
                    <ul class="b-blog__aside-categories-list">
                        @if (!empty($brandscar))
                            @foreach ($brandscar as $item)
                                @if ($item->category == 'Cars')
                                    <li
                                        class="{{ request()->url() === url($item->category . '/' . $item->brands_url) ? 'm-active' : '' }}">
                                        <a
                                            href="{{ url(strtolower($item->category) . '/' . $item->brands_url) }}">
                                            {{ $item->brands_name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif

                    </ul>
                </ul>
            </nav>
        </div>
        <div class="b-blog__aside-categories wow zoomInUp" data-wow-delay="0.3s">
            <header class="s-lineDownLeft">
                <h2 class="s-titleDet">Explore Other Bikes Brands</h2>
            </header>
            <nav>
                <ul class="b-blog__aside-categories-list">
                    <ul class="b-blog__aside-categories-list">
                        @if (!empty($brandsbike))
                            @foreach ($brandsbike as $item)
                                @if ($item->category == 'Bikes')
                                    <li
                                        class="{{ request()->url() === url($item->category . '/' . $item->brands_url) ? 'm-active' : '' }}">
                                        <a
                                            href="{{ url(strtolower($item->category) . '/' . $item->brands_url) }}">
                                            {{ $item->brands_name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </ul>
            </nav>
        </div>
    </aside>
</div>
</div>
</div>
</div>
</section>

@endsection
