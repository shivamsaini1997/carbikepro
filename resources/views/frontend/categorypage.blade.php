@extends('frontend.layouts.main')
@push('title')
    <title>{{ $categorys->category }}</title>
@endpush
@push('meta')
    @foreach ($allcategory as $item)
        @if ($item->slug == $categorys->slug)
            <meta name="keywords" content="{{ $item->meta_tags }}">
            <meta name="description" content="{{ $item->meta_description }}">
        @endif
    @endforeach
@endpush
@section('main')

    {{-- banner start  --}}
    @php
        $categoryNames = [];

        foreach ($subcategories as $subname) {
            if (is_object($subname)) {
                $categoryNames[] = $subname->category;
            }
        }

        $filteredBanners = $banner->filter(function ($item) use ($categoryNames) {
            return in_array($item->pages_name, $categoryNames);
        });

    @endphp
    <section class="b-slider">
        <div id="carousel" class="slide carousel carousel-fade">
            <div class="carousel-inner">
                @foreach ($filteredBanners as $key => $item)
                    <div class="item {{ $loop->first ? 'active' : '' }}"->
                        <a href="{{ $item->banner_url }}">
                            <img src="{{ asset($item->banner) }}" alt="{{ $categorys->category }}" />
                        </a>
                    </div>
                @endforeach
            </div>

            <a class="carousel-control right" href="#carousel" data-slide="next">
                <span class="fa fa-angle-right m-control-right"></span>
            </a>
            <a class="carousel-control left" href="#carousel" data-slide="prev">
                <span class="fa fa-angle-left m-control-left"></span>
            </a>
        </div>
    </section>
    <section class="newcar py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2><b>{{ $categorys->category }}</b></h2>
                    <p>{!! isset($pages) ? $pages->page_detail : '' !!}</p>
                </div>

            </div>
        </div>
    </section>
    {{-- banner end  --}}

    {{-- brands start  --}}
    <section class="b-auto">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @foreach ($brands as $item)
                        @foreach ($categorys as $itemcat)
                            @php
                                $categoryWords = explode(' ', $categorys->category);
                                $secondWord = isset($categoryWords[1]) ? $categoryWords[1] : '';
                            @endphp
                            <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">{{ $secondWord }} Brands</h2>
                        @break
                    @endforeach
                @break
            @endforeach
        </div>
    </div>

    <div class="row">
        @php
            $secondWord = '';
            $slug = Str::slug($categorys->category);
            if ($slug == $categorys->slug) {
                $words = explode(' ', $categorys->category);
                if (count($words) > 1) {
                    $secondWord = $words[1];
                }
            }

        @endphp

        @php
            $counter = 0;
        @endphp

        @foreach ($brands as $item)
            @if ($item->category == $secondWord && $counter < 12)
                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="brand-img">
                        <a href="{{ url(strtolower($item->category) . '/' . $item->brands_url) }}"
                            class="wow slideInUp text-center" data-wow-delay="0.3s" data-wow-offset="100">
                            <img class="img-responsive" src="{{ asset($item->brands_image) }}"
                                alt="{{ $item->brands_name }}" />
                            <h2 class="text-center">{{ $item->brands_name }}</h2>
                        </a>
                    </div>
                </div>
                @php
                    $counter++;
                @endphp
            @endif
        @endforeach


        <div class="col-sm-12">
            <div>
                @php
                    $carsButtonDisplayed = false;
                @endphp

                @foreach ($brands as $item)
                    @if ($item->category == $secondWord && !$carsButtonDisplayed)
                        <a href="{{ route('brands', [strtolower($item->category)]) }}"
                            class="btn m-btn btn-primarynew btn">View All {{ $item->category }} Brands</a>
                        @php
                            $carsButtonDisplayed = true;
                        @endphp
                    @endif
                @endforeach

            </div>
        </div>

    </div>
</div>
</div>
</section>


{{-- brands end  --}}


{{-- Latest products  --}}
<section class="b-featured pt-5">
<div class="container">
    @php
        $secondWord = '';
        $categoryname = '';

        $slug = Str::slug($categorys->category);
        $pagename = $categorys->category;
        $words = explode(' ', $pagename);

        if (isset($words[1])) {
            $secondWord = $words[1];
        }

        foreach ($allcategory as $categoryItem) {
            if ($categoryItem->category == $secondWord) {
                $categoryname = strtolower($categoryItem->category);
            }
        }
    @endphp

    <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Latest {{ $secondWord }}</h2>
    <div class="row">
        <div class="col-sm-12">
            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4" data-navigation="true"
                data-auto-play="true" data-stop-on-hover="true" data-items-desktop="4" data-items-desktop-small="4"
                data-items-tablet="3" data-items-tablet-small="2">
                @foreach ($product as $items)
                    @if ($secondWord == $items->category)
                        @if ($items->pages_name == 'Latest' . ' ' . $secondWord)
                            <div>
                                <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s"
                                    data-wow-offset="150">
                                    <a
                                        href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
                                        <img src="{{ asset($items->productimage1) }}"
                                            alt="{{ $items->product_name }}" />
                                        @if ($items->product_label == '1')
                                            <span class="m-premium">Just Launched</span>
                                        @endif
                                        @if ($items->product_label == '2')
                                            <span class="m-leasing">Electric</span>
                                        @endif
                                        @if ($items->product_label == '3')
                                            <span class="m-leasing">Popular Cars</span>
                                        @endif
                                        @if ($items->product_label == '4')
                                            <span class="m-leasing">Upcoming Cars</span>
                                        @endif
                                        @if ($items->product_label == '5')
                                            <span class="m-leasing">Latest Bike</span>
                                        @endif
                                        @if ($items->product_label == '6')
                                            <span class="m-leasing">Popular Bike</span>
                                        @endif
                                        @if ($items->product_label == '7')
                                            <span class="m-leasing">Upcoming Bike</span>
                                        @endif
                                        @if ($items->product_label == '8')
                                            <span class="m-leasing">Latest Scooter</span>
                                        @endif
                                        @if ($items->product_label == '9')
                                            <span class="m-leasing">Popular Scooter</span>
                                        @endif
                                        @if ($items->product_label == '10')
                                            <span class="m-leasing">Upcoming Scooter</span>
                                        @endif

                                    </a>
                                    <h5><a
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                    </h5>
                                    <div class="b-featured__item-prices">
                                        Rs {{ $items->showroom_price }}
                                    </div>
                                    <div class="b-featured__item-count"><span
                                            class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                                    <div class="b-featured__item-links">
                                        <a
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                        <a
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                        <a
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                    </div>
                                    <a href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                        class="btn m-btn newcardbtn">Get on road price</a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            <div>
                <a href="{{ url('latest' . '-' . strtolower($secondWord)) }}"
                    class="btn m-btn btn-primarynew btn">View All Latest {{ $secondWord }}</a>
            </div>
        </div>
    </div>
