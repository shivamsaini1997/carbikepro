@extends('frontend.layouts.main')
@push('title')
    <title>{{ $brands->brands_name }}</title>
@endpush
@push('meta')
    <meta name="keywords" content="{{ $brands->meta_tags }}">
    <meta name="description" content="{{ $brands->meta_description }}">
@endpush
@section('main')
    <div class="b-blog s-shadow">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2><b>{{ $brands->brands_name }}</b></h2>
                    <p>{!! $brands->brands_details !!}</p>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-3 col-xs-12 d-none">
                    <aside class="b-blog__aside">
                        <div class="b-blog__aside-categories wow zoomInUp" data-wow-delay="0.3s">
                            <header class="s-lineDownLeft">
                                <h2 class="s-titleDet">Explore Other {{ $brands->category }} Brands</h2>
                            </header>
                            <nav>
                                <ul class="b-blog__aside-categories-list">
                                    <ul class="b-blog__aside-categories-list">
                                        @foreach ($brandsname as $item)
                                            @if (strtolower($item->category) == strtolower($brands->category))
                                                <li
                                                    class="{{ strtolower(request()->url()) === strtolower(url($item->category . '/' . $item->brands_url)) ? 'm-active' : '' }}">
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
                <div class="col-md-9 col-xs-12">
                    <div class="row">
                        <div class="text-center">
                            @foreach ($product as $items)
                                @if (strtolower($brands->brands_name == $items->brands))
                                    @if ($brands->category == $items->category)
                                        <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">{{ $brands->brands_name }}
                                            {{ $brands->category }} </h2>
                                    @break
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @foreach ($product as $items)
                        @if (strtolower($brands->brands_name == $items->brands))
                            @if ($brands->category == $items->category)
                                <div class="col-lg-4 col-md-6">
                                    <div>
                                        <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s"
                                            data-wow-offset="150">
                                            <a
                                                href="{{ url(strtolower($brands->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
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
                                                    href="{{ url(strtolower($brands->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                            </h5>
                                            <div class="b-featured__item-prices">
                                                Rs {{ $items->showroom_price }}
                                            </div>
                                            <div class="b-featured__item-count"><span
                                                    class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                                            <div class="b-featured__item-links">
                                                <a
                                                    href="{{ url(strtolower($brands->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                                <a
                                                    href="{{ url(strtolower($brands->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                                <a
                                                    href="{{ url(strtolower($brands->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                            </div>
                                            <a href="{{ url(strtolower($brands->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                                class="btn m-btn newcardbtn">Get on road price</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>

                {{-- news  --}}
                <br>
                <div class="row">
                    <div class="text-center">
                        <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s" data-wow-offset="100">Latest News
                            And Articles</h2>
                    </div>

                    @php
                        $newsalldata = $newsalldata->sortByDesc('created_at')->take(3);
                        use Illuminate\Support\Str;
                    @endphp
                    @foreach ($newsalldata as $item)
                        <div class="col-sm-4 col-xs-12">
                            <div class="b-world__item wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                                <img class="img-responsive" src="{{ asset($item->news_image) }}"
                                    alt="{{ $items->product_name }}">
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

                    <div class="text-center b-btn">
                        <a href="{{ url('/news/latest-news') }}"
                            class="btn m-btn btn-primarynew newbtnall btn mt-5">More News</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
