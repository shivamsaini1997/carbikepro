@extends('frontend.layouts.main')
@push('title')
    <title>News / {{ $newsdetails->news_page }} / {{ $newsdetails->title }}</title>
@endpush
@push('meta')
    <meta name="description" content="{{ $newsdetails->meta_description }}">
    <meta name="keywords" content="{{ $newsdetails->meta_tags }}">
@endpush

@section('main')
    <section class="b-pageHeader py-5" style="background-image: url({{ asset($newsdetails->news_image) }});">
        <div class="container py-5">
            <h1 class="wow zoomInLeft" data-wow-delay="0.7s">{{ $newsdetails->title }}</h1>
        </div>
    </section>
    @php
        $newspageslug = [];
        foreach ($newsreviewpage as $item) {
            $newspageslug = $item;
        }
    @endphp

    <div class="b-breadCumbs s-shadow">
        <div class="container wow zoomInUp" data-wow-delay="0.7s">
            <a href="{{ url('/') }}" class="b-breadCumbs__page">Home</a><span class="fa fa-angle-right"></span><a
                href="javascript:void(0)" class="b-breadCumbs__page">News</a><span class="fa fa-angle-right"></span><a
                href="{{ url('news/' . $newspageslug->slug) }}"
                class="b-breadCumbs__page m-active">{{ $newsdetails->news_page }}</a><span
                class="fa fa-angle-right"></span><a
                href="{{ url('news/' . $newspageslug->slug . '/' . $newsdetails->slug) }}"
                class="b-breadCumbs__page m-active">{{ $newsdetails->title }}</a>
        </div>
    </div>
    <!--b-breadCumbs-->
    <section class="b-article">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-xs-12">
                    <div class="b-article__main">
                        <div class="b-blog__posts-one">
                            <div class="row m-noBlockPadding">
                                <div class="col-sm-12">
                                    <div class="b-blog__posts-one-body">
                                        <header class="b-blog__posts-one-body-head wow zoomInUp" data-wow-delay="0.5s">
                                            <h2 class="s-titleDet">{{ $newsdetails->title }}</h2>
                                            <div class="b-blog__posts-one-body-head-notes">
                                                <span class="b-blog__posts-one-body-head-notes-note">
                                                    <span
                                                        class="fa fa-calendar-o"></span>{{ $newsdetails->created_at->format('d-m-Y') }}</span>
                                                @php
                                                    // dd($item->created_at->format('d-m-Y'))
                                                @endphp
                                            </div>
                                        </header>
                                        <div class="b-blog__posts-one-body-main wow zoomInUp" data-wow-delay="0.5s">
                                            <div class="b-blog__posts-one-body-main-img">
                                                <img class="img-responsive" src="{{ asset($newsdetails->news_image) }}"
                                                    alt="{{ $newsdetails->title }}" />
                                            </div>
                                            <p>
                                                {!! $newsdetails->news_details !!}
                                            </p>
                                        </div>
                                        <div class="b-blog__posts-one-author wow zoomInUp d-frlx d-flex"
                                            style="display: flex; width: 100%; gap: 15px;" data-wow-delay="0.5s">
                                            <div class="b-blog__posts-one-share" style="margin: 0; padding: 0;">SHARE THIS
                                            </div>
                                            <div class="b-blog__posts-one-social"
                                                style="display: flex; gap: 5px;margin: 0;">
                                                <div>
                                                    <!-- Facebook Share -->
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('news/' . Str::slug($newsdetails->news_page) . '/' . $newsdetails->slug)) }}"
                                                        target="_blank">
                                                        <span class="fa fa-facebook-square"></span>
                                                    </a>
                                                    <!-- Twitter Share -->
                                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('news/' . Str::slug($newsdetails->news_page) . '/' . $newsdetails->slug)) }}&text={{ urlencode($newsdetails->title) }}"
                                                        target="_blank">
                                                        <span class="fa fa-twitter-square"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="text-center">
                            <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s" data-wow-offset="100">Related News
                            </h2>
                        </div>
                        <br>
                        <div class="row">
                            @php
                                $newsalldata = $newsalldata->sortByDesc('created_at')->take(3); // Adjust field if needed
                                use Illuminate\Support\Str;
                            @endphp
                            @foreach ($newsalldata as $item)
                                <div class="col-sm-4 col-xs-12">
                                    <div class="b-world__item wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">
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
                        <div class="text-center">
                            <a href="{{ url('/news/latest-news') }}"
                                class="btn m-btn btn-primarynew newbtnall btn mt-5">More News</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 d-none">
                    <aside class="b-blog__aside">
                        <div class="b-blog__aside-categories wow zoomInUp" data-wow-delay="0.3s">
                            <header class="s-lineDownLeft">
                                <h2 class="s-titleDet">Explore Other Cars Brands</h2>
                            </header>
                            <nav>
                                <ul class="b-blog__aside-categories-list">
                                    <ul class="b-blog__aside-categories-list">
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
                                    </ul>
                                </ul>
                            </nav>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <section class="b-featured pt-5">
        <div class="container">
            <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Recently Viewed vehicle </h2>
            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4" data-navigation="true"
                data-auto-play="true" data-stop-on-hover="true" data-items-desktop="4" data-items-desktop-small="4"
                data-items-tablet="3" data-items-tablet-small="2">
                @foreach ($product as $items)
                    <div>
                        <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s" data-wow-offset="150">
                            <a
                                href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
                                <img src="{{ asset($items->productimage1) }}" alt="{{ $items->product_name }}" />
                                @if ($items->product_label == '1')
                                    <span class="m-premium">Just Launched</span>
                                @endif
                                @if ($items->product_label == '2')
                                    <span class="m-leasing">Electric</span>
                                @endif
                            </a>
                            <h5><a
                                    href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                            </h5>
                            <div class="b-featured__item-prices">
                                Rs {{ $items->showroom_price }}
                            </div>
                            <div class="b-featured__item-count"><span
                                    class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                            <div class="b-featured__item-links">
                                <a
                                    href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                <a
                                    href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                <a
                                    href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                            </div>
                            <a href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                class="btn m-btn newcardbtn">Get on road price</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