</div>
</section>
{{-- Latest products  --}}


{{-- Upcoming products  --}}
<section class="b-featured pt-5">
<div class="container">
    <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s"> Upcoming {{ $secondWord }}</h2>
    <div class="row">
        <div class="col-sm-12">
            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4" data-navigation="true"
                data-auto-play="true" data-stop-on-hover="true" data-items-desktop="4"
                data-items-desktop-small="4" data-items-tablet="3" data-items-tablet-small="2">
                @foreach ($product as $items)
                    @if ($secondWord == $items->category)
                        @if ($items->pages_name == 'Upcoming' . ' ' . $secondWord)
                            <div>
                                <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s"
                                    data-wow-offset="150">
                                    <a
                                        href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
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
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                    </h5>
                                    <div class="b-featured__item-prices">
                                        Rs {{ $items->showroom_price }}
                                    </div>
                                    <div class="b-featured__item-count"><span
                                            class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                                    <div class="b-featured__item-links">
                                        <a
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                        <a
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                        <a
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                    </div>
                                    <a href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                        class="btn m-btn newcardbtn">Get on road price</a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach

            </div>
            <div>
                <a href="{{ url('upcoming' . '-' . strtolower($secondWord)) }}"
                    class="btn m-btn btn-primarynew btn">View All Upcoming {{ $secondWord }}</a>
            </div>
        </div>
    </div>

</div>
</section>
{{-- Upcoming products  --}}

{{-- Popular products  --}}
<section class="b-featured pt-5">
<div class="container">
    <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Popular {{ $secondWord }} </h2>
    <div class="row">
        <div class="col-sm-12">
            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4"
                data-navigation="true" data-auto-play="true" data-stop-on-hover="true" data-items-desktop="4"
                data-items-desktop-small="4" data-items-tablet="3" data-items-tablet-small="2">
                @foreach ($product as $items)
                    @if ($secondWord == $items->category)
                        @if ($items->pages_name == 'Popular' . ' ' . $secondWord)
                            <div>
                                <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s"
                                    data-wow-offset="150">
                                    <a
                                        href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
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
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                    </h5>
                                    <div class="b-featured__item-prices">
                                        Rs {{ $items->showroom_price }}
                                    </div>
                                    <div class="b-featured__item-count"><span
                                            class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                                    <div class="b-featured__item-links">
                                        <a
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                        <a
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                        <a
                                            href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                    </div>
                                    <a href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                        class="btn m-btn newcardbtn">Get on road price</a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach

            </div>
            <div>
                <a href="{{ url('popular' . '-' . strtolower($secondWord)) }}"
                    class="btn m-btn btn-primarynew btn">View All Popular {{ $secondWord }}</a>
            </div>
        </div>
    </div>

</div>
</section>
{{-- Popular products  --}}


{{-- news  --}}
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
                    <img class="img-responsive" src="{{ asset($item->news_image) }}" alt="wolks">
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
{{-- news  --}}


<section class="b-featured pt-5">
<div class="container">
    <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Recently Viewed {{ $secondWord }}</h2>
    <div class="row">
        <div class="col-sm-12">
            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4"
                data-navigation="true" data-auto-play="true" data-stop-on-hover="true" data-items-desktop="4"
                data-items-desktop-small="4" data-items-tablet="3" data-items-tablet-small="2">
                @foreach ($product as $items)
                    @if ($secondWord == $items->category)
                        <div>
                            <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s"
                                data-wow-offset="150">
                                <a
                                    href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
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
                                        href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                </h5>
                                <div class="b-featured__item-prices">
                                    Rs {{ $items->showroom_price }}
                                </div>
                                <div class="b-featured__item-count"><span
                                        class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                                <div class="b-featured__item-links">
                                    <a
                                        href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                    <a
                                        href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                    <a
                                        href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                </div>
                                <a href="{{ url($categoryname . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                    class="btn m-btn newcardbtn">Get on road price</a>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>


</div>
</section>
@endsection
