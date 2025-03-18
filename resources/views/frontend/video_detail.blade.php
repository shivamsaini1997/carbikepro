@extends('frontend.layouts.main')
@section('main')
    <section class="newcar py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2><b>Videos And Podcasts</b></h2>
                </div>

            </div>
        </div>
    </section>
    <section class="b-auto">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div>
                        <iframe width="100%" class="youtube-video"  src="{{ $video->video_url }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                        <div style="text-align: start;">
                            <h2 style="font-size: 24px;"><b>{{ $video->video_title }}</b></h2>
                            <div>
                                <p><b>{{ $video->created_at->format('d-M-Y h:i A') }}</b></p>
                                <a href="{{ $video->channelslug }}" target="_blank">
                                    <img style="width: 130px;" src="{{ asset('frontend/images/subscribe.svg') }}" alt="{{ $video->video_title }}">
                                </a>
                            </div>
                            <div class="b-blog__posts-one-author wow zoomInUp d-frlx d-flex" style="display: flex; width: 100%; gap: 15px; margin-top:10px" data-wow-delay="0.5s">
                                <div class="b-blog__posts-one-share" style="margin: 0; padding: 0;">SHARE THIS</div>
                                <div class="b-blog__posts-one-social" style="display: flex; gap: 5px;margin: 0;">
                                    <div>
                                        <!-- Facebook Share -->
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('news/' . Str::slug($video->news_page) . '/' . $video->slug)) }}"
                                           target="_blank">
                                           <span class="fa fa-facebook-square"></span>
                                        </a>
                        
                                        <!-- Twitter Share -->
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('news/' . Str::slug($video->news_page) . '/' . $video->slug)) }}&text={{ urlencode($video->title) }}"
                                           target="_blank">
                                           <span class="fa fa-twitter-square"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 40px;">
                        <div class="text-center">
                            <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s" data-wow-offset="100"> Latest News And Articles</h2>
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
                                        <img class="img-responsive" src="{{asset($item->news_image)}}" alt="{{$item->title}}">
                                        <h2>{{$item->title}}</h2>
                                        <div class="ss-titleDet" style="text-transform: lowercase;">
                                            {!! $item->news_details !!}
                                        </div>

                                        <div class="b-blog__posts-one-body-head-notes" style="margin-bottom: 10px">
                                            <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-calendar-o"></span>{{$item->created_at->format('d-m-Y')}}</span>
                                        </div>

                                            <a href="{{ url('news/' . Str::slug($item->news_page) . '/' . $item->slug) }}" class="btn m-btn">READ MORE<span class="fa fa-angle-right"></span></a>


                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <a href="{{url('/news/latest-news')}}" class="btn m-btn btn-primarynew newbtnall btn mt-5">More News</a>
                        </div>
                    </div>
                    <div class="" style="margin-top: 40px;">
                        <div class="row" style="    padding: 15px !important;">
                            <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Recently Viewed vehicle </h2>
                            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4"
                                data-navigation="true" data-auto-play="true" data-stop-on-hover="true"
                                data-items-desktop="3" data-items-desktop-small="3" data-items-tablet="2"
                                data-items-tablet-small="2">
                                @foreach ($product as $items)
                                    <div>
                                        <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s"
                                            data-wow-offset="150">
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
                    </div>
                </div>
                <div class="col-lg-2 text-start d-none">
                    <div class="row">
                        <aside class="b-blog__aside">
                            <div class="b-blog__aside-categories wow zoomInUp" data-wow-delay="0.3s">
                                <header class="s-lineDownLeft">
                                    <h2 class="s-titleDet">Explore Other Cars Brands</h2>
                                </header>
                                <nav>
                                    <ul class="b-blog__aside-categories-list text-left">
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
                                </nav>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
