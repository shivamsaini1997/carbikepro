@extends('frontend.layouts.main')
@section('main')
    @push('title')
        <title>Home</title>
    @endpush
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!--b-slider-->
    <section class="b-slider">
        <div id="carousel" class="slide carousel carousel-fade">
            <div class="carousel-inner">
                @php
                    $filteredBanners = $banner->filter(function ($item) {
                        return $item->pages_name == 'Home Page';
                    });
                @endphp
                @foreach ($filteredBanners as $key => $item)
                    <div class="item {{ $loop->first ? 'active' : '' }}">
                        <a href="{{ $item->banner_url }}">
                            <img src="{{ asset($item->banner) }}" alt="{{ pathinfo($item->banner, PATHINFO_FILENAME) }}" />
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
    <!--b-slider-->

    <section class="b-search">
        <div class="container">
            <form action="{{ route('search.product') }}" method="POST" class="b-search__main">
                @csrf
                <div class="b-search__main-title wow zoomInUp" data-wow-delay="0.3s">
                    <h2>UNSURE WHICH VEHICLE YOU ARE LOOKING FOR? FIND IT HERE</h2>
                </div>
                <div class="b-search__main-form wow zoomInUp" data-wow-delay="0.3s">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="m-firstSelects">
                                <div class="col-xs-6">
                                    @php
                                        // dd($categorys,$brands);
                                    @endphp
                                    <select name="vehicle" class="vehicle">
                                        <option value="">Any Vehicle</option>
                                        @foreach ($categorys as $item)
                                            @if ($item->parent_id == '0')
                                                <option value="{{ $item->category }}">{{ $item->category }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('vehicle')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xs-6">
                                    <select name="brands" class="brands">
                                        <option value="">Any Brand</option>
                                        @foreach ($brands as $item)
                                            <option value="{{ $item->brands_name }}">{{ $item->brands_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brands')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-left">
                            <div class="b-search__main-form-range">
                                <label>PRICE RANGE</label>
                                <div class="slider"></div>
                                <input type="hidden" name="min" class="j-min" />
                                <input type="hidden" name="max" class="j-max" />

                            </div>
                            <div class="b-search__main-form-submit">
                                <button type="submit" class="btn m-btn">Search the Vehicle<span
                                        class="fa fa-angle-right"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </section>
    <!--b-search-->

    {{-- Latest Cars  --}}
    <section class="b-featured latestcars">
        <div class="container">
            <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Latest Cars </h2>
            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4" data-navigation="true"
                data-auto-play="true" data-stop-on-hover="true" data-items-desktop="4" data-items-desktop-small="4"
                data-items-tablet="3" data-items-tablet-small="2">

                @foreach ($product as $items)
                    @php
                        $cars = '';
                        $allcat = '';
                        foreach ($categorys as $categoryItem) {
                            if ($categoryItem->category == 'Cars') {
                                $cars = strtolower($categoryItem->slug);
                                break;
                            }
                        }
                        foreach ($categorys as $cate) {
                            $allcat = strtolower($cate->category);
                        }

                    @endphp
                    @if ($cars == strtolower($items->category))
                        @if ($items->pages_name == 'Latest Cars')
                            <div>
                                <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s" data-wow-offset="150">
                                    <a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
                                        <img src="{{ asset($items->productimage1) }}" alt="{{ $items->product_name }}" />
                                        @if ($items->product_label == '1')
                                            <span class="m-premium">Just Launched</span>
                                        @endif
                                        @if ($items->product_label == '2')
                                            <span class="m-leasing">Electric</span>
                                        @endif
                                    </a>
                                    <h5>
                                        <a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                    </h5>
                                    <div class="b-featured__item-prices">
                                        Rs {{ $items->showroom_price }}
                                    </div>
                                    <div class="b-featured__item-count"><span
                                            class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                                    <div class="b-featured__item-links">
                                        <a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                        <a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                        <a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                    </div>
                                    <a href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                        class="btn m-btn newcardbtn">Get on road price</a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach



            </div>
            <div>
                <div>
                    <a href="{{ url('latest-cars') }}" class="btn m-btn btn-primarynew btn">View All Latest Cars</a>
                </div>
            </div>
        </div>
    </section>
    {{-- Latest Cars  --}}

    {{-- Popular Cars --}}
    <section class="b-featured pt-5">
        <div class="container">
            <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Popular Cars </h2>
            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4" data-navigation="true"
                data-auto-play="true" data-stop-on-hover="true" data-items-desktop="4" data-items-desktop-small="4"
                data-items-tablet="3" data-items-tablet-small="2">

                @foreach ($product as $items)
                    @php
                        $cars = '';
                        $allcat = '';
                        foreach ($categorys as $categoryItem) {
                            if ($categoryItem->category == 'Cars') {
                                $cars = strtolower($categoryItem->slug);
                                break;
                            }
                        }
                        foreach ($categorys as $cate) {
                            $allcat = strtolower($cate->category);
                        }

                    @endphp
                    @if ($cars == strtolower($items->category))
                        @if ($items->pages_name == 'Popular Cars')
                            <div>
                                <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s" data-wow-offset="150">
                                    <a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
                                        <img src="{{ asset($items->productimage1) }}"
                                            alt="{{ $items->product_name }}" />
                                        @if ($items->product_label == '1')
                                            <span class="m-premium">Just Launched</span>
                                        @endif
                                        @if ($items->product_label == '2')
                                            <span class="m-leasing">Electric</span>
                                        @endif
                                        @if ($items->product_label == '3')
                                            <span class="m-premium">Popular Cars</span>
                                        @endif
                                        @if ($items->product_label == '4')
                                            <span class="m-leasing">Upcoming Car</span>
                                        @endif
                                    </a>
                                    <h5><a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                    </h5>
                                    <div class="b-featured__item-prices">
                                        Rs {{ $items->showroom_price }}
                                    </div>
                                    <div class="b-featured__item-count"><span
                                            class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                                    <div class="b-featured__item-links">
                                        <a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                        <a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                        <a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                    </div>
                                    <a href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                        class="btn m-btn newcardbtn">Get on road price</a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach


            </div>
            <div>
                <a href="{{ url('popular-cars') }}" class="btn m-btn btn-primarynew btn">View All Popular Cars</a>
            </div>
        </div>
    </section>
    {{-- Popular Cars --}}

    {{-- Upcoming Cars --}}
    <section class="b-featured pt-5">
        <div class="container">
            <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Upcoming Cars </h2>
            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4" data-navigation="true"
                data-auto-play="true" data-stop-on-hover="true" data-items-desktop="4" data-items-desktop-small="4"
                data-items-tablet="3" data-items-tablet-small="2">
                @foreach ($product as $items)
                    @php
                        $cars = '';
                        $allcat = '';
                        foreach ($categorys as $categoryItem) {
                            if ($categoryItem->category == 'Cars') {
                                $cars = strtolower($categoryItem->slug);
                                break;
                            }
                        }
                        foreach ($categorys as $cate) {
                            $allcat = strtolower($cate->category);
                        }

                    @endphp
                    @if ($cars == strtolower($items->category))
                        @if ($items->pages_name == 'Upcoming Cars')
                            @php
                                // dd($items);
                            @endphp
                            <div>
                                <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s" data-wow-offset="150">
                                    <a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
                                        <img src="{{ asset($items->productimage1) }}"
                                            alt="{{ $items->product_name }}" />
                                        @if ($items->product_label == '1')
                                            <span class="m-premium">Just Launched</span>
                                        @endif
                                        @if ($items->product_label == '2')
                                            <span class="m-leasing">Electric</span>
                                        @endif
                                        @if ($items->product_label == '3')
                                            <span class="m-premium">Popular Cars</span>
                                        @endif
                                        @if ($items->product_label == '4')
                                            <span class="m-leasing">Upcoming Car</span>
                                        @endif
                                    </a>
                                    <h5><a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                    </h5>
                                    <div class="b-featured__item-prices">
                                        Rs {{ $items->showroom_price }}
                                    </div>
                                    <div class="b-featured__item-count"><span
                                            class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                                    <div class="b-featured__item-links">
                                        <a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                        <a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                        <a
                                            href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                    </div>
                                    <a href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                        class="btn m-btn newcardbtn">Get on road price</a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach


            </div>
            <div>
                <a href="{{ url('upcoming-cars') }}" class="btn m-btn btn-primarynew btn">View All Upcoming Cars</a>
            </div>
        </div>
    </section>
    {{-- Upcoming Cars --}}

    {{-- WORLD'S LEADING CAR DEALER --}}
    <section class="b-welcome">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-offset-2 col-sm-6 col-xs-12">
                    <div class="b-welcome__text wow fadeInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                        <h2>WORLD'S LEADING CAR DEALER</h2>
                        <h3>WELCOME TO AUTOCLUB</h3>
                        <p>Curabitur libero. Donec facilisis velit eudsl est. Phasellus consequat. Aenean vita quam. Vivamus
                            et nunc. Nunc consequat sem velde metus imperdiet lacinia. Dui estter neque molestie necd
                            dignissim ac hendrerit quis purus. Etiam sit amet vec convallis massa scelerisque mattis. Sed
                            placerat leo nec.</p>
                        <p>Ipsum midne ultrices magn eu tempor quam dolor eustrl sem. Donec quis dolel Donec pede quam
                            placerat alterl tristique faucibus posuere lobortis.</p>
                        <ul>
                            <li><span class="fa fa-check"></span>Donec facilisis velit eu est phasellus consequat </li>
                            <li><span class="fa fa-check"></span>Aenean vitae quam. Vivamus et nunc nunc consequat</li>
                            <li><span class="fa fa-check"></span>Sem vel metus imperdiet lacinia enean </li>
                            <li><span class="fa fa-check"></span>Dapibus aliquam augue fusce eleifend quisque tels</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="b-welcome__services wow fadeInRight" data-wow-delay="0.3s" data-wow-offset="100">
                        <div class="row">
                            <div class="col-xs-6 m-padding">
                                <div class="b-welcome__services-auto">
                                    <div class="b-welcome__services-img m-auto">
                                        <span class="fa fa-cab"></span>
                                    </div>
                                    <h3>AUTO LOANS</h3>
                                </div>
                            </div>
                            <div class="col-xs-6 m-padding">
                                <div class="b-welcome__services-trade">
                                    <div class="b-welcome__services-img m-trade">
                                        <span class="fa fa-male"></span>
                                    </div>
                                    <h3>Trade-Ins</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 text-center">
                                <span class="b-welcome__services-circle"></span>
                            </div>
                            <div class="col-xs-6 m-padding">
                                <div class="b-welcome__services-buying">
                                    <div class="b-welcome__services-img m-buying">
                                        <span class="fa fa-book"></span>
                                    </div>
                                    <h3>Buying guide</h3>
                                </div>
                            </div>
                            <div class="col-xs-6 m-padding">
                                <div class="b-welcome__services-support">
                                    <div class="b-welcome__services-img m-support">
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="45px"
                                            height="45px" viewBox="0 0 612 612"
                                            style="enable-background:new 0 0 612 612;" xml:space="preserve">
                                            <g>
                                                <path d="M257.938,336.072c0,17.355-14.068,31.424-31.423,31.424c-17.354,0-31.422-14.068-31.422-31.424
                                                                        c0-17.354,14.068-31.423,31.422-31.423C243.87,304.65,257.938,318.719,257.938,336.072z M385.485,304.65
                                                                        c-17.354,0-31.423,14.068-31.423,31.424c0,17.354,14.069,31.422,31.423,31.422c17.354,0,31.424-14.068,31.424-31.422
                                                                        C416.908,318.719,402.84,304.65,385.485,304.65z M612,318.557v59.719c0,29.982-24.305,54.287-54.288,54.287h-39.394
                                                                        C479.283,540.947,379.604,606.412,306,606.412s-173.283-65.465-212.318-173.85H54.288C24.305,432.562,0,408.258,0,378.275v-59.719
                                                                        c0-20.631,11.511-38.573,28.46-47.758c0.569-84.785,25.28-151.002,73.553-196.779C149.895,28.613,218.526,5.588,306,5.588
                                                                        c87.474,0,156.105,23.025,203.987,68.43c48.272,45.777,72.982,111.995,73.553,196.779C600.489,279.983,612,297.925,612,318.557z
                                                                        M497.099,336.271c0-13.969-0.715-27.094-1.771-39.812c-24.093-22.043-67.832-38.769-123.033-44.984
                                                                        c7.248,8.15,13.509,18.871,17.306,32.983c-33.812-26.637-100.181-20.297-150.382-79.905c-2.878-3.329-5.367-6.51-7.519-9.417
                                                                        c-0.025-0.035-0.053-0.062-0.078-0.096l0.006,0.002c-8.931-12.078-11.976-19.262-12.146-11.31
                                                                        c-1.473,68.513-50.034,121.925-103.958,129.46c-0.341,7.535-0.62,15.143-0.62,23.08c0,28.959,4.729,55.352,12.769,79.137
                                                                        c30.29,36.537,80.312,46.854,124.586,49.59c8.219-13.076,26.66-22.205,48.136-22.205c29.117,0,52.72,16.754,52.72,37.424
                                                                        c0,20.668-23.604,37.422-52.72,37.422c-22.397,0-41.483-9.93-49.122-23.912c-30.943-1.799-64.959-7.074-95.276-21.391
                                                                        C198.631,535.18,264.725,568.41,306,568.41C370.859,568.41,497.099,486.475,497.099,336.271z M550.855,264.269
                                                                        C547.4,116.318,462.951,38.162,306,38.162S64.601,116.318,61.145,264.269h20.887c7.637-49.867,23.778-90.878,48.285-122.412
                                                                        C169.37,91.609,228.478,66.13,306,66.13c77.522,0,136.63,25.479,175.685,75.727c24.505,31.533,40.647,72.545,48.284,122.412
                                                                        H550.855L550.855,264.269z" />
                                            </g>
                                        </svg>

                                    </div>
                                    <h3>24/7 support</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- WORLD'S LEADING CAR DEALER --}}

    {{-- Bikes --}}
    <section class="b-featured pt-5">
        <div class="container">
            <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Bikes </h2>
            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4" data-navigation="true"
                data-auto-play="true" data-stop-on-hover="true" data-items-desktop="4" data-items-desktop-small="4"
                data-items-tablet="3" data-items-tablet-small="2">
                @foreach ($product as $items)
                    @php
                        $cars = '';
                        $allcat = '';
                        foreach ($categorys as $categoryItem) {
                            if ($categoryItem->category == 'Bikes') {
                                $cars = strtolower($categoryItem->slug);
                                break;
                            }
                        }
                        foreach ($categorys as $cate) {
                            $allcat = strtolower($cate->category);
                        }

                    @endphp
                    @if ($cars == strtolower($items->category))
                        <div>
                            <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s" data-wow-offset="150">
                                <a href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
                                    <img src="{{ asset($items->productimage1) }}" alt="{{ $items->product_name }}" />
                                    @if ($items->product_label == '1')
                                        <span class="m-premium">Just Launched</span>
                                    @endif
                                    @if ($items->product_label == '2')
                                        <span class="m-leasing">Electric</span>
                                    @endif
                                    @if ($items->product_label == '3')
                                        <span class="m-premium">Popular Bike</span>
                                    @endif
                                    @if ($items->product_label == '4')
                                        <span class="m-leasing">Upcoming Bike</span>
                                    @endif
                                </a>
                                <h5><a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                </h5>
                                <div class="b-featured__item-prices">
                                    Rs {{ $items->showroom_price }}
                                </div>
                                <div class="b-featured__item-count"><span
                                        class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                                <div class="b-featured__item-links">
                                    <a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                    <a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                    <a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                </div>
                                <a href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                    class="btn m-btn newcardbtn">Get on road price</a>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
            <div>
                <a href="{{ url('new-bikes') }}" class="btn m-btn btn-primarynew btn">View All Bikes</a>
            </div>
        </div>
    </section>
    {{-- Bikes --}}


    {{-- Scooters --}}
    <section class="b-featured pt-5">
        <div class="container">
            <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Scooters </h2>
            <div id="carousel-small" class="owl-carousel enable-owl-carousel" data-items="4" data-navigation="true"
                data-auto-play="true" data-stop-on-hover="true" data-items-desktop="4" data-items-desktop-small="4"
                data-items-tablet="3" data-items-tablet-small="2">
                @foreach ($product as $items)
                    @php
                        $cars = '';
                        $allcat = '';
                        foreach ($categorys as $categoryItem) {
                            if ($categoryItem->category == 'Scooters') {
                                $cars = strtolower($categoryItem->slug);
                                break;
                            }
                        }
                        foreach ($categorys as $cate) {
                            $allcat = strtolower($cate->category);
                        }

                    @endphp
                    @if ($cars == strtolower($items->category))
                        <div>
                            <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s" data-wow-offset="150">
                                <a href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
                                    <img src="{{ asset($items->productimage1) }}" alt="{{ $items->product_name }}" />
                                    @if ($items->product_label == '1')
                                        <span class="m-premium">Just Launched</span>
                                    @endif
                                    @if ($items->product_label == '2')
                                        <span class="m-leasing">Electric</span>
                                    @endif
                                    @if ($items->product_label == '3')
                                        <span class="m-premium">Popular Scooter</span>
                                    @endif
                                    @if ($items->product_label == '4')
                                        <span class="m-leasing">Upcoming Scooter</span>
                                    @endif
                                </a>
                                <h5><a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                </h5>
                                <div class="b-featured__item-prices">
                                    Rs {{ $items->showroom_price }}
                                </div>
                                <div class="b-featured__item-count"><span
                                        class="fa fa-tachometer"></span>{{ $items->top_speed }}</div>
                                <div class="b-featured__item-links">
                                    <a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                    <a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                    <a
                                        href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                </div>
                                <a href="{{ url($cars . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                    class="btn m-btn newcardbtn">Get on road price</a>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
            <div>
                <a href="{{ url('new-scooters') }}" class="btn m-btn btn-primarynew btn">View All Scooters</a>
            </div>
        </div>
    </section>
    {{-- Scooters --}}


    {{-- Explore Vehicles By Brands --}}
    <section class="b-auto">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Explore Vehicles By Brands </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="b-auto__main">
                        <div class="col-sm-12">
                            <a href="#" class="b-auto__main-toggle s-lineDownCenter m-active j-tab wow zoomInLeft"
                                data-wow-delay="0.3s" data-wow-offset="100" data-to="#first">Cars Brands</a>
                            <a href="#" class="b-auto__main-toggle j-tab wow zoomInUp" data-wow-delay="0.3s"
                                data-wow-offset="100" data-to="#second">Bikes Brands</a>
                            <a href="#" class="b-auto__main-toggle j-tab wow zoomInUp" data-wow-delay="0.3s"
                                data-wow-offset="100" data-to="#three">Scooters Brands</a>
                        </div>
                    </div>
                    <div id="first">
                        <div class="row">
                            @php
                                $carsBrands = $brands->where('category', 'Cars')->take(12);
                            @endphp
                            @foreach ($carsBrands as $item)
                                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="brand-img">
                                        <a href="{{ url(strtolower($item->category) . '/' . $item->brands_url) }}"
                                            class="wow slideInUp text-center" data-wow-delay="0.3s"
                                            data-wow-offset="100">
                                            <img class="img-responsive" src="{{ asset($item->brands_image) }}"
                                                alt="{{ $item->brands_name }}" />
                                            <h2 class="text-center">{{ $item->brands_name }}</h2>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-sm-12">
                                <div>
                                    @php
                                        $carsButtonDisplayed = false; // Flag variable
                                    @endphp

                                    @foreach ($brands as $item)
                                        @if ($item->category == 'Cars' && !$carsButtonDisplayed)
                                            <a href="{{ route('brands', ['category' => 'cars']) }}"
                                                class="btn m-btn btn-primarynew btn">View All Cars Brands</a>
                                            @php
                                                $carsButtonDisplayed = true; // Set the flag to true after displaying the button
                                            @endphp
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="second">
                        <div class="row">
                            @php
                                $bikesBrands = $brands->where('category', 'Bikes')->take(12);
                            @endphp

                            @foreach ($bikesBrands as $item)
                                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="brand-img">
                                        <a href="{{ url(strtolower($item->category) . '/' . $item->brands_url) }}"
                                            class="wow slideInUp text-center" data-wow-delay="0.3s"
                                            data-wow-offset="100">
                                            <img class="img-responsive" src="{{ asset($item->brands_image) }}"
                                                alt="{{ $item->brands_name }}" />
                                            <h2 class="text-center">{{ $item->brands_name }}</h2>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-sm-12">
                                <div>
                                    @php
                                        $carsButtonDisplayed = false; // Flag variable
                                    @endphp

                                    @foreach ($brands as $item)
                                        @if ($item->category == 'Bikes' && !$carsButtonDisplayed)
                                            <a href="{{ route('brands', ['category' => 'bikes']) }}"
                                                class="btn m-btn btn-primarynew btn">View All Bikes Brands</a>
                                            @php
                                                $carsButtonDisplayed = true; // Set the flag to true after displaying the button
                                            @endphp
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="three">
                        <div class="row">
                            @php
                                $scootersBrands = $brands->where('category', 'Scooters')->take(12);
                            @endphp

                            @foreach ($scootersBrands as $item)
                                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="brand-img">
                                        <a href="{{ url(strtolower($item->category) . '/' . $item->brands_url) }}"
                                            class="wow slideInUp text-center" data-wow-delay="0.3s"
                                            data-wow-offset="100">
                                            <img class="img-responsive" src="{{ asset($item->brands_image) }}"
                                                alt="{{ $item->brands_name }}" />
                                            <h2 class="text-center">{{ $item->brands_name }}</h2>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-sm-12">
                                <div>
                                    <div>
                                        @php
                                            $carsButtonDisplayed = false; // Flag variable
                                        @endphp

                                        @foreach ($brands as $item)
                                            @if ($item->category == 'Scooters' && !$carsButtonDisplayed)
                                                <a href="{{ route('brands', ['category' => 'scooters']) }}"
                                                    class="btn m-btn btn-primarynew btn">View All Scooters Brands</a>
                                                @php
                                                    $carsButtonDisplayed = true; // Set the flag to true after displaying the button
                                                @endphp
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>
    {{-- Explore Vehicles By Brands --}}

    <section class="b-count ">
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-xs-12 percent-blocks m-main" data-waypoint-scroll="true">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div class="b-count__item">
                                <div class="b-count__item-circle">
                                    <span class="fa fa-car"></span>
                                </div>
                                <div class="chart" data-percent="5000">
                                    <h2 class="percent">5000</h2>
                                </div>
                                <h5>vehicles in stock</h5>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="b-count__item">
                                <div class="b-count__item-circle">
                                    <span class="fa fa-users"></span>
                                </div>
                                <div class="chart" data-percent="3100">
                                    <h2 class="percent">3100</h2>
                                </div>
                                <h5>HAPPY CUSTOMER REVIEWS</h5>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="b-count__item">
                                <div class="b-count__item-circle">
                                    <span class="fa fa-building-o"></span>
                                </div>
                                <div class="chart" data-percent="54">
                                    <h2 class="percent">54</h2>
                                </div>
                                <h5>DEALER BRANCHES</h5>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="b-count__item j-last">
                                <div class="b-count__item-circle">
                                    <span class="fa fa-suitcase"></span>
                                </div>
                                <div class="chart" data-percent="547">
                                    <h2 class="percent">547</h2>
                                </div>
                                <h5>FREE PARTS GIVEN</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--b-count-->


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
                            <img class="img-responsive" src="{{ asset($item->news_image) }}"
                                alt="{{ $item->title }}">
                            <h2>{{ $item->title }}</h2>
                            <div class="ss-titleDet" style="text-transform: lowercase;">
                                {!! $item->news_details !!}
                            </div>
                            <div class="b-blog__posts-one-body-head-notes" style="margin-bottom: 10px">
                                <span class="b-blog__posts-one-body-head-notes-note">
                                    <span class="fa fa-calendar-o"></span>{{ $item->created_at->format('d-m-Y') }}</span>
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
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> --}}

    <script>
        // Slider Initialization
        // $(document).ready(function () {
        //     $(".slider").slider({
        //         range: true,
        //         min: 50000,
        //         max: 10000000,
        //         values: [50000, 10000000],
        //         slide: function (event, ui) {
        //             $(".min").text(ui.values[0].toLocaleString());
        //             $(".max").text(ui.values[1].toLocaleString());
        //         },
        //         stop: function (event, ui) {
        //             $('input.j-min').val(ui.values[0]);
        //             $('input.j-max').val(ui.values[1]);
        //         }
        //     });

        //     // Set initial display values
        //     $(".min").text($(".slider").slider("values", 0).toLocaleString());
        //     $(".max").text($(".slider").slider("values", 1).toLocaleString());
        //     $('input.j-min').val($(".slider").slider("values", 0));
        //     $('input.j-max').val($(".slider").slider("values", 1));
        // });


        //     
    </script>
@endsection
